<?php

// Kelas untuk menangani operasi database
class database{
    // Parameter koneksi database
    var $host= "localhost";
    var $username = "root";
    var $password="";
    var $database="db_emading";
    var $koneksi = "";

    // Konstruktor untuk membentuk koneksi database
    function __construct()
    {
        $this->koneksi = mysqli_connect($this->host,$this->username,$this->password,$this->database);
        if(mysqli_connect_errno()) {
            echo "Koneksi database Gagal : " . mysqli_connect_error();
        }
    }

    // Metode untuk mendapatkan data pengguna berdasarkan nama pengguna dari tabel 'admin'
    public function get_data_users($username){
        $data = mysqli_query($this->koneksi, "SELECT * FROM admin WHERE username = '$username' ");
        return $data;
    }

    // Metode untuk mengambil artikel yang sudah dipublish untuk halaman Dashboard
    public function tampil_data_dashboard(){
        $data = mysqli_query($this->koneksi,"SELECT tbk.id, judul, deskripsi, isi_artikel, status, tbk.id_admin, nama, tanggal_publish,gambar FROM artikel tbk
        JOIN admin tba ON tbk.id_admin = tba.id WHERE status = 'publish' ");
        
        if($data){
            if(mysqli_num_rows($data) >0){
                while ($row = mysqli_fetch_array($data)){
                    $hasil[] = $row;
                }
            } else {
                $hasil = '0';
            }
        }

        return $hasil;
    }

    // Metode untuk mengambil semua artikel untuk halaman Admin
    public function tampil_data(){
        $data = mysqli_query($this->koneksi,"SELECT tbk.id, judul, deskripsi, isi_artikel, status, tbk.id_admin, nama, tanggal_publish,gambar FROM artikel tbk
        JOIN admin tba ON tbk.id_admin = tba.id");
        
        if($data){
            if(mysqli_num_rows($data) >0){
                while ($row = mysqli_fetch_array($data)){
                    $hasil[] = $row;
                }
            } else {
                $hasil = '0';
            }
        }

        return $hasil;
    }

    // Metode untuk menambahkan artikel baru ke dalam database
    public function tambah_data($judul,$deskripsi,$isi_artikel,$status, $id_admin,$gambar){
        $datetime = date("Y-m-d H:i:s");
        $insert = mysqli_query($this->koneksi, "INSERT INTO artikel (judul,deskripsi,isi_artikel,status, id_admin, tanggal_publish,gambar)
        VALUES ('$judul', '$deskripsi', '$isi_artikel','$status', '$id_admin','$datetime', '$gambar') ");
       
        return $insert; 
    }

    // Metode untuk mengambil data artikel berdasarkan ID
    public function get_by_id($id){
        $query = mysqli_query($this->koneksi, "SELECT tbk.id, judul, deskripsi, isi_artikel, status, tbk.id_admin, nama, tanggal_publish,gambar FROM artikel tbk
        JOIN admin tba ON tbk.id_admin = tba.id WHERE tbk.id = '$id'")
        or die (mysqli_error($this->koneksi));

        return $query->fetch_array();
    }

    // Metode untuk memperbarui data artikel di dalam database
    public function update_data($id, $judul, $deskripsi, $isi_artikel,$status,$id_admin, $gambar) {
        $datetime = date("Y-m-d H:i:s");
        if($gambar == 'not_set'){
            $query = mysqli_query($this->koneksi, "UPDATE artikel SET judul = '$judul', deskripsi = '$deskripsi', isi_artikel = '$isi_artikel', status = '$status', id_admin = '$id_admin',
            tanggal_publish = '$datetime' WHERE id = '$id'")
            or die (mysqli_error($this->koneksi)); 
            return $query;
        } else{
            $query = mysqli_query($this->koneksi, "UPDATE artikel SET judul= '$judul', deskripsi = '$deskripsi', isi_artikel = '$isi_artikel', status = '$status', id_admin = '$id_admin',
            tanggal_publish = '$datetime', gambar = '$gambar' WHERE id = '$id'")
            or die (mysqli_error($this->koneksi)); 
            return $query;
        }
    }

    // Metode untuk menghapus artikel dari database
    public function hapus_artikel($id)
    {
        $query = mysqli_query($this->koneksi, "DELETE FROM artikel WHERE id = '$id'");
        return $query;
    }
}
