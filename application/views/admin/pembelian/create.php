<?= form_open('pembelian/pembelianfinish','method="post" autocomplete="off" id="TypeValidation" novalidate="novalidate"')?>
  
  <input type="hidden" name="id_pembelian" value="<?=$this->uri->segment(3,0)?>">
  <div class="card ">
    <div class="card-header card-header-rose card-header-icon">
      <div class="card-icon">
        <i class="material-icons">
          assignment
        </i>
      </div>
      <h4 class="card-title">
        Form Pembelian Material
      </h4>
      <br>
      
    </div>
    <div class="card-body ">
      <div class="row">
        <div class="col-md-6">
          <div class="form-group bmd-form-group">
            <label for="inputProduk" class="bmd-label-static">Nomor Faktur.</label>
            <input type="text" class="form-control" id="nofaktur" name="nofaktur" value="<?=$pembelian->nofaktur ?>" required="true" aria-required="true" aria-invalid="true">
          </div>
          <div class="form-group bmd-form-group">
            <label for="inputProduk" class="bmd-label-static">Tanggal.</label>
            <input type="text" class="form-control datepicker" name="tanggal" placeholder="yyyy-mm-dd" value="<?=$pembelian->tanggal ?>" required="true" aria-required="true" aria-invalid="true">
          </div>
        </div>

        <div class="col-md-6">
          <div class="form-group bmd-form-group">
            <label for="inputProduk" class="bmd-label-static">Suplier.</label>
            <input type="text" class="form-control" id="suplier" name="suplier" required="true" value="<?=$pembelian->suplier ?>" aria-required="true" aria-invalid="true">
          </div>
          <div class="form-group bmd-form-group">
            <label for="inputProduk" class="bmd-label-static">Keterangan.</label>
            <textarea type="text" class="form-control" id="keterangan" name="keterangan"><?=$pembelian->keterangan ?></textarea>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="card">
    <div class="card-header card-header-primary card-header-icon">
      <a href="#" class="card-icon text-white" id="btn-tambah" data-toggle="modal" data-target="#createModal">
        <i class="material-icons text-light">add</i> Tambah Material
      </a>
      <h4 class="card-title">Tabel Pembelian Material</h4>
    </div>
    <div class="card-body">
      <div class="toolbar">
      </div>
      <div id="tampil_tabel">
        <?php $this->load->view('admin/pembelian/tabel',array('det_material' => $det_material)) ?>
      </div>
    </div>
    <div class="row">
        <div class="col text-center">
          <button type="submit" class="btn btn-rose">Selesai</button>
          <button type="button" class="btn btn-default" onclick="window.location.href='<?=base_url()?>pembelian/pembelianBatal/<?=$this->uri->segment(3,0)?>'">Batal</button>
        </div>
      </div>
      <br>
  <!-- end content-->
  </div>
</form>


<div id="createModal" class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Pilih Material</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <?php //echo form_open("pembelian/addMaterial","class='form-horizontal' autocomplete='off' id='ValidationModal' novalidate='novalidate'"); ?>
      <form class='form-horizontal' autocomplete='off' id='ValidationModal' novalidate='novalidate'>
        <input type="hidden" name="pembelianid" id="pembelianid" value="<?=$this->uri->segment(3,0)?>">
        <div class="modal-body">
          <div class="row">
            <label for="inputState" class="col-md-3 col-form-label">Material</label>
            <div class="col-md-9">
              <div class="form-group">
                <select id="Material" name="materialid" class="form-control select2" style="width:100%" required="true" aria-required="true" aria-invalid="true">
                  <option value="">Pilih Material...</option>
                  <?php foreach ($material as $key):?>
                  <option value="<?=$key->id_material ?>"><?=$key->label ?></option>
                  <?php endforeach ?>
                </select>
              </div>
            </div>
          </div>

          <div class="row stok_awal" style="display:none">
            <label for="inputProduk" class="col-md-3 col-form-label">Stok Awal.</label>
            <div class="col-md-9">
              <div class="form-group bmd-form-group">
                <input type="number" class="form-control" name="stok_awal" readonly>
              </div>
            </div>
          </div>

          <div class="row">
            <label for="inputProduk" class="col-md-3 col-form-label">Jumlah.</label>
            <div class="col-md-9">
              <div class="form-group bmd-form-group">
                <input type="number" min="1" class="form-control" name="jumlah" required="true" aria-required="true" aria-invalid="true">
              </div>
            </div>
          </div>
      
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary" id="btn-simpan">Simpan</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        </div>
      <?=form_close();?>
    </div>
  </div>
</div>

<div id="editModal" class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit Material</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <?php //form_open("pembelian/addMaterial","class='form-horizontal' autocomplete='off' id='ValidationModal2' novalidate='novalidate'"); ?>
      <form class='form-horizontal' autocomplete='off' id='ValidationModal2' novalidate='novalidate'>
        <input type="hidden" name="pembelianid" id="pembelianid" value="<?=$this->uri->segment(3,0)?>">
        <input type="hidden" name="id" id="id">
        <input type="hidden" name="materialid" id="materialid">
        <div class="modal-body">

          <div class="row">
            <label for="inputProduk" class="col-md-3 col-form-label">Label.</label>
            <div class="col-md-9">
              <div class="form-group bmd-form-group">
                <input type="text" class="form-control" id="label" disabled>
              </div>
            </div>
          </div>
          
          <div class="row">
            <label for="inputProduk" class="col-md-3 col-form-label">Jumlah.</label>
            <div class="col-md-9">
              <div class="form-group bmd-form-group">
                <input type="number" min="1" class="form-control" id="jumlah" name="jumlah" required="true" aria-required="true" aria-invalid="true">
              </div>
            </div>
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" id="btn-ubah">Simpan</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        </div>
      <?=form_close();?>
    </div>
  </div>
</div>

<script>
  function getDetail(ini) {
    $('#jumlah').val("");
    var id = $(ini).attr('data-id');
    $.ajax({
      type: 'GET',
      url: "<?=base_url('');?>pembelian/detailPembelianJson/"+id,
      success: function (data) {
        //Do stuff with the JSON data
          console.log(data);
         $('#editModal #id').val(id).hide();
         $('#editModal #label').val(data.label).focus();
         $('#editModal #jumlah').val(data.jumlah).focus();
         $('#editModal #materialid').val(data.materialid).hide();
        }
    });
  }

</script>