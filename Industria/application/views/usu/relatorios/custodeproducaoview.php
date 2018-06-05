<div class=" justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
 <?php if(isset($alert)) {?>
        <div class="alert alert-<?php
            $a = explode('-', isset($alert) ? $alert : '');
            echo $a[0];
        ?>">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <?php
            $a = explode('-', isset($alert) ? $alert : '');
            echo $a[1];
        ?>
        </div>
    <?php }?>
    <form action="#" method="post" enctype="multipart/form-data">
        <div class="row form-group">
            <div class="col-sm-3">
                <label for="Data Inicial">Data inicial: </label>
                <input type="date" class="form-control" name="data_inicial">
             </div>
            <div class="col-sm-3">
                <label for="Data Final">Data final: </label>
                <input type="date" class="form-control" name="data_final">
            </div>
            <div style="margin-top:28px">
        <button type="submit" class="btn btn-success">Gerar</button>
        </div>
        </div>
        
    </form>
    <table class="table table-striped table-sm">
        <thead>
            <tr>
                <th>Código</th>
                <th>Nome</th>
                <th>Quantidade</th>
                <th>Custo Atual</th>
                <th>Custo Médio</th>
                <th>Custo Total</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach($relatorio_custo as $row):?>
            <tr>
                <td><?= $row->codigo; ?></td>
                <td><?= $row->nome; ?></td>
                <td><?= number_format($row->quantidade,2,',','.'); ?></td>
                <td><?= "R$ ".number_format($row->custo_atual,2,',','.'); ?></td>
                <td><?= "R$ ".number_format($row->custo_medio,2,',','.'); ?></td>
                <td><?= "R$ ".number_format($row->custo_total,2,',','.'); ?></td>
            </tr>
        <?php endforeach ?>
        </tbody>
    </table>
</div>  