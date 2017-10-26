<?php 
require_once '../php/mysql.php'; 
if(isset($_SESSION['user']))
{
	$no_peserta = $mysql->real_escape_string($_POST['no_peserta']);
	$name = $mysql->real_escape_string($_POST['name']);
	$birthdate = strtotime($mysql->real_escape_string($_POST['birthdate']));
	$school = $mysql->real_escape_string($_POST['school']);
	$class = $mysql->real_escape_string($_POST['class']);
	$competition = $mysql->real_escape_string($_POST['competition']);
	if($_POST['oldpassword'] != "" && $_POST['password'] != "" && $_POST['cpassword'] != "")
	{
		$oldpassword = sha1($mysql->real_escape_string($_POST['oldpassword']));
		$password = sha1($mysql->real_escape_string($_POST['password']));
		$cpassword = sha1($mysql->real_escape_string($_POST['cpassword']));
		$query = $mysql->query("SELECT * FROM peserta WHERE password = '$oldpassword' AND id = ".$_SESSION['user']['id']."") or die('SQL Error: '.$mysql->error);
		if($query->num_rows == 1)
		{
			if($cpassword == $password){
				$sql = "UPDATE peserta SET password = '$password', no_peserta = $no_peserta, nama = '$name', tgl_lahir = $birthdate, sekolah_id = $school, kelas = '$class', lomba_id = $competition WHERE id = '$id'";
				$query = $mysql->query($sql) or die('SQL Error: '.$mysql->error);
				unset($_SESSION['user']);
				
			} else{
				$output['success'] = false;
				$output['message'] = 'Kata sandi baru tidak cocok.';
			}
		}
		else{
			$output['success'] = false;
			$output['message'] = 'Kata sandi lama tidak cocok.';
		}
		
	}	
	else{
		$sql = "UPDATE peserta SET no_peserta = $no_peserta, nama = '$name', tgl_lahir = $birthdate, sekolah_id = $school, kelas = '$class', lomba_id = $competition WHERE id = ".$_SESSION['user']['id']."";
		$query = $mysql->query($sql) or die('SQL Error: '.$mysql->error);
		$result = $mysql->query("SELECT * FROM peserta WHERE id = ".$_SESSION['user']['id']."")->fetch_assoc();
		$_SESSION['user'] = $result;
	}	
	if($query)
	{
		$output['success'] = true;
	}
	else{
		$output['success'] = false;
		$output['message'] = 'Gagal memperbaharui data.';
	}

	echo json_encode($output);
}
?>