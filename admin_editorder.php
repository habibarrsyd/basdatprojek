<?php
session_start(); // Mulai session

if (!isset($_SESSION['user_id'])) {
    header("Location: http://localhost/basdat/index.html");
}

$koneksi = mysqli_connect("localhost", "root", "", "order_db");

$is_admin = false; // Tambahkan variabel is_admin

// Periksa apakah pengguna adalah admin
$user_id = $_SESSION['user_id'];
$query_check_admin = "SELECT role FROM tbl_users WHERE user_id = $user_id";
$result_check_admin = mysqli_query($koneksi, $query_check_admin);

if ($result_check_admin) {
    $row_check_admin = mysqli_fetch_assoc($result_check_admin);
    $is_admin = ($row_check_admin['role'] == 'admin');
}

if ($is_admin) {
    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        // Ambil informasi pesanan berdasarkan id
        $query_get_order = "SELECT * FROM daftar_pesanan WHERE id = $id";
        $result_get_order = mysqli_query($koneksi, $query_get_order);

        if ($result_get_order && mysqli_num_rows($result_get_order) > 0) {
            $row = mysqli_fetch_assoc($result_get_order);
            $nama = $row['Nama'];
            $alamat = $row['alamat'];
            $No_HP = $row['no_HP'];
            $item_name = $row['item_name'];
            $status = $row['status'];
        } else {
            echo "Pesanan tidak ditemukan.";
            exit;
        }
    } else {
        echo "Order ID tidak valid.";
        exit;
    }

    // Proses form edit
    if (isset($_POST['edit_submit'])) {
        $nama_baru = $_POST['nama'];
        $alamat_baru = $_POST['alamat'];
        $No_HP_baru = $_POST['No_HP'];
        $item_name_baru = $_POST['pilihan_jasa'];
        $status_baru = $_POST['status'];

        // Query update pesanan
        $query_update_order = "UPDATE daftar_pesanan SET nama = '$nama_baru', alamat = '$alamat_baru', no_HP = '$No_HP_baru', item_name = '$item_name_baru', status = '$status_baru' WHERE id = $id";

        if (mysqli_query($koneksi, $query_update_order)) {
            echo "Pesanan berhasil diupdate!";
            // Tambahkan tombol kembali ke halaman admin_listorder.php
            echo '<br><a href="admin_listorder.php">Kembali ke List Order</a>';
        } else {
            echo "Error: " . $query_update_order . "<br>" . mysqli_error($koneksi);
        }
        
    }
} else {
    echo "Anda tidak memiliki izin untuk mengakses halaman ini.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pesanan</title>
</head>

<body>
    <h2>Edit Pesanan</h2>
    <form action="edit_order.php?id=<?php echo $id; ?>" method="POST">
        <label for="nama">Nama:</label>
        <input type="text" name="nama" value="<?php echo $nama; ?>" required><br>

        <label for="alamat">Alamat:</label>
        <input type="text" name="alamat" value="<?php echo $alamat; ?>" required><br>

        <label for="No_HP">No. HP:</label>
        <input type="text" name="No_HP" value="<?php echo $No_HP; ?>" required><br>

        <label for="pilihan_jasa">Item Name:</label>
        <input type="text" name="pilihan_jasa" value="<?php echo $item_name; ?>" required><br>

        <label for="status">Status:</label>
        <select name="status">
         <option value="Sedang Diproses" <?php echo ($status == 'Sedang Diproses') ? 'selected' : ''; ?>>Pending</option>
         <option value="Sedang Dikirim" <?php echo ($status == 'Sedang Dikirim') ? 'selected' : ''; ?>>Processing</option>
        <option value="Selesai" <?php echo ($status == 'Selesai') ? 'selected' : ''; ?>>Completed</option>
    <!-- Tambahkan opsi status lain sesuai kebutuhan -->
</select><br>

            <!-- Tambahkan opsi status lain sesuai kebutuhan -->
        </select><br>

        <input type="submit" name="edit_submit" value="Simpan Perubahan">
    </form>
</body>

</html>


