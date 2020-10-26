<!-- Main content -->
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?=$title ?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?=base_url('assets/bootstrap/dist/css/bootstrap.min.css') ?>">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?=base_url('assets/font-awesome/css/font-awesome.min.css') ?>">
  <link rel="stylesheet" href="<?=base_url('assets/css/AdminLTE.min.css') ?>">
</head>
<body onload="window.print();">
			
			<div class="wrapper">
			  <section class="invoice">
			    <!-- title row -->
					<div class="row">
			      <div class="col-xs-12">
			        <h1 class="page-header text-center">
			          <?=$title ?>
			        </h1>
			      </div>
			      <!-- /.col -->
			    </div>

			    <div class="row">
			      <div class="col-xs-12">
			        <h3 class="">
			          CV.Berkat Tresna Abadi
			          <small class="pull-right">Tanggal: <?=tgl_indo($produksi->tanggal) ?></small>
			        </h3>
			      </div>
			      <!-- /.col -->
			    </div>
			    <!-- info row -->
			    <div class="row invoice-info">
			      
			      <div class="col-sm-4 invoice-col">
              <?php 
              $permintaan = $this->M_Permintaan->getDetail($produksi->permintaanid);
              ?>
			        <b>Bill ID :</b> <?=$produksi->id_produksi ?><br>
			        <b>Bill Permintaan :</b> <?=$produksi->permintaanid ?><br>
			        <b>Produk :</b> <?=$this->M_Produk->getDetail($permintaan->produkid)->label ?><br>
			        <b>Jumlah Permintaan :</b> <?=$permintaan->qty_permintaan ?> Pcs <br />
			        <b>Retur :</b> <?=$produksi->retur ?> Pcs <br />
			        <b>Total :</b> <?=$permintaan->qty_permintaan - $produksi->retur ?> Pcs <br />
			        <b>Keterangan :</b> <?=$produksi->keterangan ?> 
			      </div>
			      <!-- /.col -->
			    </div>
			    <!-- /.row -->

			    <!-- Table row -->
					<br>
			    <div class="row">
			      <div class="col-xs-12 table-responsive">
			        <table class="table table-striped">
			          <thead>
			          <tr>
			            <th>#</th>
			            <th>Bahan Baku</th>
			            <th>Sisa Produksi</th>
			          </tr>
			          </thead>
			          <tbody> 
									<?php $no=1; foreach ($det_produksi as $key ):?>
										<tr>
											<td><?= $no++ ?></td>
											<td><?= $this->M_Material->getDetail($key->materialid)->label ?></td>
											<td><?= $key->jumlah_sisa. " ".$this->M_Satuan->getDetail($key->satuanid)->nama_satuan ?></td>
										</tr>
									<?php endforeach ?>
			          
			          </tbody>
			        </table>
			      </div>
			      <!-- /.col -->
			    </div>
			    <!-- /.row -->

			    <div class="row">
			      
			      <div class="col-xs-6 pull pull-right">

			        <div class="table-responsive">
			          <table class="table">
			            <tr>
			              <th style="width:50%">Total :</th>
			              <td><?=count($det_produksi) ?> Material</td>
			            </tr>
			          </table>
			        </div>
			      </div>
			      <!-- /.col -->
			    </div>
			    <!-- /.row -->
			  </section>
			  <!-- /.content -->
			</div>
		</body>
	</html>