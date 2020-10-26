<div class="card card-plain">
  <div class="card-header card-header-icon card-header-rose">
    <div class="card-icon">
      <i class="material-icons">data</i>
    </div>
    <h4 class="card-title mt-0"> Table on Plain</h4>
    <p class="card-category"> Bahan baku yang dibutuhkan</p>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table">
        <thead class="">
          <th>NO</th>
          <th>Bahan Baku</th>
          <th>Stok</th>
          <th>Jumlah yang dibutuhkan</th>
        </thead>
        <tbody>
        <?php $no=1; foreach ($detBOM as $key ):?>
          <?php $material = $this->M_Material->getDetail($key->materialid)?>
          <?php $satuan = $this->M_Satuan->getDetail($key->satuanid)?>
          <?php $total = $key->qty * $jumlah?>
          <tr <?= ($total >= $material->stok) ? "class='table-danger' name='danger'" : ""?>>
            <td><?= $no++ ?></td>
            <td><?= $material->label?></td>
            <td><?= $material->stok." ".$satuan->nama_satuan?></td>
            <td><?= $total." ".$satuan->nama_satuan ?></td>
          </tr>
        <?php endforeach ?>
        </tbody>
      </table>
    </div>
  </div>
</div>