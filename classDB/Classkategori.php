<?php
	class Classkategori{
		
		public function create ($kategori_buku){
			include 'Koneksi.php';
			$sql = "INSERT INTO tbl_kategori(kategori_buku) VALUES(?)";
			$stmt = $conn->prepare($sql);
			$stmt->bind_param('s',$kategori_buku);
			$query = $stmt->execute();
			$stmt->close();
			$conn->close();
			return $query;
		}
		public function readbyid($id_kategori_buku){
			include 'Koneksi.php';
			$sql = "SELECT * FROM tbl_kategori WHERE id_kategori_buku = '".$id_kategori_buku."'";
			$query = $conn->query($sql);
			$conn->close();
			return $query;
		}
		public function readAll(){
			include 'Koneksi.php';
			$sql = "SELECT * FROM tbl_kategori";
			$query = $conn->query($sql);
			$conn->close();
			return $query;
		}
		public function updatebyid($id_kategori_buku,$kategori_buku){
			include 'Koneksi.php';
			$sql = "UPDATE tbl_kategori SET kategori_buku = ? WHERE id_kategori_buku = ?";
			$stmt = $conn->prepare($sql);
			$stmt->bind_param('si',$kategori_buku,$id_kategori_buku);
			$query = $stmt->execute();
			$stmt->close();
			$conn->close();
			return $query;
		}
		public function deletebyid($id_kategori_buku){
			include 'Koneksi.php';
			$sql = "DELETE FROM tbl_kategori WHERE id_kategori_buku = ?";
			$stmt = $conn->prepare($sql);
			$stmt->bind_param('i',$id_kategori_buku);
			$query = $stmt->execute();
			$stmt->close();
			$conn->close();
			return $query;
		}
	}
?>