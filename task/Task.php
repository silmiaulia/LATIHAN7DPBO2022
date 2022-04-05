<?php 

class Task extends DB{
	
	// Mengambil data
	function getTask(){
		// Query mysql select data ke tb_to_do
		$query = "SELECT * FROM tb_to_do";

		// Mengeksekusi query
		return $this->execute($query);
	}


	function orderData($order){ //fungsi untuk mengurutkan data 

		$query = "SELECT * FROM tb_to_do order by $order"; //buat query
		return $this->execute($query); //eksekusi
	}
	
}

?>