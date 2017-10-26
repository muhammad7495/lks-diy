<?php 
require_once '../php/mysql.php'; 
if(isset($_POST['id']))
{
	$id = $mysql->real_escape_string($_POST['id']);
	$no_peserta = $mysql->real_escape_string($_POST['no_peserta']);
	$name = $mysql->real_escape_string($_POST['name']);
	$email = $mysql->real_escape_string($_POST['email']);
	$birthdate = strtotime($mysql->real_escape_string($_POST['birthdate']));
	$school = $mysql->real_escape_string($_POST['school']);
	$class = $mysql->real_escape_string($_POST['class']);
	$competition = $mysql->real_escape_string($_POST['competition']);
	$query = $mysql->query("UPDATE peserta SET no_peserta = $no_peserta, nama = '$name', tgl_lahir = $birthdate, sekolah_id = $school, kelas = '$class', lomba_id = $competition WHERE id = '$id'") or die('SQL Error: '.$mysql->error);
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