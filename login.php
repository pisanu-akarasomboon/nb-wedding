<?php
session_start();

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $password = trim($_POST['password'] ?? '');

    if ($password === 'nb@1234') {

        $_SESSION['admin_login'] = true;

        header('Location: admin.php');
        exit;
    }

    $error = 'รหัสผ่านไม่ถูกต้อง';
}
?>

<!doctype html>

<html lang="th">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Admin Login</title>
<script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-[#10140f] flex items-center justify-center min-h-screen">

<div class="bg-white p-8 rounded-3xl w-full max-w-md shadow-2xl">

<h1 class="text-3xl font-bold mb-2">
Admin Login
</h1>

<p class="text-gray-500 mb-6">
NB Wedding Management
</p>

<?php if($error): ?>

<div class="bg-red-100 text-red-700 p-3 rounded-xl mb-4">
<?= htmlspecialchars($error) ?>
</div>
<?php endif; ?>

<form method="post">

<input
type="password"
name="password"
placeholder="Password"
required
class="w-full border rounded-xl px-4 py-3 mb-4">

<button
class="w-full bg-[#6c7450] text-white py-3 rounded-xl font-bold hover:bg-[#586042]">

Login

</button>

</form>

</div>

</body>
</html>
