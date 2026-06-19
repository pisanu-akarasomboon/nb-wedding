<?php
require __DIR__ . '/config.php';
require __DIR__ . '/auth.php';

$rsvps = $pdo->query("SELECT r.*, g.guest_name AS invited_name FROM rsvps r LEFT JOIN guests g ON r.guest_id = g.id ORDER BY r.created_at DESC")->fetchAll();
$total = count($rsvps);
$attending = 0; $not = 0; $people = 0;
foreach($rsvps as $r){ if($r['attendance']==='attending'){ $attending++; $people += (int)$r['guests']; } else { $not++; } }
?>
<!doctype html><html lang="th"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1"><title>RSVP Admin</title><script src="https://cdn.tailwindcss.com"></script></head>
<body class="bg-[#10140f] text-white p-6"><div class="max-w-7xl mx-auto">
<div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-8"><div><h1 class="text-4xl font-bold">RSVP Dashboard</h1><p class="text-white/50 mt-2">รายชื่อผู้ตอบรับร่วมงาน</p></div><a href="admin_guest.php" class="rounded-full bg-[#aab08d] px-5 py-3 text-[#10140f] font-bold">สร้างลิงก์แขก</a><center><a 
href="logout.php"
class="bg-red-600 text-white px-5 py-3 rounded-xl">

Logout

</a></div>
<div class="grid md:grid-cols-4 gap-4 mb-8"><div class="bg-white/10 p-6 rounded-3xl"><p class="text-white/50">ทั้งหมด</p><p class="text-4xl font-bold mt-2"><?= $total ?></p></div><div class="bg-green-700 p-6 rounded-3xl"><p class="text-white/70">มา</p><p class="text-4xl font-bold mt-2"><?= $attending ?></p></div><div class="bg-red-700 p-6 rounded-3xl"><p class="text-white/70">ไม่มา</p><p class="text-4xl font-bold mt-2"><?= $not ?></p></div><div class="bg-[#aab08d] text-[#10140f] p-6 rounded-3xl"><p class="opacity-70">จำนวนคนรวม</p><p class="text-4xl font-bold mt-2"><?= $people ?></p></div></div>
<div class="bg-white rounded-3xl overflow-x-auto text-black"><table class="w-full min-w-[1000px]"><thead class="bg-[#aab08d]"><tr><th class="p-3 text-left">ชื่อจากลิงก์</th><th class="p-3 text-left">ชื่อผู้ตอบ</th><th class="p-3">สถานะ</th><th class="p-3">จำนวน</th><th class="p-3 text-left">อาหาร</th><th class="p-3 text-left">คำอวยพร</th><th class="p-3">เวลา</th></tr></thead><tbody>
<?php foreach($rsvps as $r): ?><tr class="border-b"><td class="p-3"><?= h($r['invited_name'] ?: '-') ?></td><td class="p-3"><?= h($r['guest_name']) ?></td><td class="p-3 text-center"><?= h($r['attendance']) ?></td><td class="p-3 text-center"><?= h($r['guests']) ?></td><td class="p-3"><?= h($r['dietary']) ?></td><td class="p-3"><?= h($r['message']) ?></td><td class="p-3 text-sm"><?= h($r['created_at']) ?></td></tr><?php endforeach; ?>
</tbody></table></div>
</center></div></body>
</html>

