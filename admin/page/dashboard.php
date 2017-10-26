<?php 
require_once '../../php/mysql.php'; 
$peserta_count = $mysql->query('SELECT * FROM peserta')->num_rows;
$juri_count = $mysql->query('SELECT * FROM admin WHERE rank = 0')->num_rows;
$lomba_count = $mysql->query('SELECT * FROM lomba')->num_rows;
$sekolah_count = $mysql->query('SELECT * FROM sekolah')->num_rows;
?>
<div class="row">
	<div class="stats red col-3">
		<div class="count"><span class="fa fa-users"></span><?php echo $peserta_count; ?></div>
		<div class="caption">Jumlah Peserta</div>
	</div>
	<div class="stats green col-3">
		<div class="count"><span class="fa fa-pencil"></span><?php echo $juri_count; ?></div>
		<div class="caption">Jumlah Juri</div>
	</div>
	<div class="stats blue col-3">
		<div class="count"><span class="fa fa-tasks"></span><?php echo $lomba_count; ?></div>
		<div class="caption">Jumlah Lomba</div>
	</div>
	<div class="stats yellow col-3">
		<div class="count"><span class="fa fa-institution"></span><?php echo $sekolah_count; ?></div>
		<div class="caption">Jumlah Sekolah</div>
	</div>
</div>
<!-- Modal -->
<div id="login" class="modal">
	<div class="modal-content">
		<div class="modal-header">
				Masuk
		</div>
		<div class="modal-body">
			<form>
				<input type="text" name="username" placeholder="Username">
				<input type="text" name="password" placeholder="Password">
				<button class="btn">Masuk</button>
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
			<form>
				<input>
				<input>
				<button class="btn">Daftar</button>
			</form>
		</div>
	</div>
</div>