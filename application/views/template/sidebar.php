<div class="sidebar" data-color="rose" data-background-color="black" data-image="<?=base_url() ?>/assets/img/sidebar-1.jpg">
      <!--
        Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

        Tip 2: you can also add an image using data-image tag
        -->
      <div class="logo">
        <a href="<?php base_url('dashboard') ?>" class="simple-text logo-mini">
          GAP
        </a>
        <a href="<?php base_url('dashboard') ?>" class="simple-text logo-normal">
          Pencatatan Barang
        </a>
      </div>
      <div class="sidebar-wrapper">
        <!-- <div class="user">
          <div class="photo">
            <img src="<?=base_url() ?>/assets/img/faces/avatar.jpg" />
          </div>
          <div class="user-info">
            <a data-toggle="collapse" href="#collapseExample" class="username">
              <span>
                <?= $this->ion_auth->user()->row()->first_name." ".$this->ion_auth->user()->row()->last_name ?>
                <b class="caret"></b>
              </span>
            </a>
            <div class="collapse" id="collapseExample">
              <ul class="nav">
                <li class="nav-item">
                  <a class="nav-link" href="#">
                    <span class="sidebar-mini"> MP </span>
                    <span class="sidebar-normal"> My Profile </span>
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#">
                    <span class="sidebar-mini"> EP </span>
                    <span class="sidebar-normal"> Edit Profile </span>
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#">
                    <span class="sidebar-mini"> S </span>
                    <span class="sidebar-normal"> Settings </span>
                  </a>
                </li>
              </ul>
            </div>
          </div>
        </div> -->
        <ul class="nav">
          <li class="nav-item <?= $this->uri->segment(1) == 'dashboard' ? 'active' : '' ?> ">
            <a class="nav-link" href="<?=base_url('dashboard') ?>">
              <i class="material-icons">dashboard</i>
              <p> Dashboard </p>
            </a>
          </li>
          <li class="nav-item <?= $this->uri->segment(1) == 'material' || $this->uri->segment(1) == 'produk' || $this->uri->segment(1) == 'jenis' || $this->uri->segment(1) == 'satuan' ? 'active' : '' ?>">
            <a class="nav-link" data-toggle="collapse" href="#componentsExamples">
              <i class="material-icons">apps</i>
              <p> Master Data
                <b class="caret"></b>
              </p>
            </a>
            <div class="collapse <?=$this->uri->segment(1) == 'material' || $this->uri->segment(1) == 'produk' || $this->uri->segment(1) == 'jenis' || $this->uri->segment(1) == 'satuan' ? 'show' : '' ?>" id="componentsExamples">
              <ul class="nav">
                <li class="nav-item <?= $this->uri->segment(1) == 'material' ? 'active' : '' ?>">
                  <a class="nav-link" href="<?=base_url('material') ?>">
                    <i class="material-icons">M</i>
                    <span class="sidebar-normal"> Material </span>
                  </a>
                </li>
                <li class="nav-item <?= $this->uri->segment(1) == 'produk'? 'active' : '' ?>">
                  <a class="nav-link" href="<?=base_url('produk') ?>">
                    <i class="material-icons">P</i>
                    <span class="sidebar-normal"> Produk </span>
                  </a>
                </li>
                 <li class="nav-item <?= $this->uri->segment(1) == 'satuan'? 'active' : '' ?>">
                  <a class="nav-link" href="<?=base_url('satuan') ?>">
                    <i class="material-icons">S</i>
                    <span class="sidebar-normal"> Satuan </span>
                  </a>
                </li>
              </ul>
            </div>
          </li>
          <li class="nav-item <?= $this->uri->segment(1) == 'bom'? 'active' : '' ?>">
            <a class="nav-link" href="<?=base_url('bom') ?>">
              <i class="material-icons">timeline</i>
              <p> Bill Of Material </p>
            </a>
          </li>
          <li class="nav-item <?= $this->uri->segment(1) == 'pembelian' || $this->uri->segment(1) == 'produksi' ? 'active' : '' ?>">
            <a class="nav-link" data-toggle="collapse" href="#formsExamples">
              <i class="material-icons">input</i>
              <p> Barang Masuk
                <b class="caret"></b>
              </p>
            </a>
            <div class="collapse <?= $this->uri->segment(1) == 'pembelian' || $this->uri->segment(1) == 'produksi'? 'show' : '' ?>" id="formsExamples">
              <ul class="nav">
                <li class="nav-item <?= $this->uri->segment(1) == 'pembelian'? 'active' : '' ?>">
                  <a class="nav-link" href="<?=base_url('pembelian') ?>">
                    <span class="sidebar-mini"> PM </span>
                    <span class="sidebar-normal"> Pembelian Material </span>
                  </a>
                </li>
              </ul>

              <ul class="nav">
                <li class="nav-item <?= $this->uri->segment(1) == 'produksi'? 'active' : '' ?>">
                  <a class="nav-link" href="<?=base_url('produksi') ?>">
                    <span class="sidebar-mini"> PJ </span>
                    <span class="sidebar-normal"> Produk Jadi </span>
                  </a>
                </li>
              </ul>
            </div>
        
          </li>
          <li class="nav-item <?= $this->uri->segment(1) == 'permintaan'? 'active' : '' ?>">
            <a class="nav-link" data-toggle="collapse" href="#tablesExamples">
              <i class="material-icons">assignment_return</i>
              <p> Barang Keluar
                <b class="caret"></b>
              </p>
            </a>
            <div class="collapse <?= $this->uri->segment(1) == 'permintaan'? 'show' : '' ?>" id="tablesExamples">
              <ul class="nav">
                <li class="nav-item <?= $this->uri->segment(1) == 'permintaan'? 'active' : '' ?>">
                  <a class="nav-link" href="<?=base_url('permintaan') ?>">
                    <span class="sidebar-mini"> P </span>
                    <span class="sidebar-normal"> Permintaan Material </span>
                  </a>
                </li>
              </ul>
            </div>
          </li>
          <li class="nav-item <?= $this->uri->segment(1) == 'laporan'? 'active' : '' ?>">
            <a class="nav-link" href="<?=base_url('laporan')?>">
              <i class="material-icons">widgets</i>
              <p> Laporan </p>
            </a>
          </li>
          <li class="nav-item <?= $this->uri->segment(1) == 'backup'? 'active' : '' ?>">
            <a class="nav-link" href="<?=base_url('backup')?>">
              <i class="fa fa-cog fa-2x"></i>
              <p> Backup </p>
            </a>
          </li>
        </ul>
      </div>
    </div>