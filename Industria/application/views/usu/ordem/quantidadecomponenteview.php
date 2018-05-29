<div class=" justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
   
    <form action="<?= base_url('ordem/incluir/'.$ordem.'/'.$componente)?>" method="post" enctype="multipart/form-data">
        <div class="row form-group">
            <div class="col-sm-2">
                <label for="quantidade">Quantidade produzida: </label>
                <input type="number" step="any" class="form-control" name="quantidade">
            </div>
        </div>
        <div class="row form-group">
            <div class="col-sm-2">
                <label for="quantidade">Custo unitário: </label>
                <input type="number" step="any" class="form-control" name="custo">
            </div>
        </div>
        <button type="submit" class="btn btn-success">Salvar</button>
    </form>
</div>
