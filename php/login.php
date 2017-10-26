<?php 
require_once '../php/mysql.php'; 
if(isset($_POST['username']))
{
	$username = $mysql->real_escape_string($_POST['username']);
	$password = $mysql->real_escape_string($_POST['password']);
	$passwordhashed = sha1($password);
	$query = $mysql->query("SELECT * FROM peserta WHERE username = '$username'") or die('SQL Error: '.$mysql->error);
	if($query->num_rows > 0)
	{
		$result = $query->fetch_assoc();
		if($passwordhashed == $result['password']){
			$_SESSION['user'] = $result;
			$output['success'] = true;
			$output['url'] = './';
		}
		else{
			$output['success'] = false;
			$output['message'] = 'Kata sandi tidak cocok.';
		}
	}
	else{
		$query = $mysql->query("SELECT * FROM admin WHERE username = '$username'") or die('SQL Error: '.$mysql->error);
		if($query->num_rows > 0){
			$result = $query->fetch_assoc();
			if($passwordhashed == $result['password']){
				$_SESSION['admin'] = $result;
				$output['success'] = true;
				$output['url'] = './admin';
			}
			else{
				$output['success'] = false;
				$output['message'] = 'Kata sandi tidak cocok.';
			}
		}
		else{
			$output['success'] = false;
			$output['message'] = 'Akun belum terdaftar.';
		}
	}
	echo json_encode($output);
}
?>