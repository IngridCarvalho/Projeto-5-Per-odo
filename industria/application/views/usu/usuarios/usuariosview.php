<div class="container">
    <h1 class="page-header">Usuários</h1>
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
                    <a href="#" class="btn btn-success">Novo Usuário</a>
                </div>
                <th>CPF</th>
                <th>Nome</th>
                <th>Nível de Usuário</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($usuarios as $row):?>
            <tr>
                <td><?= $row->cpf; ?></td>
                <td><?= $row->nome; ?></td>
                <td><?= $row->nivel; ?></td>
                <td>
                    <div style="float:right">
                        <a href="#" class="btn btn-info">Editar</a>
                        <a href="#" class="btn btn-danger">Excluir</a>
                    </div>
                </td>  
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    </div>
</div>