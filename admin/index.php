<?php
// Memasukkan file header.php dan konfigurasi database
include("template/header.php");
include("config.php");

// Membuat objek dari kelas database
$db = new database();

// Mengambil data artikel dari database
$data_artikel = $db->tampil_data();
?>

<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Manajemen /</span> Artikel</h4>

    <div class="card">
        <div class="card-header">
            <div class="card-title">
                <div class="row">
                    <div class="col-lg-6">
                        <h5>Daftar Artikel</h5>
                    </div>
                    <div class="col-lg-6">
                        <div class="float-end">
                            <!-- Tombol untuk menambahkan data baru -->
                            <a href="tambah_data.php" class="btn btn-primary">
                                <i class="bx bx-plus"></i>
                                Tambah Data
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead>
                        <tr class="text-nowrap">
                            <th>No</th>
                            <th>Gambar</th>
                            <th>Judul</th>
                            <th>Status Publish</th>
                            <th>Tanggal Publish</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Mengecek apakah data artikel tersedia
                        if($data_artikel == '0'){
                            echo "<tr><td>Data tidak tersedia</td>";
                        } else {
                            $no = 1;
                            foreach($data_artikel as $row ){
                                ?>
                                <tr>
                                    <th><?= $no++; ?></th>
                                    <td>
                                        <img src="../files/<?= $row['gambar']; ?>" alt="<?= $row['gambar']; ?>" style="max-width: 100px; max-height: 100px;">
                                    </td>
                                    <td><?= $row['judul']; ?></td>
                                    <td><?= $row['status']; ?></td>
                                    <td>
                                        <?php 
                                        // Menampilkan tanggal publish jika status 'publish', jika tidak, menampilkan 'Belum dipublish'
                                        if($row['status'] == 'publish'){
                                            echo date('d F Y H:i:s', strtotime($row['tanggal_publish'])); 
                                        } else {
                                            echo 'Belum dipublish';
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <!-- Tombol untuk mengedit dan menghapus artikel -->
                                        <a href="edit.php?id=<?= $row['id']; ?>" class="btn btn-sm btn-warning">Edit</a>
                                        <a href="delete.php?id=<?= $row['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus artikel ini?');">Delete</a>
                                    </td>
                                </tr>
                                <?php
                            } 
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php
// Memasukkan file footer.php
include("template/footer.php");
?>
