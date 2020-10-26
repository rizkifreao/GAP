<?= form_open('permintaan/save','method="post" autocomplete="off" id="TypeValidation" novalidate="novalidate"')?>
  
<input type="hidden" name="permintaanid" value="<?=$this->uri->segment(3,0)?>">
<div class="card ">
  <div class="card-header card-header-rose card-header-icon">
    <div class="card-icon">
      <i class="material-icons">
        assignment
      </i>
    </div>
    <h4 class="card-title">
      Form Permintaan Material
    </h4>
    <br>
    <div class="row">
      <div class="col text-center">
        <button type="submit" class="btn btn-rose">Selesai</button>
        <button type="button" class="btn btn-default" onclick="window.location.href='<?=base_url()?>permintaan/permintaanBatal/<?=$this->uri->segment(3,0)?>'">Batal</button>
      </div>
    </div>
  </div>
  
  <div class="card-body ">
    <div class="row">
    <div class="col-md-6">
      <div class="row">
        <label for="inputProduk" class="col-md-3 col-form-label">No Permintaan.</label>
        <div class="col-md-9">
          <div class="form-group bmd-form-group">
            <input type="text" class="form-control" id="nofaktur" name="nofaktur" value="<?=$permintaan->id_permintaan ?>" disabled>
          </div>
        </div>
      </div>

      <div class="row">
        <label for="inputState" class="col-md-3 col-form-label">Produk</label>
        <div class="col-md-9">
          <div class="form-group">
            <select id="pilihProduk" name="produkid" class="form-control select2" onchange="getProduk(this)" style="width:100%" required="true" aria-required="true" aria-invalid="true">
              <option value="">Pilih Produk...</option>
              <?php foreach ($produks as $key):?>
              <option value="<?=$key->id_produk ?>"><?=$key->label ?></option>
              <?php endforeach ?>
            </select>
          </div>
        </div>
      </div>

      <div class="row">
        <label for="inputProduk" class="col-md-3 col-form-label">Jumlah.</label>
        <div class="col-md-6">
          <div class="form-group bmd-form-group">
            <input type="number" class="form-control" min="1" id="kuantiti" name="kuantiti" required="true" aria-required="true" aria-invalid="true" >
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
            <textarea type="text" class="form-control" name="keterangan"></textarea>
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
            <input type="text" class="form-control" value="<?=tgl_indo(date('Y-m-d')) ?>" disabled>
          </div>
        </div>
      </div>
    </div>
    
    </div>
  </div>
</div>

<div id="bahan_baku"></div>
  
</form>

<script>
  $(document).ready(function () {
    var pilihProduk = $("#pilihProduk").select2({
      tags: true,
    });

    $("#kuantiti").on('keyup',function () {
      var value = parseInt($(this).val())
      if (value != "" && value > 0 && isNaN(value) == false) {
        if (pilihProduk.val() == "") {
          notificationShow('danger', 'Silahkan pilih produk !!', 'close')
          $("#pilihProduk").select2('open')
        }else{
          $.ajax({
            url: base_url+"permintaan/getDataTable/"+pilihProduk.val()+"/"+value,
            type: "GET",
            success: (response) => {
              // console.log(response.produkid +" "+ response.jumlah);
              if (response.detBOM.length == 0) {
                notificationShow('danger', 'Silahkan masukan data Bill Of Material !!', 'close')
                $("#bahan_baku").html("")
                // console.log(response.detBOM.length);
                // console.log(pilihProduk.val());
                
              }else{
                $("#bahan_baku").html(response.html)
              }
            }
          })
        }
      }
      // console.log(value);
      
    })
  })

  function getProduk(id) {
    var id_produk = $(id).val();
    // $("#satuan").append("")
    if (id != "") {
      $.ajax({
      type: 'GET',
      url: base_url+"permintaan/getProduk/"+id_produk,
      success: (response) => {
        console.log(response);
        if (response.status != "FAILED") {
          if (response.detBOM.length == 0) {
            $("#satuan").html("<b>"+response.satuan+"</b>")
            notificationShow('danger', 'Silahkan masukan data detail Bill Of Material !!', 'close')
            $("#bahan_baku").html("")
          }else{
            $("#satuan").html("<b>"+response.satuan+"</b>")
            $("#bahan_baku").html(response.html)
            $("#kuantiti").focus()
          }
        }else{
          notificationShow('danger', 'Silahkan  input produk ke tabel Bill of Material !!', 'close')
          $("#bahan_baku").html("")
        }
      }
    })
    }
    
  }

</script>