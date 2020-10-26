<div class="card">
  <div class="card-header card-header-primary card-header-icon">
    <a href="#" class="card-icon" data-toggle="modal" data-target="#createSatuan" onclick="clearForm()">
      <i class="material-icons text-light">add</i>
    </a>
    <h4 class="card-title">Tabel Data Satuan</h4>
  </div>
  <div class="card-body">
    <div class="toolbar">
    </div>
    <div class="material-datatables">
      <table id="tabel_material" class="table  table-striped table-no-bordered table-hover custom-table" cellspacing="0" width="100%"
        style="width:100%">
        <thead>
          <tr>
            <th>#</th>
            <th>Id Satuan</th>
            <th>Nama Satuan</th>
            <th>Created At</th>
            <th>Updated At</th>
            <th class="disabled-sorting text-right">Actions</th>
          </tr>
        </thead>

        <tbody>
          <?php $no=1; foreach($satuans as $key ): ?>
            <tr>
              <td><?=$no++ ?></td>
              <td><?=$key->id_satuan?></td>
              <td><?=$key->nama_satuan ?></td>
              <td><?=$key->created_at?></td>
              <td><?=$key->updated_at?></td>
              <td class="text-right">
                <button data-id="<?=$key->id_satuan ?>" title="Ubah" class="btn btn-link btn-warning btn-just-icon edit" data-toggle="modal" data-target="#editSatuan"
                  onclick="getDetail(this)">
                  <i class="material-icons">dvr</i>
                </button>
                <button class="btn btn-link btn-danger btn-just-icon remove" title="Hapus"
                  onclick="hapusConfirm('<?=base_url();?>satuan/delete/<?=$key->id_satuan ?>')">
                  <i class="material-icons">close</i>
                </button>
              </td>
            </tr>
          <?php endforeach ?>
        </tbody>
      </table>
    </div>
  </div>
  <!-- end content-->
</div>
<div id="createSatuan" class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Tambah Satuan Baru</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <?=form_open("satuan/add","class='form-horizontal' autocomplete='off' id='TypeValidation' novalidate='novalidate'"); ?>
        <div class="modal-body">

          <div class="row">
            <label for="inputProduk" class="col-md-3 col-form-label">Nama Satuan.</label>
            <div class="col-md-9">
              <div class="form-group bmd-form-group">
                <input type="text" class="form-control" name="nama_satuan" id="nama_satuan" required="true" aria-required="true" aria-invalid="true">
              </div>
            </div>
          </div>

        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Simpan</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      <?=form_close();?>
    </div>
  </div>
</div>

<div id="editSatuan" class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit Satuan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <?=form_open("satuan/add","class='form-horizontal' autocomplete='off' id='TypeValidation' novalidate='novalidate'"); ?>
        <input type="hidden" id="id_satuan" name="id_satuan" value="">
        <div class="modal-body">

          <div class="row">
            <label for="inputProduk" class="col-md-3 col-form-label">Nama Satuan.</label>
            <div class="col-md-9">
              <div class="form-group bmd-form-group">
                <input type="text" class="form-control" id="nama_satuan" name="nama_satuan" required="true" aria-required="true" aria-invalid="true">
              </div>
            </div>
          </div>

        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Ubah</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      <?=form_close();?>
    </div>
  </div>
</div>


<script>

  function getDetail(ini) {
    clearForm();
    var id = $(ini).attr('data-id');
    $.ajax({
      type: 'GET',
      url: "<?=base_url('');?>satuan/detailJson/"+id,
      success: function (data) {
        //Do stuff with the JSON data
          console.log(data);
         $('#editSatuan #id_satuan').val(data.id_satuan).hide();
         $('#editSatuan #nama_satuan').val(data.nama_satuan).focus();
        }
    });
  }

  function clearForm() {    
     $('#id_satuan').val("");
     $('#nama_satuan').val("");
  }

</script>