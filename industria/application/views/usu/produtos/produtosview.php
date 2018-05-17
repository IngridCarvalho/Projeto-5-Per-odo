<div class="container">
    <h1 class="page-header">Produtos</h1>
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
                    <a href="<?= base_url('usu/produtos/cadastro')?>" class="btn btn-success">Novo Produto</a>
                </div>
                <th>Código</th>
                <th>Nome</th>
                <th>Quantidade</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($produtos as $row):?>
            <tr>
                <td><?= $row->codigo; ?></td>
                <td><?= $row->nome; ?></td>
                <td><?= $row->quantidade; ?></td>
                <td>
                    <div style="float:right">
                        <a href="<?= base_url('usu/produtos/editar/'.$row->nome)?>" class="btn btn-info">Editar</a>
                        <a href="<?= base_url('usu/produtos/deletar/'.$row->id)?>" class="btn btn-danger" onclick="return confirm('Deseja apagar o usuário?')">Excluir</a>
                    </div>
                </td>  
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    </div>
</div>