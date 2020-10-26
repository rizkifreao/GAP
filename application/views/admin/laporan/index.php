<div class="card">
  <div class="card-header card-header-primary card-header-icon">
    <!-- <a href="#" class="card-icon" data-toggle="modal" data-target="#createBom" onclick="clearForm()">
      <i class="material-icons text-light">add</i>
    </a> -->
    <h4 class="card-title">Cetak Laporan</h4>
  </div>
  <div class="card-body">
    <div class="toolbar">
    </div>

    <form action="<?=base_url()?>laporan/print" method="post" target="_blank">
      <div class="row">
        <label class="col-sm-2 col-form-label">Tanggal Periode</label>
        <div class="col-sm-2">
          <div class="form-group bmd-form-group">
            <!-- <input class="form-control" type="text" name="required" required="true" aria-required="true"> -->
            <input type="text" class="form-control" id="periodeAwal" name="periodeAwal">
          </div>
        </div>
        <label class="label-on-right">
          <p>S/D</p>
        </label>
        <div class="col-sm-2">
          <div class="form-group bmd-form-group">
            <!-- <input class="form-control" type="text" name="required" required="true" aria-required="true"> -->
            <input type="text" class="form-control" id="periodeAkhir" name="periodeAkhir">
          </div>
        </div>
      </div>

      <div class="row view_jenis_laporan" style="display:none">
        <label for="inputState" class="col-md-2 col-form-label">Laporan</label>
        <div class="col-md-9">
          <div class="form-group">
            <select id="jenis_laporan" name="jenis_laporan" class="form-control select2" style="width:50%">
              <option value="">Pilih Laporan...</option>
              <option value="produksi">Produksi</option>
              <option value="pembelian">Pembelian</option>
              <option value="permintaan">Permintaan</option>
            </select>
          </div>
        </div>
      </div>

      <div class="modal-footer">
          <button type="submit" class="btn btn-primary" id="btn-simpan">Print</button>
        </div>
    </form>
    <!-- <div class="material-datatables">
      <table id="tabel_material" class="table  table-striped table-no-bordered table-hover custom-table" cellspacing="0" width="100%"
        style="width:100%">
        <thead>
          <tr>
            <th>#</th>
            <th>Produk</th>
            <th>Label</th>
            <th>Keterangan</th>
            <th>Created At</th>
            <th>Updated At</th>
            <th class="disabled-sorting text-right">Actions</th>
          </tr>
        </thead>

        <tbody>
          <?php $no=1; foreach($boms as $key ): ?>
            <tr>
              <td><?=$no++ ?></td>
              <td><?=$this->M_Produk->getDetail($key->produkid)->label?></td>
              <td><?=$key->label ?></td>
              <td><?=$key->keterangan?></td>
              <td><?=$key->created_at?></td>
              <td><?=$key->updated_at?></td>
              <td class="text-right">
                <button title="Tambah Detail" class="btn btn-link btn-success btn-just-icon add"
                  onclick="window.location.href='<?=base_url()?>bom/detail/<?=$key->id ?>'">
                  <i class="material-icons">add</i>
                </button>
                <button data-id="<?=$key->id ?>" title="Ubah" class="btn btn-link btn-warning btn-just-icon edit" data-toggle="modal" data-target="#editBom"
                  onclick="getDetail(this)">
                  <i class="material-icons">dvr</i>
                </button>
                <button class="btn btn-link btn-danger btn-just-icon remove" title="Hapus"
                  onclick="hapusConfirm('<?=base_url();?>bom/delete/<?=$key->id ?>')">
                  <i class="material-icons">close</i>
                </button>
              </td>
            </tr>
          <?php endforeach ?>
        </tbody>
      </table>
    </div> -->
  </div>
  <!-- end content-->
</div>

<script>

  $(document).ready(function () {

    $("#jenis_laporan").select2({
      tags: true,
      // dropdownParent: $("#createModal")
    })
    
    $("#periodeAwal").datetimepicker({format: "Y-M-DD"})
    $(".modal-footer").hide()
    $('#periodeAkhir').datetimepicker({format: "Y-M-DD"}).on('dp.change', function (ev) {
        
        if ($('#periodeAkhir').val() != '' && $('#periodeAwal').val() != '') {
          var startDate = $('#periodeAwal').val().replace(/\//g, '');
          var endDate = $('#periodeAkhir').val().replace(/\//g, '');

          // console.log(startDate+" sd "+endDate);
          if(startDate <= endDate){
            // reloadTable(startDate,endDate)
            $(".view_jenis_laporan").show()
            $(".modal-footer").show()
          }else{
            alert('Tanggal periode akhir tidak boleh lebih kecil dari tanggal awal');
            $('#periodeAkhir').val(startDate); 
          }
          // reloadTableByDate(startDate, endDate, asuransiId, leasingId);
        }else {
          alert('pilih tanggal periode mulai');
        }
      });

  })

  function reloadTable(ini) {
    clearForm();
    var id = $(ini).attr('data-id');
    $.ajax({
      type: 'GET',
      url: "<?=base_url('');?>bom/detailJson/"+id,
      success: function (data) {
        //Do stuff with the JSON data
          // console.log(data);
         $('#editBom #id').val(id).hide();
         $('#editBom #produk_label').val(data.produk_label);
         $('#editBom #keterangan').val(data.keterangan);
         $('#editBom #produkid').val(data.produkid);
         $('#editBom #label').val(data.label);
         $('#editBom #editSatuan').val(data.satuanid);
         $('#editBom #editSatuan').trigger("change");
        }
    });
  }

  function clearForm() {    
     $('#id').val("");
     $('#produk_label').val("");
     $('#keterangan').val("");
     $('#label').val("");
  }

</script>