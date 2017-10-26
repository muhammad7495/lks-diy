<?php
	require_once 'php/mysql.php';
	$url = $_SERVER['REQUEST_URI'];
	$urls = explode('/', $url);
	$title = $urls[count($urls)-1]!=""?ucfirst($urls[count($urls)-1]):'Home';
	if(isset($_SESSION['admin']))
	{
		header('Location: ./admin');
	}
?>
<html>
<head>
	<title>LKS DIY - <?php echo $title; ?></title>
	<link rel="favicon" href="img/favicon/favicon.ico">
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/font-awesome.css">
</head>
<body>
	<nav class="nav">
		<div class="container">
			<div class="nav-left">
				<a href="./"><img src="img/logo.png"><span class="nav-brand"> LKS DIY - 2017</span></a>
			</div>
			<div class="nav-right">
			</div>
		</div>
	</nav>
	
	<div id="content">
	</div>
	
	<footer>Copyright &copy; 2017 - LKS DIY</footer>
	
	<!-- Modal -->
	<div id="login" class="modal">
		<div class="modal-content">
			<div class="modal-header">
				Masuk
			</div>
			<div class="modal-body">
				<div class="message"></div>
				<form action="php/login.php" method="POST">
					<input type="text" name="username" placeholder="Nama Pengguna" required>
					<input type="password" name="password" placeholder="Kata Sandi" required>
					<button class="btn btn-fulfill btn-important" name="login">Masuk</button>
				</form>
			</div>
		</div>
	</div>
	<div id="register" class="modal">
		<div class="modal-content">
			<div class="modal-header">
				Daftar
			</div>
			<div class="modal-body">
				<div class="message"></div>
				<form action="php/register.php" method="POST">
					<input type="text" name="fullname" placeholder="Nama Panjang" required>
					<input type="text" name="username" placeholder="Nama Pengguna" required>
					<input type="text" name="email" placeholder="Email" required>
					<input type="password" name="password" placeholder="Kata Sandi" required>
					<input type="password" name="cpassword" placeholder="Ulang Kata Sandi" required>
					<input type="text" name="birthdate" pattern="(0[1-9]|1[0-9]|2[0-9]|3[01]).(0[1-9]|1[012]).[0-9]{4}" placeholder="Tanggal Lahir (DD-MM-YYYY)" required>
					<select name="permissions" required>
						<option selected disabled>Hak Akses</option>
						<option value="0">Peserta</option>
						<option value="1">Juri/Admin</option>
					</select>
					<button class="btn btn-fulfill btn-important" name="register">Daftar</button>
				</form>
			</div>
		</div>
	</div>
	<div id="setPeserta" class="modal">
		<div class="modal-content">
			<div class="modal-header">
				Pengaturan
			</div>
			<div class="modal-body">
				<div class="message"></div>
				<form id="frmSettings">
					No Peserta:<br>
					<input type="text" name="no_peserta" placeholder="No Peserta" value="<?php echo $_SESSION['user']['no_peserta']; ?>" required>
					Nama Panjang:<br>
					<input type="text" name="name" placeholder="Nama Panjang" value="<?php echo $_SESSION['user']['nama']; ?>" required>
					Nama Pengguna:<br>
					<input type="text" name="username" placeholder="Nama Pengguna" value="<?php echo $_SESSION['user']['username']; ?>" disabled>
					Kata Sandi Lama:<br>
					<input type="password" name="oldpassword" placeholder="Kata Sandi Lama">
					Kata Sandi Baru:<br>
					<input type="password" name="password" placeholder="Kata Sandi Baru">
					Ulang Kata Sandi Baru:<br>
					<input type="password" name="cpassword" placeholder="Ulang Kata Sandi Baru">
					Tanggal Lahir:<br>
					<input type="text" name="birthdate" pattern="(0[1-9]|1[0-9]|2[0-9]|3[01]).(0[1-9]|1[012]).[0-9]{4}" placeholder="Tanggal Lahir (DD-MM-YYYY)" value="<?php echo date('d-m-Y',$_SESSION['user']['tgl_lahir']); ?>" required>
					Asal Sekolah:<br>
					<select name="school" value="<?php echo $_SESSION['user']['sekolah_id']; ?>" required>
						<option disabled>Asal Sekolah</option>
						<?php $query = $mysql->query('SELECT * FROM sekolah ORDER BY nama_sekolah ASC') or die('SQL Error: '. $mysql->error);
											while($rows = $query->fetch_assoc()){?>
						<option value="<?php echo $rows['id_sekolah']; ?>"><?php echo $rows['nama_sekolah']; ?></option>
						<?php } ?>
					</select>
					Kelas:<br>
					<select name="class" value="<?php echo $_SESSION['user']['kelas']; ?>" required>
						<option disabled>Kelas</option>
						<option value="10">X</option>
						<option value="11">XI</option>
						<option value="12">XII</option>
					</select>
					Lomba:<br>
					<select name="competition" value="<?php echo $_SESSION['user']['lomba_id']; ?>" required>
						<option disabled>Lomba</option>
						<?php $query = $mysql->query('SELECT * FROM lomba ORDER BY nama_lomba ASC') or die('SQL Error: '. $mysql->error);
											while($rows = $query->fetch_assoc()){?>
						<option value="<?php echo $rows['id_lomba']; ?>"><?php echo $rows['nama_lomba']; ?></option>
						<?php } ?>
					</select>
					#Note: Isi kolom kata sandi apabila ingin mengubah kata sandi.
					<button type="submit" class="btn btn-fulfill btn-success" name="settings">Simpan</button>
				</form>
			</div>
		</div>
	</div>
</body>
<!--- Scripts --->
<script src="js/jquery.min.js"></script>
<script src="js/page.js"></script>
<script src="js/modal.js"></script>
<script src="js/modify.js"></script>
<script src="js/user.js"></script>
</html>