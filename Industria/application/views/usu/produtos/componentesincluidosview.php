<div class=" justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
    <h1 class="page-header">Componentes: <?= $composicao[0]->nome ?></h1>
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
    <div class="bs-example" data-example-id="striped-table">
            <table class="table table-striped" id="dataTable">
                <thead>
                    <tr>
                        <th>Código da Composição</th>
                        <th>Nome do Componente</th>
                        <th>Quantidade</th>
                        <th>
                            <div style="float:right">
                               <a href="<?= base_url('produtos/componentes/'.$composicao[0]->codigo)?>" class="btn btn-success">Novo Componente</a>
                            </div>
                        </th>
                      
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($produtos as $row):?>
                   
                    <?php foreach($produto as $row2):?>
                    <input type="hidden" name="cod" value="<?= $row2->codigo?>">
                    <?php endforeach ?>   
                        <tr>
                        <!-- <input type="hidden" name="codigo" value="<?= $row->codigo?>"> -->
                  
                            <td><?= $row->codigo_produto; ?></td>
                            <td><?= $row->nome; ?></td>
                            <td><?= $row->quantidade_componente; ?></td>
                            <td>
                            <a style="float:right" href="<?= base_url('produtos/excluir_componente/'.$row->codigo_produto.'/'.$composicao[0]->codigo)?>" class="btn btn-danger" onclick="return confirm('Deseja apagar o componente?')">excluir</a>
                            </td>  
                        </tr>
                             
                    <?php endforeach; ?>
                </tbody>
            </table>
           <a href="javascript:window.history.go(-1);"><input  class="btn btn-info" type="button" value="Voltar"></a>

       </div>
</div>