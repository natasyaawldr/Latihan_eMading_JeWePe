<?php
include('template/header.php');
include('admin/config.php');
$db = new database;
$id_artikel = $_GET['id'];
if (!is_null($id_artikel)) {
    $data = $db->get_by_id($id_artikel);
    if (empty($data)) {
        echo "<script>alert('Id artikel tidak ditemukan!');document.location.href='index.php'; </script>";
    } elseif ($data['status'] != 'publish') {
        echo "<script>alert('Artikel yang anda belum tersedia!');document.location.href='index.php'; </script>";
    }
} else {
    echo "<script>alert('Anda belum memilih artikel!');document.location.href='index.php'; </script>";
}
?>

<div class="site-cover site-cover-sm same-height overlay single-page" style="background-image: url('files/<?= $data['gambar']; ?>');">
    <div class="container">
        <div class="row same-height justify-content-center">
            <div class="col-md-6">
                <div class="post-entry text-center">
                    <h1 class="mb-4"><?= $data['judul']; ?></h1>
                    <div class="post-meta align-items-center text-center">
                        <figure class="author-figure mb-0 me-3 d-inline-block"><img src="assets/landing/images/icon.png" alt="Image" class="img-fluid"></figure>
                        <span class="d-inline-block mt-1"><?= $data['nama']; ?></span>
                        <span>&nbsp;-&nbsp; <?= date('d M Y', strtotime($data['tanggal_publish'])); ?></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Tambahkan modal untuk gambar -->
<div class="modal fade" id="gambarModal" tabindex="-1" role="dialog" aria-labelledby="gambarModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-body">
                <img src="files/<?= $data['gambar']; ?>" alt="Image" class="img-fluid w-100">
            </div>
        </div>
    </div>
</div>

<section class="section">
    <div class="container">
        <div class="row blog-entries element-animate">
            <div class="col-md-12 col-lg-12 main-content">
                <div class="post-content-body">
                    <?= $data['isi_artikel']; ?>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
// Tambahkan event listener untuk membuka modal saat gambar diklik
document.addEventListener('DOMContentLoaded', function() {
    var gambarModal = new bootstrap.Modal(document.getElementById('gambarModal'));

    document.querySelector('.site-cover').addEventListener('click', function() {
        gambarModal.show();
    });
});
</script>

<?php
include('template/footer.php')
?>
