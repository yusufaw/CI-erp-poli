                <!-- Main content -->
                <script type="text/javascript">
	var id_pasien="";
	function getDaftarPasien(x){
		
		id_pasien=x;
		$.get("<?php echo base_url()?>pelayanan/getDaftarPasien/"+x, "", 'json').done(function(hasil){
			console.log(hasil);
			$('#nama_edit').val(hasil[0].nama_pasien);
			$('#pekerjaan_edit option[value='+hasil[0].pekerjaan+']').prop('selected', true);
			$('#alamat_edit').val(hasil[0].alamat);
		}).fail(function (e) {
			alert('Terjadi Kesalahan : '+e);
		});
	}
	
	
	function proses_edit(){
		console.log($('#edit_form').serialize());
		$.post("<?php echo base_url()?>pelayanan/update_pasien/"+id_pasien, $('#edit_form').serialize());
		console.log(id_pasien);
		$('#modal_edit').modal('hide');
		location.reload();
	}
	
	function proses_hapus(){
		//console.log($('#edit_form').serialize());
		$.post("<?php echo base_url()?>pelayanan/hapus_pasien/"+id_pasien);
		console.log(id_pasien);
		$('#modal_hapus').modal('hide');
		location.reload();
	}
		function getNamaPasien(x){
		id_pasien=x;
		$.get("<?php echo base_url()?>pelayanan/getNamaPasien/"+x, "", 'json').done(function(hasil){
			$('#nama_hapus').html(hasil[0].nama_pasien);
			console.log(hasil);
		}).fail(function (e) {
			alert('Terjadi Kesalahan : '+e);
		});
	}
	
	</script>
        

                
                <section class="content">
                <div class="col-xs-12">
                            <div class="box">
	<div class="box-header">
                                    <h3 class="box-title">Tambah Pasien</h3>                                    
                                </div><!-- /.box-header -->
				<form role="form" method="post" action="<?php echo base_url()?>pelayanan/tambah_pasien">
				             <div class="box-body">
                                        <div class="form-group">
                                            <label for="nama">Nama Lengkap</label>
                                            <input type="text" class="form-control" name="nama" placeholder="nama">
                                        </div>
                                        <div class="form-group">
                                            <label for="pekerjaan">Pekerjaan</label>
                                            <select name="pekerjaan" class="form-control">
                                            	<?php
							foreach ($semua_pekerjaan as $key) {
								echo "<option value=\"".$key->id_pekerjaan."\">".$key->nama_pekerjaan."</option>";
							}
							?>
                                            </select>
                                        </div>
										<div class="form-group">
                                            <label for="alamat">Alamat</label>
                                            <textarea name="alamat" class="form-control" rows="5" cols="40" placeholder="alamat"></textarea>
                                        </div>
                                    <div class="box-footer">
                                        <button type="submit" class="btn btn-primary" input type="submit" >Submit</button>
                                    </div>
                                </form>
                            </div><!-- /.box -->
                            </div>
                            </div>
               <div class="col-xs-12">
                            <div class="box">
	<div class="box-header">
                                    <h3 class="box-title">Daftar Pasien</h3>                                    
                                </div><!-- /.box-header -->
	<div id="tab" class="box-body table-responsive">
                <table id="tabel" class="table table-striped">
				<thead>
                <tr>
				<td>ID Pasien</td>
				<td>Nama</td>
				<td>Pekerjaan</td>
				<td>Alamat</td>
				<td>Tanggal Pendaftaran</td>
				<td>Aksi</td></tr></thead><tbody>
             <?php
								foreach ($daftar_pasien as $key) {

				echo "<tr>";
				echo "<td>".$key->id_pasien."</td>";
				echo "<td>".$key->nama_pasien."</td>";
				echo "<td>".$key->pekerjaan."</td>";
				echo "<td>".$key->alamat."</td>";
				echo "<td>".$key->tanggal_daftar."</td>"; ?>
				<form action="Pelayanan.php" method="get">
                                        
			<?php
				echo "<td>" ; ?> 
				<div class="form-group">
				<button class="btn btn-info" onclick="getDaftarPasien(<?php echo $key->id_pasien?>)" data-toggle="modal" data-target="#modal_edit">
		<i class="fa fa-edit"></i> Edit</button>
				</form>
				<a pelayananef="#">
				<button class="btn btn-danger" onclick="getNamaPasien(<?php echo $key->id_pasien?>)" data-toggle="modal" data-target="#modal_hapus">
		<i class="ion-ios7-trash"></i> Hapus!</button>
											
			    </div>
                
              
										
                                      
<?php echo "</td>";
echo "</tr>";

								}
echo "</tbody>";
echo "</table>";
?>
</div></div></div>
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
				<h4 class="modal-title" id="myModalLab">Hapus pasien</h4>
			</div>
			<div class="modal-body">
				Apakah anda yakin menghapus 
                <label id="nama_hapus"></label> dari pasien?
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
				<h4 class="modal-title" id="myModalLab">Tambah Kereta Api</h4>
			</div>
			<div class="modal-body">
				<form role="form" method="post" action="insert.php" id="edit_form">
					<table class="table table-striped">
						<tr>
                        <td width="100">Nama Kereta Api</td>
                        <td width="100"><input type="text" id="nama_edit" class="form-control" name="nama" placeholder="Nama Kereta Api" /></td>
                        </tr>
						<tr><td>Kapasitas Orang</td>
                        <td><input type="text" id="alamat_edit" class="form-control" name="alamat" placeholder="Kapasitas Orang" /></td>
                        </tr>
						<tr>
                        <td>Kapasitas Barang</td>
                        <td><input type="text" id="alamat_edit" class="form-control" name="alamat" placeholder="Kapasitas Barang" /></td>
                        </tr>
						
					</table>
				</form>

				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">
						Batal
					</button>
					<button type="button" class="btn btn-primary" id="proses_edit" onclick="proses_tambah()">
						Proses
					</button>
				</div>
			</div>
		</div>
	</div>
</div>
