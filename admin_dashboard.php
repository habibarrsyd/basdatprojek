<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: index.html');
    exit();
}
// Ambil informasi pengguna dari session
$user_id = $_SESSION['user_id'];
$email = $_SESSION['email'];
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Utama</title>
    <script>
        // function redirectToForm(formType) {
        //     // Ganti dengan URL ke halaman form yang sesuai
        //     if (formType === 'order') {
        //         window.location.href = "http://localhost/basdat/form_order.php";
        //     } else if (formType === 'konsultasi') {
        //         window.location.href = "http://localhost/basdat/form_konsultasi.php";
        //     }
        // }

        function redirectToOrders() {
            // Ganti dengan URL ke halaman daftar pesanan
            window.location.href = "http://localhost/basdat/admin_listorder.php";
        }

        function redirectToConsultationHistory() {
            // Ganti dengan URL ke halaman riwayat konsultasi
            window.location.href = "http://localhost/basdat/riwayat_konsul.php";
        }

        function logout() {
            // Redirect ke halaman logout
            window.location.href = "http://localhost/basdat/logout.php";
        }
    </script>
</head>

<body>

    <h1>Selamat Datang di Halaman Utama, <?php echo $email; ?>!</h1>

    <!-- Tombol untuk menuju ke halaman form
    <button onclick="redirectToForm('order')">Pesan sekarang!</button>
    <button onclick="redirectToForm('konsultasi')">Konsul sekarang!</button> -->

    <!-- Tombol untuk menuju ke halaman daftar pesanan -->
    <button onclick="redirectToOrders()">Daftar Pesanan</button>

    <!-- Tombol untuk menuju ke halaman riwayat konsultasi -->
    <button onclick="redirectToConsultationHistory()">Riwayat Konsultasi</button>

    <!-- Tombol untuk logout -->
    <button onclick="logout()">Logout</button>

</body>

</html>

<!-- // Tampilkan konten dashboard admin di sini
echo "Selamat datang, Admin!";
?> -->