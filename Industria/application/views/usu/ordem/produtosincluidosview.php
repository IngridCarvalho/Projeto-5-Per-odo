<div class=" justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
    <h2 class="page-header">Produtos da Ordem de Produção:</h2>
    <div class="bs-example" data-example-id="striped-table">
            <table class="table table-striped" id="dataTable">
                <thead>
                    <tr>
                        <th>Código do Produto</th>
                        <th>Nome</th>
                        <th>Quantidade Prevista</th>
                        <?php if($ordem[0]->status == '2'){?>
                        <th>Quantidade Produzida</th>
                        <?php } ?>
                        <th>Custo Unit.</th>
                        <th>Custo Total</th>
                        <?php if($ordem[0]->status != '2'){?>
                            <th>
                            <div style="float:right">
                                <a href="<?= base_url('ordem/produtos/'.$ordem[0]->codigo)?>" class="btn btn-success">Incluir Produto</a>
                            </div>
                            </th>
                        <?php } ?>
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
                            <?php if($ordem[0]->status == '2'){?>
                            <td><?= $row->quantidade_produzida; ?></td>
                            <?php } ?> 
                            <td><?= "R$ ".number_format($row->custo_unitario,2,',','.'); ?></td>
                            <td><?= "R$ ".number_format($row->custo_total,2,',','.'); ?></td>
                            <?php if($ordem[0]->status != '2'){?>
                            <td>
                                <div style="float:right">
                                    <a href="#" class="btn btn-info">Editar</a>
                                    <a href="<?= base_url('ordem/excluir_item/'.$row->codigo.'/'.$ordem[0]->codigo)?>" class="btn btn-danger" onclick="return confirm('Deseja remover o item?')">Remover</a>
                                </div>
                            </td> 
                            <?php } ?> 
                        </tr>
                             
                    <?php endforeach; ?>
                </tbody>
            </table>
       </div>
       <br>
       <?php if($ordem[0]->status != '2'){?>
       <a href="<?= base_url('ordem')?>" class="btn btn-success">Salvar Ordem</a>
       <?php } ?> 
       <a href="javascript:window.history.go(-1);"><input  class="btn btn-info" type="button" value="Voltar"></a>
</div>