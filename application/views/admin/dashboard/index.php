    <div class="row">
      <div class="col-lg-3 col-md-6 col-sm-6">
        <div class="card card-stats">
          <div class="card-header card-header-warning card-header-icon">
            <div class="card-icon">
              <i class="material-icons">weekend</i>
            </div>
            <p class="card-category">Bahan Baku</p>
            <h3 class="card-title"><?=count($this->M_Material->getAll()) ?></h3>
          </div>
          <div class="card-footer">
            <div class="stats">
              <i class="material-icons text-danger">warning</i>
              <a href="#pablo">Total Bahan Baku.</a>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 col-sm-6">
        <div class="card card-stats">
          <div class="card-header card-header-rose card-header-icon">
            <div class="card-icon">
              <i class="material-icons">equalizer</i>
            </div>
            <p class="card-category">Pembelian</p>
            <h3 class="card-title"><?=count($this->M_Pembelian->getAll()) ?></h3>
          </div>
          <div class="card-footer">
            <div class="stats">
              <i class="material-icons">local_offer</i> Jumlah total pemebelian bahan baku
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 col-sm-6">
        <div class="card card-stats">
          <div class="card-header card-header-success card-header-icon">
            <div class="card-icon">
              <i class="material-icons">store</i>
            </div>
            <p class="card-category">Permintaan</p>
            <h3 class="card-title"><?=count($this->M_Permintaan->getAll())?></h3>
          </div>
          <div class="card-footer">
            <div class="stats">
              <i class="material-icons">date_range</i> Jumlah total permintaan bahan baku
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 col-sm-6">
        <div class="card card-stats">
          <div class="card-header card-header-info card-header-icon">
            <div class="card-icon">
              <i class="material-icons">assignment</i>
            </div>
            <p class="card-category">Produksi</p>
            <h3 class="card-title"><?=count($this->m_Produksi->getAll()) ?></h3>
          </div>
          <div class="card-footer">
            <div class="stats">
              <i class="material-icons">update</i> Hasil produksi
            </div>
          </div>
        </div>
      </div>
    </div>  
    
    <!-- <div class="row">
      <div class="col-md-4">
        <div class="card card-chart">
          <div class="card-header card-header-rose" data-header-animation="true">
            <div class="ct-chart" id="websiteViewsChart"></div>
          </div>
          <div class="card-body">
            <div class="card-actions">
              <button type="button" class="btn btn-danger btn-link fix-broken-card">
                <i class="material-icons">build</i> Fix Header!
              </button>
              <button type="button" class="btn btn-info btn-link" rel="tooltip" data-placement="bottom" title="Refresh">
                <i class="material-icons">refresh</i>
              </button>
              <button type="button" class="btn btn-default btn-link" rel="tooltip" data-placement="bottom" title="Change Date">
                <i class="material-icons">edit</i>
              </button>
            </div>
            <h4 class="card-title">Material</h4>
            <p class="card-category">Stok Material</p>
          </div>
          <div class="card-footer">
            <div class="stats">
              <i class="material-icons">access_time</i> campaign sent 2 days ago
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card card-chart">
          <div class="card-header card-header-success" data-header-animation="true">
            <div class="ct-chart" id="dailySalesChart"></div>
          </div>
          <div class="card-body">
            <div class="card-actions">
              <button type="button" class="btn btn-danger btn-link fix-broken-card">
                <i class="material-icons">build</i> Fix Header!
              </button>
              <button type="button" class="btn btn-info btn-link" rel="tooltip" data-placement="bottom" title="Refresh">
                <i class="material-icons">refresh</i>
              </button>
              <button type="button" class="btn btn-default btn-link" rel="tooltip" data-placement="bottom" title="Change Date">
                <i class="material-icons">edit</i>
              </button>
            </div>
            <h4 class="card-title">Permintaan</h4>
            <p class="card-category">
              <span class="text-success"><i class="fa fa-long-arrow-up"></i> 55% </span> increase in today sales.</p>
          </div>
          <div class="card-footer">
            <div class="stats">
              <i class="material-icons">access_time</i> updated 4 minutes ago
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card card-chart">
          <div class="card-header card-header-info" data-header-animation="true">
            <div class="ct-chart" id="completedTasksChart"></div>
          </div>
          <div class="card-body">
            <div class="card-actions">
              <button type="button" class="btn btn-danger btn-link fix-broken-card">
                <i class="material-icons">build</i> Fix Header!
              </button>
              <button type="button" class="btn btn-info btn-link" rel="tooltip" data-placement="bottom" title="Refresh">
                <i class="material-icons">refresh</i>
              </button>
              <button type="button" class="btn btn-default btn-link" rel="tooltip" data-placement="bottom" title="Change Date">
                <i class="material-icons">edit</i>
              </button>
            </div>
            <h4 class="card-title">Hasil Produk</h4>
            <p class="card-category">Last Campaign Performance</p>
          </div>
          <div class="card-footer">
            <div class="stats">
              <i class="material-icons">access_time</i> campaign sent 2 days ago
            </div>
          </div>
        </div>
      </div>
    </div> -->

    
    <!-- <h3>Manage Listings</h3> -->
    <br>
  </div>
</div>