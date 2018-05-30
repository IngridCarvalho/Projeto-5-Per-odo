<div class=" justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
<h1>Novo Produto</h1>
<form action="<?= base_url('produtos/salvar')?>" method="post" enctype="multipart/form-data">
    <div class="row form-group">
        <div class="col-sm-8">
            <label for="nome">Nome: </label>
            <input type="text" class="form-control" name="nome" required>
        </div>
    </div>
    <div class="row form-group">
        <div class="col-sm-4">
            <label for="quantidade">Quantidade: </label>
            <input type="number" step="any" class="form-control" name="quantidade">
        </div>
        <div class="col-sm-4">
            <label for="tipoproduto">Tipo de produto: </label>
            <select class="form-control" name="tipo">
                <?php foreach ($tipoproduto as $row):?>
                    <option value="<?= $row->codigo?>"><?= $row->descricao?></option>   
                <?php endforeach;?>
            </select>
        </div>
    </div>
    <div class="row form-group">
        <div class="col-sm-4">
            <label for="custo">Preço de custo: </label>
            <input type="number" step="any" class="form-control" name="custo">
        </div>
        <div class="col-sm-4">
            <label for="venda">Preço de venda: </label>
            <input type="number" step="any" class="form-control" name="venda">
        </div>
    </div>
    <button type="submit" class="btn btn-success">Salvar</button>
    <!--<button type="reset" class="btn btn-info" onclick="return confirm('Deseja limpar o formulário de cadastro?')">Limpar</button>-->
    <a href="javascript:window.history.go(-1);"><input  class="btn btn-info" type="button" value="Voltar"></a>
</form>
</div>
