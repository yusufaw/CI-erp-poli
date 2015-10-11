                <!-- Main content -->
                <section class="content">
                	<div class="col-xs-6">
                	<div class="box">
                    	<div class="box-header">
                                    <h3 class="box-title">Order Barang</h3>                                    
                                </div>
				<form role="form" method="post" action="<?php echo base_url()?>warehouse/proses_order/" enctype="multipart/form-data">
					<div class="box-body">
						<div class="box box-primary">
						<div class="form-group">
							<div class="form-group">
								<label for="nama">Nama Barang</label>
								<input type="nama" class="form-control" name="nama" placeholder="nama barang">
							</div>
							<div class="form-group">
								<label for="stok">Jumlah Barang</label>
								<input type="number" id="stok" class="form-control" name="stok" placeholder="0">
							</div>
							<div class="form-group">
								<label for="satuan_barang">Satuan</label>
								<select name="satuan_barang" class="form-control" id="satuan_edit">
									<?php
										foreach ($semua_satuan_barang as $key) {
											echo "<option value=\"".$key->id_satuanbarang."\">".$key->satuan_barang."</option>";
										}
									?>
						</select>
							</div>
							<div class="form-group">
								<label for="jenis">Jenis</label>
								<select name="jenis" class="form-control" id="jabatan_edit">
									<?php
									foreach ($semua_jenis_barang as $key) {
										echo "<option value=\"".$key->id_jenisbarang."\">".$key->jenis_barang."</option>";
									}
									?>
									</select>
							</div>
							<div class="form-group">
								<label for="harga">Harga per satuan</label>
								<div class="input-group">
								<span class="input-group-addon">Rp</span>
								<input type="harga_satuan" id="harga_satuan" class="form-control" name="harga_satuan" placeholder="0">
								</div>
							</div>
							
							<div class="form-group">
								<label for="harga">Harga total</label>
								<div class="input-group">
								<span class="input-group-addon">Rp</span>
								<input type="harga_total" id="harga_total" class="form-control" name="harga_total" placeholder="0" disabled>
								</div>
							</div>
							
							<div class="form-group">
								<button class="btn btn-info" type="submit">Tambahkan</button>
							</div>
						</div>
					</div>
					</div>
				</form>

               </div>
               </div>
               <div class="col-xs-12">
               <div class="box">
	<div class="box-header">
                                    <h1 class="box-title">Daftar Order Barang</h1>
                                </div><!-- /.box-header -->
                                <div id="tab" class="box-body table-responsive">
                        <table class="table table-striped" id="tabel"><thead>
                            <tr><th>ID Barang</th><th>Nama</th><th>Stok</th><th>Satuan</th><th>Jenis</th><th>Harga Satuan</th><th>Harga Total</th><th>Waktu Pengajuan</th><th>Waktu Diterima</th><th>Status</th></tr></thead>
                            <tbody>
                            <?php
				foreach ($barang_order as $key) {
					echo "<tr>";
					echo "<td>".$key->id_barang."</td>";
					echo "<td>".$key->nama_barang."</td>";
					echo "<td>".$key->jumlah."</td>";
					echo "<td>".$key->satuan."</td>";
					echo "<td>".$key->jenis."</td>";
					echo "<td> Rp ".$key->harga_satuan."</td>";
					echo "<td> Rp ".$key->harga_total."</td>";
					echo "<td>".$key->waktu_pengajuan."</td>";
					echo "<td>".$key->waktu_diterima."</td>";
					echo "<td>" ; 
					
					if($key->status==1){
						echo "<span class=\"label label-warning\">Belum Diproses</span>";
					}
				else if($key->status==2){
					echo "<span class=\"label label-success\">Diterima</span>";
					}
					else if($key->status==3){
						echo "<span class=\"label label-danger\">Ditolak</span>";
					}
					?>
					
                                        
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
                      </div>

                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->
        <script>
        	$('#stok').keyup(function(){
        		//alert($('#harga_satuan').val()*$('#stok').val());
        		$('#harga_total').val($('#harga_satuan').val()*$('#stok').val());
        	});
        	
        	$('#harga_satuan').keyup(function(){
        		//alert($('#harga_satuan').val()*$('#stok').val());
        		$('#harga_total').val($('#harga_satuan').val()*$('#stok').val());
        	});
        </script>