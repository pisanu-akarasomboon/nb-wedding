<?php
require __DIR__ . '/config.php';
require __DIR__ . '/auth.php';

$createdLink = '';
$notice = '';

function build_guest_link($token) {
    $folder = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\');
    $host = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'];
    return $host . $folder . '/index.php?token=' . urlencode($token);
}

/* DELETE */
if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];

    if ($id > 0) {
        $stmt = $pdo->prepare("DELETE FROM guests WHERE id = ?");
        $stmt->execute([$id]);
    }

    header("Location: admin_guest.php");
    exit;
}

/* UPDATE */
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_id'])) {
    $id = (int)($_POST['edit_id'] ?? 0);
    $guestName = trim($_POST['edit_name'] ?? '');

    if ($id > 0 && $guestName !== '') {
        $stmt = $pdo->prepare("UPDATE guests SET guest_name = ? WHERE id = ?");
        $stmt->execute([$guestName, $id]);
        $notice = 'แก้ไขชื่อเรียบร้อยแล้ว';
    }
}

/* CREATE */
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['guest_name'])) {
    $guestName = trim($_POST['guest_name'] ?? '');

    if ($guestName !== '') {
        $token = bin2hex(random_bytes(8));

        $stmt = $pdo->prepare("INSERT INTO guests (guest_name, token) VALUES (?, ?)");
        $stmt->execute([$guestName, $token]);

        $createdLink = build_guest_link($token);
        $notice = 'สร้างลิงก์เรียบร้อยแล้ว';
    }
}

$guests = $pdo->query("SELECT * FROM guests ORDER BY id DESC")->fetchAll();
?>
<!doctype html>
<html lang="th">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Guest Link Admin</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-[#10140f] text-white p-6">
  <div class="max-w-6xl mx-auto">

    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-8">
      <div>
        <h1 class="text-4xl font-bold">Guest Invitation Links</h1>
        <p class="text-white/50 mt-2">สร้างลิงก์เฉพาะแขกแต่ละท่าน</p>
      </div>

      <div class="flex gap-3">
        <a href="index.php" class="rounded-full bg-white/10 px-5 py-3 text-sm">
          หน้าเว็บ
        </a>
        <a href="admin.php" class="rounded-full bg-[#aab08d] px-5 py-3 text-sm text-[#10140f] font-bold">
          ดู RSVP
        </a>
      </div>
    </div>

    <?php if ($notice): ?>
      <div class="mb-6 rounded-2xl bg-[#aab08d] p-4 text-[#10140f] font-bold">
        <?= h($notice) ?>
      </div>
    <?php endif; ?>

    <form method="post" class="bg-white/10 p-6 rounded-3xl mb-8">
      <label class="block mb-3 text-sm text-white/60">
        ชื่อที่ต้องการแสดงบนซอง
      </label>

      <div class="flex flex-col md:flex-row gap-3">
        <input
          name="guest_name"
          required
          class="w-full rounded-2xl px-5 py-4 text-black"
          placeholder="เช่น คุณสมชาย และครอบครัว"
        >

        <button class="rounded-2xl bg-[#aab08d] px-8 py-4 text-[#10140f] font-bold">
          Generate Link
        </button>
      </div>
    </form>

    <?php if ($createdLink): ?>
      <div class="bg-[#aab08d] text-[#10140f] p-5 rounded-2xl mb-8">
        <p class="font-bold mb-2">ลิงก์ที่สร้างแล้ว</p>

        <div class="flex flex-col md:flex-row gap-3">
          <input
            id="createdLink"
            class="w-full px-4 py-3 rounded-xl"
            value="<?= h($createdLink) ?>"
            readonly
            onclick="this.select()"
          >

          <button
            onclick="copyLink('createdLink')"
            class="rounded-xl bg-[#10140f] px-6 py-3 text-white font-bold"
          >
            Copy
          </button>
        </div>
      </div>
    <?php endif; ?>

    <div class="bg-white rounded-3xl overflow-x-auto text-black">
      <table class="w-full min-w-[900px]">
        <thead class="bg-[#aab08d]">
          <tr>
            <th class="p-3 text-left">ชื่อแขก</th>
            <th class="p-3 text-left">ลิงก์</th>
            <th class="p-3 text-left">วันที่สร้าง</th>
            <th class="p-3 text-center">Action</th>
          </tr>
        </thead>

        <tbody>
          <?php foreach ($guests as $g): ?>
            <?php $link = build_guest_link($g['token']); ?>

            <tr class="border-b">
              <td class="p-3 align-top">
                <form method="post" class="flex gap-2">
                  <input
                    type="hidden"
                    name="edit_id"
                    value="<?= h($g['id']) ?>"
                  >

                  <input
                    name="edit_name"
                    value="<?= h($g['guest_name']) ?>"
                    class="border rounded-lg px-3 py-2 w-full"
                  >

                  <button class="bg-green-600 text-white px-4 rounded-lg">
                    Save
                  </button>
                </form>
              </td>

              <td class="p-3 align-top">
                <div class="flex gap-2">
                  <input
                    id="link<?= h($g['id']) ?>"
                    class="w-full border px-3 py-2 rounded-lg"
                    value="<?= h($link) ?>"
                    readonly
                    onclick="this.select()"
                  >

                  <button
                    type="button"
                    onclick="copyLink('link<?= h($g['id']) ?>')"
                    class="bg-blue-600 text-white px-4 rounded-lg"
                  >
                    Copy
                  </button>
                </div>
              </td>

              <td class="p-3 align-top">
                <?= h($g['created_at']) ?>
              </td>

              <td class="p-3 text-center align-top">
                <a
                  href="?delete=<?= h($g['id']) ?>"
                  onclick="return confirm('ต้องการลบลิงก์นี้ใช่ไหม?')"
                  class="inline-flex h-10 w-10 items-center justify-center rounded-full bg-red-600 text-white font-bold"
                  title="Delete"
                >
                  ✕
                </a>
              </td>
            </tr>
          <?php endforeach; ?>

          <?php if (empty($guests)): ?>
            <tr>
              <td colspan="4" class="p-8 text-center text-black/50">
                ยังไม่มีรายชื่อแขก
              </td>
            </tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>

  </div>

  <script>
    async function copyLink(id) {
      const el = document.getElementById(id);
      if (!el) return;

      el.select();
      el.setSelectionRange(0, 99999);

      try {
        await navigator.clipboard.writeText(el.value);
        alert('คัดลอกลิงก์แล้ว');
      } catch (err) {
        document.execCommand('copy');
        alert('คัดลอกลิงก์แล้ว');
      }
    }
  </script>
</body>
</html>