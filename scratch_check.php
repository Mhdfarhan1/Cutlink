<?php
$pdo = new PDO('mysql:host=127.0.0.1;port=3306;dbname=cutlink_db', 'root', '');
$stmt = $pdo->query('SELECT id, name, code, bridge_enabled, is_active, destination_url FROM short_links');
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    echo "ID: {$row['id']} | Name: {$row['name']} | Code: {$row['code']} | Bridge: {$row['bridge_enabled']} | Active: {$row['is_active']} | Dest: {$row['destination_url']}\n";
}
