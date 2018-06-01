<div class=" justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
    <h2 class="page-header">Dados do produto:</h2>
    <br>
    <form action="<?= base_url('ordem/incluir/'.$ordem.'/'.$produto)?>" method="post" enctype="multipart/form-data">
        <div class="row form-group">
            <div class="col-sm-4">
                <label for="quantidade">Quantidade a produzir:</label>
                <input type="number" step="any" class="form-control" name="quantidade">
            </div>
        </div>
        <button type="submit" class="btn btn-success">Salvar</button>
        <a href="javascript:window.history.go(-1);"><input  class="btn btn-info" type="button" value="Voltar"></a>
    </form>
</div>
