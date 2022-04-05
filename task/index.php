<?php

include("conf.php");
include("DB.php");
include("Task.php");
include("Template.php");

// Membuat objek dari kelas task
$otask = new Task($db_host, $db_user, $db_password, $db_name);
$otask->open();


// Memanggil method getTask di kelas Task


if(isset($_GET['sorting'])){ //cek apakah link sorting di klik

	$sorting_mode = $_GET['sorting'];

	if(strcmp($sorting_mode, 'reset') == 0){ //jika yang dipilih reset ke urutan awal data
		
		$otask->getTask(); //panggil fungsi getTask

	}else{

		$otask->orderData($sorting_mode); //jika urutkan selain reset maka panggil fungsi orderData
	}


}else{ //jika link sorting tidak di klik

	$otask->getTask(); //tampilkan data awal
}


// Proses mengisi tabel dengan data
$data = null;
$no = 1;


while (list($id, $tname, $tdetails, $tsubject, $tpriority, $tdeadline, $tstatus) = $otask->getResult()) {
	// Tampilan jika status task nya sudah dikerjakan
	if($tstatus == "Sudah"){
		$data .= "<tr>
		<td>" . $no . "</td>
		<td>" . $tname . "</td>
		<td>" . $tdetails . "</td>
		<td>" . $tsubject . "</td>
		<td>" . $tpriority . "</td>
		<td>" . $tdeadline . "</td>
		<td>" . $tstatus . "</td>
		<td>
		<button class='btn btn-danger'><a href='cekButton.php?id_hapus=" . $id . "' style='color: white; font-weight: bold;'>Hapus</a></button>
		</td>
		</tr>";
		$no++;
	}

	// Tampilan jika status task nya belum dikerjakan
	else{
		$data .= "<tr>
		<td>" . $no . "</td>
		<td>" . $tname . "</td>
		<td>" . $tdetails . "</td>
		<td>" . $tsubject . "</td>
		<td>" . $tpriority . "</td>
		<td>" . $tdeadline . "</td>
		<td>" . $tstatus . "</td>
		<td>
		<button class='btn btn-danger'><a href='cekButton.php?id_hapus=" . $id . "' style='color: white; font-weight: bold;'>Hapus</a></button>
		<button class='btn btn-success' ><a href='cekButton.php?id_status=" . $id .  "' style='color: white; font-weight: bold;'>Selesai</a></button>
		</td>
		</tr>";
		$no++;
	}
}

// Menutup koneksi database
$otask->close();

// Membaca template skin.html
$tpl = new Template("templates/skin.html");

// Mengganti kode Data_Tabel dengan data yang sudah diproses
$tpl->replace("DATA_TABEL", $data);

// Menampilkan ke layar
$tpl->write();