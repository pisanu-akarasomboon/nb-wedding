<?php
// NB-Wedding Database Config
$DB_HOST = 'localhost';
$DB_NAME = 'wedding_db';
$DB_USER = 'root';
$DB_PASS = '';

try {
    $pdo = new PDO(
        "mysql:host={$DB_HOST};dbname={$DB_NAME};charset=utf8mb4",
        $DB_USER,
        $DB_PASS,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ]
    );
} catch (PDOException $e) {
    http_response_code(500);
    die('Database connection failed. Please check config.php and import database.sql');
}

function h($value) {
    return htmlspecialchars((string)$value, ENT_QUOTES, 'UTF-8');
}
// DELETE
if (isset($_GET['delete'])) {

    $id = (int)$_GET['delete'];

    $stmt = $pdo->prepare("
        DELETE FROM guests
        WHERE id = ?
    ");

    $stmt->execute([$id]);

    header("Location: admin_guest.php");
    exit;
}

// UPDATE
if (isset($_POST['edit_id'])) {

    $id = (int)$_POST['edit_id'];

    $guestName = trim($_POST['edit_name']);

    if ($guestName !== '') {

        $stmt = $pdo->prepare("
            UPDATE guests
            SET guest_name=?
            WHERE id=?
        ");

        $stmt->execute([
            $guestName,
            $id
        ]);
    }

    header("Location: admin_guest.php");
    exit;
}