<?php
session_start();
$error = $_SESSION['error'] ?? '';
unset($_SESSION['error']);
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Guru</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<body class="min-h-screen flex items-center justify-center bg-gradient-to-r from-indigo-600 to-blue-600">

    <div class="w-full max-w-sm">
        <div class="bg-white rounded-md shadow-lg px-6 py-5">
            <div class="text-center mb-4">
                <h1 class="text-3xl font-semibold text-black flex items-center justify-center gap-2">
                    <i class="fa-solid fa-user"></i>
                    <span>Login Guru</span>
                </h1>
                <div class="border-b mt-2"></div>
            </div>

            <?php if ($error): ?>
                <div class="mb-4 bg-red-100 text-red-700 px-3 py-2 rounded text-sm">
                    <?= htmlspecialchars($error) ?>
                </div>
            <?php endif; ?>

            <form action="process/login_process.php" method="POST" class="space-y-4">
                <input type="hidden" name="role" value="guru">

                <div>
                    <label class="block text-sm text-gray-700 mb-1">Username</label>
                    <input
                        type="text"
                        name="username"
                        placeholder="Masukkan Username Guru"
                        required
                        class="w-full border border-gray-300 h-10 px-3 text-sm rounded-sm focus:outline-none focus:ring-1 focus:ring-indigo-500">
                </div>

                <div>
                    <label class="block text-sm text-gray-700 mb-1">Password</label>
                    <input
                        type="password"
                        name="password"
                        placeholder="Masukkan Password"
                        required
                        class="w-full border border-gray-300 h-10 px-3 text-sm rounded-sm focus:outline-none focus:ring-1 focus:ring-indigo-500">
                </div>

                <p>Bukan guru? <a href="login_siswa.php" class="text-blue-500 hover:underline">Login sebagai siswa</a></p>

                <button
                    type="submit"
                    class="w-full h-10 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold rounded-sm transition flex items-center justify-center gap-2">
                    <i class="fa-solid fa-right-to-bracket"></i>
                    Login
                </button> 
            </form>
        </div>
    </div>

</body>

</html>