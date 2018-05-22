<div class=" justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
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
    <div style="float:right; margin-bottom:10px">
                    <a href="<?= base_url('usu/produtos/cadastro')?>" class="btn btn-success">Novo Produto</a>
                </div>

    <div class="table-responsive">
   
   <table class="table table-striped table-sm">
        <thead>
            <tr>
                                <th>Código</th>
                <th>Nome</th>
                <th>Quantidade</th>
                <th>Tipo</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($produtos as $row):?>
            <tr>
                <td><?= $row->codigo; ?></td>
                <td><?= $row->nome; ?></td>
                <td><?= $row->quantidade; ?></td>
                <?php if($row->tipo_produto == 1){ ?>
                    <td>Composição</td>
                <?php } else{ ?>
                    <td>Componente</td>
                <?php } ?>
                <td>
                    <div style="float:right">
                        <?php if($row->tipo_produto == 1){ ?>
                            <a href="<?= base_url('usu/produtos/componentes/'.$row->codigo)?>" class="btn btn-primary">Incluir Componente</a>
                        <?php } ?>
                        <a href="<?= base_url('usu/produtos/editar/'.$row->nome)?>" class="btn btn-info">Editar</a>
                        <a href="<?= base_url('usu/produtos/deletar/'.$row->codigo)?>" class="btn btn-danger" onclick="return confirm('Deseja apagar o produto?')">Excluir</a>
                    </div>
                </td>  
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    </div>
</div>