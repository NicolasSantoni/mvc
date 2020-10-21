<?php
/**
 * MainController - Todos os controllers deverão estender essa classe
 * @package mvc.classes
 * @since 0.1
 */
class MainController
{



	/**
	 * $title
	 *
	 * Título das páginas
	 *
	 * @access public
	 */
	public $title;

	/**
	 * $user
	 * Usuario atual
	 * @access public
	 */
	public $user = null;


	/**
	 * $login_required
	 * Se a página precisa de login
	 * @access public
	 */
	public $login_required = false;

	/**
	 * $permission_required
	 *
	 * Permissão necessária
	 *
	 * @access public
	 */
	public $permission_required = 'any';

	/**
	 * $parametros
	 *
	 * @access public
	 */
	public $parametros = array();

	/**
	 * Construtor da classe
	 *
	 * Configura as propriedades e métodos da classe.
	 *
	 * @since 0.1
	 * @access public
	 */
	public function __construct ( $parametros = array() ) {
		// Parâmetros
		$this->parametros = $parametros;
		// Verifica o login
		$this->checkUserLogin();
	} // __construct

	/**
	 * Load model
	 *
	 * Carrega os modelos presentes na pasta /models/.
	 *
	 * @since 0.1
	 * @access public
	 */
	public function load_model( $model_name = false ) {

		// Um arquivo deverá ser enviado
		if ( ! $model_name ) return;

		// Garante que o nome do modelo tenha letras minúsculas
		$model_name =  strtolower( $model_name );

		//Adiciona o sufixo 'Model'
		$model_name.="Model";

		//transforma a primeira letra da string para maiúsculo
		$model_name=ucfirst($model_name);


		// Inclui o arquivo
		$model_path = PATH . '/models/' . $model_name . '.php';

		// Verifica se o arquivo existe
		if ( file_exists( $model_path ) ) {

			// Inclui o arquivo
			require_once $model_path;

			// Remove os caminhos do arquivo (se tiver algum)
			$model_name = explode('/', $model_name);

			// Pega só o nome final do caminho
			$model_name = end( $model_name );

			// Remove caracteres inválidos do nome do arquivo
			$model_name = preg_replace( '/[^a-zA-Z0-9]/is', '', $model_name );

			//Verifica a existência da classe definda para o model
			if(class_exists($model_name)){
				return new $model_name();
			}


			return;

		} //if

	} // load_model


	/**
	 * get User
	 * Carrega as informações do usuário logado
	 * @since 0.1
	 * @access public
	 * @author Cândido Farias
	 */
	public function getUser(){
		return $this->user;
	}// getUser

	/**
	 * check user login
	 * Verifica as permissões do usuário logado
	 * @since 0.1
	 * @access public
	 * @author Cândido Farias
	 */
	public function checkUserLogin(){
		if(isset($_SESSION['user'])){
			$this->user=$_SESSION['user'];
			/*if(isset($_SESSION['user']['permission'])){
				$this->permission_required=$_SESSION['user']['permission'];
			}*/
		}else{
			$this->user=null;
		}
	}

	/**
	 * get user  Define o usuário corrente
	 * @since 0.1
	 * @param array Array com informações do usúario
	 * @author Cândido Farias
	 */
	public function setUser($user){
		if($user){
			$_SESSION['user']=$user;
			$this->user;
		}
	}
	/**
	 * unset user  Encerra a sessão do usuário corrente
	 * @since 0.1
	 * @author Cândido Farias
	 */
	function unsetUser(){
		if($this->user){
			unset($_SESSION['user']);
		}
	}

	/**
	* banco Mensagem Faz a conexão com o banco de dados e mostra a mensagem de sucesso ou Falha
	* @since 0.1
	* @author Nicolas Santoni
	* @author Saimon Hunger
	*/
	public function bancoMensagem($modelo, $acao, $pot, $op)
	{
		if ($op == "salvar") {
			if($alunos=$modelo->{$acao}($pot)){
					$this->setMansagem("Aluno salvo com sucesso!", "success");
			}else{
					$this->setMansagem("Falha ao salvar o aluno!", "danger");
			}
		}
		else if ($op == "excluir") {
			if($modelo->$acao($pot)){
					$this->setMansagem("Aluno excluído com sucesso!", "success");
			}else{
					$this->setMansagem("Falha ao exluir o aluno!", "danger");
			}
		}
	}

	/**
	* set Mensagem Mostra a mensagem de sucesso ou falha
	* @since 0.1
	* @author Nicolas Santoni
	* @author Saimon Hunger
	*/
	public function setMansagem($mensagem, $atributo)
	{
		$msg['msg']=$mensagem;
		$msg['class']=$atributo;
		$_SESSION['msg'][]=$msg;
	}

	/**
	* base Apresenta as requires que sempre são usadas mais o rquire da página atual
	* @since 0.1
	* @author Nicolas Santoni
	* @author Saimon Hunger
	*/
	public function base($includePrincipal, $alunos)
	{
		require PATH . '/views/includes/header.php';
		require PATH . '/views/includes/menu.php';
		require PATH . $includePrincipal;
		require PATH . '/views/includes/footer.php';
	}
} // class MainController
