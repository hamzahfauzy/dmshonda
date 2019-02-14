<?php
use vendor\zframework\Session;
$level = Session::user()->level;

$menu = [];
if($level == 1)
{
    $level_label = "admin";
    $menu[] = [
        "label" => '<span class="fas fa-home"></span> Home',
        "url" => base_url().'/'
    ];

    $menu[] = [
        "label" => '<span class="fas fa-user-tie"></span> Operator',
        "url" => base_url().'/'.$level_label.'/operator-list'
    ];

    $menu[] = [
        "label" => '<span class="fas fa-map-marker-alt"></span> Pos Dealer',
        "url" => base_url().'/'.$level_label.'/pos-list'
    ];

    $menu[] = [
        "label" => '<span class="fas fa-users"></span> Sales',
        "url" => base_url().'/'.$level_label.'/sales-list'
    ];

    $menu[] = [
        "label" => '<span class="fas fa-list-alt"></span> Kategori',
        "url" => base_url().'/'.$level_label.'/kategori-list'
    ];

    $menu[] = [
        "label" => '<span class="fas fa-book"></span> Jenis',
        "url" => base_url().'/'.$level_label.'/jenis-list'
    ];

    $menu[] = [
        "label" => '<span class="fas fa-motorcycle"></span> Unit',
        "url" => base_url().'/'.$level_label.'/unit-list'
    ];

    $menu[] = [
        "label" => '<span class="fas fa-shipping-fast"></span> Penjualan',
        "url" => base_url().'/'.$level_label.'/penjualan-list'
    ];

    $menu[] = [
        "label" => '<span class="fas fa-truck"></span> Mutasi',
        "url" => base_url().'/'.$level_label.'/mutasi-list'
    ];

    $menu[] = [
        "label" => '<span class="fas fa-dot-circle"></span> Target',
        "url" => base_url().'/'.$level_label.'/target-list'
    ];
}

if($level == 2)
{
    $level_label = "operator";
    $menu[] = [
        "label" => '<span class="fas fa-home"></span> Home',
        "url" => base_url().'/'
    ];

    $menu[] = [
        "label" => '<span class="fas fa-users"></span> Sales',
        "url" => base_url().'/'.$level_label.'/sales-list'
    ];

    $menu[] = [
        "label" => '<span class="fas fa-list-alt"></span> Stok',
        "url" => base_url().'/'.$level_label.'/stok-list'
    ];

    $menu[] = [
        "label" => '<span class="fas fa-motorcycle"></span> Unit',
        "url" => base_url().'/'.$level_label.'/unit-list'
    ];

    $menu[] = [
        "label" => '<span class="fas fa-shipping-fast"></span> Penjualan',
        "url" => base_url().'/'.$level_label.'/penjualan-list'
    ];
}

?>
<div class="sidebar-sticky">
    <ul class="nav flex-column">
        <?php foreach ($menu as $key => $value) : ?>
        <li class="nav-item">
            <a class="nav-link active" href="<?= $value['url'] ?>">
                <?= $value['label'] ?>
            </a>
        </li>
        <?php endforeach ?>
    </ul>
</div>