<?php 
require_once '../php/mysql.php'; 
$search = isset($_POST['search'])?$mysql->real_escape_string($_POST['search']):'';
$start = isset($_POST['filter'])?$mysql->real_escape_string($_POST['filter'])*10:0;
$query = $mysql->query('SELECT admin.id, admin.nama, admin.email, admin.username, admin.tgl_lahir, admin.lomba_id, lomba.nama_lomba FROM admin LEFT JOIN lomba ON admin.lomba_id = lomba.id_lomba WHERE (admin.rank = 0 AND admin.pending = 0) AND (admin.nama LIKE "%'.$search.'%") ORDER BY admin.nama ASC LIMIT '.$start.', 10') or die ('SQL Error: '.$mysql->error); ?>
	<table>
		<thead>
			<th class="col-1">No</th>
			<th class="col-3">Nama</th>
			<th class="col-3">Bidang Lomba</th>
			<?php if($_SESSION['admin']['rank']==1){ ?><th class="col-1">Opsi</th><?php } ?>
		</thead>
		<tbody>
		<?php $i=1; while($peserta = $query->fetch_assoc()){ ?>
			<tr>
				<td><?php echo $i; ?></td>
				<td><?php echo $peserta['nama']; ?></td>
				<td><?php echo $peserta['nama_lomba']; ?></td>
				<?php if($_SESSION['admin']['rank']==1){ ?><td><a modal-toggle="#detailJuri" data-id="<?php echo $peserta['id']; ?>" data-name="<?php echo $peserta['nama']; ?>" data-email="<?php echo $peserta['email']; ?>" data-username="<?php echo $peserta['username']; ?>" data-competition="<?php echo $peserta['lomba_id']; ?>" data-birthdate="<?php echo date('d-m-Y', $peserta['tgl_lahir']); ?>" class="btn btn-sm btn-important">Detail</a></td><?php } ?>
			</tr>
		<?php $i++;} ?>	
		</tbody>
	</table>
	<input type="hidden" name="table_count" value="<?php echo $search!=''?$query->num_rows:$mysql->query('SELECT * FROM admin WHERE rank = 0')->num_rows; ?>" disabled>