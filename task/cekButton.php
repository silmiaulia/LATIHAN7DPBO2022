<?php

include("conf.php");
include("DB.php");
include("Task.php");


$tsk = new Task($db_host, $db_user, $db_password, $db_name);

$tsk->open(); //koneksi ke database

    if(isset($_POST['add'])){ //cek jika button add di klik
        
        //menampung semua value di form
		$tname = $_POST['tname'];
		$tdeadline = $_POST['tdeadline'];
		$tdetails = $_POST['tdetails'];
		$tsubject = $_POST['tsubject'];
		$tpriority = $_POST['tpriority'];
		$status = "Belum";

        //membuat query untuk add data ke database
        $query = "INSERT INTO tb_to_do (name_td, details_td, subject_td, priority_td, deadline_td, status_td) VALUES ('$tname', '$tdetails', '$tsubject', '$tpriority','$tdeadline', '$status')";
        $tsk->execute($query); //eksekusi
        header("location:index.php"); //kembali ke halaman index

    }

    if(isset($_GET['id_hapus'])){ //cek jika button hapus di klik

        //menampung id di variabel id_hapus
        $id_hapus = $_GET['id_hapus'];

		$query = "DELETE FROM tb_to_do where id =  $id_hapus"; //membuat query untuk delete data dari database
		$tsk->execute($query); //eksekusi
        header("location:index.php"); //kembali ke halaman index

	}

	if(isset($_GET['id_status'])){ //cek jika button selesai di klik

        //menampung id di variabel id_status
        $id_status = $_GET['id_status'];

		$query = "UPDATE tb_to_do set status_td='Sudah' where id =  $id_status";  //membuat query untuk update status record menjadi selesai di database
		$tsk->execute($query); //eksekusi
        header("location:index.php"); //kembali ke halaman index


	}


    

?>