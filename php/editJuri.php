<?php 
require_once '../php/mysql.php'; 
if(isset($_POST['data']))
{
	if(isset($_POST['id']))
	{
		$id = $mysql->real_escape_string($_POST['id']);
		$name = $mysql->real_escape_string($_POST['name']);
		$email = $mysql->real_escape_string($_POST['email']);
		$competition = $mysql->real_escape_string($_POST['competition']);
		$birthdate = strtotime($mysql->real_escape_string($_POST['birthdate']));
		$query = $mysql->query("UPDATE admin SET nama = '$name', email = '$email', tgl_lahir = $birthdate, lomba_id = $competition WHERE id = '$id'") or die('SQL Error: '.$mysql->error);
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
}
else{
	if(isset($_POST['id']))
	{
		$id = $mysql->real_escape_string($_POST['id']);
		$query = $mysql->query("UPDATE admin SET rank = 1 WHERE id = '$id'") or die('SQL Error: '.$mysql->error);
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
}
?>