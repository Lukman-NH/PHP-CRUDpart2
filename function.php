<?php 
//koneksi ke database
$db = mysqli_connect("localhost","root","","3ka16_lukman_film");


function query($query){
	global $db;
	$result = mysqli_query($db, $query);
	$rows =[];
	while( $row = mysqli_fetch_assoc($result) ) {
		$rows[] = $row;
	}
	return $rows;
}

function tambah($data){
	global $db;
	//ambil data dari tiap element
	$kdmov = htmlspecialchars($data["kdmov"]);
	$judul = htmlspecialchars($data["judul"]);
	$series = htmlspecialchars($data["series"]);
	$kdgenre = htmlspecialchars($data["kdgenre"]);
	$tahun = htmlspecialchars($data["tahun"]);
	$negara = htmlspecialchars($data["negara"]);
	$director = htmlspecialchars($data["director"]);
	$rating = htmlspecialchars($data["rating"]);

	//query insert data
	$query ="
			 INSERT INTO film VALUES
			 ('$kdmov', '$judul', '$series', '$kdgenre', '$tahun', '$negara', '$director' ,'$rating')
			";
	mysqli_query($db, $query);

	return mysqli_affected_rows($db);
}

	function hapus($kdmov){
		global $db;
		mysqli_query($db, "DELETE FROM film WHERE kdmov = $kdmov");
		return mysqli_affected_rows($db);

	}

	function ubah($data){
	global $db;
	//ambil data dari tiap element
	$kdmov = $data["kdmov"];
	$judul = htmlspecialchars($data["judul"]);
	$series = htmlspecialchars($data["series"]);
	$kdgenre = htmlspecialchars($data["kdgenre"]);
	$tahun = htmlspecialchars($data["tahun"]);
	$negara = htmlspecialchars($data["negara"]);
	$director = htmlspecialchars($data["director"]);
	$rating = htmlspecialchars($data["rating"]);

	//query insert data
	$query ="
			 UPDATE film SET
			 kdmov = '$kdmov',
			 judul = '$judul',
			 series = '$series',
			 kdgenre = '$kdgenre',
			 tahun = '$tahun',
			 negara = '$negara',
			 director = '$director',
			 rating = '$rating'
			 WHERE kdmov = $kdmov
			";
	mysqli_query($db, $query);

	return mysqli_affected_rows($db);
}

function cari($keyword){
	$query ="
			 SELECT * FROM film WHERE
			 judul LIKE '%$keyword%' OR
			 kdmov LIKE '%$keyword%' OR
			 tahun LIKE '%$keyword%' OR
			 director LIKE '%$keyword%'
			";
	return query($query);
}
 ?>
