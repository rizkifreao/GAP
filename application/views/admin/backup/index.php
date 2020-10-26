<div class="row">
  <div class="col-md-6">
    <div class="card">
      <div class="card-header card-header-primary card-header-icon">
        <h4 class="card-title">Backup Tables & Databases</h4>
      </div>
      <div class="card-body">

        <b>Database Information</b>
        <hr>
        <table width="100%">
          <tr>
            <td>Database Name</td>
            <td> : </td>
            <td><?=$database->database ?></td>
          </tr>
          <tr>
            <td>Database Driver</td>
            <td> : </td>
            <td><?=$database->dbdriver ?></td>
          </tr>
          <tr>
            <td>Char Set</td>
            <td> : </td>
            <td><?=$database->char_set ?></td>
          </tr>
          <tr>
            <td>Db Collation</td>
            <td> : </td>
            <td><?=$database->dbcollat ?></td>
          </tr>
        </table>

        <hr>

        <form action="<?php echo base_url();?>backup/backupTable" method="post">
          <div class="form-group">
            <select id="pilihTable" name="tabel_name" class="form-control select2" style="width:100%" required="true" aria-required="true" aria-invalid="true">
              <option value="">Pilih Tabel...</option>
              <?php foreach ($tables as $key):?>
              <option value="<?=$key ?>"><?=$key ?></option>
              <?php endforeach ?>
            </select>
          </div>
       
      </div>
      <div class="card-footer ">
        <button type="submit" class="btn btn-fill btn-rose">Backup Table</button>
        <a href="<?php echo base_url();?>backup/backupDB" class="btn btn-success">Backup Databases</a>
      </div>
      </form>
    </div>
  </div>

  <div class="col-md-6">
    <div class="card">
      <div class="card-header card-header-primary card-header-icon">
        <h4 class="card-title">Restore Databases</h4>
      </div>
      <div class="card-body">
        <input  type="file" id="datafile" name="datafile" required>
        <span><p class="help-block">File harus dalam format .sql</p></span>
        
       
      </div>
      <div class="card-footer ">
        <button type="button" class="btn btn-primary" onclick="restore()" id="restore" data-loading-text="<i class='fa fa-spinner fa-spin'></i> Processing Order">Restore Database</button>
      </div>
    </div>
  </div>

</div>



<script>

$(document).ready(function () {
  $("#pilihTable").select2({
    tags: true,
    // dropdownParent: $("#form_tabel")
  });
})

function restore() {
  alert('Berhasil restore')
}

</script>