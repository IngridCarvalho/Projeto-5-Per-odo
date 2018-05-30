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
    
    <div class="table-responsive">
   
    <table class="table table-striped table-sm" id="dataTable">
        <thead>
            <tr>
                
                <th>Código</th>
                <th>Descrição</th>
                <th>Data de Início</th>
                <th>Data de Finalização</th>
                <th>Situação</th>
                <th>
                    <div style="float:right">
                        <a href="<?= base_url('ordem/novaordem')?>" class="btn btn-success">Nova Ordem</a>
                    </div>
                </th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($ordens as $row):?>
            <tr>
                <td><?= $row->codigo; ?></td>
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
<!--                            <a href="<?= base_url('ordem/componentes/'.$row->codigo)?>" class="btn btn-primary">Novo Componente</a>
                            <a href="<?= base_url('ordem/componentesincluidos/'.$row->codigo)?>" class="btn btn-secondary">Ver Componentes</a>-->
                            <a href="<?= base_url('ordem/finalizar/'.$row->codigo)?>" class="btn btn-success" onclick="return confirm('Deseja finalizar a ordem de produção?')">Finalizar</a>
                        <?php } ?>
                        <a href="<?= base_url('ordem/editar/'.$row->codigo)?>" class="btn btn-info">Editar</a>
                        <a href="<?= base_url('ordem/deletar/'.$row->codigo)?>" class="btn btn-danger" onclick="return confirm('Deseja apagar a ordem de produção?')">Excluir</a>
                    </div>
                </td>  
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    </div>
</div>