<div class=" justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
    <h1 class="page-header">Escolha de Componentes</h1>
    <div class="bs-example" data-example-id="striped-table">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Código</th>
                        <th>Nome</th>
                        <th>Quantidade</th>
                        <th>Custo</th>
                        <th>Quantidade usada</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($produtos as $row):?>
                    <form action="<?= base_url('usu/produtos/incluir')?>" method="post" enctype="multipart/form-data">
                    <?php foreach($produto as $row2):?>
                    <input type="hidden" name="cod" value="<?= $row2->codigo?>">
                    <?php endforeach ?>   
                        <tr>
                        <input type="hidden" name="codigo" value="<?= $row->codigo?>">
                  
                            <td><?= $row->codigo; ?></td>
                            <td><?= $row->nome; ?></td>
                            <td><?= $row->quantidade; ?></td>
                            <td><?= $row->preco_custo; ?></td>
                            <td class="col-sm-2">
                                <input type="number" class="form-control" name="qtd_usada" >
                            </td>
                            <td>
                            <button type="submit" class="btn btn-success">incluir</button>
                            </td>  
                        </tr>
                             
                      </form>
                    <?php endforeach; ?>
                </tbody>
            </table>
       </div>
</div>