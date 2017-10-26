<?php 
require_once '../../php/mysql.php'; 
?>
<div class="title-content">Juri</div>
<div class="box">
	<a class="btn btn-md btn-danger" id="previous">&lt;</a><a class="btn btn-md btn-success" id="next">&gt;</a>
	<input type="text" name="search" class="col-3 pull-right input-search" placeholder="Cari">
	<div id="table">Loading... <span class="fa fa-spinner fa-spin"></span></div>
</div>
<?php if($_SESSION['admin']['rank']==1){ ?>
<!-- Modal -->
<div id="detailJuri" class="modal">
	<div class="modal-content">
		<div class="modal-header">
				Detil Data Juri
		</div>
		<div class="modal-body">
			<div class="message"></div>
			<form id="frmJuri">
				Nama Panjang:<br>
				<input type="text" name="name" disabled>
				Email:<br>
				<input type="text" name="email" disabled>
				Nama Pengguna:<br>
				<input type="text" name="username" disabled>
				Tanggal Lahir:<br>
				<input type="text" name="birthdate" pattern="(0[1-9]|1[0-9]|2[0-9]|3[01]).(0[1-9]|1[012]).[0-9]{4}" disabled>
				Lomba:<br>
				<select name="competition" disabled>
					<option disabled>Lomba</option>
					<?php $query = $mysql->query('SELECT * FROM lomba ORDER BY nama_lomba ASC') or die('SQL Error: '. $mysql->error);
										while($rows = $query->fetch_assoc()){?>
					<option value="<?php echo $rows['id_lomba']; ?>"><?php echo $rows['nama_lomba']; ?></option>
					<?php } ?>
				</select>
				<input type="hidden" name="id">
				<input type="hidden" name="data">
				<button id="edit" class="btn btn-fulfill btn-important">Ubah</button>
				<button type="submit" class="btn btn-fulfill btn-success">Simpan</button><br>
				<button id="rank" class="btn btn-fulfill btn-success">Jadikan Panitia</button>
			</form>
		</div>
	</div>
</div>
<?php } ?>
<script src="../js/table.js"></script>