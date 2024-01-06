<?php 
include('template/header.php');
include('admin/config.php');
$db = new database;
$data_artikel = $db->tampil_data_dashboard();
?>
	<section class="section">
		<div class="container">

			<div class="row mb-4">
				<div class="col-sm-6">
					<h2 class="posts-entry-title">Mading JeWepe</h2>
				</div>
				
			</div>

			<div class="row">
				<?php
				foreach($data_artikel as $row){

				?>
				<div class="col-lg-4 mb-4">
					<div class="post-entry-alt">
						<a href="detail.php?id=<?= $row['id']; ?>" class="img-link"><img src="files/<?= $row['gambar']; ?>" alt="Image" class="img-fluid"></a>
						<div class="excerpt">
							

							<h2><a href="detail.php?id=<?= $row['id']; ?>"><?= $row['judul']; ?></a></h2>
							<div class="post-meta align-items-center text-left clearfix">
								<figure class="author-figure mb-0 me-3 float-start"><img src="assets/landing/images/icon.png" alt="Image" class="img-fluid"></figure>
								<span class="d-inline-block mt-1">By <a href="#"><?= $row['nama'] ?></a></span>
								<span>&nbsp;-&nbsp; <?= date('d M Y', strtotime($row['tanggal_publish'])); ?></span>
							</div>
                            
							<?= $row['deskripsi']?>
							<p>
								<a href="detail.php?id=<?= $row['id']; ?>" class="read-more">Baca Artikel</a>
							</p>
						</div>
					</div>
				</div>
				<?php } ?>
				
			</div>
			
		</div>
	</section>

<?php 
include('template/footer.php')
?>


	

    