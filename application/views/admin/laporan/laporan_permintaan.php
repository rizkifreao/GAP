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
			          <small class="pull-right">Periode: <?=$periode ?></small>
			        </h3>
			      </div>
			      <!-- /.col -->
			    </div>
					<br>
			    <div class="row">
			      <div class="col-xs-12 table-responsive">
			        <table class="table table-bordered">
			          <thead>
			          <tr>
			            <th class="text-uppercase text-center" width="30px">No</th>
			            <th class="text-uppercase text-center">Produk</th>
			            <th class="text-uppercase text-center">Jumlah</th>
			            <th class="text-uppercase text-center">Status Produksi</th>
			            <th class="text-uppercase text-center">Keterangan</th>
			          </tr>
			          </thead>
			          <tbody> 
									<?php $no=1; foreach ($permintaan as $key ):?>
									<?php 
                    $produk = $this->M_Produk->getDetail($key->produkid)->label;
                  ?>
                    <tr style="background-color : #f2f2f2">
                      <td class="text-center"><?= $no++ ?></td>
                      <td class="text-uppercase"><?= $produk?></td>
                      <td class="text-uppercase text-center"><?= $key->qty_permintaan ?></td>
                      <td class="text-uppercase text-center"><?= $key->status ?></td>
                      <td class="text-uppercase"><?= $key->keterangan ?></td>
                    </tr>
                    <?php $barangs = $this->m_Permintaan_detail->getAllBy(['permintaanid'=>$key->id_permintaan]);
                      foreach ($barangs as $barang ) :            
                    ?>
                      <tr>
                        <td></td>
                        <td class="text-sm-left"><?=$this->M_Material->getDetail($barang->materialid)->label?></td>
												<td><?=$barang->jumlah?></td>
                        <td class="text-sm-left"><?=$this->M_Satuan->getDetail($barang->satuanid)->nama_satuan ?></td>
												<td></td>
                      </tr>
                    <?php endforeach; ?>
									<?php endforeach ?>
			          </tbody>
                <tfoot>
                  <tr>
                    <th colspan="4">Total Permintaan :</th>
                    <th><?=count($permintaan) ?></th>
                  </tr>
									<tr>
                    <th colspan="4">Jumlah Produksi Selesai :</th>
                    <th><?=count($this->M_Permintaan->getAllBy(['status'=>'SELESAI'])) ?></th>
                  </tr>
									<tr>
                    <th colspan="4">Jumlah Produksi Proses :</th>
                    <th><?=count($this->M_Permintaan->getAllBy(['status'=>'PROSES'])) ?></th>
                  </tr>
                </tfoot>
			        </table>
			      </div>
			      <!-- /.col -->
			    </div>
			    <!-- /.row -->

			    <!-- <div class="row">
			      
			      <div class="col-xs-6 pull pull-right">

			        <div class="table-responsive">
			          <table class="table">
			            <tr>
			              <th style="width:50%">Total :</th>
			              <td><?=count($det_pembelian) ?> Material</td>
			            </tr>
			          </table>
			        </div>
			      </div>
	
			    </div> -->
			    <!-- /.row -->
			  </section>
			  <!-- /.content -->
			</div>
		</body>
	</html>