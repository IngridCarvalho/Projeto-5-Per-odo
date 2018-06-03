<div class=" justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
<?php foreach($ordens as $row): ?>
<h1>Editar Ordem de Produção - <?= $row->codigo ?></h1>
<?php endforeach; ?>
<form action="<?= base_url('ordem/atualizar')?>" method="post" enctype="multipart/form-data">
    <input type="hidden" name="codigo" value="<?= $ordens[0]->codigo?>">
    <div class="row form-group">
        <div class="col-sm-8">
            <label for="Descrição">Descrição: </label>
            <input class="form-control" rows="3" name="descricao" value="<?= $ordens[0]->descricao; ?>"/>
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