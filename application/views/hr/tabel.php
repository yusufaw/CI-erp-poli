
	<table id="tabel" class="table table-bordered table-striped">
	<thead>
	<tr>
		<th></th>
	<th>ID</th>
	<th>Nama</th>
	<th>Departemen</th>
	<th width="150">Alamat</th>
	<th>Telepon</th>
	<th>Tanggal Masuk</th>
	<th>Tanggal Keluar</th>
	<th>Status</th>
	<th>Jabatan</th>
	<th>Gaji</th>
	<th>Aksi</th></tr></thead><tbody>
	<?php
	foreach ($daftar_pegawai as $key) {
	echo "<tr>";
	echo "<td><img src=\"".base_url()."application/views/img/pegawai/".$key->foto."\" width=\"50\"></td>";
	echo "<td>".$key->id_pegawai."</td>";
	echo "<td>".$key->nama."</td>";
	echo "<td>".$key->departemen."</td>";
	echo "<td>".$key->alamat."</td>";
	echo "<td>".$key->telepon."</td>";
	echo "<td>".$key->tanggal_masuk."</td>";
	echo "<td>".$key->tanggal_keluar."</td>";
	echo "<td>".$key->status."</td>";
	echo "<td>".$key->jabatan."</td>";
	echo "<td>".$key->gaji."";
	echo "<td>";
	?>
	<div class="form-group">
	<button class="btn btn-success" onclick="getDataGajiPegawai(<?php echo $key->id_pegawai?>)" data-toggle="modal" data-target="#modal_gaji">
		<i class="fa fa-plus"></i> Gaji</button>
		<br /><br />
	<button class="btn btn-warning" onclick="getDataEditPegawai(<?php echo $key->id_pegawai?>)" data-toggle="modal" data-target="#modal_edit">
		<i class="fa fa-edit"></i> Edit</button>
		<br /><br />
	<button class="btn btn-danger" onclick="getNamaPegawai(<?php echo $key->id_pegawai?>)" data-toggle="modal" data-target="#modal_hapus">
		<i class="ion-ios7-trash"></i> Hapus</button>
	</div>

	<?php echo "</td>";
	echo "</tr>";
	}
	echo "</tbody>";
	echo "</table>";
	?>