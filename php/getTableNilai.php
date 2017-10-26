<?php 
require_once '../php/mysql.php'; 
$search = isset($_POST['search'])?$mysql->real_escape_string($_POST['search']):'';
$start = isset($_POST['filter'])?$mysql->real_escape_string($_POST['filter'])*10:0;
$query = $mysql->query('SELECT peserta.id, peserta.no_peserta, peserta.nama, peserta.username, lomba.id_lomba, lomba.nama_lomba, nilai.nilai, nilai.id_nilai FROM peserta INNER JOIN lomba ON peserta.lomba_id = lomba.id_lomba INNER JOIN nilai ON peserta.id = nilai.id_nama_peserta WHERE (peserta.nama LIKE "%'.$search.'%" OR peserta.no_peserta LIKE "%'.$search.'%" OR lomba.nama_lomba LIKE "%'.$search.'%" OR nilai.nilai LIKE "%'.$search.'%") ORDER BY lomba.nama_lomba ASC, nilai.nilai DESC') or die ('SQL Error: '.$mysql->error); ?>
	<table>
		<thead>
			<th class="col-1">No Peserta</th>
			<th class="col-3">Nama</th>
			<th class="col-1">Bidang Lomba</th>
			<th class="col-1">Nilai</th>
			<th class="col-1">Opsi</th>
		</thead>
		<tbody>
		<?php while($peserta = $query->fetch_assoc()){ ?>
			<tr>
				<td><?php echo $peserta['no_peserta']; ?></td>
				<td><?php echo $peserta['nama']; ?></td>
				<td><?php echo $peserta['nama_lomba']; ?></td>
				<td><?php echo $peserta['nilai']; ?></td>
				<?php if($_SESSION['admin']['rank']==1 || $_SESSION['admin']['lomba_id']==$peserta['id_lomba']){ ?><td><a modal-toggle="#detailNilai" data-id="<?php echo $peserta['id_nilai']; ?>" data-no-peserta="<?php echo $peserta['no_peserta']; ?>" data-name="<?php echo $peserta['id']; ?>" data-competition="<?php echo $peserta['id_lomba']; ?>" data-mark="<?php echo $peserta['nilai']; ?>" class="btn btn-sm btn-important">Detail</a></td><?php } else { ?><td></td><?php } ?>
			</tr>
		<?php } ?>	
		</tbody>
	</table>
	<input type="hidden" name="table_count" value="<?php echo $search!=''?$query->num_rows:$mysql->query('SELECT * FROM nilai')->num_rows; ?>" disabled>