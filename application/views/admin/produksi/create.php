<?= form_open('produksi/save','method="post" autocomplete="off" id="TypeValidation" novalidate="novalidate"')?>
  
<input type="hidden" name="permintaanid" id="permintaanid" value="<?=$permintaan->id_permintaan?>">
<div class="card ">
  <div class="card-header card-header-rose card-header-icon">
    <div class="card-icon">
      <i class="material-icons">
        assignment
      </i>
    </div>
    <h4 class="card-title">
      Form Produk Jadi
    </h4>
    <br>
    <div class="row">
      <div class="col text-center">
        <button type="submit" class="btn btn-rose">Selesai</button>
        <button type="button" class="btn btn-default" onclick="window.location.href='<?=base_url()?>permintaan/pembelianBatal/<?=$this->uri->segment(3,0)?>'">Batal</button>
      </div>
    </div>
  </div>
  
  <div class="card-body ">
    <div class="row">
      <div class="col-md-6">
        <div class="row">
          <label for="inputProduk" class="col-md-3 col-form-label">ID Permintaan.</label>
          <div class="col-md-9">
            <div class="form-group bmd-form-group">
              <input type="text" class="form-control" value="<?=$permintaan->id_permintaan ?>" disabled>
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
              <input type="number" class="form-control" id="jum_permintaan" value="<?=$permintaan->qty_permintaan?>" disabled aria-invalid="true" >
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
              <input type="number" class="form-control" min="0" max="<?=$permintaan->qty_permintaan?>" id="retur" name="retur" aria-required="true" aria-invalid="true" >
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

    <br><br>
    <div id="tabel_produksi">
    </div>
  </div>

  <!-- <hr> -->
  <!-- <div class="material-datatables"> -->
      
    <!-- </div> -->
</div>

<div id="bahan_baku"></div>
  
</form>

<script>
  $(document).ready(function () {

    $("#retur").on('keyup',function () {
      var value = parseInt($(this).val())
      var id = $("#permintaanid").val()
      var jum_permintaan = $("#jum_permintaan").val()

      if (value != "" && value > 0 && isNaN(value) == false && value <= jum_permintaan) {
        $.ajax({
          url: base_url+"produksi/HitungRetur/"+id+"/"+value,
          type: "GET",
          success: (response) => {
            // console.log(response.produkid +" "+ response.jumlah);
            $("#tabel_produksi").html(response.html)
          }
        })
      }else{
        $("#tabel_produksi").html("")
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
        if (response.detBOM.length == 0) {
          $("#satuan").html("<b>"+response.satuan+"</b>")
          notificationShow('danger', 'Silahkan masukan data Bill Of Material !!', 'close')
        }else{
          $("#satuan").html("<b>"+response.satuan+"</b>")
          $("#bahan_baku").html(response.html)
          $("#kuantiti").focus()
        }
      }
    })
    }
    
  }

</script>