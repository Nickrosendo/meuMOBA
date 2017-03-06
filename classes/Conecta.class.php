<?php
//Validação de segurança
//Valida a url para acesso nao autorizado
/*||*/$url= $_SERVER['PHP_SELF'];
/*||*/if (eregi("Conecta.class.php", $url)) {
/*||*/header("Location: ../index.php");
/*||*/}


Class Conecta{
	public $servidor="localhost"; 	//||Servidor Mysql
	public $usuario="admin"; 		//||Usuario Mysql
	public $senha="admin";			//||Senha Mysql
	public $banco="meumoba";		//||Banco de Dados Mysql
	public $query;					//||Query de conexao com o Mysql
	public $link;					//||Link que realiza a conexao	
	public $resultado;				//||Resultado da conexao com o Mysql

	function MySQL(){
		//apenas instancia o objeto
	}
	
	public function conecta_mysql(){
		$this->link= mysqli_connect($this->servidor,
									$this->usuario,
									$this->senha);	
		if (!$this->link) {
			echo "Falha ao conectar com o MySQL!<br/>
				  Erro: ". mysql_error();
			die();	  
		}
		elseif (!mysqli_select_db($this->link, $this->banco)) {
			echo "O Banco de Dados {$this->banco} não pode ser utilizado!<br/>
				 Erro: ". mysql_error();
			die();	 
		}
	}
	
}

?>

