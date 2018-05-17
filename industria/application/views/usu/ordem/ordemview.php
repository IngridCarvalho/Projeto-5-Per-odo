<div class="container">
    <h1 class="page-header">Ordem de Produção</h1>
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
    <div class="bs-example" data-example-id="striped-table">
    <table class="table table-striped">
        <thead>
            <tr>
                <div style="float:right">
                    <a href="#" class="btn btn-success">Incluir Ordem</a>
                </div>
                <th>Código</th>
                <th>Descrição</th>
                <th>Data</th>
                <th>Situação</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($ordens as $row):?>
            <tr>
                <td><?= $row->numero; ?></td>
                <td><?= $row->descricao; ?></td>
                <td><?= $row->data; ?></td>
                <?php if($row->status == 1){ ?>
                    <td>Pendente</td>
                <?php } else{ ?>
                    <td>Finalizado</td>
                <?php } ?>
                <td>
                    <div style="float:right">
                        <a href="#" class="btn btn-info">Editar</a>
                        <a href="#" class="btn btn-danger" onclick="return confirm('Deseja apagar o usuário?')">Excluir</a>
                    </div>
                </td>  
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    </div>
</div>