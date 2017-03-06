<?php
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
}else{
  // Verifica se existe o resultado GET requisitado pelo visitante
// Caso contrario, redireciona o visitante para a pagina inicial
if (!isset($_GET['id'])) {
  header("Location: index.php");
  exit;
}
}
$_SG['link'] = mysql_connect($_SG['servidor'], $_SG['usuario'], $_SG['senha']) or die("MySQL: Não foi possível conectar-se ao servidor: [".$_SG['servidor']."].");
  mysql_select_db($_SG['banco'], $_SG['link']) or die("MySQL: Não foi possível conectar-se ao banco de dados: [".$_SG['banco']."].");
?>
<!DOCTYPE html>
<html lang="en" ng-app="appcadastro" ng-cloak>
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="img/meumoba2_xUw_icon.ico">
    <title>MeuMOBA v1.0 BETA</title>
    <link rel="stylesheet" href="css/bootstrap.css" >
    <link href="css/carousel.css" rel="stylesheet">
    <style>
    [ng\:cloak], [ng-cloak], .ng-cloak{
    	display: none;
    }
    input.ng.dirty.ng-invalid{
    	border-color: red;
    }

    </style>
</head>
<body>
<div class="wrapper">
	<nav class="navbar navbar-fixed-top ">	    	   
		<nav class="navbar navbar-default ">
		<div class="container-fluid ">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>	
				<span class="icon-bar"></span>
			</button>
			<a class="pull-left" href="http://localhost:8080/meuMOBA/"><img  src="img/meumoba2.PNG" width="100px"></a>
		</div>
		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			<ul class="nav navbar-nav">
				<div class="btn-group ">
					<button type="button" class="btn btn-success btn-lg dropdown-toggle glyphicon glyphicon-menu-hamburger" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					    Anúncios <span class="caret"></span>
					</button>
					  <ul class="dropdown-menu">
					    <li><a href="anuncios.php?categoria=Venda_de_Conta&pagina=1">Contas</a></li>
              <li><a href="anuncios.php?categoria=Roupas&pagina=1">Roupas</a></li>
              <li><a href="anuncios.php?categoria=E-Sport&pagina=1">E-Sport</li>
              <li><a href="anuncios.php?categoria=Elo_Job&pagina=1">Elojob</a></li>
              <li><a href="anuncios.php?categoria=Coaching&pagina=1">Coaching</a></li>
              <li><a href="anuncios.php?categoria=Cosplay&pagina=1">Cosplay</a></li>
              <li><a href="anuncios.php?categoria=Outros&pagina=1">Outros</a></li>
					  </ul>
					
					<button onclick="window.document.location='http://localhost:8080/meuMOBA/Cadastro.php';" type="button" class="btn btn-success btn-lg glyphicon glyphicon-user ">
					Cadastro</button>
					<button onclick="window.document.location='file:///C:/Users/Abraao/Desktop/Boots_Site/Contato.html';" type="button" class="btn btn-success btn-lg glyphicon glyphicon-send "> Contato</button> 

					<button onclick="window.document.location='file:///C:/Users/Abraao/Desktop/Boots_Site/Sobre.html';" type="button" class="btn btn-success btn-lg glyphicon glyphicon-info-sign "> Sobre</button> 
					
				</div><!-- btn-group -->
				<ul class="nav navbar-nav navbar-right" ng-controller="userCtrl">
				<form class="navbar-form navbar-left" action="buscar.php" method="get" name="form_busca"  role="search">
			        <div class="form-group">
			          <input type="text" required="required" name="pesquisa" class="form-control" placeholder="Search">
			        </div>
			        <button type="submit" class="btn btn-success btn-md glyphicon glyphicon-search">Buscar</button>
			    </form>
			    	<div class="pull-right ">
					<?if (!isset($_SESSION['usuarioID']) OR !isset($_SESSION['usuarioNome'])) {
				    // Não há usuário logado, mostra a barra de navegação apropriada
				    ?><div ng-include="'navbar_deslogado.html'"></div><?
				  } else if (isset($_SESSION['usuarioID']) OR isset($_SESSION['usuarioNome'])) {
				    // Há usuário logado, verifica se precisa validar o login novamente
				     ?><div ng-include="'navbar_logado.php'"></div><?
				    }?>
				   </div> 
				</ul>
			</ul>
	</div><!-- /.navbar-collapse -->
	</div><!-- /.container-fluid -->
	</nav><!-- navbar secundaria -->	
</nav><!-- navbar fixa -->	
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Login meuMOBA.com</h4>
        <a href="https://www.facebook.com/nicolasoliveira.rosendo"class="btn pull-right" data-toggle="tooltip" title="Entrar com o Facebook">
						<span class="social_buttons">
							<img src="img/social_icon/login_facebook.PNG">
						</span>
					</a>
					<a href="#"class="btn pull-right">
						<span class="social_buttons" data-toggle="tooltip" title="Entrar com o Google Plus">
							<img class="social_login" src="img/social_icon/g+_login.PNG">
						</span>
					</a>
						
					<a href="#"class="btn pull-right">
						<span class="social_buttons" data-toggle="tooltip" title="Entrar com o Twitter">
							<img src="img/social_icon/twitter_login.PNG">
						</span>
					</a>
      </div>
      <div class="modal-body">
        <form name="loginForm" action="login.php" method="post">
					<div class="form-group">
						<label class="sr-only" for="exampleInputEmail3">Email</label>
						<input type="email" name="email" required="true" class="form-control" id="exampleInputEmail3" placeholder="Email">
					</div>
					<div class="form-group">
						<label class="sr-only" for="exampleInputPassword3">Senha</label>
						<input type="password" name="senha" required="true" class="form-control" id="exampleInputPassword3" placeholder="Password">
					</div>
					<div class="checkbox">
						<label >
							<input value="true" type="checkbox"> Permanecer conectado
						</label>
					</div>
					<button type="submit" ng-disabled="loginForm.$invalid" class="btn btn-success glyphicon glyphicon-log-in">Entrar</button>

					<button type="button" class="btn btn-success" data-dismiss="modal">Cancelar</button>
				</form>
      </div>
      <div class="modal-footer">
      </div>
    </div>
  </div>
</div>

<div class="container">
<div class="jumbotron">
<!--_________________________________AREA DO CONTEUDO_____________________________________ -->
<?php
if ($_GET['id']===$_SESSION['usuarioID']) {
// Salva o id do usuario salvo na sessao na variavel id_usu
$id_usu=$_SESSION['usuarioID'];
// ============================================
$condicoes="(`id` ='$id_usu')";
// Monta a consulta MySQL para saber quantos registros serão encontrados
$sql = "SELECT * FROM `usuarios` WHERE {$condicoes}";
// Executa a consulta
$query = mysql_query($sql);
$resultado = mysql_fetch_assoc($query);
	$nome=$resultado['nome'];
	$sobrenome=$resultado['sobrenome']; 	
	$datanasc=utf8_encode($resultado['data_nascimento']);	 	
	$dia=substr(utf8_encode($resultado['data_nascimento']), 0, 2);
	$mes=substr(utf8_encode($resultado['data_nascimento']), 3, 2);
	$ano=substr(utf8_encode($resultado['data_nascimento']), 6, 4);
	$sexo=utf8_encode($resultado['sexo']);
	$telefone1=utf8_encode($resultado['telefone1']);
	$telefone2=utf8_encode($resultado['telefone2']);
	$email=utf8_encode($resultado['email']);
	$premium=$resultado['usuario_premium'];
	$profile_picture=utf8_encode($resultado['foto_perfil']);
}; 	
?>
<h2 class="text-center text-success" >Minha Conta</h2>
  <!--LINHA CONTENDO O BOTAO DE USUARIO PREMIUM-->
  <div class="row center-block">
  <?
  //CONFERE SE O USUARIO É PREMIUM OU NAO, SE NÃO FOR ADICIONA O BOTAO DE ADQUIRIR CONTA PREMIUM
  if($premium==='1'){
  echo"<h2><label class='label label-success'>Usúario Premium</label></h2><br> ";//adiciona uma label mostrando que o usuario é premium
  }else{
  echo"<button class='btn btn-success btn-lg'>Tornar-se Premium</button><br><br>";
  }
  ?>
  </div>
  <!--FIM DA LINHA DE USUARIO PREMIUM-->
  
  <!--LINHA CONTENDO A IMAGEM DE PERFIL-->
  <div class="row center-block">
  	<!--FOTO DE PERFIL-->
  	<img src='<?echo"$profile_picture";?>' width="120px" height="120px">
  	<!--FIM DA FOTO DE PERFIL-->
  	<!--BOTAO DE EDITAR A FOTO DE PERFIL-->
  	<br><button class="btn btn-success glyphicon glyphicon-camera ajeita_botao_img"type="button"></button>
  	<!--FIM DO BOTAO DE EDITAR A FOTO DE PERFIL-->
  </div>
  <!--FIM DA LINHA DA IMAGEM DE PERFIL-->
  <!--LINHA CONTENDO A IMAGEM DE PERFIL-->
  <div class="row">
  	<!--BOTAO DE EDITAR DADOS DO PERFIL-->
  		<button class="btn btn-success btn-lg glyphicon glyphicon-edit center-block botao_editar">Editar Perfil</button>
  	<!--FIM DO BOTAO DE EDITAR DADOS DO PERFIL-->
  </div>
  <!--LINHA CONTENDO O BOTAO DE EDITAR PERFIL-->	
  <!--LINHA CONTENDO OS CAMPOS NOME E SOBRENOME-->
  <div class="row">
  	<!--LABEL NOME-->
  	<span class="col-md-5">
  		<h3><span class="label label-success">Nome:</span> <?echo"$nome"?> </h3>
  	</span>
  	<!--FIM DA LABEL NOME-->
  	<!--LABEL SOBRENOME-->
  	<span class="col-md-6">
  		<h3><span class="label label-success">SobreNome:</span> <?echo"$sobrenome"?> </h3>
  	</span>
  	<!--FIM DA LABEL SOBRENOME-->
  </div>
  <!--FIM DA LINHA DE NOME E SOBRENOME-->
  <!--LINHA CONTENDO OS CAMPOS DATA DE NASCIMENTO E SEXO-->
  <div class="row">	
  	<!--LABEL DATA DE NASCIMENTO-->
  	<span class="col-md-5">
  		<h3><span class="label label-success">Data de Nascimento:</span> <?echo"$datanasc"?> </h3>
  	</span>
  	<!--FIM DA LABEL DE DATA DE NASCIMENTO-->
  	<!--LABEL DE SEXO-->
  	<span class="col-md-5">
  		<h3><span class="label label-success">Sexo:</span> <?echo"$sexo"?></h3>
  	</span>
  	<!--FIM DA LABEL DE SEXO-->
  </div>
  <!--FIM DA LINHA DE DATA DE NASCIMENTO E SEXO-->
  <!--LINHA CONTENDO OS CAMPOS TELEFONE1 E TELEFONE2-->
  <div class="row">	
  	<!--LABEL TELEFONE1-->
  	<span class="col-md-5">
  		<h3><span class="label label-success">Telefone1:</span> <?echo"$telefone1"?> </h3>
  	</span>
  	<!--FIM DA LABEL DE TELEONE1-->
  	<!--LABEL DE TELEFONE2-->
  	<span class="col-md-5">
  		<h3><span class="label label-success">Telefone2:</span> <?echo"$telefone2"?></h3>
  	</span>
  	<!--FIM DA LABEL DE TELEFONE2-->
  </div>
  <!--FIM DA LINHA DE TELEFONE1 E TELEFONE2-->
  <!--LINHA CONTENDO O CAMPO EMAIL-->
  <div class="row">	
  	<!--LABEL EMAIL-->
  	<span class="col-md-12">
  		<h3><span class="label label-success">Email:</span> <?echo"$email"?> </h3>
  	</span>
  	<!--FIM DA LABEL DE EMAIL-->
  </div>
  <!--FIM DA LINHA DE EMAIL-->
</div><!-- Jumbotron -->	
</div><!-- Container do Jumbotron -->

<div class="push"></div>
</div>
</div><!-- Fim do Wrapper -->
<div class="footer">
<div class="jumbotron_footer muda_cor">
<div class="row">
	<div class="col-md-1"></div> 
	<div class="col-md-6">
	<button onclick="window.document.location='';" type="button"  class="btn btn-success btn-md botoes_rodape">
		<span class="glyphicon glyphicon-info-sign " aria-hidden="true">Sobre Nós</span>
	</button>
	<button onclick="window.document.location='';" type="button"  class="btn btn-success btn-md ">
		<span class="glyphicon glyphicon-send" aria-hidden="true">Contato</span>
	</button>
	<button onclick="window.document.location='';" type="button"  class="btn btn-success btn-md ">
		<span class="glyphicon glyphicon-question-sign" aria-hidden="true">FAQ</span>
	</button>

	<button onclick="window.document.location='file:///C:/Users/Abraao/Desktop/Boots_Site/Termos_de_Uso.html';" type="button"  class="btn btn-success btn-sm">
	<span class="glyphicon glyphicon-file botoes_footer" aria-hidden="true"> 
	Termos de Uso!
	</span>
	</button>

	<button onclick="window.document.location=''" type="button"  class="btn btn-success btn-sm">
	<span class="glyphicon glyphicon-flag" aria-hidden="true"> 
	Política de Privacidade!
	</span>
	</button>

	</div>
	<div class="col-md-1 pull-right">
		<a href="https://www.facebook.com/nicolasoliveira.rosendo"class="btn"><span class="social_buttons">
		<img src="img/social_icon/Facebook_icon.PNG">
		</span>
		</a>
		<a href="#"class="btn"><span class="social_buttons">
		<img src="img/social_icon/Twitter_icon.PNG">
		</span>
		</a>
		<a href="#"class="btn"><span class="social_buttons">
		<img src="img/social_icon/YouTube_icon.PNG">
		</span>
		</a>
	</div>
	<p><img  class="img_rodape" src="img/meumoba2.PNG" width="100px"></p>
	<p>© Copyright 2016 -  - Todos os direitos reservados.</p>
</div>

</div>
</div>



<!-- Javascript e JQuery do bootstrap e do angular -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="js/bootstrap.js"></script>
<script src="js/angular.js"></script>
<script src="js/script_cadastro.js"></script>
<script src="js/Valida.js"></script>
<!--_______________________________________________-->
</body>
</html>
