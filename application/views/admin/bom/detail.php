<div class="card ">
  <div class="card-header card-header-rose card-header-icon">
    <div class="card-icon">
      <i class="material-icons">
        assignment
      </i>
    </div>
    <h4 class="card-title">
      Form Bill Of Material
    </h4>
  </div>
  <div class="card-body ">
    <div class="row">
      <div class="col-md-6">
        <div class="form-group bmd-form-group">
          <label for="inputProduk" class="bmd-label-static">No BOM.</label>
          <input type="text" class="form-control" value="<?=$bom->id ?>" disabled>
        </div>
        <div class="form-group bmd-form-group">
          <label for="inputProduk" class="bmd-label-static">Nama Produk</label>
          <input type="text" class="form-control" value="<?=$this->M_Produk->getDetail($bom->produkid)->label?>" disabled>
        </div>
        <div class="form-group bmd-form-group">
          <label for="inputProduk" class="bmd-label-static">Satuan</label>
          <input type="text" class="form-control" value="<?=$this->M_Satuan->getDetail($bom->satuanid)->nama_satuan?>" disabled>
        </div>
      </div>

      <div class="col-md-6">
        <div class="form-group bmd-form-group">
          <label for="inputProduk" class="bmd-label-static">Label</label>
          <input type="text" class="form-control"  value="<?=$bom->label ?>" disabled>
        </div>
        <div class="form-group bmd-form-group">
          <label for="inputProduk" class="bmd-label-static">Keterangan.</label>
          <textarea type="text" class="form-control" disabled><?=$bom->keterangan ?></textarea>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="card">
  <div class="card-header card-header-primary card-header-icon">
    <a href="#" class="card-icon text-white" id="btn-tambah" data-toggle="modal" data-target="#createDetail">
      <i class="material-icons text-light">add</i> Tambah Bahan Baku
    </a>
    <h4 class="card-title">Tabel Material Produk <?=$this->M_Produk->getDetail($bom->produkid)->label?></h4>
  </div>
  <div class="card-body">
    <div class="material-datatables">
      <table id="tabel_material" class="table table-striped table-no-bordered table-hover custom-table" cellspacing="0" width="100%"
      style="width:100%">
        <thead>
          <tr>
            <th>#</th>
            <th>BAHAN BAKU</th>
            <th>JUMLAH</th>
            <th>Created At</th>
            <th>Updated At</th>
            <th class="disabled-sorting text-right">Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php $no=1; foreach ($det_bom as $key ):?>
          <tr>
            <td><?=$no++?></td>
            <td><?=$this->M_Material->getDetail($key->materialid)->label?></td>
            <td><?=$key->qty?> <?=$this->M_Satuan->getDetail($key->satuanid)->nama_satuan?></td>
            <td><?=$key->created_at?></td>
            <td><?=$key->updated_at?></td>
            <td class="disabled-sorting text-right">
              <button data-id="<?=$key->id?>" title="Ubah" class="btn btn-link btn-warning btn-just-icon edit" data-toggle="modal" data-target="#editDetailBom"
                onclick="getDetail(this)">
                <i class="material-icons">dvr</i>
              </button>
              <button class="btn btn-link btn-danger btn-just-icon remove" title="Hapus"
                onclick="hapusConfirm('<?=base_url()?>bom/deleteDetail/<?=$key->id?>')">
                <i class="material-icons">close</i>
              </button>
            </td>
          </tr>
          <?php endforeach ?>
        </tbody>
      </table>
    </div>
  </div>
</div>


<div id="createDetail" class="modal" tabindex="-1" role="dialog">
<div class="modal-dialog" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title">Pilih Bahan Baku</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <?php echo form_open("bom/addDetail","class='form-horizontal' autocomplete='off' id='TypeValidation' novalidate='novalidate'"); ?>
    <!-- <form class='form-horizontal' autocomplete='off' id='TypeValidation' novalidate='novalidate'> -->
      <input type="hidden" name="bomid" id="bomid" value="<?=$this->uri->segment(3,0)?>">
      <input type="hidden" name="produkid" id="produkid" value="<?=$bom->produkid?>">
      <div class="modal-body">
        <div class="row">
          <label for="inputState" class="col-md-3 col-form-label">Bahan Baku</label>
          <div class="col-md-9">
            <div class="form-group">
              <select id="PilihMaterial" name="materialid" class="form-control select2" style="width:100%" required="true" aria-required="true" aria-invalid="true">
                <option value="">Material...</option>
                <?php foreach ($materials as $key):?>
                <option value="<?=$key->id_material ?>"><?=$key->label ?></option>
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
          <label for="inputProduk" class="col-md-3 col-form-label">Jumlah.</label>
          <div class="col-md-9">
            <div class="form-group bmd-form-group">
              <input type="number" min="1" class="form-control" id="jumlah" name="jumlah" required="true" aria-required="true" aria-invalid="true">
              <small id="emailHelp" class="form-text text-muted">Jumlah yang dibutuhkan.</small>
            </div>
          </div>
        </div>

      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Simpan</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
      </div>
    <?=form_close();?>
  </div>
</div>
</div>

<div id="editDetailBom" class="modal" tabindex="-1" role="dialog">
<div class="modal-dialog" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title">Edit Material</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <?= form_open("bom/addDetail","class='form-horizontal' autocomplete='off' id='TypeValidation' novalidate='novalidate'"); ?>
    <!-- <form class='form-horizontal' autocomplete='off' id='TypeValidation2' novalidate='novalidate'> -->
      <input type="hidden" name="id" id="id">
      <input type="hidden" name="satuanid" id="satuanid">
      <input type="hidden" name="bomid" id="bomid" value="<?=$this->uri->segment(3,0)?>">
      <input type="hidden" name="produkid" id="produkid" value="<?=$bom->produkid?>">

      <div class="modal-body">

        <div class="row">
          <label for="inputProduk" class="col-md-3 col-form-label">Bahan Baku.</label>
          <div class="col-md-9">
            <div class="form-group bmd-form-group">
              <input type="text" class="form-control" id="Bahan_Baku" disabled>
            </div>
          </div>
        </div>

        <div class="row">
          <label for="inputState" class="col-md-3 col-form-label">Satuan.</label>
          <div class="col-md-9">
            <div class="form-group">
              <select id="Satuan" name="satuanid" class="form-control select2" style="width:100%" required="true" aria-required="true" aria-invalid="true">
                <option value="">Pilih Satuan...</option>
                <?php foreach ($satuans as $key):?>
                <option value="<?=$key->id_satuan ?>"><?=$key->nama_satuan ?></option>
                <?php endforeach ?>
              </select>
            </div>
          </div>
        </div>
        
        <div class="row">
          <label for="inputProduk" class="col-md-3 col-form-label">Jumlah.</label>
          <div class="col-md-9">
            <div class="form-group bmd-form-group">
              <input type="number" min="1" class="form-control" id="jumlah" name="jumlah" required="true" aria-required="true" aria-invalid="true">
              <small id="emailHelp" class="form-text text-muted">Jumlah yang dibutuhkan.</small>
            </div>
          </div>
        </div>

      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Ubah</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
      </div>
    <?=form_close();?>
  </div>
</div>
</div>

<script>

$(document).ready(function () {
    $('#PilihMaterial').select2({
      tags: true,
		  dropdownParent: $("#createDetail")
    });

    $('#pilihSatuan').select2({
      tags: true,
		  dropdownParent: $("#createDetail")
    });

    $('#Satuan').select2({
      tags: true,
		  dropdownParent: $("#editDetailBom")
    });

    $('#createDetail').on('hidden.bs.modal',function () {
      $('#PilihMaterial').val("");
      $('#PilihMaterial').select2().trigger('change');

      $('#pilihSatuan').val("");
      $('#pilihSatuan').select2().trigger('change');

      $('#jumlah').val("");
    })
  })

function getDetail(ini) {
  $('#jumlah').val("");
  var id = $(ini).attr('data-id');
  $.ajax({
    type: 'GET',
    url: "<?=base_url('');?>bom/bomDetailJson/"+id,
    success: function (data) {
      //Do stuff with the JSON data
        console.log(data);
        $('#editDetailBom #id').val(id).hide();
        $('#editDetailBom #jumlah').val(data.qty).focus();
        $('#editDetailBom #Bahan_Baku').val(data.material).focus();

        $('#Satuan').val(data.satuanid);
        $('#Satuan').select2().trigger('change');
      }
  });
}

</script>