<?php

// $pass = password_hash('jewepe123', PASSWORD_DEFAULT);

// var_dump($pass);
// die;

include('admin/config.php');

$db = new database();

//inisialisasi session 

session_start(); 

// cek session aktif

if(isset($_SESSION['username']) || isset($_SESSION['id'])){
    header('Location: admin/index.php');
    


} else {
  
    //apakah form disubmit
    if(isset($_POST['submit'])){
        
        

        //menghilangkan backslasses
        $username = stripslashes($_POST['username']);
        $password = stripslashes($_POST['password']);

        //cek nilai username password apakah kosong

        if(!empty(trim($username)) && !empty (trim($password))){
            //select data tabel admin berdasarkan username
            
            $query = $db->get_data_users($username);

            if($query){
              $rows = mysqli_num_rows($query);
            }else{
              $rows == 0;
            }
            //var_dump($query);die;

            //cek ketersediaan data username 
            if($rows !==0){
                $getData = $query->fetch_assoc();

                 if(password_verify($password, $getData['password'])){

                    $_SESSION['username']=$username;
                    $_SESSION['id']=$getData['id'];
                    
                    header('location: admin/index.php');
                 } else {
                    header("location: login.php?pesan=gagal");
                 }
            } else {
                header("location: login.php?pesan=notfound");
            }

        } else {
            header("location: login.php?pesan=empty");
        }
    } else {
        header("location: login.php?pesan=empty");
    }
}

?>
