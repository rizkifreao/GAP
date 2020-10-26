<div class="material-datatables">
    <table id="tabel_material" class="table table-striped table-no-bordered table-hover custom-table" cellspacing="0" width="100%"
    style="width:100%">
    <thead>
        <tr>
        <th>#</th>
        <th>Kode Material</th>
        <th>Label</th>
        <th>Jumlah</th>
        <th>Stok Awal</th>
        <th>Stok Akhir</th>
        <th class="disabled-sorting text-right">Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php $no=1; foreach ($det_material as $key ):?>
        <tr>
        <td><?=$no++?></td>
        <td><?=$key->materialid?></td>
        <td><?=$this->M_Material->getDetail($key->materialid)->label?></td>
        <td><?=$key->jumlah?></td>
        <td><?=$key->stok_awal?></td>
        <td><?=$key->stok_awal + $key->jumlah?></td>
        <td class="disabled-sorting text-right">
            <button data-id="<?=$key->id?>" title="Ubah" class="btn btn-link btn-warning btn-just-icon edit" data-toggle="modal" data-target="#editModal"
                onclick="getDetail(this)">
                <i class="material-icons">dvr</i>
            </button>
            <button class="btn btn-link btn-danger btn-just-icon remove" title="Hapus"
                onclick="hapus_det_pembelian('<?=$key->id?>')">
                <i class="material-icons">close</i>
            </button>
        </td>
        </tr>
        <?php endforeach ?>
        
    </tbody>
    </table>
</div>