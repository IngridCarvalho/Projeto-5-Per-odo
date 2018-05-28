<div class=" justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
<h1>Novo Usuário</h1>
<form action="<?= base_url('usuarios/salvar')?>" method="post" enctype="multipart/form-data">
    <div class="row form-group">
        <div class="col-sm-2">
            <label for="cpf">CPF: </label>
            <input type="number" class="form-control" name="cpf">
        </div>
    </div>
    <div class="row form-group">
        <div class="col-sm-2">
            <label for="nome">Nome: </label>
            <input type="text" class="form-control" name="nome">
        </div>
    </div>
    <div class="row form-group">
        <div class="col-sm-2">
            <label for="sobrenome">Sobrenome: </label>
            <input type="text" class="form-control" name="sobrenome">
        </div>
    </div>
    <div class="row form-group">
        <div class="col-sm-2">
            <label for="senha">Senha: </label>
            <input type="password" class="form-control" name="senha" max="8">
        </div>
    </div>
    <div class="row form-group">
        <div class="col-sm-2">
            <label for="nivel">Nível: </label>
            <select class="form-control" name="nivel">
                <?php foreach ($nivelusuarios as $row):?>
                    <option value="<?= $row->nivel?>"><?= $row->tipo?></option>   
                <?php endforeach;?>
            </select>
        </div>
    </div>
    <button type="submit" class="btn btn-success">Salvar</button>
    <button type="reset" class="btn btn-info" onclick="return confirm('Deseja limpar o formulário de cadastro?')">Limpar</button>
</form>
</div>