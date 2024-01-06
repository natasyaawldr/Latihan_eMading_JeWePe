<?php
include("template/header.php") ?>
         
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light"><a href="index.php">Manajemen Artikel</a>/</span> Tambah Data
    </h4>

    <div class="row">
        
        <div class="col-md-12">
            <div class="card mb-4 ">
                <div class="card-header"></div>
                <h4>Tambah Artikel Baru</h4>
                <div class="card-body">
                    <form action="action.php?aksi=add" method="POST" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-lg-9">
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Judul Artikel</label>
                                    <input type="text" name="judul" class="form-control" id="exampleFormControlInput1" placeholder="Masukkan judul artikel" required />
                                </div>
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Deskripsi</label>
                                    <input type="text" name="deskripsi" class="form-control" id="exampleFormControlInput1" placeholder="Masukkan judul artikel" required />
                                </div>
                                <div class="mb-3">
                                    <label for="exampleFormControlTextarea1" class="form-label">Isi Artikel</label>
                                    <textarea class="form-control summernote" name="isi_artikel" id="exampleFormControlTextarea1" rows="3" required></textarea>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="col-md mb-3">
                                    <small class="form-label d-block">Status Publish*</small>
                                    <div class="form-check mt-3">
                                        <input name="status" class="form-check-input" type="radio" value="publish" id="defaultRadio1" checked required>
                                        <label class="form-check-label" for="defaultRadio1"> Publish</label>
                                    </div>
                                    <div class="form-check">
                                        <input name="status" class="form-check-input" type="radio" value="draft" id="defaultRadio2" >
                                        <label class="form-check-label" for="defaultRadio2"> Draft </label>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="uploadGambar" class="form-label">Gambar Artikel*</label>
                                    <input type="file" name="gambar" class="form-control" id="uploadGambar" required  />
                                    <small class="text-danger">Max Size 5Mb, ext. png, jpg, jpeg</small>
                                </div>
                                
                            </div>
                        </div>
                        <hr>
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
include("template/footer.php");
?>

 


