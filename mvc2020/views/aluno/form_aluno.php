<?php
if( ! defined('PATH')) exit;
if ($user) {
    if ($user['nivel']!='admin') exit;
}
else exit;
?>

<form method="POST" action="<?php echo HOME_URI;?>/aluno/salvar/">
  <input type="hidden" name="aluno[id]" value="<?= $alunos['id'] ?>"/>
  <div class="form-group">
    <label for="inputNome">Nome Completo</label>
    <input type="text" name="aluno[nome]" value="<?= $alunos['nome']   ?>" class="form-control" id="exampleInputNome" aria-describedby="NomeHelp" placeholder="Nome completo">

  </div>
  <div class="form-group">
    <label for="inputMatricula">Matricula</label>
    <input type="text" name="aluno[matricula]" value="<?= $alunos['matricula']   ?>" class="form-control" id="inputMatricula" aria-describedby="MatriculaHelp" placeholder="Número de matrícula">

  </div>
  <div class="form-group">
    <label for="inputDataNascimento">Data de Nasciemnto</label>
    <input type="date" name="aluno[data_nascimento]" value="<?= $alunos['data_nascimento']   ?>" class="form-control" id="inputDataNascimento" aria-describedby="DataNasciemntoHelp" >

  </div>
  <button type="submit" name="aluno[enviar]" class="btn btn-primary">Enviar</button>
</form>
