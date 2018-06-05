<div class=" justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
    <h2 class="page-header">Quantidades Produzidas</h2>
    <br>
    <p class="info">Informe a quantidade que foi produzida em cada produto:</p>
    <div class="bs-example" data-example-id="striped-table">
    <form action="<?= base_url('ordem/finalizar_ordem/'.$ordem[0]->codigo.'/')?>" method="post" enctype="multipart/form-data">
            <table class="table table-striped" id="dataTable">
                <thead>
                    <tr>
                        <th>Código do Produto</th>
                        <th>Nome</th>
                        <th>Quantidade Prevista</th>
                        <th>Quantidade Produzida</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($produtos_ordem as $row):?>
                   
                    <?php foreach($ordem as $row2):?>
                    <input type="hidden" name="cod" value="<?= $row2->codigo?>">
                    <?php endforeach ?>   
                        <tr>
                            <td><?= $row->codigo_item; ?></td>
                            <td><?= $row->nome; ?></td>
                            <td><?= $row->quantidade_prevista; ?></td>
                            <td><input type="number" step="any" class="form-control" name="<?= $row->codigo_item; ?>"></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <br>
            <button type="submit" class="btn btn-success">Finalizar Ordem</button>
            <a href="javascript:window.history.go(-1);"><input  class="btn btn-info" type="button" value="Voltar"></a>
    </form>
    </div>
</div>