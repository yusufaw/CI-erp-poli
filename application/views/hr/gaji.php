                <!-- Main content -->
                <section class="content">
                	<div class="col-xs-6">
                	<div class="box">
                    	<div class="box-header">
                                    <h3 class="box-title">Penggajian Pegawai</h3>                                    
                                </div>
				<form role="form" method="post" action="<?php echo base_url()?>hr/tambah_pegawai/" enctype="multipart/form-data">
					<div class="box-body">
						<div class="box box-primary">
						<div class="form-group">
							<div class="form-group">
								<label for="nama">Nama</label>
								<input type="nama" class="form-control" name="nama" placeholder="nama lengkap">
							</div>
							<div class="form-group">
								<label for="alamat">Alamat</label>
								<textarea class="form-control" id="alamat_edit" name="alamat" placeholder="alamat rumah"></textarea>
							</div>
							<div class="form-group">
								<label for="telepon">Telepon</label>
								<input type="text" class="form-control" name="telepon" placeholder="telepon" />
							</div>
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
							<div class="form-group">
								<button class="btn btn-info" type="submit">Proses</button>
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
                                    <h3 class="box-title">Daftar Penggajian Pegawai</h3>                                    
                                </div><!-- /.box-header -->
	<div id="tab" class="box-body table-responsive">
	
	<table id="tabel" class="table table-bordered table-striped">
	<thead>
	<tr>
	<th>ID</th>
	<th>Id Pegawai</th>
	<th>Nama</th>
	<th>Hari Aktif</th>
	<th>Cuti</th>
	<th>Lembur</th>
	<th>Total</th>
	<th>Tanggal Pengajuan</th>
	<th>Tanggal Diterima/Ditolak</th>
	<th>Status</th></tr></thead><tbody>

	<?php
	foreach ($daftar_gaji_pegawai as $key) {
	echo "<tr>";
	echo "<td>".$key->id_penggajian."</td>";
	echo "<td>".$key->id_pegawai."</td>";
	echo "<td>".$key->nama."</td>";
	echo "<td>".$key->hari_aktif."</td>";
	echo "<td>".$key->cuti."</td>";
	echo "<td>".$key->lembur."</td>";
	echo "<td> Rp ".$key->total."</td>";
	echo "<td>".$key->waktu_pengajuan."</td>";
	echo "<td>".$key->waktu_diterima."</td>";
	if($key->status=="Diterima"){
		echo "<td><span class=\"label label-success\">".$key->status."</span></td>";
	}
	else if($key->status=="Ditolak") {
		echo "<td><span class=\"label label-danger\">".$key->status."</span></td>";
	}
	else if($key->status=="Belum Diproses") {
		echo "<td><span class=\"label label-warning\">".$key->status."</span></td>";
	}
	
	echo "</tr>";
	}
	echo "</tbody>";
	echo "</table>";
	?>
	</div>
	</div>
	</div>

                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->