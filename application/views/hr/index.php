

<script type="text/javascript">
	var id_pegawai="";
	
		function proses_edit(){
			console.log($('#edit_form').serialize());
			$.post("<?php echo base_url()?>hr/update_pegawai/"+id_pegawai, $('#edit_form').serialize());
			console.log('haihai');
			$('#modal_edit').modal('hide');
			location.reload();
		}
	
	function proses_tambah(){
		console.log($('#tambah_form').serialize());
		$.post("<?php echo base_url()?>hr/tambah_pegawai/", $('#tambah_form').serialize()).done(function(hasil){
			console.log(hasil);
			});
		$('#modal_tambah').modal('hide');
		//location.reload();
	}
	
	function proses_hapus(){
		//console.log($('#edit_form').serialize());
		$.post("<?php echo base_url()?>hr/hapus_pegawai/"+id_pegawai);
		console.log(id_pegawai);
		$('#modal_hapus').modal('hide');
		location.reload();
	}
	
	function proses_gaji(){
		$.post("<?php echo base_url()?>hr/gaji_pegawai/"+id_pegawai, $('#gaji_form').serialize());
		$('#modal_gaji').modal('hide');console.log($('#gaji_form').serialize());
		window.location.assign("<?php echo base_url()?>hr/gaji");
	}
	
	function getDataGajiPegawai(x){
		id_pegawai=x;
		$.get("<?php echo base_url()?>hr/getPegawaiGaji/"+x, "", 'json').done(function(hasil){
			$('#id_pegawai_gaji').html(hasil[0].id_pegawai);
			$('#nama_pegawai_gaji').html(hasil[0].nama);
			$('#gaji_pegawai_gaji').html(hasil[0].gaji);
		}).fail(function (e) {
			alert('Terjadi Kesalahan : '+e);
		});
	}
	
	function getDataEditPegawai(x){
		$.get("<?php echo base_url()?>hr/getDetailPegawai/"+x, "", 'json').done(function(hasil){
			id_pegawai=hasil[0].id_pegawai;
			$('#nama_edit').val(hasil[0].nama);
			$('#alamat_edit').val(hasil[0].alamat);
			$('#telepon_edit').val(hasil[0].telepon);
			$('#tanggal_masuk_edit').val(hasil[0].tanggal_masuk);
			$('#tanggal_keluar_edit').val(hasil[0].tanggal_keluar);
			$('#gaji_edit').val(hasil[0].gaji);
			$('#status_edit option[value='+hasil[0].status_pegawai+']').prop('selected', true);
			$('#jabatan_edit option[value='+hasil[0].jabatan+']').prop('selected', true);
			$('#departemen_edit option[value='+hasil[0].departemen+']').prop('selected', true);
		}).fail(function (e) {
			alert('Terjadi Kesalahan : '+e);
		});
	}
	
	function getNamaPegawai(x){
		id_pegawai=x;
		$.get("<?php echo base_url()?>hr/getNamaPegawai/"+x, "", 'json').done(function(hasil){
			$('#nama_hapus').html(hasil[0].nama);
		}).fail(function (e) {
			alert('Terjadi Kesalahan : '+e);
		});
	}
</script>
	
<!-- Main content -->
<section class="content">
<div class="row">
                        <div class="col-xs-12">
                            <div class="box">
	<div class="box-header">
                                    <h3 class="box-title">Daftar Pegawai</h3>
                                </div><!-- /.box-header -->
                                
                                    <div>
                                    	<a href="<?php echo base_url()?>hr/tambah">
                                    <button class="btn btn-danger">
		Tambah Pegawai</button></a></div>
	<div id="tab" class="box-body table-responsive">
	
	<table id="tabel" class="table table-bordered table-striped">
	<thead>
	<tr>
		<th></th>
	<th>ID</th>
	<th width="80">Nama</th>
	<th>Departemen</th>
	<th width="150">Alamat</th>
	<th>Telepon</th>
	<th>Tanggal Masuk</th>
	<th>Tanggal Keluar</th>
	<th>Status</th>
	<th>Jabatan</th>
	<th>Gaji</th>
	<th width="280">Aksi</th></tr></thead><tbody>

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
	
	<button class="btn btn-warning" onclick="getDataEditPegawai(<?php echo $key->id_pegawai?>)" data-toggle="modal" data-target="#modal_edit">
		<i class="fa fa-edit"></i> Edit</button>
	
	<button class="btn btn-danger" onclick="getNamaPegawai(<?php echo $key->id_pegawai?>)" data-toggle="modal" data-target="#modal_hapus">
		<i class="ion-ios7-trash"></i> Hapus</button>
	</div>

	<?php echo "</td>";
	echo "</tr>";
	}
	echo "</tbody>";
	echo "</table>";
	?>
	</div>
	</div>
	</div>
	</div>
</section><!-- /.content -->
</aside><!-- /.right-side -->
</div><!-- ./wrapper -->
<div class="modal fade" id="modal_hapus" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
					&times;
				</button>
				<h4 class="modal-title" id="myModalLab">Hapus Pegawai</h4>
			</div>
			<div class="modal-body">
				Apakah anda yakin menghapus <label id="nama_hapus"></label> dari pegawai?
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">
					Batal
				</button>
				<button type="button" onclick="proses_hapus()" class="btn btn-danger">
					Hapus
				</button>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="modal_edit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
					&times;
				</button>
				<h4 class="modal-title" id="myModalLab">Edit Data Pegawai</h4>
			</div>
			<div class="modal-body">
				<form role="form" method="post" action="insert.php" id="edit_form">
					<table class="class="table table-striped">
						<tr><td width="200">Nama</td><td width="50"><input type="nama" id="nama_edit" class="form-control" name="nama" placeholder="hari aktif" /></td></tr>
						<tr><td>Alamat</td><td><textarea class="form-control" id="alamat_edit" name="alamat"></textarea></td></tr>
						<tr><td>Telepon</td><td><input type="text" id="telepon_edit" class="form-control" name="telepon" placeholder="Telepon" /></td></tr>
						<tr><td>Status Pegawai</td><td><select name="status_pegawai" class="form-control" id="status_edit">
							<?php
							foreach ($semua_status as $key) {
								echo "<option value=\"".$key->id_status_pegawai."\">".$key->nama_status_pegawai."</option>";
							}
							?>
						</select></td></tr>
						<tr><td>Jabatan</td><td><select name="jabatan" class="form-control" id="jabatan_edit">
							<?php
							foreach ($semua_jabatan as $key) {
								echo "<option value=\"".$key->id_jabatan."\">".$key->nama_jabatan."</option>";
							}
							?>
						</select></td></tr>
						<tr><td>Departemen</td><td><select name="departemen" class="form-control" id="departemen_edit">
							<?php
							foreach ($semua_departemen as $key) {
								echo "<option value=\"".$key->id_departemen."\">".$key->nama_departemen."</option>";
							}
							?>
						</select></td></tr>
						<tr><td>Gaji</td><td><input type="text" id="gaji_edit" class="form-control" name="gaji" placeholder="gaji" /></td></tr>
						<tr><td>Tanggal Masuk</td><td><input type="date" id="tanggal_masuk_edit" class="form-control" name="tanggal_masuk" /></td></tr>
						<tr><td>Tanggal Keluar</td><td><input type="date" id="tanggal_keluar_edit" class="form-control" name="tanggal_keluar" /></td></tr>
						<tr><td>Foto</td><td><input type="file" class="form-control" name="foto" /></td></tr>
					</table>
				</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">
						Batal
					</button>
					<button type="button" class="btn btn-primary" id="proses_edit" onclick="proses_edit()">
						Proses
					</button>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="modal_gaji" tabindex="-1" role="dialog" aria-labelledby="myModalLabe" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
					&times;
				</button>
				<h4 class="modal-title" id="myModalLab">Penggajian Pegawai</h4>
			</div>
			<div class="modal-body">
				<table class="table table-striped table-condensed">
					<tr>
						<td>Id Pegawai</td><td id="id_pegawai_gaji"></td>
					</tr>
					<tr>
						<td>Nama</td><td id="nama_pegawai_gaji"></td>
					</tr>
					<tr>
						<td>Gaji Reguler</td><td id="gaji_pegawai_gaji"></td>
					</tr>
					<tr>
						<td>Terakhir Penggajian</td><td>23 Maret 2011</td>
					</tr>
				</table>
				<form role="form" method="post" action="insert.php" id="gaji_form">
					<div class="box-body">
						<div class="form-group">
							<label for="hari_aktif">Hari Aktif</label>
							<input type="number" class="form-control" name="hari_aktif" value="22">
						</div>
						<div class="form-group">
							<label for="cuti">Cuti</label>
							<input type="number" class="form-control" name="cuti" value="0">
						</div>
						<div class="form-group">
							<label for="lembur">Lembur</label>
							<input type="number" class="form-control" name="lembur" value="0">
						</div>
					</div>
				</form>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">
						Batal
					</button>
					<button type="button" class="btn btn-primary" onclick="proses_gaji()">
						Proses
					</button>
				</div>
			</div>
		</div>
	</div>
</div>
