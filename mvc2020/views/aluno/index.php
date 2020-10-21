<div class="wrap">

    <a href="<?php echo HOME_URI;?>/aluno/add/" class="btn btn-primary">ADD</a>
    <hr/>
    <table class="table table-striped">
    <thead>
        <tr>
        <th scope="col">#</th>
        <th scope="col">Nome</th>
        <th scope="col">Matrícula</th>
        <th scope="col">Data de Nascimento</th>
        </tr>
    </thead>
    <tbody>
    <?php
        if($alunos){
            function botoes($aluno, $usuario) {
                if ($usuario) {
                    if ($usuario['nivel']) {
                        return "
                            <td>
                                <a href='".HOME_URI."aluno/editar/".$aluno['id']."'><i class=' fas fa-edit' style='font-size:20px'></i></a>
                            </td><td>
                                <a href='".HOME_URI."/aluno/excluir/".$aluno['id']."'><i class=' fas fa-trash' style='font-size:20px; color: red'></i></a>
                            </td>
                           ";
                    }
                }
            }
            foreach($alunos AS $aluno){


                echo "<tr>
                <th scope='row'>".$aluno['id']."</th>
                <td>".$aluno['nome']."</td>
                <td>".$aluno['matricula']."</td>
                <td>".$aluno['data_nascimento']."</td>
                ".botoes($aluno, $user)."
                </tr>";
            }
        }

    ?>
    </tbody>
    </table>
</div>
