<div class="card">
  <div class="card-header card-header-primary card-header-icon">
    <a href="#" class="card-icon" data-toggle="modal" data-target="#createModal" onclick="clearForm()">
      <i class="material-icons text-light">assigment</i>
    </a>
    <h4 class="card-title">Tabel Produk Jadi</h4>
  </div>
  <div class="card-body">
    <div class="toolbar">
    </div>
    <div class="material-datatables">
      <table id="tabel_produk" class="table table-striped table-no-bordered table-hover custom-table" cellspacing="0" width="100%"
        style="width:100%">
        <thead>
          <tr>
            <th>#</th>
            <th>Id Produksi</th>
            <th>No Permintaan</th>
            <th>Produk</th>
            <th>Retur</th>
            <th class="disabled-sorting text-right">Actions</th>
          </tr>
        </thead>

        <tbody>
          <?php $no=1; foreach($produksi as $key ): ?>
            <tr>
              <td><?=$no++ ?></td>
              <td><?=$key->id_produksi ?></td>
              <td><?=$key->permintaanid ?></td>
              <td><?=($this->M_Produk->getDetail($this->M_Permintaan->getDetail($key->permintaanid)->produkid)) ? $this->M_Produk->getDetail($this->M_Permintaan->getDetail($key->permintaanid)->produkid)->label: "" ?></td>
              <td><?=$key->retur ?></td>
              <td class="text-right">
                <button title="Detail" class="btn btn-link btn-info btn-just-icon view"
                  onclick="window.location.href='<?=base_url()?>produksi/detail/<?=$key->id_produksi?>'">
                  <i class="material-icons">visibility</i>
                </button>
                <a  title="Print" target="_blank" class="btn btn-link btn-primary btn-just-icon edit" href="<?=base_url()?>produksi/print/<?=$key->id_produksi?>">
                  <i class="material-icons">print</i>
                </a>
              </td>
            </tr>
          <?php endforeach ?>
        </tbody>
      </table>
    </div>
  </div>
  <!-- end content-->
</div>
<div id="createModal" class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Tambah Produk</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <?=form_open("produk/add","class='form-horizontal' autocomplete='off'"); ?>
        <div class="modal-body">
          
          <div class="form-group">
            <label for="inputProduk">Nama Produk.</label>
            <input type="text" class="form-control" id="nama_produk" name="nama_produk">
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

<div id="editModal" class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit Produk</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <?=form_open("produk/add","class='form-horizontal' autocomplete='off'"); ?>
        <input type="hidden" id="id_produk" name="id_produk" value="">
        <div class="modal-body">
          
          <div class="form-group">
            <label for="inputProduk">Nama Produk.</label>
            <input type="text" class="form-control" id="nama_produk" name="nama_produk">
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


<script>

  function getDetail(ini) {
    clearForm();
    var id = $(ini).attr('data-id');
    $.ajax({
      type: 'GET',
      url: "<?=base_url('');?>produk/detailJson/"+id,
      success: function (data) {
        //Do stuff with the JSON data
          console.log(data);
         $('#editModal #id_produk').val(id).hide();
         $('#editModal #nama_produk').val(data.label).focus();
        }
    });
  }

  function clearForm() {    
     $('#id_produk').val("");
     $('#nama_produk').val("");
  }

</script>