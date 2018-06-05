<div class=" justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
    <h1 class="page-header">Incluir Componentes para <?= $composicao[0]->nome ?></h1>
    <div class="bs-example" data-example-id="striped-table">
            <table class="table table-striped" id="dataTable">
                <thead>
                    <tr>
                        <th>Código</th>
                        <th>Nome</th>
                        <th>Quantidade</th>
                        <th>Custo</th>
                        <th>Ação</th>
                      
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($produtos as $row):?>
                   
                    <?php foreach($composicao as $row2):?>
                    <input type="hidden" name="cod" value="<?= $row2->codigo?>">
                    <?php endforeach ?>   
                        <tr>
                        <input type="hidden" name="codigo" value="<?= $row->codigo?>">
                  
                            <td><?= $row->codigo; ?></td>
                            <td><?= $row->nome; ?></td>
                            <td><?= $row->quantidade; ?></td>
                            <td><?= "R$ ". number_format($row->preco_custo,2,',','.'); ?></td>
                            <td>
                            <a style="float:right" href="<?= base_url('produtos/incluircomponente/'.$row2->codigo.'/'.$row->codigo)?>" class="btn btn-success">incluir</a>
                            </td>  
                        </tr>
                             
                    <?php endforeach; ?>
                </tbody>
            </table>
           <a href="javascript:window.history.go(-1);"><input  class="btn btn-info" type="button" value="Voltar"></a>

       </div>
</div>