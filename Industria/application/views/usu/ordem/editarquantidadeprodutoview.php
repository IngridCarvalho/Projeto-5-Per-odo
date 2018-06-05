<div class=" justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
    <p class="info">Editar quantidade a ser produzida:</p>
    <form action="<?= base_url('ordem/atualizar_item/'.$item[0]->codigo_item).'/'.$ordem?>" method="post" enctype="multipart/form-data">
        <div class="row form-group">
            <div class="col-sm-4">
                <label for="quantidade">Quantidade:</label>
                <input type="number" step="any" class="form-control" name="quantidade" value="<?= $item[0]->quantidade_prevista?>">
            </div>
        </div>
        <button type="submit" class="btn btn-success">Salvar</button>
        <a href="javascript:window.history.go(-1);"><input  class="btn btn-info" type="button" value="Voltar"></a>
    </form>
</div>
