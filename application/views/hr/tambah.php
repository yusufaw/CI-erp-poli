                <!-- Main content -->
                <section class="content">
                	<div class="col-xs-6">
                	<div class="box">
                    	<div class="box-header">
                                    <h3 class="box-title">Tambah Pegawai</h3>                                    
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
								<label for="status_pegawai">Status Pegawai</label>
								<select name="status_pegawai" class="form-control" id="status_edit">
									<?php
										foreach ($semua_status as $key) {
											echo "<option value=\"".$key->id_status_pegawai."\">".$key->nama_status_pegawai."</option>";
										}
									?>
						</select>
							</div>
							<div class="form-group">
								<label for="jabatan">Jabatan</label>
								<select name="jabatan" class="form-control" id="jabatan_edit">
									<?php
									foreach ($semua_jabatan as $key) {
										echo "<option value=\"".$key->id_jabatan."\">".$key->nama_jabatan."</option>";
									}
									?>
						</select>
							</div>
							<div class="form-group">
								<label for="departemen">Departemen</label>
								<select name="departemen" class="form-control" id="departemen_edit">
									<?php
									foreach ($semua_departemen as $key) {
										echo "<option value=\"".$key->id_departemen."\">".$key->nama_departemen."</option>";
									}
									?>
						</select>
							</div>
							<div class="form-group">
								<label for="gaji">Gaji</label>
								<input type="text" class="form-control" name="gaji" placeholder="gaji" />
							</div>
							<div class="form-group">
								<label for="tanggal_masuk">Tanggal Masuk</label>
								<input type="date" class="form-control" name="tanggal_masuk"  />
							</div>
							<div class="form-group">
								<label for="tanggal_keluar">Tanggal Keluar</label>
								<input type="date" class="form-control" name="tanggal_keluar" />
							</div>
							<div class="form-group">
								<label for="foto">Foto</label>
								<input type="file" class="form-control" name="foto" />
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

                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->