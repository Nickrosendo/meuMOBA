<?
  session_start();
  session_name("minha_sessao");
$_SG['servidor'] = 'localhost';    // Servidor MySQL
$_SG['usuario'] = 'admin';          // Usuário MySQL
$_SG['senha'] = 'admin';                // Senha MySQL
$_SG['banco'] = 'meumoba';            // Banco de dados MySQL
$_SG['tabela'] = 'anuncios';       // Nome da tabela onde os usuários são salvos

// Verifica se o usuario esta logado
// Caso contrario, redireciona o visitante para a pagina inicial
if (!isset($_SESSION['usuarioID']) OR !isset($_SESSION['usuarioNome'])) {
  header("Location: index.php");
  exit;
}
$_SG['link'] = mysql_connect($_SG['servidor'], $_SG['usuario'], $_SG['senha']) or die("MySQL: Não foi possível conectar-se ao servidor: [".$_SG['servidor']."].");
  mysql_select_db($_SG['banco'], $_SG['link']) or die("MySQL: Não foi possível conectar-se ao banco de dados: [".$_SG['banco']."].");
//salva em uma variavel o id do usuario logado
$id_usu=$_SESSION['usuarioID'];  
//cria uma variavel contendo o caminho da pasta temporaria das imagens
$pasta_temporaria="img/tmp_imagens/";
//cria um array contendo os formatos da imagem permitidos
$permitidos= array(".jpg",".jpeg",".png");

//confere se o POST nao esta vazio
if (isset($_POST)) {
	$nome_imagem = $_FILES['foto'] ['name'];

	$tamanho_imagem = $_FILES['foto'] ['size'];
	//verifica o formato da imagem passada via POST
	$formato= strtolower(strrchr($nome_imagem,"."));

		//verifica se o formato da imagem esta nos permitidos
		if(in_array($formato,$permitidos)){
          //converte o tamanho da foto para KB
            $tamanho = round($tamanho_imagem / 1024);
            $tamanho_max= 1024*5;//tamanho maximo de 5MB
            //confere se o tamanho é maior que o permitido de 5MB
            if ($tamanho<$tamanho_max) {
            	$nome_atual = md5(uniqid(time())).$formato; //Novo nome da Imagem
            	$tmp = $_FILES['foto']['tmp_name']; //Caminho temporário da imagem
            	//move a foto atual para a pasta temporaria
                if(move_uploaded_file($tmp,$pasta_temporaria.$nome_atual)){
                	$caminho=$pasta_temporaria.$nome_atual;
                	setcookie("caminho_foto",$caminho);
                	header("Location: Cadastro_Anuncio.php?id=$id_usu");
                }else{//else do envio da foto para a pasta temporaria
                	echo "Falha ao exibir foto";
                }	  //else do envio da foto para a pasta temporaria	
            }else{//else da verificacao de tamanho de arquivo
            	echo "Tamanho da foto é maior que o permitido de 5MB";
            }	  //else da verificacao de tamanho de arquivo
        }else{//else da verificacao de formato de arquivo
        	echo "Apenas Fotos JPG,JPEG e PNG são permitidas";
        }//else da verificacao de formato de arquivo     
}else{//else da verificacao de POST vazio
	echo "Nenhuma imagem foi selecionada";
}//else da verificacao de POST vazio

	//verifica a gravação do cookie
        if (isset($_COOKIE['caminho_foto'])) {
                //cria a imagem com o caminho passado pelo cookie
                $caminho=$_COOKIE['caminho_foto'];
                //cria um cookie para a primeira foto   
                setcookie('foto1',$caminho);
        }        
    //-------------------------------------------------------------    
?>