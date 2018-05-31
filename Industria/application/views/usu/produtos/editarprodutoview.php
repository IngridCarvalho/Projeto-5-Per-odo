<div class=" justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
<?php foreach($produtos as $row): ?>
<h1>Editar Produto - <?= $row->nome ?></h1>
<?php endforeach; ?>
<form action="<?= base_url('produtos/atualizar')?>" method="post" enctype="multipart/form-data">
    <input type="hidden" name="codigo" value="<?= $produtos[0]->codigo?>">
    <div class="row form-group">
        <div class="col-sm-8">
            <label for="nome">Nome: </label>
            <input type="text" class="form-control" name="nome" value="<?= $produtos[0]->nome?>">
        </div>
    </div>
    <div class="row form-group">
        <div class="col-sm-4">
            <label for="quantidad">Quantidade: </label>
            <input type="number" step="any" class="form-control" name="quantidade" value="<?= $produtos[0]->quantidade?>">
        </div>
        <div class="col-sm-4">
            <label for="tipoproduto">Tipo de produto: </label>
            <select class="form-control" name="tipo">
                <?php foreach ($tipoproduto as $row):?>
                    <option value="<?= $row->codigo?>"<?= $row->codigo == $produtos[0]->tipo_produto  ? 'selected' : ''?>><?= $row->descricao?></option>   
                <?php endforeach;?>
            </select>
        </div>
    </div>
    <div class="row form-group">
        <div class="col-sm-4">
            <label for="custo">Preço de custo: </label>
            <input type="text" class="form-control money" name="custo" placeholder="R$" value="<?=  number_format($produtos[0]->preco_custo,2,',','.')?>">
        </div>
        <div class="col-sm-4">
            <label for="venda">Preço de venda: </label>
            <input type="text" class="form-control money" name="venda" placeholder="R$" value="<?= number_format($produtos[0]->preco_venda,2,',','.')?>">
        </div>
    </div>
        <button type="submit" class="btn btn-success">Salvar</button>
        <a href="javascript:window.history.go(-1);"><input  class="btn btn-info" type="button" value="Voltar"></a>
</form>
</div>