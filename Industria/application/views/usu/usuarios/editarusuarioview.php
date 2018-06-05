<div class=" justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
<?php foreach($usuarios as $row): ?>
<h1>Editar Usuário - <?= $row->nome ?></h1>
<?php endforeach; ?>
<form action="<?= base_url('usuarios/atualizar')?>" method="post" enctype="multipart/form-data">
    <input type="hidden" name="cpf" value="<?= $usuarios[0]->cpf?>">
    <div class="row form-group">
        <div class="col-sm-2">
            <label for="nome">Nome: </label>
            <input type="text" class="form-control" name="nome" value="<?= $usuarios[0]->nome?>">
        </div>
    </div>
    <div class="row form-group">
        <div class="col-sm-2">
            <label for="sobrenome">Sobrenome: </label>
            <input type="text" class="form-control" name="sobrenome" value="<?= $usuarios[0]->sobrenome?>">
        </div>
    </div>
    <div class="row form-group">
        <div class="col-sm-2">
            <label for="senha">Senha: </label>
            <input type="password" class="form-control" name="senha" max="8" value="<?= $usuarios[0]->senha?>">
        </div>
    </div>
    <div class="row form-group">
        <div class="col-sm-2">
            <label for="nivel">Nível: </label>
            <select class="form-control" name="nivel">
                <?php foreach ($nivelusuarios as $row):?>
                    <option value="<?= $row->nivel?>" <?= $row->nivel == $usuarios[0]->fk_nivel ? 'selected' : '' ?>><?= $row->tipo?></option>   
                <?php endforeach;?>
            </select>
        </div>
    </div>
    <button type="submit" class="btn btn-success">Salvar</button>
    <a href="javascript:window.history.go(-1);"><input  class="btn btn-info" type="button" value="Voltar"></a>

</form>
</div>