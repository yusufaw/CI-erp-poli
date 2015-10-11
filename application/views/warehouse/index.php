
		<script>
		id_barang = '';
		function getDataBarang(x){
		id_barang=x;
		$.get("<?php echo base_url()?>warehouse/getDataBarang/"+x, "", 'json').done(function(hasil){
			console.log(hasil);
			$('#jenis_edit option[value='+hasil[0].jenis+']').prop('selected', true);
			$('#harga_edit').val(hasil[0].harga_satuan);
			
			$('#nama_barang_edit').val(hasil[0].nama_barang);
		}).fail(function (e) {
			alert('Terjadi Kesalahan : '+e);
			});
		}
		
		function proses_edit(){
		console.log($('#edit_form').serialize());
		$.post("<?php echo base_url()?>warehouse/update_barang/"+id_barang, $('#edit_form').serialize());
		console.log('haihai');
		$('#modal_edit').modal('hide');
		location.reload();
	}
		</script>
        
                <!-- Main content -->
                <section class="content">
                	<div class="col-xs-12">
                    <div class="box">
	<div class="box-header">
                                    <h1 class="box-title">Daftar Barang Tersedia</h1>
                                </div><!-- /.box-header -->
                                <div id="tab" class="box-body table-responsive">
                        <table class="table table-striped" id="tabel"><thead>
                            <tr><th>ID Barang</th><th>Nama</th><th>Stok</th><th>Satuan</th><th>Jenis</th><th>Harga</th><th>Aksi</th></tr></thead>
                            <tbody>
                            <?php
				foreach ($barang_tersedia as $key) {
					echo "<tr>";
					echo "<td>".$key->id_barang."</td>";
					echo "<td>".$key->nama_barang."</td>";
					echo "<td>".$key->jumlah."</td>";
					echo "<td>".$key->satuan."</td>";
					echo "<td>".$key->jenis."</td>";
					echo "<td> Rp ".$key->harga_satuan."</td>";
					echo "<td>" ; 
					
					?>
					<div class="form-group">
											
					<button class="btn btn-warning"  onclick="getDataBarang(<?php echo $key->id_barang?>)"  data-toggle="modal" data-target="#modal_edit" type="button">Edit</button>	
                                        </div>
                                        
					 </td>
                                        </tr>
                                        <?php
				}
				?>
                            </tbody>
                        </table>
                        </div>
                       </div>
                      </div>
                      
                      <div class="col-xs-8">
                            <div class="box">
	<div class="box-header">
                                    <h1 class="box-title">Daftar Transaksi Pembelian Obat</h1>
                                </div><!-- /.box-header -->
                                <div id="tab" class="box-body table-responsive">
                <table class="table table-striped"><thead>
                            <tr><th>Id Pembelian</th><th>Nama Obat</th><th>Jumlah</th><th>Total Pembayaran</th></tr></thead>
                            <tbody>
                            <?php
				foreach ($daftar_pembelian as $key) {
					echo "<tr>";
					echo "<td>".$key->id_pembelian."</td>";
					echo "<td>".$key->nama_barang."</td>";
					echo "<td>".$key->jumlah."</td>";
					echo "<td>".$key->harga."</td></tr>";
						}
echo "</tbody>";
echo "</table>";
?>
		</div></div></div>
                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->

        <!-- add new calendar event modal -->
        
<div class="modal fade" id="modal_edit" tabindex="-1" role="dialog" aria-labelledby="myModalLabe" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
					&times;
				</button>
				<h4 class="modal-title" id="myModalLab">Edit Barang</h4>
			</div>
			<div class="modal-body">
				<form role="form" method="post" action="insert.php" id="edit_form">
						<div class="box-body">
						<div class="form-group">
							<label for="nama_barang">Nama Barang</label>
							<input type="nama" id="nama_barang_edit" class="form-control" name="nama_barang" placeholder="hari aktif" />
						</div>
						<div class="form-group">
						<label for="jenis">Jenis Barang</label>
						<select name="jenis" class="form-control" id="jenis_edit">
									<?php
									foreach ($semua_jenis_barang as $key) {
										echo "<option value=\"".$key->id_jenisbarang."\">".$key->jenis_barang."</option>";
									}
									?>
									</select>
								</div>
						<div class="form-group">
						<label for="harga">Harga</label>
						<input type="nama" id="harga_edit" class="form-control" name="harga" placeholder="hari aktif" />
						</div>
						</div>
				</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">
						Batal
					</button>
					<button type="button" class="btn btn-primary" onclick="proses_edit()">
						Proses
					</button>
				</div>
			</div>
		</div>
	</div>
</div>