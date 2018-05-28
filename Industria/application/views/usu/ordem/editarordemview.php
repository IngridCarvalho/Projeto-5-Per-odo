<div class=" justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
<?php foreach($ordens as $row): ?>
<h1>Editar Ordem de Produção - <?= $row->codigo ?></h1>
<?php endforeach; ?>
<form action="<?= base_url('usu/ordem/atualizar')?>" method="post" enctype="multipart/form-data">
    <input type="hidden" name="codigo" value="<?= $ordens[0]->codigo?>">
    <div class="row form-group">
        <div class="col-sm-4">
            <label for="Descrição">Descrição: </label>
            <textarea class="form-control" rows="3" name="descricao"><?= $ordens[0]->descricao; ?></textarea>
        </div>   
    </div>   
    <button type="submit" class="btn btn-success">Salvar</button>
</form>
</div>