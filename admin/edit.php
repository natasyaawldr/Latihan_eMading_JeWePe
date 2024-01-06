<?php
// Memasukkan file header.php dan konfigurasi database
include('template/header.php');
include('config.php');

// Membuat objek dari kelas database
$db = new database();

// Mengambil ID artikel dari parameter GET
$id_artikel = $_GET['id'];

// Memeriksa apakah ID artikel sudah dipilih
if(!is_null($id_artikel)) {
    // Mengambil data artikel berdasarkan ID
    $data = $db->get_by_id($id_artikel);

    // Memeriksa apakah data artikel ditemukan
    if(empty($data)){
        // Menampilkan pesan jika ID artikel tidak ditemukan
        echo "<script>alert('Id artikel tidak ditemukan!');document.location.href='index.php'; </script>";
    }
} else {
    // Menampilkan pesan jika ID artikel belum dipilih
    echo "<script>alert('Anda belum memilih artikel!');document.location.href='index.php'; </script>";
}
?>

<!-- Konten halaman edit artikel -->
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light"><a href="index.php">Manajemen Artikel</a>/</span> Edit data
    </h4>

    <div class="row">
        <!-- Form controls untuk mengedit artikel -->
        <div class="col-md-12">
            <div class="card mb-4 ">
                <div class="card-header"></div>
                <h4>Edit Artikel</h4>
                <div class="card-body">
                    <!-- Form untuk mengupdate data artikel -->
                    <form action="action.php?aksi=update" method="POST" enctype="multipart/form-data">
                        <!-- Input hidden untuk menyimpan ID artikel -->
                        <input type="hidden" name="id" value="<?= $data['id']; ?>">

                        <!-- Bagian input untuk judul, deskripsi, dan isi artikel -->
                        <div class="row">
                            <div class="col-lg-9">
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Judul Artikel</label>
                                    <input type="text" name="judul" class="form-control" id="exampleFormControlInput1" placeholder="Masukkan judul artikel" value="<?= $data['judul']; ?>" required />
                                </div>
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Deskripsi</label>
                                    <input type="text" name="deskripsi" class="form-control" id="exampleFormControlInput1" placeholder="Masukkan deskripsi artikel" value="<?= $data['deskripsi']; ?>" required />
                                </div>
                                <div class="mb-3">
                                    <label for="exampleFormControlTextarea1" class="form-label">Isi Artikel</label>
                                    <textarea class="form-control summernote" name="isi_artikel" id="exampleFormControlTextarea1" rows="3" required><?= $data['isi_artikel'];?></textarea>
                                </div>
                            </div>

                            <!-- Bagian input untuk status publish, gambar, dan preview gambar -->
                            <div class="col-lg-3">
                                <div class="col-md mb-3">
                                    <small class="form-label d-block">Status Publish*</small>
                                    <!-- Radio button untuk memilih status publish atau draft -->
                                    <div class="form-check mt-3">
                                        <input name="status" class="form-check-input" type="radio" value="publish" id="defaultRadio1" <?= ($data['status'] == 'publish' ) ? 'checked' : '' ;?> required>
                                        <label class="form-check-label" for="defaultRadio1"> Publish</label>
                                    </div>
                                    <div class="form-check">
                                        <input name="status" class="form-check-input" type="radio" value="draft" id="defaultRadio2" <?= ($data['status'] == 'draft' ) ? 'checked' : '' ;?>>
                                        <label class="form-check-label" for="defaultRadio2"> Draft </label>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="uploadGambar" class="form-label">Gambar Artikel*</label>
                                    <!-- Input file untuk mengupload gambar -->
                                    <input type="file" name="gambar" class="form-control" id="uploadGambar" <?= ($data['gambar'] == '' ) ? 'required' : '' ;?> />
                                    <small class="text-danger">Max Size 5Mb, ext. png, jpg, jpeg</small>
                                </div>

                                <div class="mb-3"> 
                                    <label for="preview" class="form-label">Preview Gambar</label> 
                                    <?php
                                    // Menampilkan gambar preview jika gambar sudah diatur
                                    if($data['gambar']!="") {  ?>
                                        <a href="../files/<?= $data['gambar']; ?>" target="_blank">
                                           <img src="../files/<?= $data['gambar']; ?>" class="img-thumbnail rounded" style="max-width:160px" alt="">
                                        </a>
                                    <?php 
                                    }else{
                                        // Menampilkan pesan jika gambar belum diatur
                                        echo '<i class="text-danger">File Not Set!</i>';
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                        <hr>

                        <!-- Tombol untuk membatalkan atau menyubmit form -->
                        <div class="mb-3 float-end">
                            <a href="index.php" class="btn btn-danger">Cancel</a>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
// Memasukkan file footer.php
include("template/footer.php");
?>
