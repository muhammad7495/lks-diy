<?php
session_start();
if(isset($_POST['logout']) && $_POST['logout'] == 'admin')
{
	unset($_SESSION['admin']);
}
else
{
	unset($_SESSION['user']);
}
$output['success'] = true;
echo json_encode($output);
?>