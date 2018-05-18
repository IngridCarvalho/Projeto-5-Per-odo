<div class=" justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="page-header">Relatório de Itens Produzidos</h1>
    <?php if(isset($alert)) {?>
        <div class="alert alert-<?php
            $a = explode('-', isset($alert) ? $alert : '');
            echo $a[0];
        ?>">
        <button type="button" class="close" data-dismiss="alert-">×</button>
        <?php
            $a = explode('-', isset($alert) ? $alert : '');
            echo $a[1];
        ?>
        </div>
    <?php }?>
    <form action="#" method="post" enctype="multipart/form-data">
        <div class="row form-group">
            <div class="col-sm-2">
                <label for="Data Inicial">Data inicial: </label>
                <input type="date" class="form-control" name="inicial">
             </div>
            <div class="col-sm-2">
                <label for="Data Final">Data final: </label>
                <input type="date" class="form-control" name="inicial">
            </div>
            <div style="margin-top:27px">
        <button type="submit" class="btn btn-success">Enviar</button>
        </div>
        </div>
        
    </form>

   
    <table class="table table-striped table-sm">
        <thead>
            <tr>
                
                <th>Código</th>
                <th>Nome</th>
                <th>Quantidade</th>
                <th>Custo</th>
                <th>Custo Total</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
    </div>
</div>