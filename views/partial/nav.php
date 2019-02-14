<?php
use vendor\zframework\Session;
$level = Session::get('id') && Session::user()->level == 1 ? "admin" : "operator";
?>
<nav class="navbar navbar-expand-lg navbar-dark bg-danger">
  <div class="container">
    <button class="navbar-toggler btn-nav-toggle" type="button" data-toggle="collapse">
      <span class="navbar-toggler-icon"></span>
    </button>
    <a class="navbar-brand" href="<?= base_url() ?>">
      <img src="<?=$this->assets->get('images/honda-putih.png')?>" height="30" class="d-inline-block align-top">
      DMS Honda
    </a>
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="<?= base_url() ?>/<?= $level ?>"><i class="fas fa-chart-line"></i> Dashboard</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="javascript:void(0)" onclick="document.getElementById('form-logout').submit();"><i class="fas fa-sign-out-alt"></i> Logout</a>
        <form method="post" action="<?= base_url() ?>/logout" id="form-logout">
          <input type="hidden" name="id" value="<?= Session::get('id') ?>">
        </form>
      </li>
    </ul>
  </div>
</nav>