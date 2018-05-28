<div class=" justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="page-header">Escolha de Componentes</h1>
    <div class="bs-example" data-example-id="striped-table">
        <form action="#" method="post" enctype="multipart/form-data">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Código</th>
                        <th>Nome</th>
                        <th>Quantidade</th>
                        <th>Custo</th>
                        <th>Quantidade usada</th>
                        <th>Marcar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($componentes as $row):?>
                        <tr>
                            <td><?= $row->codigo; ?></td>
                            <td><?= $row->nome; ?></td>
                            <td><?= $row->quantidade; ?></td>
                            <td><?= $row->preco_custo?></td>
                            <td class="col-sm-2">
                                <input type="number"  class="form-control" name="qdt_usada" >
                            </td>
                            <td>
                                <input type="checkbox" name="componente">
                            </td>  
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <button type="submit" class="btn btn-success">Salvar</button>
        </form>
    </div>
</div>