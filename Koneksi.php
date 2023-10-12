<?php 
session_start();
/**
 * 
 */
class Koneksi {
	private $conn;
	function __construct() {
		$servername = "localhost";
		$username = "root";
		$password = "";
		$databasename = "tiket_pesawat";
		$this->conn = mysqli_connect($servername, $username, $password, $databasename);
	}

	public function login_admin(){
		$username = $_POST['username'];
		$password = md5($_POST['password']);
		$sql      = "SELECT * FROM admin WHERE username=LOWER('$username') AND password='$password';";
        $result   = $this->conn->query($sql);
        $row   = $result->fetch_assoc();
        if ($row > 0) {
            $_SESSION['admin'] = $username;
        	header("location: admin/dashboard.php");
        } else{
			echo "<script> alert('Username atau Password salah');</script>";
            echo "<script> location= 'admin/login.php'; </script>";
        }
	}

	public function login_user(){
		$username = $_POST['username'];
		$password = md5($_POST['password']);
		$sql      = "SELECT * FROM user WHERE username=LOWER('$username') AND password='$password';";
        $result   = $this->conn->query($sql);
        $row   = $result->fetch_assoc();
        if ($row > 0) {
            $_SESSION['user'] = $username;
        	header("location: user/dashboard.php");
        } else{
			echo "<script> alert('Username atau Password salah');</script>";
            echo "<script> location= 'user/login.php'; </script>";
        }
	}

	public function insert_admin(){
		$target_dir		= "upload/"; // Untuk Foto
		$file_name		= basename($_FILES["foto"]["name"]); // Untuk Foto
		$target_file	= $target_dir . $file_name; // Untuk Foto
		$imageFileType	= strtolower(pathinfo($target_file,PATHINFO_EXTENSION)); // untuk foto
		if (move_uploaded_file($_FILES["foto"]["tmp_name"],$target_file)) {
			if ($_POST['password']==$_POST['konfirmasi']) {
				$username =$_POST['username'];
				$nama_lengkap =$_POST['nama_depan'].' '.$_POST['nama_belakang'];
				$no_identitas =$_POST['no_identitas'];
				$email =$_POST['email'];
				$no_ponsel =$_POST['no_ponsel'];
				$alamat =$_POST['alamat'];
				$password =md5($_POST['password']);
				$sql="INSERT INTO admin(username, password, no_identitas, nama_lengkap, email, no_ponsel, alamat, foto) VALUES ('$username','$password', '$no_identitas', '$nama_lengkap', '$email', '$no_ponsel', '$alamat', '$target_file')";
				$result=$this->conn->query($sql);
				if ($result == true) {
					echo "<script> alert('Akun Admin berhasil dibuat');</script>";
					$_SESSION['admin'] = $username;
					echo "<script> location='admin/dashboard.php'; </script>";
				} else {
					echo "<script> alert('Akun Admin gagal dibuat');</script>";
					echo "<script> location='admin/registrasi.php'; </script>";
				}
			} else {
				echo "<script> alert('Pastikan Password & konfirmasi password sama');</script>";
			}
		} else {
			echo "<script> alert('Foto Gagal diunggah');</script>";
		}
		mysqli_close($this->conn);
	}

	public function insert_tiket(){
		$kode_tiket =$_POST['kode_tiket'];
		$kode_pesawat =$_POST['kode_pesawat'];
		$maskapai =$_POST['maskapai'];
		$class =$_POST['class'];
		$keberangkatan =$_POST['keberangkatan'];
		$tujuan = $_POST['tujuan'];
		$tanggal_keberangkatan = $_POST['tanggal_keberangkatan'];
		$waktu_keberangkatan = $_POST['waktu_keberangkatan'];
		$harga = $_POST['harga'];
		$sql="INSERT INTO `tiket`(`id`, `kode_tiket`, `kode_pesawat`, `maskapai`, `class`, `keberangkatan`, `tujuan`, `tanggal_keberangkatan`, `waktu_keberangkatan`, `harga`, `status`) VALUES ('','$kode_tiket', '$kode_pesawat', '$maskapai', '$class', '$keberangkatan', '$tujuan', '$tanggal_keberangkatan', '$waktu_keberangkatan', '$harga','Tersedia')";
		$result=$this->conn->query($sql);
		if ($result == true) {
			echo "<script> alert('Data Tiket berhasil ditambah');</script>";
		} else {
			echo "<script> alert('Data Tiket gagal ditambah');</script>";
		}
		echo "<script> location='admin/dashboard.php'; </script>";
		mysqli_close($this->conn);
	}

	public function update_tiket(){
		$id =$_POST['id'];
		$kode_tiket =$_POST['kode_tiket'];
		$kode_pesawat =$_POST['kode_pesawat'];
		$maskapai =$_POST['maskapai'];
		$class =$_POST['class'];
		$keberangkatan =$_POST['keberangkatan'];
		$tujuan = $_POST['tujuan'];
		$tanggal_keberangkatan = $_POST['tanggal_keberangkatan'];
		$waktu_keberangkatan = $_POST['waktu_keberangkatan'];
		$harga = $_POST['harga'];
		$sql="UPDATE `tiket` SET `kode_tiket` = '$kode_tiket',`kode_pesawat` = '$kode_pesawat',`maskapai` = '$maskapai',`class` = '$class',`keberangkatan` = '$keberangkatan',`tujuan` = '$tujuan',`tanggal_keberangkatan` = '$tanggal_keberangkatan',`waktu_keberangkatan` = '$waktu_keberangkatan',`harga` = '$harga' WHERE `id` = $id;";
		$result=$this->conn->query($sql);
		if ($result == true) {
			echo "<script> alert('Data Tiket berhasil diubah');</script>";
		} else {
			echo "<script> alert('Data Tiket gagal diubah');</script>";
		}
		echo "<script> location='admin/dashboard.php'; </script>";
		mysqli_close($this->conn);
	}

	public function insert_user(){
		$target_dir		= "upload/"; // Untuk Foto
		$file_name		= basename($_FILES["foto"]["name"]); // Untuk Foto
		$target_file	= $target_dir . $file_name; // Untuk Foto
		$imageFileType	= strtolower(pathinfo($target_file,PATHINFO_EXTENSION)); // untuk foto
		if (move_uploaded_file($_FILES["foto"]["tmp_name"],$target_file)) {
			if ($_POST['password']==$_POST['konfirmasi']) {
				$username =$_POST['username'];
				$nama_lengkap =$_POST['nama_depan'].' '.$_POST['nama_belakang'];
				$no_identitas =$_POST['no_identitas'];
				$email =$_POST['email'];
				$no_ponsel =$_POST['no_ponsel'];
				$alamat =$_POST['alamat'];
				$password =md5($_POST['password']);
				$sql="INSERT INTO user(username, password, no_identitas, nama_lengkap, email, no_ponsel, alamat, foto) VALUES ('$username','$password', '$no_identitas', '$nama_lengkap', '$email', '$no_ponsel', '$alamat', '$target_file')";
				$result=$this->conn->query($sql);
				if ($result == true) {
					echo "<script> alert('Akun Pengguna berhasil dibuat');</script>";
					$_SESSION['user'] = $username;
					echo "<script> location='user/dashboard.php'; </script>";
				} else {
					echo "<script> alert('Akun Pengguna gagal dibuat');</script>";
					echo "<script> location='user/registrasi.php'; </script>";
				}
			} else {
				echo "<script> alert('Pastikan Password & konfirmasi password sama');</script>";
			}
		} else {
			echo "<script> alert('Foto Gagal diunggah');</script>";
		}
		mysqli_close($this->conn);
	}

	public function book_tiket($id){
		$sql = "UPDATE `tiket` SET `status`='Booked' WHERE id = $id";
		$result = $this->conn->query($sql);
		$sql = "INSERT INTO `pemesanan`(`id`, `username`, `tanggal_pemesanan`) VALUES
		 ($id,'$_SESSION[user]',NOW())";
		$result = $this->conn->query($sql);
		header("location: user/dashboard.php");
	}
	public function cancel_tiket($id){
		$sql = "UPDATE `tiket` SET `status`='Tersedia' WHERE id = $id";
		$result = $this->conn->query($sql);
		$sql = "DELETE FROM `pemesanan` WHERE id = $id";
		$result = $this->conn->query($sql);
		header("location: user/dashboard.php");
	}
	public function cek_pemesanan($id){
		$sql = "SELECT * FROM pemesanan WHERE id = $id";
		return $this->conn->query($sql);
	}
	public function cek_pemesanan_username($username){
		$sql = "SELECT * FROM pemesanan WHERE username = '$username'";
		return $this->conn->query($sql);
	}
	public function pilih_pemesanan($username){
		$sql = "SELECT * FROM pemesanan JOIN tiket USING(id) WHERE username = '$username'";
		return $this->conn->query($sql);
	}
	public function select_pemesanan(){
		$sql = "SELECT * FROM pemesanan JOIN tiket USING(id)";
		return $this->conn->query($sql);
	}
	public function select_admin(){
		$sql="SELECT * FROM admin";
		return $this->conn->query($sql);
	}
	public function select_user(){
		$sql="SELECT * FROM user";
		return $this->conn->query($sql);
	}
	public function select_tiket(){
		$sql="SELECT * FROM tiket";
		return $this->conn->query($sql);
	}
	public function getUpdate_Tiket(){
		$sql = "SELECT * FROM tiket WHERE id='".$_POST['id']."'";
		$result = $this->conn->query($sql);
		$row = $result->fetch_assoc();
		echo json_encode($row);
	}
	public function delete_tiket($id){
		$sql = "DELETE FROM tiket WHERE id='$id'";
		$result = $this->conn->query($sql);
		if ($result == true) {
			echo "<script> alert('Data tiket berhasil dihapus');</script>";
			echo "<script> location='admin/dashboard.php'; </script>";
		} else {
			echo "<script> alert('Data tiket gagal dihapus');</script>";
			echo "<script> location='admin/dashboard.php'; </script>";
		}
	}
	public function logout_admin(){
		unset($_SESSION['admin']);
		header("location: admin/login.php");
	}
	public function logout_user(){
		unset($_SESSION['user']);
		header("location: user/login.php");
	}
}

$koneksi = new koneksi();

if (isset($_GET['login_user'])) {
	$koneksi->login_user();
}
if (isset($_GET['login_admin'])) {
	$koneksi->login_admin();
}
if (isset($_GET['insert_admin'])) {
	$koneksi->insert_admin();
}
if (isset($_GET['insert_user'])) {
	$koneksi->insert_user();
}
if (isset($_GET['insert_tiket'])) {
	$koneksi->insert_tiket();
}
if (isset($_GET['book_tiket'])) {
	$koneksi->book_tiket($_GET['book_tiket']);
}
if (isset($_GET['cancel_tiket'])) {
	$koneksi->cancel_tiket($_GET['cancel_tiket']);
}
if (isset($_GET['update_tiket'])) {
	$koneksi->update_tiket();
}
if (isset($_GET['delete_tiket'])) {
	$koneksi->delete_tiket($_GET['delete_tiket']);
}
if (isset($_GET['logout_admin'])) {
	$koneksi->logout_admin();
}
if (isset($_GET['logout_user'])) {
	$koneksi->logout_user();
}
if (isset($_GET['getUpdate_Tiket'])) {
	$koneksi->getUpdate_Tiket();
}