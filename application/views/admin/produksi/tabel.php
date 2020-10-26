<table id="tabel_produk" class="table" cellspacing="0" width="100%"
        style="width:100%">
        <thead class="text-primary">
          <tr>
            <th>Material</th>
            <th >Jum Permintaan</th>
            <th>Sisa</th>
          </tr>
        </thead>

        <tbody>
          <?php foreach($det_permintaan as $key ): ?>
          <?php
          $bomid = $this->M_Bom->getDetailWhere("produkid = ".$produkid);
          $detBom = $this->M_Bom_detail->getDetailWhere(array('bomid'=>$bomid->id,'materialid'=>$key->materialid));
          $total = $retur * $detBom->qty;
          ?>
            <tr>
              <td><?=$this->M_Material->getDetail($key->materialid)->label?></td>
              <td><?=$key->jumlah." ".$this->M_Satuan->getDetail($key->satuanid)->nama_satuan ?></td>
              <td>
                
                  <div class="row">
                    <!-- <label for="inputProduk" class="col-md-3 col-form-label">Jumlah Retur.</label> -->
                    <div class="col-md-6">
                      <div class="form-group bmd-form-group">
                        <input type="number" class="form-control" min="0" id="sisa" name="sisa[]>" value="<?=($total != $key->jumlah)? $key->jumlah - $total: $key->jumlah?>" aria-required="true" aria-invalid="true" >
                      </div>
                    </div>
                    <label class="col-sm-3 label-on-right">
                      <p id="satuan"><?=$this->M_Satuan->getDetail($key->satuanid)->nama_satuan ?></p>
                    </label>
                  </div>
              </td>
            </tr>
          <?php endforeach ?>
        </tbody>
      </table>