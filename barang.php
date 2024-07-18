<?php
session_start();
if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit();
}
?>
<?php
include 'navbar.php'; // Include navbar
include 'db_connection.php'; // Include file koneksi ke database

// Proses hapus data barang
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["delete"])) {
    $kd_barang = $_POST["kd_barang"];
    $sql_delete = "DELETE FROM tb_barang WHERE kd_barang = $kd_barang";
    if ($conn->query($sql_delete) === TRUE) {
        echo "<div class='alert alert-success' role='alert'>Barang berhasil dihapus.</div>";
        // Refresh halaman untuk menampilkan data terbaru
        echo "<meta http-equiv='refresh' content='0'>";
    } else {
        echo "Error: " . $sql_delete . "<br>" . $conn->error;
    }
}

// Proses pencarian barang
$search_query = "";
$category_filter = "";
$sql_select = "SELECT * FROM tb_barang";

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["search"])) {
    $search_query = $_GET["search_query"];
    $sql_select = "SELECT * FROM tb_barang WHERE nama_barang LIKE '%$search_query%'";
} elseif ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["category"])) {
    $category_filter = $_GET["category"];
    $sql_select = "SELECT * FROM tb_barang WHERE jenis_barang = '$category_filter'";
}

$result = $conn->query($sql_select);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Barang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .card {
            transition: transform 0.2s;
        }
        .card:hover {
            transform: scale(1.05);
        }
        .card-img-top {
            width: 100px;
            height: 150px;
            object-fit: cover;
            margin: 0 auto;
        }
        .rating {
            display: flex;
            justify-content: center;
            gap: 5px;
        }
        .rating span {
            color: #ffc107; /* Warna kuning untuk bintang */
            font-size: 20px; /* Ukuran font bintang */
        }
        .category-icon {
            width: 50px;
            height: 50px;
            cursor: pointer;
        }
        .category-icon img {
            width: 100%;
            height: 100%;
        }
    </style>
</head>
<body>
<div class="container text-center">
    <h1 class="mt-5">Kategori Barang</h1>

    <div class="d-flex justify-content-center flex-wrap my-3">
        <a href="barang.php?category=Minuman" class="mx-5">
            <div class="category-icon">
                <img src="Icon/minuman.jpg" alt="Minuman">
            </div>
        </a>
        <a href="barang.php?category=Makanan" class="mx-5">
            <div class="category-icon">
                <img src="Icon/makanan.jpg" alt="Makanan">
            </div>
        </a>
        <a href="barang.php?category=Skincare" class="mx-5">
            <div class="category-icon">
                <img src="Icon/skincare.jpg" alt="Skincare">
            </div>
        </a>
        <a href="barang.php?category=Bahan Masak" class="mx-5">
            <div class="category-icon">
                <img src="Icon/alatmasak.jpg" alt="Bahan Masak">
            </div>
        </a>
        <a href="barang.php?category=Sabun" class="mx-5">
            <div class="category-icon">
                <img src="Icon/alatmandi.jpg" alt="Sabun">
            </div>
        </a>
        <a href="barang.php?category=Alat Tulis" class="mx-5">
            <div class="category-icon">
                <img src="Icon/atk.jpg" alt="Alat Tulis">
            </div>
        </a>
        <!-- Tambahkan kategori lain sesuai kebutuhan -->
    </div>

    <!-- Form Pencarian -->
    <form action="barang.php" method="get" class="mt-3 mb-4">
        <div class="input-group">
            <input type="text" class="form-control" name="search_query" placeholder="Cari Nama Barang..." value="<?php echo htmlspecialchars($search_query); ?>">
            <button class="btn btn-primary" type="submit" name="search">Cari</button>
        </div>
    </form>

    <div class="row mt-3 justify-content-center">
        <?php
        if ($result->num_rows > 0) {
            // Output data dari setiap baris
            while($row = $result->fetch_assoc()) {
                echo "<div class='col-md-4 mb-4'>";
                echo "<div class='card'>";
                echo "<img src='images/" . $row["gambar"] . "' class='card-img-top'>";
                echo "<div class='card-body'>";
                echo "<h5 class='card-title'>" . $row["nama_barang"] . "</h5>";
                echo "<p class='card-text'>Rp." . $row["harga"] . "</p>";
                echo "<div class='rating'>";
                $rating = 5; // Rating statis untuk contoh, ganti dengan data rating dari database
                for ($i = 0; $i < $rating; $i++) {
                    echo "<span>&#9733;</span>"; // Menampilkan bintang (Unicode untuk bintang)
                }
                echo "</div>";
                echo "<button class='btn btn-info btn-sm mt-2' data-bs-toggle='modal' data-bs-target='#detailModal" . $row["kd_barang"] . "'>Detail</button>";
                echo "</div>";
                echo "</div>";
                echo "</div>";

                // Modal untuk menampilkan detail barang
                echo "<div class='modal fade' id='detailModal" . $row["kd_barang"] . "' tabindex='-1' aria-labelledby='detailModalLabel" . $row["kd_barang"] . "' aria-hidden='true'>";
                echo "<div class='modal-dialog'>";
                echo "<div class='modal-content'>";
                echo "<div class='modal-header'>";
                echo "<h5 class='modal-title' id='detailModalLabel" . $row["kd_barang"] . "'>Detail Barang</h5>";
                echo "<button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>";
                echo "</div>";
                echo "<div class='modal-body' id='modalBody" . $row["kd_barang"] . "'>";
                echo "<img src='images/" . $row["gambar"] . "' class='img-fluid mb-3' style='width: 100px; height: 150px; object-fit: cover;'>";
                echo "<p><strong>Nama Barang:</strong> " . $row["nama_barang"] . "</p>";
                echo "<p><strong>Jenis Barang:</strong> " . $row["jenis_barang"] . "</p>";
                echo "<p><strong>Harga:</strong> Rp." . $row["harga"] . "</p>";
                echo "<p><strong>Stock:</strong> " . $row["jumlah"] . "</p>";
                echo "<p><strong>Keterangan:</strong> " . $row["keterangan"] . "</p>";
                echo "</div>";
                echo "<div class='modal-footer'>";
                echo "<button type='button' class='btn btn-primary' data-bs-dismiss='modal'>Close</button>";
                echo "<a href='order.php?kd_barang=" . $row["kd_barang"] . "&nama_barang=" . urlencode($row["nama_barang"]) . "&harga=" . $row["harga"] . "' class='btn btn-primary'>Order</a>";
                echo "<a href='return.php?kd_barang=" . $row["kd_barang"] . "&nama_barang=" . urlencode($row["nama_barang"]) . "' class='btn btn-secondary'>Return</a>";
                echo "<a href='edit_barang.php?kd_barang=" . $row["kd_barang"] . "' class='btn btn-warning'>Edit</a>";
                echo "<form action='barang.php' method='post' style='display:inline-block;'>";
                echo "<input type='hidden' name='kd_barang' value='" . $row["kd_barang"] . "'>";
                echo "<button type='submit' name='delete' class='btn btn-danger'>Hapus</button>";
                echo "</form>";
                echo "<button type='button' class='btn btn-success' onclick='printDetail(" . $row["kd_barang"] . ")'>Cetak</button>";
                echo "</div>";
                echo "</div>";
                echo "</div>";
                echo "</div>";
            }
        } else {
            echo "<div class='col-12'><div class='alert alert-warning' role='alert'>Tidak ada data</div></div>";
        }
        ?>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
function printDetail(kd_barang) {
    var printContents = document.getElementById('modalBody' + kd_barang).innerHTML;
    var originalContents = document.body.innerHTML;

    document.body.innerHTML = printContents;
    window.print();
    document.body.innerHTML = originalContents;
    window.location.reload();
}
</script>
</body>
</html>

<?php
$conn->close(); // Tutup koneksi database
?>

