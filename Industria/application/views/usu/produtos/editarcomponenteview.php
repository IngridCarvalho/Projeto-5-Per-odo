<div class=" justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
    <p class="info">Editar quantidade utilizada:</p>
    <form action="<?= base_url('produtos/atualizar_componente/'.$componente[0]->codigo_composicao.'/'.$componente[0]->codigo_produto)?>" method="post" enctype="multipart/form-data">
       
        <div class="row form-group">
            <div class="col-sm-4">
                <label for="quantidade">Quantidade: </label>
                <input type="number" step="any" class="form-control" name="quantidade" value="<?= $componente[0]->quantidade_componente?>">
            </div>
        </div>
        <button type="submit" class="btn btn-success">Salvar</button>
        <a href="javascript:window.history.go(-1);"><input  class="btn btn-info" type="button" value="Voltar"></a>
    </form>
</div>
