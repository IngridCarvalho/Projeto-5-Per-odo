<div class=" justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
<h1>Nova Ordem de Produção</h1>
<form action="<?= base_url('ordem/salvar')?>" method="post" enctype="multipart/form-data">
    <div class="row form-group">
        <div class="col-sm-4">
            <label for="Descrição">Descrição: </label>
            <textarea class="form-control" rows="3" name="descricao"></textarea>
        </div>   
    </div>   
    <button type="submit" class="btn btn-success">Salvar</button>
    <button type="reset" class="btn btn-info" onclick="return confirm('Deseja limpar o formulário de cadastro?')">Limpar</button>
</form>
</div>