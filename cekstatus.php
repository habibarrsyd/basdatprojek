<?php
$koneksikon = mysqli_connect("localhost", "root", "", "order_db");

// Periksa apakah parameter ID tersedia di URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Ambil data pesanan berdasarkan ID
    $query = "SELECT * FROM daftar_konsultasi WHERE id = $id";
    $result = mysqli_query($koneksikon, $query);

    if ($result) {
        $pesanan = mysqli_fetch_assoc($result);

        // Tampilkan status pesanan
        echo "<h1>Status Pesanan</h1>";
        echo "<p>ID Pesanan: " . $pesanan['id'] . "</p>";
        echo "<p>Nama: " . $pesanan['nama'] . "</p>";
        echo "<p>No. HP: " . $pesanan['no_hp'] . "</p>";

        // Tambahkan tombol untuk edit pesanan
        echo '<a href="edit_pesanan.php?id=' . $id . '">Edit Pesanan</a>';

        // Tambahkan tombol untuk hapus pesanan
        echo ' | <a href="hapus_pesanan.php?id=' . $id . '">Hapus Pesanan</a>';
    } else {
        echo "Error: " . mysqli_error($koneksikon);
    }
} else {
    echo "ID pesanan tidak valid.";
}
?>