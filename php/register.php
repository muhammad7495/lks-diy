<?php 
require_once '../php/mysql.php'; 
if(isset($_POST['fullname']))
{
	$fullname = $mysql->real_escape_string($_POST['fullname']);
	$email = $mysql->real_escape_string($_POST['email']);
	$username = $mysql->real_escape_string($_POST['username']);
	$password = $mysql->real_escape_string($_POST['password']);
	$cpassword = $mysql->real_escape_string($_POST['cpassword']);
	$birthdate = strtotime($mysql->real_escape_string($_POST['birthdate']));
	$permissions = $mysql->real_escape_string($_POST['permissions']);
	if(isset($_POST['no_peserta']))
	{
		$school = $mysql->real_escape_string($_POST['school']);
		$class = $mysql->real_escape_string($_POST['class']);
		$competition = $mysql->real_escape_string($_POST['competition']);
		$no_peserta = $mysql->real_escape_string($_POST['no_peserta']);
	}
	if($cpassword == $password)
	{
		$passwordhashed = sha1($password);
		if($permissions == 0){
			$query = $mysql->query("SELECT * FROM peserta WHERE username = '$username'") or die('SQL Error: '.$mysql->error);
			if($query->num_rows < 1)
			{
				$mysql->query("INSERT INTO peserta VALUES (NULL, '$fullname', $no_peserta, $school, $birthdate, $class, '$username', '$passwordhashed', $competition)") or die('SQL Error: '.$mysql->error);
				$query = $mysql->query("SELECT * FROM peserta WHERE username = '$username'") or die('SQL Error: '.$mysql->error);
				$_SESSION['user'] = $query->fetch_assoc();
				$output['success'] = true;
				$output['url'] = './';
			}
			else{
				$output['success'] = false;
				$output['message'] = 'Akun sudah terdaftar.';
			}
		}else{
			$query = $mysql->query("SELECT * FROM admin WHERE username = '$username'") or die('SQL Error: '.$mysql->error);
			if($query->num_rows < 1){
				$mysql->query("INSERT INTO admin VALUES (NULL, '$fullname', '$email', '$username', '$passwordhashed', $birthdate, 0, 1, 1)") or die('SQL Error: '.$mysql->error);
				$query = $mysql->query("SELECT * FROM admin WHERE username = '$username'") or die('SQL Error: '.$mysql->error);
				$_SESSION['admin'] = $query->fetch_assoc();
				$output['success'] = true;
				$output['url'] = './admin';
			}
			else{
				$output['success'] = false;
				$output['message'] = 'Akun sudah terdaftar.';
			}
		}
	}
	else{
		$output['success'] = false;
		$output['message'] = 'Kata sandi tidak cocok.';
	}
	echo json_encode($output);
}
?>