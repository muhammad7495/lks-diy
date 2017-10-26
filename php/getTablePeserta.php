<?php 
require_once '../php/mysql.php'; 
$search = isset($_POST['search'])?$mysql->real_escape_string($_POST['search']):'';
$start = isset($_POST['filter'])?$mysql->real_escape_string($_POST['filter'])*10:0;
$query = $mysql->query('SELECT peserta.id, peserta.no_peserta, peserta.nama, peserta.username, peserta.sekolah_id, peserta.tgl_lahir, peserta.kelas, peserta.lomba_id, lomba.nama_lomba, sekolah.nama_sekolah FROM ((peserta INNER JOIN lomba ON peserta.lomba_id = lomba.id_lomba) INNER JOIN sekolah ON peserta.sekolah_id = sekolah.id_sekolah) WHERE (peserta.nama LIKE "%'.$search.'%" OR peserta.no_peserta LIKE "%'.$search.'%" OR lomba.nama_lomba LIKE "%'.$search.'%" OR sekolah.nama_sekolah LIKE "%'.$search.'%") ORDER BY peserta.no_peserta ASC LIMIT '.$start.', 10') or die ('SQL Error: '.$mysql->error); ?>
	<table>
		<thead>
			<th class="col-2">No Peserta</th>
			<th class="col-3">Nama</th>
			<th class="col-3">Asal Sekolah</th>
			<th class="col-3">Bidang Lomba</th>
			<?php if($_SESSION['admin']['rank']==1){ ?><th class="col-1">Opsi</th><?php } ?>
		</thead>
		<tbody>
		<?php while($peserta = $query->fetch_assoc()){ ?>
			<tr>
				<td><?php echo $peserta['no_peserta']; ?></td>
				<td><?php echo $peserta['nama']; ?></td>
				<td><?php echo $peserta['nama_sekolah']; ?></td>
				<td><?php echo $peserta['nama_lomba']; ?></td>
				<?php if($_SESSION['admin']['rank']==1){ ?><td><a modal-toggle="#detailPeserta" data-id="<?php echo $peserta['id']; ?>" data-no-peserta="<?php echo $peserta['no_peserta']; ?>" data-name="<?php echo $peserta['nama']; ?>" data-username="<?php echo $peserta['username']; ?>" data-birthdate="<?php echo date('d-m-Y', $peserta['tgl_lahir']); ?>" data-school="<?php echo $peserta['sekolah_id']; ?>" data-class="<?php echo $peserta['kelas']; ?>" data-competition="<?php echo $peserta['lomba_id']; ?>" class="btn btn-sm btn-important">Detail</a></td><?php } ?>
			</tr>
		<?php } ?>	
		</tbody>
	</table>
	<input type="hidden" name="table_count" value="<?php echo $search!=''?$query->num_rows:$mysql->query('SELECT * FROM peserta')->num_rows; ?>" disabled>