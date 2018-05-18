<nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow">
  <h4 class="navbar-brand col-sm-3 col-md-2 mr-0">Indústria</h4>
  <!--<input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search">-->
  <h5 style="color: white;">Usuário - 
    <?php if($this->session->userdata('LOGADO')){?>
    <?= $this->session->userdata('nome') ?>
    <?php } ?>
  </h5>
  <ul class="navbar-nav px-3">
    <li class="nav-item text-nowrap">
      <a class="nav-link" href="<?= base_url('usu/acesso/logout')?>" onclick="return confirm('Deseja realmente sair?')">Sair</a>
    </li>
  </ul>
</nav>

<div class="container-fluid">
  <div class="row">
    <nav class="col-md-2 d-none d-md-block bg-light sidebar">
      <div class="sidebar-sticky">
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link active" href="<?= base_url('usu')?>">
              <span data-feather="home"></span>
              Página Inicial <span class="sr-only">(current)</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?= base_url('usu/ordem')?>">
              <span data-feather="file"></span>
              Ordens de Produção
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?= base_url('usu/produtos')?>">
              <span data-feather="shopping-cart"></span>
              Produtos
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <span data-feather="bar-chart-2"></span>
              Relatórios
            </a>
          </li>
         
          <li class="nav-item">
          <?php if($this->session->userdata('fk_nivel') == 1){?>
            <a class="nav-link" href="<?= base_url('usu/usuarios')?>">
              <span data-feather="users"></span>
              Usuários
            </a>
          <?php }?>  
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <span data-feather="layers"></span>
              Manual
            </a>
          </li>
        </ul>
      </div>
    </nav>  
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">

            
