<div class=" justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
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
    <div style="float:right; margin-bottom:30px">
                    <a href="<?= base_url('usu/ordem/incluir')?>" class="btn btn-success">Incluir Ordem</a>
                </div>
    <div class="table-responsive">
   
    <table class="table table-striped table-sm">
        <thead>
            <tr>
                
                <th>Código</th>
                <th>Descrição</th>
                <th>Data de Emissão</th>
                <th>Data de Finalização</th>
                <th>Situação</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($ordens as $row):?>
            <tr>
                <td><?= $row->numero; ?></td>
                <td><?= $row->descricao; ?></td>
                <td><?= implode('/',array_reverse(explode('-',$row->data_emissao))); ?></td>
                <td><?= implode('/',array_reverse(explode('-',$row->data_finalizacao)));?></td>
                <?php if($row->status == 1){ ?>
                    <td>Pendente</td>
                <?php } else{ ?>
                    <td>Finalizado</td>
                <?php } ?>
                <td>
                    <div style="float:right">
                        <?php if($row->status == 1){ ?>
                            <a href="<?= base_url('usu/ordem/componentes')?>" class="btn btn-primary">Incluir Componentes</a>
                        <?php } ?>
                        <a href="<?= base_url('usu/ordem/editar/'.$row->numero)?>" class="btn btn-info">Editar</a>
                        <a href="<?= base_url('usu/ordem/deletar/'.$row->id)?>" class="btn btn-danger" onclick="return confirm('Deseja apagar a ordem de produção?')">Excluir</a>
                    </div>
                </td>  
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    </div>
</div>