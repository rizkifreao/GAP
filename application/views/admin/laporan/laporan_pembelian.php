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
			        <table class="table">
			          <thead>
			          <tr>
			            <th class="text-uppercase text-center" width="30px">No</th>
			            <th class="text-uppercase text-center">No Faktur</th>
			            <th class="text-uppercase text-center">Suplier</th>
			            <th class="text-uppercase text-center">Keterangan</th>
			          </tr>
			          </thead>
			          <tbody> 
									<?php $no=1; foreach ($pembelian as $key ):?>
                    <tr style="background-color : #f2f2f2">
                      <td class="text-center"><?= $no++ ?></td>
                      <td class="text-uppercase"><?= $key->nofaktur ?></td>
                      <td class="text-uppercase"><?= $key->suplier ?></td>
                      <td class="text-uppercase"><?= $key->keterangan ?></td>
                    </tr>
                    <?php $barangs = $this->M_Pembelian_detail->getAllBy(['pembelianid'=>$key->id_pembelian]);
                      foreach ($barangs as $barang ) :            
                    ?>
                      <tr>
                        <td></td>
                        <td class="text-sm-left"><?=$this->M_Material->getDetail($barang->materialid)->label?></td>
                        <td class="text-sm-left"><?= $barang->jumlah ?></td>
                        <td class="text-sm-left">Pcs</td>
                      </tr>
                    <?php endforeach; ?>
									<?php endforeach ?>
			          </tbody>
                <tfoot>
                  <tr>
                    <th></th>
                    <th>Total Pembelian :</th>
                    <th><?=count($pembelian) ?></th>
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