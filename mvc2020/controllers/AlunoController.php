<?php

class AlunoController extends MainController{
    public function __construct(){
        parent::__construct();
        $this->login_required=true;
    }
    public function index(){
        if($this->login_required)
            /* verificar se temum uusario logado */

        /**Criar objeto do modelo */
        $modelo=$this->load_model("aluno");
        $alunos=$modelo->select();

        /** Carrega os arquivos do view **/
        $this->base("/views/aluno/index.php", $alunos);
		// require PATH . '/views/includes/header.php';
    //
    //     require PATH . '/views/includes/menu.php';
    //
	  //   require PATH . '/views/aluno/index.php';
    //
		// require PATH . '/views/includes/footer.php';
    }

    public function add(){
        $aluno['id']='';
        $aluno['nome']='';
        $aluno['matricula']='';
        $aluno['data_nascimento']='';

        /** Carrega os arquivos do view **/
        $this->base("/views/aluno/form_aluno.php", $aluno);
		// require PATH . '/views/includes/header.php';
    //
    //     require PATH . '/views/includes/menu.php';
    //
	  //   require PATH . '/views/aluno/form_aluno.php';
    //
		// require PATH . '/views/includes/footer.php';
    }

    public function salvar(){
        if(isset($_POST['aluno']['enviar'])){
            /**Remove o campo do POST */
            unset($_POST['aluno']['enviar']);
            /**Criar objeto do modelo */
            $modelo=$this->load_model("aluno");

            if(!empty($_POST['aluno']['id'])){
                $acao="update";
            }else{
                $acao="insert";
                unset($_POST['aluno']['id']);
            }
            $this->bancoMensagem($modelo, $acao, $_POST['aluno'], "salvar");
            // if($alunos=$modelo->{$acao}($_POST['aluno'])){
            //     /**Mensagem de sucesso */
            //     $msg['msg']="Aluno salvo com sucesso!";
            //     $msg['class']="success";
            //     setMensagem("Aluno salvo com sucesso!", "success");
            // }else{
            //     /**Mensagem de erro */
            //     $msg['msg']="Falha ao salvar o aluno!";
            //     $msg['class']="danger";
            //     setMensagem("Falha ao salvar o aluno!", "danger");
            // }
            // $_SESSION['msg'][]=$msg;


        }

        header("location:".HOME_URI."aluno/");
    }

    public function editar($id){
        $modelo=$this->load_model("aluno");
        $resultado=$modelo->select($id);

        $aluno=$resultado[0];
        $this->base("/views/aluno/form_aluno.php", $aluno);
        // require PATH . '/views/includes/header.php';
        //
        // require PATH . '/views/includes/menu.php';
        //
	      // require PATH . '/views/aluno/form_aluno.php';
        //
        // require PATH . '/views/includes/footer.php';

    }

    public function excluir($id){
        $modelo=$this->load_model("aluno");
        $this->bancoMensagem($modelo, "delete", $id, "excluir");
        // if($modelo->delete($id)){
        //     /**Mensagem de sucesso */
        //     $msg['msg']="Aluno excluído com sucesso!";
        //     $msg['class']="success";
        // }else{
        //     /**Mensagem de erro */
        //     $msg['msg']="Falha ao excluir o aluno!";
        //     $msg['class']="danger";
        // }
        // $_SESSION['msg'][]=$msg;
        header("location:".HOME_URI."aluno/");
    }

}
