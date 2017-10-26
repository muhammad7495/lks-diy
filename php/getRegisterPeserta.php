<?php require_once '../php/mysql.php'; ?>
<input type="number" name="no_peserta" placeholder="No Peserta" max="999" required>
<select name="school" required>
	<option selected disabled>Asal Sekolah</option>
	<?php $query = $mysql->query('SELECT * FROM sekolah ORDER BY nama_sekolah ASC') or die('SQL Error: '. $mysql->error);
						while($rows = $query->fetch_assoc()){?>
	<option value="<?php echo $rows['id_sekolah']; ?>"><?php echo $rows['nama_sekolah']; ?></option>
	<?php } ?>
</select>
<select name="class" required>
	<option selected disabled>Kelas</option>
	<option value="10">X</option>
	<option value="11">XI</option>
	<option value="12">XII</option>
</select>
<select name="competition" required>
	<option selected disabled>Lomba</option>
	<?php $query = $mysql->query('SELECT * FROM lomba ORDER BY nama_lomba ASC') or die('SQL Error: '. $mysql->error);
						while($rows = $query->fetch_assoc()){?>
	<option value="<?php echo $rows['id_lomba']; ?>"><?php echo $rows['nama_lomba']; ?></option>
	<?php } ?>
</select>