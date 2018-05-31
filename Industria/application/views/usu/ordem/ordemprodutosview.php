<div class=" justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
    <h1 class="page-header">Escolha de Produtos</h1>
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
                
                        <tr>
                        <input type="hidden" name="codigo" value="<?= $row->codigo?>">
                  
                            <td><?= $row->codigo; ?></td>
                            <td><?= $row->nome; ?></td>
                            <td><?= $row->quantidade; ?></td>
                            <td><?= $row->preco_custo; ?></td>
                            <td>
                            <a style="float:right" href="<?= base_url('ordem/incluirprodutos/'.$codigo_ordem.'/'.$row ->codigo)?>" class="btn btn-success">incluir</a>
                            </td>  
                        </tr>
                             
                    <?php endforeach; ?>
                </tbody>
            </table>
       </div>
</div>