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
                    <a href="<?= base_url('usu/usuarios/cadastro')?>" class="btn btn-success">Novo Usuário</a>
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
                <?php if($row->fk_nivel == 1){?>
                    <td>Administrador</td>
                <?php }else if($row->fk_nivel == 2){?>
                    <td/>Gerente</td>
                    <?php } else{ ?>
                        <td>Funcionario</td>
                    <?php } ?>
                <td>
                    <div style="float:right">
                        <a href="<?= base_url('usu/usuarios/editar/'.$row->nome)?>" class="btn btn-info">Editar</a>
                        <a href="<?= base_url('usu/usuarios/deletar/'.$row->codigo)?>" class="btn btn-danger" onclick="return confirm('Deseja apagar o usuário?')">Excluir</a>
                    </div>
                </td>  
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    </div>
</div>