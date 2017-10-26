<section class="main-section">
	Selamat Datang<?php session_start(); echo isset($_SESSION['user'])?', '.$_SESSION['user']['nama']:''; ?> di Laman LKS DIY
</section>
<section class="nilai-section">
	<?php 
	require_once '../php/mysql.php'; 
	$query = $mysql->query('SELECT * FROM lomba WHERE id_lomba = '.$_SESSION['user']['lomba_id'].'') or die ('SQL Error: '.$mysql->error);
	$result = $query->fetch_assoc();
	?>
	<h1>Nilai Bidang Lomba - <?php echo $result['nama_lomba']; ?></h1>
	<div class="separator"></div>
	<table>
		<thead>
			<th class="col-2">No Peserta</th>
			<th class="col-8">Nama</th>
			<th class="col-2">Nilai</th>
		</thead>
		<tbody>
		<?php 
		$search = isset($_POST['search'])?$mysql->real_escape_string($_POST['search']):'';
		$start = isset($_POST['filter'])?$mysql->real_escape_string($_POST['filter'])*10:0;
		$query = $mysql->query('SELECT peserta.no_peserta, peserta.nama, peserta.username, lomba.nama_lomba, nilai.nilai FROM peserta INNER JOIN lomba ON peserta.lomba_id = lomba.id_lomba INNER JOIN nilai ON peserta.id = nilai.id_nama_peserta WHERE peserta.lomba_id = '.$_SESSION['user']['lomba_id'].' ORDER BY nilai.nilai DESC') or die ('SQL Error: '.$mysql->error);
		while($peserta = $query->fetch_assoc()){ ?>
			<tr <?php if($_SESSION['user']['username'] == $peserta['username']){ echo 'class="highlight"';} ?>>
				<td><?php echo $peserta['no_peserta']; ?></td>
				<td><?php echo $peserta['nama']; ?></td>
				<td><?php echo $peserta['nilai']; ?></td>
			</tr>
		<?php } ?>	
		</tbody>
	</table>
	<input type="hidden" name="table_count" value="<?php echo $search!=''?$query->num_rows:$mysql->query('SELECT * FROM peserta')->num_rows; ?>" disabled>
</section>