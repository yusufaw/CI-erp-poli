                <!-- Main content -->
                <section class="content">
				<div class="col-xs-12">
                            <div class="box">
	<div class="box-header">
                                    <h1 class="box-title">Daftar Transaksi Pemasukan</h1>
                                </div><!-- /.box-header -->
                                <div id="tab" class="box-body table-responsive">
                <table class="table table-striped" id="tabel"><thead>
                            <tr><th>Id Transaksi</th><th>Waktu Transaksi</th><th>Nama Pasien</th><th>Tarif Pemeriksaan</th><th>Total Pembayaran</th></tr></thead>
                            <tbody>
                            <?php
				foreach ($daftar_pemasukan as $key) {
					echo "<tr>";
					echo "<td>".$key->id_antrian."</td>";
					echo "<td>".$key->waktu_selesai."</td>";
					echo "<td>".$key->nama_pasien."</td>";
					echo "<td>".$key->tarif."</td>";
					echo "<td>".$key->total_pembayaran."</td></tr>";
						}
echo "</tbody>";
echo "</table>";
?>
		</div></div></div>
		
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