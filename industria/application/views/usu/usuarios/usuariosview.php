<div class=" justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
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
    <div style="float:right; margin-bottom:30px">
                    <a href="<?= base_url('usu/usuarios/cadastro')?>" class="btn btn-success">Novo Usuário</a>
                </div>
    <div class="table-responsive">
   
   <table class="table table-striped table-sm">
        <thead>
            <tr>
                
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
                        <a href="<?= base_url('usu/usuarios/deletar/'.$row->id)?>" class="btn btn-danger" onclick="return confirm('Deseja apagar o usuário?')">Excluir</a>
                    </div>
                </td>  
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    </div>
</div>