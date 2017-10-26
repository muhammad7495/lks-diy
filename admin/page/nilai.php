<?php 
require_once '../../php/mysql.php'; 
?>
<div class="title-content">Nilai</div>
<div class="box">
	<a class="btn btn-md btn-danger" id="previous">&lt;</a><a class="btn btn-md btn-success" id="next">&gt;</a>
	<input type="text" name="search" class="col-3 pull-right input-search" placeholder="Cari">
	<div id="table">Loading... <span class="fa fa-spinner fa-spin"></span></div>
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
<div id="detailNilai" class="modal">
	<div class="modal-content">
		<div class="modal-header">
				Detil Data Nilai
		</div>
		<div class="modal-body">
			<div class="message"></div>
			<form id="frmNilai">
				No Peserta:<br>
				<input type="text" name="no_peserta" disabled>
				Nama Peserta:<br>
				<select name="name" disabled>
					<option disabled>Nama Peserta</option>
					<?php $query = $mysql->query('SELECT * FROM peserta ORDER BY nama ASC') or die('SQL Error: '. $mysql->error);
										while($rows = $query->fetch_assoc()){?>
					<option value="<?php echo $rows['id']; ?>"><?php echo $rows['nama']; ?></option>
					<?php } ?>
				</select>
				Lomba:<br>
				<select name="competition" disabled>
					<option disabled>Lomba</option>
					<?php $query = $mysql->query('SELECT * FROM lomba ORDER BY nama_lomba ASC') or die('SQL Error: '. $mysql->error);
										while($rows = $query->fetch_assoc()){?>
					<option value="<?php echo $rows['id_lomba']; ?>"><?php echo $rows['nama_lomba']; ?></option>
					<?php } ?>
				</select>
				Nilai:<br>
				<input type="number" name="mark" max="100" disabled>
				<input type="hidden" name="id">
				<button id="edit" class="btn btn-fulfill btn-important">Ubah</button>
				<button type="submit" class="btn btn-fulfill btn-success">Simpan</button>
			</form>
		</div>
	</div>
</div>
<script src="../js/table.js"></script>