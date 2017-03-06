				<?
error_reporting (E_ALL & ~ E_NOTICE & ~ E_DEPRECATED);
				 session_start();
  session_name("minha_sessao");
  $_SG['servidor'] = 'localhost';    // Servidor MySQL
$_SG['usuario'] = 'admin';          // Usuário MySQL
$_SG['senha'] = 'admin';                // Senha MySQL
$_SG['banco'] = 'meumoba';            // Banco de dados MySQL
$_SG['tabela'] = 'anuncios';       // Nome da tabela onde os usuários são salvos

$_SG['link'] = mysql_connect($_SG['servidor'], $_SG['usuario'], $_SG['senha']) or die("MySQL: Não foi possível conectar-se ao servidor: [".$_SG['servidor']."].");
  mysql_select_db($_SG['banco'], $_SG['link']) or die("MySQL: Não foi possível conectar-se ao banco de dados: [".$_SG['banco']."].");

  $id_usu=$_SESSION['usuarioID'];
// ============================================
$condicoes="(`id` ='$id_usu')";
// Monta a consulta MySQL para saber quantos registros serão encontrados
$sql = "SELECT * FROM `usuarios` WHERE {$condicoes}";
// Executa a consulta
$query = mysql_query($sql);
$resultado = mysql_fetch_assoc($query);
	$foto_perfil=$resultado['foto_perfil'];
				?>
				<div class="pull-right">
				<img class="img-circle" src="<?echo "$foto_perfil";?>" width="50px" height="50px">
				<button type="button" class="btn btn-success btn-lg dropdown-toggle glyphicon glyphicon-comment" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					    Perfil <span class="caret"></span>
					</button>
					  <ul class="dropdown-menu">
					    <li><a class="glyphicon glyphicon-usd" href="MeusAnuncios.php?id=<?echo($_SESSION['usuarioID'])?>"> Meus anúncios</a></li>
					    <li><a class="glyphicon glyphicon-plus-sign" href="Cadastro_Anuncio.php?id=<?echo($_SESSION['usuarioID'])?>"> Cadastrar Anúncio</a></li>
					    <li><a class="glyphicon glyphicon-comment" href="#"> Mensagens</a></li>
					    <li><a class="glyphicon glyphicon-cog" href="MinhaConta.php?id=<?echo($_SESSION['usuarioID'])?>"> Minha Conta</a></li>
					    <li><a class="glyphicon glyphicon-shopping-cart" href="#"> Minhas Ofertas</a></li>
					    <li><a class="glyphicon glyphicon-warning-sign" href="#"> Segurança</a></li>
					    <li><a class="glyphicon glyphicon-log-out" href="logout.php"> Sair</a></li>
					  </ul>
					  </div>
		