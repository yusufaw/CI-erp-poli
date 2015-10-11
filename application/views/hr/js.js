<script>
		$.get("<?php echo base_url()?>hr/daftarpegawai/", "", 'json').done(function(hasil){
			for(var i=0; i<hasil.length;i++){
				$('#tabel').append('<tr><td><img src="http://localhost/ci/application/views/img/pegawai/'+hasil[i].foto+'" width="50"></td><td>'+(i+1)+'</td><td>'+hasil[i].nama+'</td><td>'+hasil[i].departemen+'</td><td>'+hasil[i].alamat+'</td><td>'+hasil[i].telepon+'</td><td>'+hasil[i].tanggal_masuk+'</td><td>'+hasil[i].tanggal_keluar+'</td><td>'+hasil[i].status+'</td><td>'+hasil[i].jabatan+'</td><td>'+hasil[i].gaji+'</td><td><div class="form-group"><button class="btn btn-success" onclick="getDataGajiPegawai('+hasil[i].id_pegawai+')" data-toggle="modal" data-target="#modal_gaji"><i class="fa fa-plus"></i> Gaji</button><button class="btn btn-warning" onclick="getDataEditPegawai('+hasil[i].id_pegawai+')" data-toggle="modal" data-target="#modal_edit"><i class="fa fa-edit"></i> Edit</button><button class="btn btn-danger" onclick="getNamaPegawai('+hasil[i].id_pegawai+')" data-toggle="modal" data-target="#modal_hapus"><i class="ion-ios7-trash"></i> Hapus</button></div></td></tr>');
				
			}
			$('#id_pegawai_gaji').html(hasil[0].id_pegawai);
			$('#nama_pegawai_gaji').html(hasil[0].nama);
			$('#gaji_pegawai_gaji').html(hasil[0].gaji);
		}).fail(function (e) {
			alert('Terjadi Kesalahan : '+e);
		});
	
</script>