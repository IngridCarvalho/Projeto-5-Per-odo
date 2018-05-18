<div class=" justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
<h1>Nova Ordem de Produção</h1>
<form action="<?= base_url('usu/ordem/salvar')?>" method="post" enctype="multipart/form-data">
    <div class="row form-group">
        <div class="col-sm-2">
            <label for="Número da Ordem">Número da Ordem: </label>
            <input type="number" class="form-control" name="numero">
        </div>
    </div>
    <div class="row form-group">
        <div class="col-sm-2">
            <label for="Data de Emissão">Data de Emissão: </label>
            <input type="date" class="form-control" name="emissao">
        </div>
    </div>
    <div class="row form-group">
        <div class="col-sm-2">
            <label for=">Data de Finalização">Data de Finalização: </label>
            <input type="date" class="form-control" name="finalizacao">
        </div>
    </div>
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