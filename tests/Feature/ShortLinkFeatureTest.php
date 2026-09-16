<?php

namespace Tests\Feature;

use App\Models\ShortLink;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ShortLinkFeatureTest extends TestCase
{
    use RefreshDatabase;

    protected User $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create([
            'username' => 'admin',
            'email' => 'admin@pikrrequestman1tpp.my.id',
            'password' => 'RequestLink2026!',
        ]);
    }

    public function test_login_screen_can_be_rendered(): void
    {
        $response = $this->get('/login');
        $response->assertStatus(200);
        $response->assertSee('REQUEST LINK');
        $response->assertSee('PIK-R REQUEST');
    }

    public function test_user_can_login_using_username(): void
    {
        $response = $this->post('/login', [
            'login' => 'admin',
            'password' => 'RequestLink2026!',
        ]);

        $this->assertAuthenticatedAs($this->user);
        $response->assertRedirect('/dashboard');
    }

    public function test_user_can_login_using_email(): void
    {
        $response = $this->post('/login', [
            'login' => 'admin@pikrrequestman1tpp.my.id',
            'password' => 'RequestLink2026!',
        ]);

        $this->assertAuthenticatedAs($this->user);
        $response->assertRedirect('/dashboard');
    }

    public function test_dashboard_can_be_rendered_for_authenticated_user(): void
    {
        $response = $this->actingAs($this->user)->get('/dashboard');
        $response->assertStatus(200);
        $response->assertSee('Dashboard Ringkasan');
        $response->assertSee('Total Short Link');
    }

    public function test_user_can_create_short_link_with_custom_alias(): void
    {
        $response = $this->actingAs($this->user)->post('/links', [
            'name' => 'Pendaftaran Duta Genre 2026',
            'destination_url' => 'https://docs.google.com/forms/d/example',
            'code' => 'duta-genre',
            'bridge_enabled' => '0',
            'qr_enabled' => '1',
            'is_active' => '1',
        ]);

        $response->assertRedirect('/links');
        $this->assertDatabaseHas('short_links', [
            'code' => 'duta-genre',
            'name' => 'Pendaftaran Duta Genre 2026',
            'is_active' => true,
        ]);
    }

    public function test_user_can_create_short_link_with_auto_generated_alias(): void
    {
        $response = $this->actingAs($this->user)->post('/links', [
            'name' => 'Dokumentasi Kegiatan',
            'destination_url' => 'https://drive.google.com/drive/folders/example',
            'code' => '',
            'bridge_enabled' => '0',
            'qr_enabled' => '1',
            'is_active' => '1',
        ]);

        $response->assertRedirect('/links');
        $link = ShortLink::where('name', 'Dokumentasi Kegiatan')->first();
        $this->assertNotNull($link);
        $this->assertEquals(6, strlen($link->code));
    }

    public function test_reserved_words_are_rejected_as_alias(): void
    {
        $response = $this->actingAs($this->user)->post('/links', [
            'name' => 'Link Terlarang',
            'destination_url' => 'https://example.com',
            'code' => 'login',
        ]);

        $response->assertSessionHasErrors('code');
    }

    public function test_active_direct_short_link_redirects_and_increments_clicks(): void
    {
        $link = ShortLink::create([
            'user_id' => $this->user->id,
            'name' => 'Tautan Langsung',
            'code' => 'test-direct',
            'destination_url' => 'https://example.com/tujuan',
            'bridge_enabled' => false,
            'qr_enabled' => true,
            'is_active' => true,
            'clicks_count' => 0,
        ]);

        $response = $this->get('/test-direct');
        $response->assertRedirect('https://example.com/tujuan');

        $link->refresh();
        $this->assertEquals(1, $link->clicks_count);
        $this->assertDatabaseHas('link_clicks', [
            'short_link_id' => $link->id,
        ]);
    }

    public function test_bridge_page_is_shown_when_bridge_enabled(): void
    {
        $link = ShortLink::create([
            'user_id' => $this->user->id,
            'name' => 'Tautan Bridge',
            'code' => 'test-bridge',
            'destination_url' => 'https://example.com/bridge-dest',
            'bridge_enabled' => true,
            'qr_enabled' => true,
            'is_active' => true,
            'clicks_count' => 0,
        ]);

        $response = $this->get('/test-bridge');
        $response->assertStatus(200);
        $response->assertSee('Tautan Bridge');
        $response->assertSee('Buka Tautan Langsung');
    }

    public function test_inactive_short_link_shows_inactive_page(): void
    {
        $link = ShortLink::create([
            'user_id' => $this->user->id,
            'name' => 'Tautan Nonaktif',
            'code' => 'test-inactive',
            'destination_url' => 'https://example.com/tujuan',
            'bridge_enabled' => false,
            'qr_enabled' => true,
            'is_active' => false,
            'clicks_count' => 0,
        ]);

        $response = $this->get('/test-inactive');
        $response->assertStatus(200);
        $response->assertSee('Tautan Tidak Aktif');
        $link->refresh();
        $this->assertEquals(0, $link->clicks_count);
    }

    public function test_qr_code_page_can_be_rendered(): void
    {
        $link = ShortLink::create([
            'user_id' => $this->user->id,
            'name' => 'Tautan QR',
            'code' => 'test-qr',
            'destination_url' => 'https://example.com',
            'bridge_enabled' => false,
            'qr_enabled' => true,
            'is_active' => true,
            'clicks_count' => 0,
        ]);

        $response = $this->actingAs($this->user)->get("/links/{$link->id}/qr");
        $response->assertStatus(200);
        $response->assertSee('QR Code Resmi');
        $response->assertSee('Unduh Format PNG');
        $response->assertSee('Unduh Format SVG');
    }
}
