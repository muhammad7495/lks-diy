<?php session_start();
if(!isset($_SESSION['admin'])){
	header('Location: ../');
}
?>
<html>
<head>
	<title>LKS DIY Admin Panel</title>
	<link rel="favicon" href="../img/favicon/favicon.ico">
	<link rel="stylesheet" href="../css/style.css">
	<link rel="stylesheet" href="../css/font-awesome.css">
</head>
<body>
	<nav class="nav nav-fixed">
		<div class="nav-left">
			<a href="./"><img src="../img/logo.png"><span class="nav-brand"> LKS DIY - 2017</span></a>
		</div>
		<div class="nav-right">
			<a href="logout"><span class="fa fa-sign-out"></span> Keluar</a>
		</div>
	</nav>
	<nav class="sidenav sidenav-fixed">
		<ul>
			<a href="dashboard"><li>Beranda</li></a>
			<a href="peserta"><li>Peserta</li></a>
			<a href="juri"><li>Juri</li></a>
			<a href="panitia"><li>Panitia</li></a>
			<a href="nilai"><li>Nilai</li></a>
		</ul>
	</nav>
	<div id="content-admin"></div>
</body>

<!--- Scripts --->
<script src="../js/jquery.min.js"></script>
<script src="../js/admin-page.js"></script>
</html>