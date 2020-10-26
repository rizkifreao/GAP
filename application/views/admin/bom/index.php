<div class="card">
  <div class="card-header card-header-primary card-header-icon">
    <a href="#" class="card-icon" data-toggle="modal" data-target="#createBom" onclick="clearForm()">
      <i class="material-icons text-light">add</i>
    </a>
    <h4 class="card-title">Tabel Material</h4>
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
    </div>
  </div>
  <!-- end content-->
</div>
<div id="createBom" class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Tambah Bill Of Material</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <?=form_open("bom/add","class='form-horizontal' autocomplete='off' id='TypeValidation' novalidate='novalidate'"); ?>
        <div class="modal-body">
          
          <div class="row">
            <label for="inputState" class="col-md-3 col-form-label">Produk</label>
            <div class="col-md-9">
              <div class="form-group">
                <select id="produkid" name="produkid" class="form-control select2" style="width:100%" required="true" aria-required="true" aria-invalid="true">
                  <option value="">Pilih Produk...</option>
                  <?php foreach ($produks as $key):?>
                  <option value="<?=$key->id_produk ?>"><?=$key->label ?></option>
                  <?php endforeach ?>
                </select>
              </div>
            </div>
          </div>

          <div class="row">
            <label for="inputState" class="col-md-3 col-form-label">Satuan</label>
            <div class="col-md-9">
              <div class="form-group">
                <select id="pilihSatuan" name="satuanid" class="form-control select2" style="width:100%" required="true" aria-required="true" aria-invalid="true">
                  <option value="">Pilih Satuan...</option>
                  <?php foreach ($satuans as $key):?>
                  <option value="<?=$key->id_satuan ?>"><?=$key->nama_satuan ?></option>
                  <?php endforeach ?>
                </select>
              </div>
            </div>
          </div>

          <div class="row">
            <label for="inputProduk" class="col-md-3 col-form-label">Label.</label>
            <div class="col-md-9">
              <div class="form-group bmd-form-group">
                <input type="text" class="form-control" name="label" id="label">
              </div>
            </div>
          </div>

          <div class="row">
            <label for="inputProduk" class="col-md-3 col-form-label">Keterangan.</label>
            <div class="col-md-9">
              <div class="form-group bmd-form-group">
                <textarea type="text" class="form-control" id="keterangan" name="keterangan"></textarea>
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

<div id="editBom" class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit Material</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <?=form_open("bom/add","class='form-horizontal' autocomplete='off' id='TypeValidation' novalidate='novalidate'"); ?>
        <input type="hidden" id="id" name="id" value="">
        <input type="hidden" id="produkid" name="produkid" value="">
        <div class="modal-body">
          
          <div class="row">
            <label for="inputProduk" class="col-md-3 col-form-label">Nama Produk.</label>
            <div class="col-md-9">
              <div class="form-group bmd-form-group">
                <input type="text" class="form-control" id="produk_label" required="true" disabled>
              </div>
            </div>
          </div>

          <div class="row">
            <label for="inputState" class="col-md-3 col-form-label">Satuan</label>
            <div class="col-md-9">
              <div class="form-group">
                <select id="editSatuan" name="produkid" class="form-control select2" style="width:100%" required="true" aria-required="true" aria-invalid="true">
                  <option value="">Pilih Satuan...</option>
                  <?php foreach ($satuans as $key):?>
                  <option value="<?=$key->id_satuan ?>"><?=$key->nama_satuan ?></option>
                  <?php endforeach ?>
                </select>
              </div>
            </div>
          </div>

          <div class="row">
            <label for="inputProduk" class="col-md-3 col-form-label">Label.</label>
            <div class="col-md-9">
              <div class="form-group bmd-form-group">
                <input type="text" class="form-control" id="label" name="label">
              </div>
            </div>
          </div>

          <div class="row">
            <label for="inputProduk" class="col-md-3 col-form-label">Keterangan.</label>
            <div class="col-md-9">
              <div class="form-group bmd-form-group">
                <textarea type="text" class="form-control" id="keterangan" name="keterangan"></textarea>
                <!-- <textarea type="text" class="form-control" id="keterangan" name="keterangan" required="true" aria-required="true" aria-invalid="true"></textarea> -->
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

  $(document).ready(function () {
    $('#produkid').select2({
      tags: true,
		  dropdownParent: $("#createBom")
    });

    $('#pilihSatuan').select2({
      tags: true,
		  dropdownParent: $("#createBom")
    });

    $('#editSatuan').select2({
      tags: true,
		  dropdownParent: $("#editBom")
    });

    $('#createBom').on('hidden.bs.modal',function () {
      $('#produkid').val("");
      $('#produkid').select2().trigger('change');
      $('#keterangan').val("");
      $('#label').val("");
    })
  })

  function getDetail(ini) {
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