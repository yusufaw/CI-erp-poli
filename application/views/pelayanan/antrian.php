                <!-- Main content -->
                <script type="text/javascript">
	var id_pasien="";
	var id_antrian="";
	var a = new Array();
	function getDaftarPasien(x){
		
		id_antrian=x;
		$.get("<?php echo base_url()?>pelayanan/getDaftarAntrian/"+x, "", 'json').done(function(hasil){
			console.log(hasil);
			$('#id_pasien_selesai').html(hasil[0].id_pasien);
			$('#nama_selesai').html(hasil[0].nama_pasien);
			$('#pekerjaan_selesai').html(hasil[0].nama_pekerjaan);
			$('#waktu_daftar_selesai').html(hasil[0].waktu_antri);
			
		}).fail(function (e) {
			alert('Terjadi Kesalahan : '+e);
		});
	}
	
	function set_harga(){
		id_obat = $('#obat').val();
		$.get("<?php echo base_url()?>pelayanan/detail_obat/"+id_obat, "", 'json').done(function(hasil){
			$('#harga_obat').val(hasil[0].harga_satuan);
		}).fail(function (e) {
			alert('Terjadi Kesalahan : '+e);
		});
	}
	
	function tambah_obat(){
		harga = $('#jumlah').val()*$('#harga_obat').val();
		arrayA = [];
		var xx = {
			id_antrian:id_antrian,
			order_barang:$('#obat').val(),
			jumlah:$('#jumlah').val(),
			harga:harga
		};
			
		// arrayA["id_antrian"]=id_antrian;
		// arrayA["order_barang"]=$('#obat').val();
		// arrayA["jumlah"]=$('#jumlah').val();
		// arrayA["harga"]=harga;
		
		a.push(JSON.stringify(xx));
		console.log(a);
		$('#tabel_obat').append('<tr><td>'+$('#obat option:selected').html()+'</td><td>'+$('#jumlah').val()+'</td><td>'+harga+'</label></td><td width="50"><button class="btn btn-danger"><i class="fa fa-trash"></i> Hapus</button></div></td></tr>');
		total = (parseInt($('#harga_total_o').val())+parseInt(harga));
		$('#harga_total_o').val(total);
	}
	
	function proses_obat(){
		a = new Array();
		$('#modal_obat').modal('show');
		$('#harga_total_o').val($('#tarif').val());
		$('#tarif_o').val($('#tarif').val());
	}
	
	function proses_selesai(){
		console.log($('#selesai_form').serialize());
		$('#harga_total').val($('#tarif').val());
		$.post("<?php echo base_url()?>pelayanan/hapus_antrian/"+id_antrian, $('#selesai_form').serialize());
		console.log(id_pasien);
		$('#modal_selesai').modal('hide');
		location.reload();
	}
	
	function proses_selesai_obat(){
		console.log($('#selesai_obat').serialize());
		//daftar_obat = JSON.stringify(a);
		//console.log(daftar_obat);
		 for(i=0;i<a.length;i++){
			 daftar_obat = JSON.stringify(a[i]);
			 console.log(daftar_obat);
			
			 $.post("<?php echo base_url()?>pelayanan/selesai_obat/"+id_antrian, {'ok[]':a[i]});
		}
		// var b = {a:a}
		// daftar_obat = JSON.stringify(b)
		// $.post("<?php echo base_url()?>pelayanan/selesai_obat/"+id_antrian, JSON.stringify(b)).done(function(hasil){
			// console.log(hasil);
		// }).fail(function (e) {
			// alert('Terjadi Kesalahan : '+e);
		// });
		//console.log(daftar_obat);
		$.post("<?php echo base_url()?>pelayanan/hapus_antrian/"+id_antrian, $('#selesai_obat').serialize());
		
		
		$('#modal_selesai').modal('hide');
		location.reload();
	}
	
	function proses_tambah(){
		//console.log($('#edit_form').serialize());
		$.post("<?php echo base_url()?>pelayanan/tambah_antrian/"+id_pasien);
		console.log(id_pasien);
		$('#modal_tambah').modal('hide');
		location.reload();
	}
		function getNamaPasien(x){
		id_pasien=x;
		$.get("<?php echo base_url()?>pelayanan/getNamaPasien/"+x, "", 'json').done(function(hasil){
			$('#nama_tambah').html(hasil[0].nama_pasien);
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
                                    <h3 class="box-title">Antrian Pasien</h3>                                    
                                </div><!-- /.box-header -->
				
				             <div class="box-body">
				             	<table class="table table-striped">
				<thead>
                <tr>
				<th>No Antrian</th>
				<th>ID Pasien</th>
				<th>Nama</th>
				<th>Waktu Daftar</th>
				<th>Aksi</th>
				</tr></thead>
				<tbody>
					             <?php
								foreach ($daftar_antrian as $key) {

				echo "<tr>";
				echo "<td>".$key->no_antrian."</td>";
				echo "<td>".$key->id_pasien."</td>";
				echo "<td>".$key->nama_pasien."</td>";
				echo "<td>".$key->waktu_antri."</td>";
				echo "<td>" ; ?> 
				<div class="form-group">
				<button class="btn btn-danger" onclick="getDaftarPasien(<?php echo $key->id_antrian?>)" data-toggle="modal" data-target="#modal_selesai">
		<i class="fa fa-minus"></i> Selesai</button>
											
			    </div>                       
<?php echo "</td>";
echo "</tr>";
								}
								?>
				</tbody>
				</table>
                            </div>
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
				<th>ID Pasien</th>
				<th>Nama</th>
				<th>Pekerjaan</th>
				<th>Alamat</th>
				<th>Tanggal Pendaftaran</th>
				<th>Aksi</th></tr></thead><tbody>
             <?php
								foreach ($daftar_pasien as $key) {

				echo "<tr>";
				echo "<td>".$key->id_pasien."</td>";
				echo "<td>".$key->nama_pasien."</td>";
				echo "<td>".$key->pekerjaan."</td>";
				echo "<td>".$key->alamat."</td>";
				echo "<td>".$key->tanggal_daftar."</td>"; ?>
				
                                        
			<?php
				echo "<td>" ; ?> 
				<div class="form-group">
				<button class="btn btn-info" onclick="getNamaPasien(<?php echo $key->id_pasien?>)" data-toggle="modal" data-target="#modal_tambah">
		<i class="fa fa-plus"></i> Tambah ke Antrian</button>
											
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
                <div class="modal fade" id="modal_tambah" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
					&times;
				</button>
				<h4 class="modal-title" id="myModalLab">Tambah Antrian</h4>
			</div>
			<div class="modal-body">
				Apakah anda yakin menambahkan
                <label id="nama_tambah"></label> dalam antrian?
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">
					Batal
				</button>
				<button type="button" onclick="proses_tambah()" class="btn btn-primary">
					Tambahkan
				</button>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="modal_selesai" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
					&times;
				</button>
				<h4 class="modal-title" id="myModalLab">Pelayanan Pasien</h4>
			</div>
			<div class="modal-body">
				<form role="form" id="selesai_form">
					<table class="table table-striped">
						<tr>
                        <td width="200">Id Pasien</td>
                        <td width="50"><label id="id_pasien_selesai"></label></td>
                        </tr>
						<tr>
                        <td width="200">Nama</td>
                        <td width="50"><label id="nama_selesai"></label></td>
                        </tr>
                        <tr>
                        <td>Pekerjaan</td>
                        <td><label id="pekerjaan_selesai"></label></td>
                        </tr>
						<tr>
                        <td width="200">Waktu daftar</td>
                        <td width="50"><label id="waktu_daftar_selesai"></label></td>
                        </tr>
						
						
					</table>
					<div class="box-body">
						<div class="form-group">
							<label for="tarif">Tarif Periksa</label>
							<div class="input-group">
								<span class="input-group-addon">Rp</span>
							<input type="number" id="tarif" class="form-control" name="tarif" value="0"/>
							<input type="hidden" id="harga_total" class="form-control" name="harga_total" />
							</div>
							</div>	
						</div>
				</form>

				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">
						Batal
					</button>
					<button type="button"  data-dismiss="modal" class="btn btn-primary" id="proses_edit" onclick="proses_obat()">
						Lanjut ke pembelian obat
					</button>
					<button type="button" class="btn btn-success" id="proses_edit" onclick="proses_selesai()">
						Selesai
					</button>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="modal_obat" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
					&times;
				</button>
				<h4 class="modal-title" id="myModalLab">Pembelian Obat</h4>
			</div>
			<div class="modal-body">
				
					<table class="table table-striped" id="tabel_obat">
						<thead>
							<tr></tr>
							<th>Nama Obat</th>
							<th>Jumlah</th>
							<th>Harga Total</th>
							<th></th>
						</tr>
						</thead>
						<tbody>
						
						
						</tbody>
					</table>
					<div class="box-body">
							<div class="form-group">
							<label for="tarif">Pembelian Obat</label>
							<div class="input-group">
							<select class="form-control" id="obat" name="obat" onchange="set_harga()">
                        <?php
							foreach ($daftar_obat as $key) {
								echo "<option value=\"".$key->id_barang."\">".$key->nama_barang."</option>";
							}
							?>
                        </select>
                        
								<span class="input-group-addon">Rp</span>
								<input type="harga_total" id="harga_obat" class="form-control" name="harga_obat" placeholder="0" disabled>
								</div>
							</div>
							<div class="form-group">
							Jumlah <input type="harga_total" id="jumlah" class="form-control" name="jumlah" placeholder="0">
							</div>
							<button class="btn btn-info" onclick="tambah_obat()">
		<i class="fa fa-plus"></i> Tambah</button>
							<form role="form" id="selesai_obat">
								<input type="hidden" name="tarif" id="tarif_o">
							<div class="form-group">
								<label for="harga">Pembayaran total</label>
								<div class="input-group">
								<span class="input-group-addon">Rp</span>
								<input type="harga_total" id="harga_total_o" class="form-control" name="harga_total" placeholder="0">
								</div>
							</div>
						</div>
				</form>

				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">
						Batal
					</button>
					<button type="button" class="btn btn-success" id="proses_edit" onclick="proses_selesai_obat()">
						Selesai
					</button>
				</div>
			</div>
		</div>
	</div>
</div>
