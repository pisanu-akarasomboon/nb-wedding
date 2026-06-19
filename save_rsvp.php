<?php
header('Content-Type: application/json; charset=utf-8');
require __DIR__ . '/config.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Method not allowed'], JSON_UNESCAPED_UNICODE);
    exit;
}

$guestId = !empty($_POST['guest_id']) ? (int)$_POST['guest_id'] : null;
$guestName = trim($_POST['guest_name'] ?? '');
$attendance = $_POST['attendance'] ?? 'attending';
$guests = max(1, min(20, (int)($_POST['guests'] ?? 1)));
$dietary = trim($_POST['dietary'] ?? '');
$message = trim($_POST['message'] ?? '');

if ($guestName === '') {
    http_response_code(422);
    echo json_encode(['success' => false, 'message' => 'กรุณากรอกชื่อ - นามสกุล'], JSON_UNESCAPED_UNICODE);
    exit;
}

if (!in_array($attendance, ['attending', 'not_attending'], true)) {
    $attendance = 'attending';
}

try {
    $stmt = $pdo->prepare("INSERT INTO rsvps (guest_id, guest_name, attendance, guests, dietary, message, ip_address, user_agent) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->execute([
        $guestId,
        $guestName,
        $attendance,
        $guests,
        $dietary,
        $message,
        $_SERVER['REMOTE_ADDR'] ?? null,
        substr($_SERVER['HTTP_USER_AGENT'] ?? '', 0, 255),
    ]);

    echo json_encode(['success' => true, 'message' => 'ขอบคุณครับ ระบบได้รับข้อมูล RSVP เรียบร้อยแล้ว'], JSON_UNESCAPED_UNICODE);
} catch (Throwable $e) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'ไม่สามารถบันทึกข้อมูลได้: '.$e->getMessage()], JSON_UNESCAPED_UNICODE);
}
