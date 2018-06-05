<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../../../favicon.ico">

    <title>Login - Indústria</title>

    <!-- Bootstrap core CSS -->
    <link href="<?= base_url(); ?>dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- <link rel="stylesheet" href="http://code.jquery.com/qunit/qunit-1.11.0.css" type="text/css" media="all"> -->
    <!-- Custom styles for this template -->
    <link href="<?= base_url(); ?>dist/css/signin.css" rel="stylesheet">
  </head>

  <body class="text-center">
    <form class="form-signin" action="<?= base_url('acesso/logar') ?>" method="post">
      <?php if (isset($alert)) { ?>
        <div class="alert alert-<?php 
            $a = explode('-', isset($alert) ? $alert : '');
            echo $a[0];
            ?>">
          <button type="button" class="close" data-dismiss="alert">×</button>
          <?php
            $a = explode('-', isset($alert) ? $alert : '');
            echo $a[1];
          ?>
        </div>
                <?php } ?>
      <h1 class="h3 mb-3 font-weight-normal">Acesso ao Sistema Industrial </h1>
      <label for="cpf" class="sr-only">CPF</label>
      <input type="text"  id="cpf" name="cpf" class="form-control" placeholder="cpf" required autofocus>
      <label for="inputSenha" class="sr-only">Senha</label>
      <input type="password" id="senha" name="senha" class="form-control" placeholder="Senha" required>
      <!--<div class="checkbox mb-3">
        <label>
          <input type="checkbox" value="Lembrar-me"> Lembrar-me
        </label>
      </div>-->
      <button class="btn btn-lg btn-primary btn-block" type="submit">Acessar</button>
      <p class="mt-5 mb-3 text-muted">&copy; <?php echo date("Y");?></p>
    </form>
    
    <!-- Scripts da Máscara -->
    <script src="<?= base_url()?>dist/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
   
    <script src="<?= base_url(); ?>dist/js/jquery.mask.min.js"></script>
    <script>
      $(document).ready(function(){
        $('#cpf').mask('000.000.000-00');
      });
    </script>
     <script>$('.alert').alert()
          </script>
  </body>
</html>
