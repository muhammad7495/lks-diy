<?php 
require_once '../php/mysql.php'; 
if(isset($_POST['id']))
{
	$id = $mysql->real_escape_string($_POST['id']);
	$name = $mysql->real_escape_string($_POST['name']);
	$mark = $mysql->real_escape_string($_POST['mark']);
	$query = $mysql->query("UPDATE nilai SET id_nama_peserta = $name, nilai = $mark WHERE id_nilai = $id") or die('SQL Error: '.$mysql->error);
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