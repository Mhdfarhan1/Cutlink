<?php

namespace App\Services;

use chillerlan\QRCode\Output\QRGdImagePNG;
use chillerlan\QRCode\Output\QRMarkupSVG;
use chillerlan\QRCode\QRCode;
use chillerlan\QRCode\QROptions;

class QrCodeService
{
    /**
     * Hasilkan QR Code dalam format inline markup SVG.
     */
    public function svg(string $data, int $scale = 6): string
    {
        $options = new QROptions([
            'outputInterface' => QRMarkupSVG::class,
            'outputBase64' => false,
            'svgAddXmlHeader' => false,
            'scale' => $scale,
            'addQuietzone' => true,
        ]);

        return (new QRCode($options))->render($data);
    }

    /**
     * Hasilkan QR Code dalam format data URI PNG (Base64).
     */
    public function png(string $data, int $scale = 10): string
    {
        $options = new QROptions([
            'outputInterface' => QRGdImagePNG::class,
            'outputBase64' => true,
            'scale' => $scale,
            'addQuietzone' => true,
        ]);

        return (new QRCode($options))->render($data);
    }

    /**
     * Hasilkan raw binary PNG untuk di-download langsung.
     */
    public function rawPng(string $data, int $scale = 12): string
    {
        $options = new QROptions([
            'outputInterface' => QRGdImagePNG::class,
            'outputBase64' => false,
            'scale' => $scale,
            'addQuietzone' => true,
        ]);

        return (new QRCode($options))->render($data);
    }
}
