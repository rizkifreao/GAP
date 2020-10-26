<div class="card">
  <div class="card-header card-header-rose card-header-icon">
    <a href="#" class="card-icon" onclick="window.location.href = '<?=base_url()?>permintaan/create'">
      <i class="material-icons text-light">add</i>
    </a>
    <h4 class="card-title">Daftar Permintaan Bahan Baku</h4>
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
            <th>ID</th>
            <th>Produk</th>
            <th>Jumlah</th>
            <th>Tanggal</th>
            <th>Status Produksi</th>
            <th>Keterangan</th>
            <th class="disabled-sorting text-right">Actions</th>
          </tr>
        </thead>
        <tbody>

        <?php $no=1; foreach ($permintaan as $key):?>
          <tr>
            <td><?=$no++ ?></td>
            <td><?=$key->id_permintaan ?></td>
            <td><?=$this->M_Produk->getDetail($key->produkid)->label ?></td>
            <td><?=$key->qty_permintaan ?></td>
            <td><?=tgl_indo($key->tanggal) ?></td>
            <td><?=$key->status ?></td>
            <td><?=$key->keterangan ?></td>
            <td class="disabled-sorting text-right">
              <button title="Detail" class="btn btn-link btn-info btn-just-icon view"
                  onclick="window.location.href='<?=base_url()?>permintaan/detail/<?=$key->id_permintaan?>'">
                  <i class="material-icons">visibility</i>
              </button>
              <a  title="Print" target="_blank" class="btn btn-link btn-primary btn-just-icon edit" href="<?=base_url()?>permintaan/print/<?=$key->id_permintaan?>">
                  <i class="material-icons">print</i>
                </a>
              <?php if ($key->status !== "SELESAI"): ?>
                  <button class="btn btn-link btn-primary btn-just-icon remove" title="Selesai"
                    onclick="window.location.href = '<?=base_url()?>produksi/create/<?=$key->id_permintaan?>'">
                  <i class="material-icons">send</i>
                  </button>
              <?php endif ?>
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
        <h5 class="modal-title">Tambah Material</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <?=form_open("material/add","class='form-horizontal' autocomplete='off'"); ?>
        <div class="modal-body">
          
          <div class="form-group">
            <label for="inputProduk">Nama Material.</label>
            <input type="text" class="form-control" id="nama_material" name="nama_material" required="true" aria-required="true" aria-invalid="true">
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
        <h5 class="modal-title">Edit Material</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <?=form_open("material/add","class='form-horizontal' autocomplete='off'"); ?>
        <input type="hidden" id="id_material" name="id_material" value="">
        <div class="modal-body">
          
          <div class="form-group">
            <label for="inputProduk">Nama Produk.</label>
            <input type="text" class="form-control" id="nama_material" name="nama_material" required="true" aria-required="true" aria-invalid="true">
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