<div class=" justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
    <h1 class="page-header">Componentes Incluídos</h1>
    <div class="bs-example" data-example-id="striped-table">
            <table class="table table-striped" id="dataTable">
                <thead>
                    <tr>
                        <th>Código da Composição</th>
                        <th>Nome do Componente</th>
                        <th>Quantidade</th>
                        <th>Ação</th>
                      
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
                            <a style="float:right" href="<?= base_url('produtos/excluir_componente/'.$row->codigo_produto)?>" class="btn btn-danger" onclick="return confirm('Deseja apagar o componente?')">excluir</a>
                            </td>  
                        </tr>
                             
                    <?php endforeach; ?>
                </tbody>
            </table>
       </div>
</div>