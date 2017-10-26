<?php 
require_once '../../php/mysql.php'; 
?>
<div class="title-content">Peserta</div>
<div class="box">
	<a class="btn btn-md btn-danger" id="previous">&lt;</a><a class="btn btn-md btn-success" id="next">&gt;</a>
	<input type="text" name="search" class="col-3 pull-right input-search" placeholder="Cari">
	<div id="table">Loading... <span class="fa fa-spinner fa-spin"></span></div>
</div>

<?php if($_SESSION['admin']['rank']==1){ ?>
<!-- Modal -->
<div id="detailPeserta" class="modal">
	<div class="modal-content">
		<div class="modal-header">
				Detil Data Peserta
		</div>
		<div class="modal-body">
			<div class="message"></div>
			<form id="frmPeserta">
				No Peserta:<br>
				<input type="number" name="no_peserta" max="999" disabled>
				Nama Panjang:<br>
				<input type="text" name="name" disabled>
				Nama Pengguna:<br>
				<input type="text" name="username" disabled>
				Tanggal Lahir:<br>
				<input type="text" name="birthdate" pattern="(0[1-9]|1[0-9]|2[0-9]|3[01]).(0[1-9]|1[012]).[0-9]{4}" disabled>
				Asal Sekolah:<br>
				<select name="school" disabled>
					<option disabled>Asal Sekolah</option>
					<?php $query = $mysql->query('SELECT * FROM sekolah ORDER BY nama_sekolah ASC') or die('SQL Error: '. $mysql->error);
										while($rows = $query->fetch_assoc()){?>
					<option value="<?php echo $rows['id_sekolah']; ?>"><?php echo $rows['nama_sekolah']; ?></option>
					<?php } ?>
				</select>
				Kelas:<br>
				<select name="class" disabled>
					<option disabled>Kelas</option>
					<option value="10">X</option>
					<option value="11">XI</option>
					<option value="12">XII</option>
				</select>
				Lomba:<br>
				<select name="competition" disabled>
					<option disabled>Lomba</option>
					<?php $query = $mysql->query('SELECT * FROM lomba ORDER BY nama_lomba ASC') or die('SQL Error: '. $mysql->error);
										while($rows = $query->fetch_assoc()){?>
					<option value="<?php echo $rows['id_lomba']; ?>"><?php echo $rows['nama_lomba']; ?></option>
					<?php } ?>
				</select>
				<input type="hidden" name="id">
				<button id="edit" class="btn btn-fulfill btn-important">Ubah</button>
				<button type="submit" class="btn btn-fulfill btn-success">Simpan</button>
			</form>
		</div>
	</div>
</div>
<?php } ?>
<script src="../js/table.js"></script>