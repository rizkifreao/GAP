<div class="card">
  <div class="card-header card-header-primary card-header-icon">
    <a href="#" class="card-icon" data-toggle="modal" data-target="#createModal" onclick="clearForm()">
      <i class="material-icons text-light">add</i>
    </a>
    <h4 class="card-title">Tabel Produk</h4>
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
            <th>Kode Produk</th>
            <th>Label</th>
            <th>Qty</th>
            <th class="disabled-sorting text-right">Actions</th>
          </tr>
        </thead>

        <tbody>
          <?php $no=1; foreach($produks as $key ): ?>
            <tr>
              <td><?=$no++ ?></td>
              <td><?=$key->id_produk ?></td>
              <td><?=$key->label ?></td>
              <td><?=$key->stok ?></td>
              <td class="text-right">
                    <button data-id="<?=$key->id_produk ?>" title="Ubah" class="btn btn-link btn-warning btn-just-icon edit" data-toggle="modal" data-target="#editModal"
                        onclick="getDetail(this)">
                        <i class="material-icons">dvr</i>
                    </button>
                    <button class="btn btn-link btn-danger btn-just-icon remove" title="Hapus"
                        onclick="hapusConfirm('<?=base_url();?>produk/delete/<?=$key->id_produk ?>')">
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