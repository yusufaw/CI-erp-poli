$(function() {
	$('#cari').click(function() {
		if ($('#NIM').val() == '') {
			return;
		}
		BtnCariKtmByNim();
	});
});

$(window).load(function() {
	BtnCariKtmByNim();
});

function CariKrs(nim, k_jenjang, k_jurusan, k_program_studi) {
	var Url = "siam/akademik/getAcademicInfoKrs/";
	var Data = {
		NIM : nim,
		K_JENJANG : k_jenjang,
		K_JURUSAN : k_jurusan,
		K_PROGRAM_STUDI : k_program_studi
	}
	var TheData = EncryptData(Data);
	var Param = "p=" + TheData;
	$.ajax({
		type : "POST",
		timeout : this.TheTimeout,
		url : Url,
		data : Data,
		success : function(rv) {
			console.log("hahah"+rv);
			try {
				//var msg = DecryptData(rv);
				//var DataArr = JsonToArray(msg);
				//console.log(DataArr[0]);
			} catch (err) {
				alert('Data tidak ditemukan');
			}
		},
		error : function(x, t, m) {
			if (t === "timeout") {
				alert(this.TheMsgErr);
			} else {
				alert(t);
			}
		}
	});
}

function BtnCariKtmByNim() {
	var Url = "siam/akademik/getBioKtmMhs/";
	var Data = {
		IN_NIM : $('#NIM').val()
	}
	var TheData = EncryptData(Data);
	var Param = "p=" + TheData;
	//$.loader();
	$('#pleaseWaitDialog').modal('show');
	$.ajax({
		type : "POST",
		timeout : this.TheTimeout,
		url : Url,
		data : Param,
		success : function(rv) {
			//$.loader('close');
			console.log(rv);
			$('#pleaseWaitDialog').modal('show');
			try {
				var msg = DecryptData(rv);
				var DataArr = JsonToArray(msg);
				console.log(DataArr[0]);
				$('.lblnim').html(DataArr[0].NIM);
				$('.noujian').html(DataArr[0].NO_UJIAN);
				$('.nama').html(DataArr[0].NAMA);
				$('.angkatan').html(DataArr[0].ANGKATAN);
				$('.seleksi').html(DataArr[0].SELEKSI);
				$('.lingkupAkademik').html(DataArr[0].JENJANG + '/' + DataArr[0].FAKULTAS);
				$('.kelas').html(DataArr[0].KELAS);
				$('.prodi').html(DataArr[0].PROG_STUDI);
				$('.status').html(DataArr[0].STATUS_AKTIF);
				
				CariKrs(DataArr[0].NIM, DataArr[0].K_JENJANG, DataArr[0].K_JURUSAN, DataArr[0].K_PROG_STUDI);
				if ($('.angkatan').text() == '2014') {
					$('#DivFoto').html('<img src="https://siakad.ub.ac.id/siam/biodata.foto.php?maba=1&foto=' + $('#NIM').val() + '.JPG&angkatan=' + $('.angkatan').text() + '&ukuran=200"  border:1px solid #999;" />');
				} else {
					$('#DivFoto').html('<img src="https://siakad.ub.ac.id/siam/biodata.foto.php?foto=' + $('#NIM').val() + '.JPG&angkatan=' + $('.angkatan').text() + '&ukuran=200"  border:1px solid #999;" />');
				}

				/**
				 $('#DivSimpan').show();
				 $('#DivBaru').hide();
				 */

			} catch (err) {
				//alert(err.message);
				/**
				 $('#FrmKtm')[0].reset();
				 $('#DivSimpan').hide();
				 $('#DivBaru').show();
				 */
				//ClearFrmKtm();
				alert('Data tidak ditemukan');
			}
		},
		error : function(x, t, m) {
			$('#pleaseWaitDialog').modal('hide');
			//$.loader('close');
			if (t === "timeout") {
				alert(this.TheMsgErr);
			} else {
				alert(t);
			}
		}
	});
}