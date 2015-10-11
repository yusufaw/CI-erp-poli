<script>

    var id_penggajian = '';
    var id_barang = '';
    function getDataGajiTerima(x) {
        id_penggajian = x;
        $.get("<?php echo base_url()?>accounting/getPegawaiGaji/" + x, "", 'json').done(function (hasil) {
            $('#nama_pegawai_terima').html(hasil[0].nama);
            $('#total_gaji_terima').html(hasil[0].total);
        }).fail(function (e) {
            alert('Terjadi Kesalahan : ' + e);
        });
    }

    function getDataGajiTolak(x) {
        id_penggajian = x;
        $.get("<?php echo base_url()?>accounting/getPegawaiGaji/" + x, "", 'json').done(function (hasil) {
            $('#nama_pegawai_tolak').html(hasil[0].nama);
            $('#total_gaji_tolak').html(hasil[0].total);
        }).fail(function (e) {
            alert('Terjadi Kesalahan : ' + e);
        });
    }

    function getDataBarangTerima(x) {
        id_barang = x;
        $.get("<?php echo base_url()?>warehouse/getDataBarang/" + x, "", 'json').done(function (hasil) {
            $('#nama_barang_terima').html(hasil[0].nama_barang);
            $('#total_barang_terima').html(hasil[0].harga_total);
        }).fail(function (e) {
            alert('Terjadi Kesalahan : ' + e);
        });
    }

    function getDataBarangTolak(x) {
        id_barang = x;
        $.get("<?php echo base_url()?>warehouse/getDataBarang/" + x, "", 'json').done(function (hasil) {
            $('#nama_barang_tolak').html(hasil[0].nama_barang);
            $('#total_barang_tolak').html(hasil[0].harga_total);
        }).fail(function (e) {
            alert('Terjadi Kesalahan : ' + e);
        });
    }


    function proses_terima_gaji() {
        $.get("<?php echo base_url()?>accounting/terima_gaji/" + id_penggajian);
        console.log(id_penggajian);
        $('#modal_gaji_terima').modal('hide');
        location.reload();
    }
    function proses_tolak_gaji() {
        $.get("<?php echo base_url()?>accounting/tolak_gaji/" + id_penggajian);
        console.log(id_penggajian);
        $('#modal_gaji_tolak').modal('hide');
        location.reload();
    }

    function proses_terima_barang() {
        $.get("<?php echo base_url()?>accounting/terima_barang/" + id_barang);
        $('#modal_gaji_terima').modal('hide');
        location.reload();
    }

    function proses_tolak_barang() {
        $.get("<?php echo base_url()?>accounting/tolak_barang/" + id_barang);
        $('#modal_gaji_tolak').modal('hide');
        location.reload();
    }
</script>

<!-- Main content -->
<section class="content">

    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h1 class="box-title">Order Pengadaan Obat dan Alat</h1>
            </div>
            <!-- /.box-header -->
            <div id="tab" class="box-body table-responsive">
                <table class="table table-striped" id="tabel">
                    <thead>
                    <tr>
                        <th>ID Barang</th>
                        <th>Nama</th>
                        <th>Stok</th>
                        <th>Satuan</th>
                        <th>Jenis</th>
                        <th>Harga Satuan</th>
                        <th>Harga Total</th>
                        <th>Waktu Pengajuan</th>
                        <th>Waktu Diterima</th>
                        <th>Status</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($barang_order as $key) {
                        echo "<tr>";
                        echo "<td>" . $key->id_barang . "</td>";
                        echo "<td>" . $key->nama_barang . "</td>";
                        echo "<td>" . $key->jumlah . "</td>";
                        echo "<td>" . $key->satuan . "</td>";
                        echo "<td>" . $key->jenis . "</td>";
                        echo "<td> Rp " . $key->harga_satuan . "</td>";
                        echo "<td> Rp " . $key->harga_total . "</td>";
                        echo "<td>" . $key->waktu_pengajuan . "</td>";
                        echo "<td>" . $key->waktu_diterima . "</td>";
                        echo "<td>";

                        if ($key->status == 1) {
                            ?>
                            <div class="form-group">
                                <button class="btn btn-primary"
                                        onclick="getDataBarangTerima(<?php echo $key->id_barang ?>)" data-toggle="modal"
                                        data-target="#modal_barang_terima" type="button">Terima
                                </button>

                                <button class="btn btn-danger"
                                        onclick="getDataBarangTolak(<?php echo $key->id_barang ?>)" data-toggle="modal"
                                        data-target="#modal_barang_tolak" type="button">Tolak
                                </button>
                            </div>
                        <?php
                        } else if ($key->status == 2) {
                            echo "<span class=\"label label-success\">Diterima</span>";
                        } else if ($key->status == 3) {
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


    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h1 class="box-title">Order Penggajian Pegawai</h1>
            </div>
            <!-- /.box-header -->
            <div id="tab" class="box-body table-responsive">
                <table class="table table-striped">
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
                        <th>Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($daftar_gaji_pegawai as $key) {
                        echo "<tr>";
                        echo "<td>" . $key->id_penggajian . "</td>";
                        echo "<td>" . $key->id_pegawai . "</td>";
                        echo "<td>" . $key->nama . "</td>";
                        echo "<td>" . $key->hari_aktif . "</td>";
                        echo "<td>" . $key->cuti . "</td>";
                        echo "<td>" . $key->lembur . "</td>";
                        echo "<td> Rp " . $key->total . "</td>";
                        echo "<td>" . $key->waktu_pengajuan . "</td>";
                        echo "<td>";

                        if ($key->status_gaji == 1) {
                            ?>
                            <div class="form-group">
                                <button class="btn btn-primary"
                                        onclick="getDataGajiTerima(<?php echo $key->id_penggajian ?>)"
                                        data-toggle="modal" data-target="#modal_gaji_terima" type="button">Terima
                                </button>

                                <button class="btn btn-danger"
                                        onclick="getDataGajiTolak(<?php echo $key->id_penggajian ?>)"
                                        data-toggle="modal" data-target="#modal_gaji_tolak" type="button">Tolak
                                </button>
                            </div>
                        <?php
                        } else if ($key->status_gaji == 2) {
                            echo "<span class=\"label label-success\">Diterima</span>";
                        } else if ($key->status_gaji == 3) {
                            echo "<span class=\"label label-danger\">Ditolak</span>";
                        }
                        echo "</td>";
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

<div class="modal fade" id="modal_gaji_terima" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    &times;
                </button>
                <h4 class="modal-title" id="myModalLab">Terima Penggajian Pegawai</h4>
            </div>
            <div class="modal-body">
                Melakukan Penggajian <label id="nama_pegawai_terima"></label> sebesar Rp <label
                    id="total_gaji_terima"></label>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">
                    Batal
                </button>
                <button type="button" onclick="proses_terima_gaji()" class="btn btn-success">
                    Proses
                </button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal_gaji_tolak" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    &times;
                </button>
                <h4 class="modal-title" id="myModalLab">Tolak Penggajian Pegawai</h4>
            </div>
            <div class="modal-body">
                Melakukan penolakan gaji untuk <label id="nama_pegawai_tolak"></label> sebesar Rp <label
                    id="total_gaji_tolak"></label>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">
                    Batal
                </button>
                <button type="button" onclick="proses_tolak_gaji()" class="btn btn-danger">
                    Tolak
                </button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal_barang_tolak" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    &times;
                </button>
                <h4 class="modal-title" id="myModalLab">Tolak Pengadaan Barang</h4>
            </div>
            <div class="modal-body">
                Melakukan penolakan pengadaan barang untuk <label id="nama_barang_tolak"></label> sebesar Rp <label
                    id="total_barang_tolak"></label>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">
                    Batal
                </button>
                <button type="button" onclick="proses_tolak_barang()" class="btn btn-danger">
                    Tolak
                </button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal_barang_terima" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    &times;
                </button>
                <h4 class="modal-title" id="myModalLab">Terima Penggadaan Barang</h4>
            </div>
            <div class="modal-body">
                Melakukan perimaan pengadaan barang untuk <label id="nama_barang_terima"></label> sebesar Rp <label
                    id="total_barang_terima"></label>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">
                    Batal
                </button>
                <button type="button" onclick="proses_terima_barang()" class="btn btn-primary">
                    Terima
                </button>
            </div>
        </div>
    </div>
</div>