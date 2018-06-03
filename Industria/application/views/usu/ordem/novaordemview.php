<?php
date_default_timezone_set('America/Sao_Paulo');
?>

<div class=" justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
<h2>Cadastro de Ordem de Produção:</h2>
<form action="<?= base_url('ordem/proximo')?>" method="post" enctype="multipart/form-data">
    <div class="row form-group">
        <div class="col-sm-8">
            <label for="descricao">Descrição: </label>
            <input type="text" class="form-control" name="descricao" required>
        </div>
    </div>
    <div class="row form-group">
        <div class="col-sm-4">
            <label for="dataInicio">Data de Início: </label>
            <input type="date" class="form-control" name="dataInicio" value="<?php echo date('Y-m-d'); ?>">
        </div>
    </div>
    <button type="submit" class="btn btn-success">Próximo</button>
    <a href="javascript:window.history.go(-1);"><input  class="btn btn-info" type="button" value="Voltar"></a>
</form>
</div>