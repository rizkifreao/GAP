<div class="card ">
  <div class="card-header card-header-rose card-header-icon">
    <div class="card-icon">
      <i class="material-icons">
        assignment
      </i>
    </div>
    <h4 class="card-title">
      Detail Permintaan Material
    </h4>
    <br>
    
  </div>
  <div class="card-body ">
    <div class="row">
      <div class="col-md-6">
        <div class="form-group bmd-form-group">
          <label for="inputProduk" class="bmd-label-static">Nomor Faktur.</label>
          <input type="text" class="form-control" id="nofaktur" name="nofaktur" value="<?=$permintaan->id_permintaan ?>" disabled>
        </div>
        <div class="form-group bmd-form-group">
          <label for="inputProduk" class="bmd-label-static">Tanggal.</label>
          <input type="text" class="form-control datepicker" name="tanggal" value="<?=$permintaan->tanggal ?>" disabled>
        </div>
      </div>

      <div class="col-md-6">
        <div class="form-group bmd-form-group">
          <label for="inputProduk" class="bmd-label-static">Produk.</label>
          <input type="text" class="form-control" value="<?=$this->M_Produk->getDetail($permintaan->produkid)->label ?>" disabled>
        </div>
        <div class="form-group bmd-form-group">
          <label for="inputProduk" class="bmd-label-static">Keterangan.</label>
          <textarea type="text" class="form-control" id="keterangan" name="keterangan" disabled><?=$permintaan->keterangan ?></textarea>
        </div>
      </div>
    </div>

    <br>
    <hr>
    <div class="material-datatables">
      <table id="tabel_material" class="table table-striped table-no-bordered table-hover custom-table" cellspacing="0" width="100%"
      style="width:100%">
        <thead>
          <tr>
            <th>#</th>
            <th>Bahan baku</th>
            <th>Jumlah</th>
          </tr>
        </thead>
        <tbody>
          <?php $no=1; foreach ($det_permintaan as $key ):?>
          <tr>
            <td><?=$no++?></td>
            <td><?=$this->M_Material->getDetail($key->materialid)->label?></td>
            <td><?=$key->jumlah." ".$this->M_Satuan->getDetail($key->satuanid)->nama_satuan?></td>
          </tr>
          <?php endforeach ?>
        </tbody>
      </table>
    </div>
  </div>
</div>