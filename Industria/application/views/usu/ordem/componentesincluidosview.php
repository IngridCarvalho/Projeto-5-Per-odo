<div class=" justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
    <h1 class="page-header">Informe os produtos da Ordem de Produção:</h1>
    <div class="bs-example" data-example-id="striped-table">
            <table class="table table-striped" id="dataTable">
                <thead>
                    <tr>
                        <th>Código da Ordem</th>
                        <th>Nome</th>
                        <th>Quantidade</th>
                        <th>Custo</th>
                        <th>
                        <div style="float:right">
                            <a href="<?= base_url('ordem/componentes/'.$ordem[0]->codigo)?>" class="btn btn-primary">Incluir Produto</a>
                        </div>
                        </th>
                      
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($ordens as $row):?>
                   
                    <?php foreach($ordem as $row2):?>
                    <input type="hidden" name="cod" value="<?= $row2->codigo?>">
                    <?php endforeach ?>   
                        <tr>
                        <input type="hidden" name="codigo" value="<?= $row->codigo?>">
                  
                            <td><?= $row->codigo; ?></td>
                            <td><?= $row->nome; ?></td>
                            <td><?= $row->quantidade; ?></td>
                            <td><?= $row->preco_custo; ?></td>
                            <td>
                            <a style="float:right" href="<?= base_url('produtos/excluir_componente/'.$row->codigo)?>" class="btn btn-danger" onclick="return confirm('Deseja apagar o componente?')">excluir</a>
                            </td>  
                        </tr>
                             
                    <?php endforeach; ?>
                </tbody>
            </table>
       </div>
</div>