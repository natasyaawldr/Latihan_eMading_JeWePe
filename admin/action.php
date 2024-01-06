<?php

include("template/header.php");
include('config.php');

//membuat objek database
$db = new database();

//mendapatkan ID admin dari session
$id_admin = $_SESSION['id'];
$aksi = $_GET['aksi'];

// Memeriksa apakah HTTP method adalah POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $aksi = $_GET['aksi'];

    if ($aksi == "add") {
        // Operasi untuk insert data
        $judul_artikel = $_POST["judul"];
        $deskripsi = $_POST["deskripsi"];
        $isi_artikel = $_POST["isi_artikel"];
        $status_publish = $_POST["status"];

        // Mengelola upload gambar
        if ($_FILES["gambar"]["name"] != '') {
             // Mendapatkan ekstensi file dan memeriksa validitasnya
            $tmp = explode('.', $_FILES["gambar"]["name"]);
            $ext = end($tmp);
            $filename = $tmp[0];
            $allowed_ext = array("jpg", "png", "jpeg");

            // Jika ekstensi file valid
            if (in_array($ext, $allowed_ext)) {
                // Memeriksa ukuran file
                if ($_FILES["gambar"]["size"] <= 5120000) {
                    // Menyiapkan nama file unik
                    $name = $filename . '_' . rand() . '.' . $ext;
                    $path = "../files/" . $name;
                    
                    // Upload file
                    $uploaded = move_uploaded_file($_FILES["gambar"]["tmp_name"], $path);
                    
                     // Jika upload berhasil
                    if ($uploaded) {
                        // Insert data ke database
                        $insertData = $db->tambah_data($judul_artikel, $deskripsi, $isi_artikel, $status_publish, $id_admin, $name);
                        
                        // Menampilkan pesan sesuai hasil operasi
                        if ($insertData) {
                            echo "<script>alert('Data Berhasil Ditambahkan!!');document.location.href = 'index.php';</script>";
                        } else {
                            echo "<script>alert('Data Gagal Ditambahkan!!');document.location.href = 'tambah_data.php';</script>";
                        }
                    } else {
                        echo "<script>alert('Upload File Gagal!');document.location.href = 'tambah_data.php';</script>";
                    }
                } else {
                    echo "<script>alert('Ukuran Gambar Tidak Boleh Lebih Dari 5 Mb!');document.location.href = 'tambah_data.php';</script>";
                }
            } else {
                echo "<script>alert('Mohon Masukkan Extensi File yang Sesuai!');document.location.href = 'tambah_data.php';</script>";
            }
        } else {
            echo "<script>alert('Silahkan Masukkan File Gambar');document.location.href = 'tambah_data.php';</script>";
        }
    } elseif ($aksi == "update") {
          // Operasi untuk mengupdate data
        $id_artikel = $_POST['id'];
        if (!empty($id_artikel)) { //cek apakah id artikel ada?
            if ($_FILES['gambar']['name'] != '') { //cek apakah melakukan upload file?
                 // Mendapatkan data artikel berdasarkan ID
                $data = $db->get_by_id($id_artikel);

                  // Operasi hapus file gambar lama
                if (file_exists('../files/' . $data['gambar']) && $data['gambar']) 
                    unlink('../files/' . $data['gambar']);
                
                $tmp = explode('.', $_FILES["gambar"]["name"]);
                $ext = end($tmp);
                $filename = $tmp[0];
                $allowed_ext = array("jpg", "png", "jpeg");

                if (in_array($ext, $allowed_ext)) {
                    if ($_FILES["gambar"]["size"] <= 5120000) {
                        $name = $filename . '_' . rand() . '.' . $ext;
                        $path = "../files/" . $name;

                        $uploaded = move_uploaded_file($_FILES["gambar"]["tmp_name"], $path);

                        if ($uploaded) {
                            // update data ke database
                            // operasi update data ke database dengan gambar baru
                            $update_data = $db->update_data($_POST['id'],$_POST['judul'], $_POST['deskripsi'], $_POST['isi_artikel'], $_POST['status'],$id_admin, $name); //Query update data
                            if ($update_data) {
                                echo "<script>alert('Data Berhasil Di Edit!!');document.location.href = 'index.php';</script>";
                            }
                        } else {
                            echo "<script>alert('Data Gagal Di Edit!!');document.location.href = 'index.php';</script>";
                        }
                    } else {
                        echo "<script>alert('Upload File Gagal!');document.location.href = 'edit.php?id=" . $id_artikel . "';</script>";
                    }
                } else {
                    echo "<script>alert('Ukuran Gambar Tidak Boleh Lebih Dari 5 Mb!');document.location.href = 'edit.php?id=" . $id_artikel . "';</script>";
                }
            } else {
                //operasi update data ke database tanpa mengubah gambar
                $update_data = $db->update_data($_POST['id'],$_POST['judul'], $_POST['deskripsi'], $_POST['isi_artikel'], $_POST['status'],$id_admin, 'not_set');
            if ($update_data) {
                echo "<script>alert('Data Berhasil di Edit!');document.location.href = 'index.php';</script>";
            } else {
                echo "<script>alert('Data Gagal di Edit!');document.location.href = 'tambah_data.php';</script>";
            }
            }
        } else {
           // Menampilkan pesan jika ID artikel belum dipilih
            echo "<script>alert('Anda belum memilih artikel');document.location.href = 'index.php';</script>";
        }
    } elseif ($aksi == "delete") {
          // Operasi untuk menghapus data
    } else {
        echo "<script>alert('Anda tidak mendapatkan akses untuk operasi ini!');document.location.href = 'index.php';</script>";
    }
}
include("template/footer.php");
?>
