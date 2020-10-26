<?php 
  $jmh = $permintaan->qty_permintaan; 
?>
<div class="card ">
  <div class="card-header card-header-rose card-header-icon">
    <div class="card-icon">
      <i class="material-icons">
        assignment
      </i>
    </div>
    <h4 class="card-title">
      Detail Hasil Produksi
    </h4>
    <br>
    <!-- <div class="row">
      <div class="col text-center">
        <button type="submit" class="btn btn-rose">Selesai</button>
        <button type="button" class="btn btn-default" onclick="window.location.href='<?=base_url()?>produksi/pembelianBatal/<?=$this->uri->segment(3,0)?>'">Batal</button>
      </div>
    </div> -->
  </div>
  
  <div class="card-body ">
    <div class="row">
      <div class="col-md-6">
        <div class="row">
          <label for="inputProduk" class="col-md-3 col-form-label">ID Produksi.</label>
          <div class="col-md-9">
            <div class="form-group bmd-form-group">
              <input type="text" class="form-control" value="<?=$produksi->id_produksi ?>" disabled>
            </div>
          </div>
        </div>

        <div class="row">
          <label for="inputProduk" class="col-md-3 col-form-label">ID Permintaan.</label>
          <div class="col-md-9">
            <div class="form-group bmd-form-group">
              <input type="text" class="form-control" value="<?=$produksi->permintaanid ?>" disabled>
            </div>
          </div>
        </div>

        <div class="row">
          <label for="inputProduk" class="col-md-3 col-form-label">Nama Produk.</label>
          <div class="col-md-9">
            <div class="form-group bmd-form-group">
              <input type="text" class="form-control" value="<?=$this->M_Produk->getDetail($permintaan->produkid)->label ?>" disabled>
            </div>
          </div>
        </div>

        <div class="row">
          <label for="inputProduk" class="col-md-3 col-form-label">Jumlah Permintaan.</label>
          <div class="col-md-6">
            <div class="form-group bmd-form-group">
              <input type="text" class="form-control" value="<?=$jmh?>" disabled aria-invalid="true" >
            </div>
          </div>
          <label class="col-sm-3 label-on-right">
            <p id="satuan"></p>
          </label>
        </div>

        <div class="row">
          <label for="inputProduk" class="col-md-3 col-form-label">Jumlah Retur.</label>
          <div class="col-md-6">
            <div class="form-group bmd-form-group">
              <input type="text" class="form-control" value="<?=$produksi->retur?>" disabled >
            </div>
          </div>
          <label class="col-sm-3 label-on-right">
            <p id="satuan"></p>
          </label>
        </div>

        <div class="row">
          <label for="inputProduk" class="col-md-3 col-form-label">Jumlah Hasil Produksi.</label>
          <div class="col-md-6">
            <div class="form-group bmd-form-group">
              <input type="text" class="form-control" value="<?= $jmh - $produksi->retur ?>" disabled>
            </div>
          </div>
          <label class="col-sm-3 label-on-right">
            <p id="satuan"></p>
          </label>
        </div>

        <div class="row">
          <label for="inputProduk" class="col-md-3 col-form-label">Keterangan.</label>
          <div class="col-md-9">
            <div class="form-group bmd-form-group">
              <textarea type="text" class="form-control" disabled><?=$produksi->keterangan?></textarea>
            </div>
          </div>
        </div>
      </div>

      <div class="col-md-3"></div>
      <div class="col-md-3">
        <div class="row">
          <label for="inputProduk" class="col-md-3 col-form-label">Tanggal.</label>
          <div class="col-md-9">
            <div class="form-group bmd-form-group">
              <input type="text" class="form-control" value="<?=tgl_indo($produksi->tanggal) ?>" disabled>
            </div>
          </div>
        </div>
      </div>
    </div>

    <br><br>
    <h2>Tabel Sisa Bahan Baku</h2>
    <table id="tabel_produk" class="table" cellspacing="0" width="100%"
        style="width:100%">
      <thead class="text-primary">
        <tr>
          <th>Bahan Baku</th>
          <th>Sisa</th>
        </tr>
      </thead>

      <tbody>
        <?php foreach($det_produksi as $key ): ?>
          <tr>
            <td><?=$this->M_Material->getDetail($key->materialid)->label?></td>
            <td><?=$key->jumlah_sisa." ".$this->M_Satuan->getDetail($key->satuanid)->nama_satuan ?></td>
          </tr>
        <?php endforeach ?>
      </tbody>
    </table>
    
  </div>

  <!-- <hr> -->
  <!-- <div class="material-datatables"> -->
      
    <!-- </div> -->
</div>
