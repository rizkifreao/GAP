var id = 0 // Untuk menampung ID yang kaan di ubah / hapus

function hapus_det_pembelian(id_detail) {

	swal({
		title: 'Peringatan',
		text: "Anda yakin akan menghapus data ini ?",
		type: 'warning',
		showCancelButton: true,
		confirmButtonClass: 'btn btn-success',
		cancelButtonClass: 'btn btn-danger',
		confirmButtonText: 'Ya, hapus!',
		cancelButtonText: 'Batal',
		buttonsStyling: false
	}).then(function (result) {
		if (result.value) {
			$.ajax({
				url: base_url + 'pembelian/hapusDetailPembelian/' + id_detail, // URL tujuan
				type: 'GET', // Tentukan type nya POST atau GET
				dataType: 'json',
				beforeSend: function (e) {
					if (e && e.overrideMimeType) {
						e.overrideMimeType('application/jsoncharset=UTF-8')
					}
				},
				success: function (response) { // Ketika proses pengiriman berhasil
					// $('#loading-hapus').hide() // Sembunyikan loading hapus

					// Ganti isi dari div view dengan view yang diambil dari proses_hapus.php
					$('#tampil_tabel').html(response.html)

					/*
					 * Ambil pesan suksesnya dan set ke div pesan-sukses
					 * Lalu munculkan div pesan-sukes nya
					 * Setelah 10 detik, sembunyikan kembali pesan suksesnya
					 */
					notificationShow(response.status, response.pesan, 'done')

					// $('#delete-modal').modal('hide') // Close / Tutup Modal Dialog
				}
			})
		}
	})
}

$(document).ready(function () {
	$("#Material").select2({
		tags: true,
		dropdownParent: $("#createModal")
	})

	$("#createModal #Material").on('change', function () {
		var materialid = $(this).val()
		// console.log(materialid);

		if (materialid != "") {
			$.ajax({
				url: base_url + 'material/detailJson/' + materialid,
				type: 'GET',
				// data: {
				// 	materialid: $(this).val()
				// },
				dataType: 'json',
				success: function (response) {
					$("#createModal input[name=stok_awal]").val(response.stok)
					$("#createModal .stok_awal").show(true)
				}
			})
		} else {
			$("#createModal .stok_awal").hide()
		}
	})

	$('#btn-simpan').click(function () { // Ketika tombol simpan di klik

		var check_form = $("#ValidationModal").valid()

		if (check_form == true) {
			$("#ValidationModal").submit((e) => {
				e.preventDefault()
			})

			$.ajax({
				url: base_url + 'pembelian/addMaterial', // URL tujuan
				type: 'POST', // Tentukan type nya POST atau GET
				data: $("#createModal form").serialize(), // Ambil semua data yang ada didalam tag form
				dataType: 'json',
				beforeSend: function (e) {
					// setFormValidation('#ValidationModal');
					if (e && e.overrideMimeType) {
						e.overrideMimeType('application/jsoncharset=UTF-8')
					}
				},
				success: function (response) { // Ketika proses pengiriman berhasil

					if (response.status == 'success') { // Jika Statusnya = sukses
						// Ganti isi dari div tampil dengan tampil yang diambil dari proses_simpan.php
						$('#tampil_tabel').html(response.html)

						/*
						 * Ambil pesan suksesnya dan set ke div pesan-sukses
						 * Lalu munculkan div pesan-sukes nya
						 * Setelah 10 detik, sembunyikan kembali pesan suksesnya
						 */
						notificationShow('success', response.pesan, 'done')

						$('#createModal').modal('hide') // Close / Tutup Modal Dialog
					} else { // Jika statusnya = gagal
						/*
						 * Ambil pesan errornya dan set ke div pesan-error
						 * Lalu munculkan div pesan-error nya
						 */
						notificationShow('danger', response.pesan, 'close')
					}
				},
				error: function (xhr, ajaxOptions, thrownError) { // Ketika terjadi error
					console.log(xhr.responseText) // munculkan alert
				}
			})
		}

	})

	$('#btn-ubah').click(function () { // Ketika tombol simpan di klik
		var check_form = $("#ValidationModal").valid()
		if (check_form == true) {
			$.ajax({
				url: base_url + 'pembelian/addMaterial', // URL tujuan
				type: 'POST', // Tentukan type nya POST atau GET
				data: $("#editModal form").serialize(), // Ambil semua data yang ada didalam tag form
				dataType: 'json',
				beforeSend: function (e) {
					if (e && e.overrideMimeType) {
						e.overrideMimeType('application/jsoncharset=UTF-8')
					}
				},
				success: function (response) { // Ketika proses pengiriman berhasil

					if (response.status == 'success') { // Jika Statusnya = sukses
						// Ganti isi dari div tampil dengan tampil yang diambil dari proses_simpan.php
						$('#tampil_tabel').html(response.html)

						/*
						 * Ambil pesan suksesnya dan set ke div pesan-sukses
						 * Lalu munculkan div pesan-sukes nya
						 * Setelah 10 detik, sembunyikan kembali pesan suksesnya
						 */

						notificationShow('success', response.pesan, 'done')

						$('#editModal').modal('hide') // Close / Tutup Modal Dialog
					} else { // Jika statusnya = gagal
						/*
						 * Ambil pesan errornya dan set ke div pesan-error
						 * Lalu munculkan div pesan-error nya
						 */
						notificationShow('danger', response.pesan, 'close')
					}
				},
				error: function (xhr, ajaxOptions, thrownError) { // Ketika terjadi error
					console.log(xhr.responseText) // munculkan alert
				}
			})
		}
	})

	$('#createModal').on('hidden.bs.modal', function (e) { // Ketika Modal Dialog di Close / tertutup
		// $('#createModal').trigger("reset");
		$('#createModal input[name=jumlah], #createModal select[name=materialid]').val('') // Clear inputan menjadi kosong
	})
})

function notificationShow(s, p, i) {
	// const Toast = Swal.mixin({
	// 	toast: true,
	// 	position: 'top-end',
	// 	showConfirmButton: false,
	// 	timer: 3000
	// })
	// Toast.fire({
	// 	type: status,
	// 	title: pesan
	// })
	$.notify({
		icon: i,
		message: p
	}, {
		type: s,
		timer: 3e3,
		placement: {
			from: 'bottom',
			align: 'right'
		}
	})
}
