<div class=" justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
<?php foreach($produtos as $row): ?>
<h1>Editar Produto - <?= $row->nome ?></h1>
<?php endforeach; ?>
<form action="<?= base_url('usu/produtos/atualizar')?>" method="post" enctype="multipart/form-data">
    <input type="hidden" name="codigo" value="<?= $produtos[0]->codigo?>">
    <div class="row form-group">
        <div class="col-sm-2">
            <label for="nome">Nome: </label>
            <input type="text" class="form-control" name="nome" value="<?= $produtos[0]->nome?>">
        </div>
    </div>
    <div class="row form-group">
        <div class="col-sm-2">
            <label for="quantidad">Quantidade: </label>
            <input type="number" step="any" class="form-control" name="quantidade" value="<?= $produtos[0]->quantidade?>">
        </div>
    </div>
    <div class="row form-group">
        <div class="col-sm-2">
            <label for="custo">Preço de custo: </label>
            <input type="number" step="any" class="form-control" name="custo" value="<?= $produtos[0]->preco_custo?>">
        </div>
    </div>
    <div class="row form-group">
        <div class="col-sm-2">
            <label for="venda">Preço de venda: </label>
            <input type="number" step="any" class="form-control" name="venda" value="<?= $produtos[0]->preco_venda?>">
        </div>
    </div>
    <div class="row form-group">
        <div class="col-sm-2">
            <label for="tipoproduto">Tipo de produto: </label>
            <select class="form-control" name="tipo">
                <?php foreach ($tipoproduto as $row):?>
                    <option value="<?= $row->codigo?>"<?= $row->codigo == $produtos[0]->tipo_produto  ? 'selected' : ''?>><?= $row->descricao?></option>   
                <?php endforeach;?>
            </select>
        </div>
    </div>
    <button type="submit" class="btn btn-success">Salvar</button>
</form>
</div>