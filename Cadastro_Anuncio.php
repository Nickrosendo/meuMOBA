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
<!--_________________________________AREA DO CONTEUDO_____________________________________ -->
<?
//Confere se o id passado pelo get é o mesmo do id que esta na sessao
if ($_GET['id']===$_SESSION['usuarioID']) {
// Salva o id do usuario salvo na sessao na variavel id_usu
$id_usu=$_SESSION['usuarioID'];
};
?>
<div class="container">
<div class="jumbotron">
<h2 class="text-center text-success">Cadastro de Anuncios</h2>
<!--TABELA DE CADASTRO DE ANUNCIOS-->
<!--<form action="Cadastro_Anuncio.php" method="POST" enctype="multipart/form-data" name="cadastro_usuario"></form>-->
<table class='table table-bordered'>
      <tr>
      <!--LINHA CONTENDO O BOTAO DE ADICIONAR ANUNCIO PREMIUM-->
      <button class="btn btn-success btn-lg">Adquirir Premium</button>
      <!--FIM DA LINHA CONTENDO O BOTAO DE ANUNCIO PREMIUM-->
      <h2><label class='label label-success col-md-12'>Titulo: </label>
      <input name="Titulo" ng-model="userInfo.Titulo" ng-required="true" maxlength="30" class="form-control" 
      placeholder="Titulo do seu Anuncio(max 30 digitos)" aria-describedby="sizing-addon1">
      </h2>
      </tr>
      <tr>
        <td>
        	<form action='Pre_Visualiza_foto.php' method="POST" enctype="multipart/form-data" name="pre_visualiza">
        	<h3>
        		<label class='label label-success'>Escolher Imagem: </label>
        	</h3>	
        	<input required class="text-success"type="file" name="foto" id="foto"></input>
        	<br>
        	</form>
        	
        	<?
        	//verifica se o cookie está gravado
        	if (isset($_COOKIE['caminho_foto'])) {
        	$caminho=$_COOKIE['caminho_foto'];
        	  }
        			else{	
        				$caminho="img/img.jpg"; 
        			}
        	
        	?>
        	<div id="theCarousel" class="carousel slide" data-ride="carousel">
								<ol class="carousel-indicators">
									<li data-target="#theCarousel" data-slide-to="0" class="active"></li>
									<li data-target="#theCarousel" data-slide-to="1" ></li>
								</ol>
							<div class="carousel-inner" role="listbox">
								<div class="item active">
									<img class="first-slide" src="img/background_ad.JPG" alt="Primeiro Slide">
									<div class="container">
										<div class="carousel-caption">
											<img src="<?echo "$caminho";?>" alt="" width="200px" height="150px">

										</div>
									</div>	
								</div>
							
								<div class="item">
									<img src="img/blue_bg.PNG" class="forth-slide" alt="Quarto Slide">
									<div class="container">
										<div class="carousel-caption">
										
											<h1> Nos Acompanhe nas redes Sociais</h1>
											
											<p> <a href="https://www.facebook.com/nicolasoliveira.rosendo"class="btn"><span class="btn">
		   							<img class="social_ad" src="img/facebook_like.PNG">
		   						</span>
		   						</a>
		   						<a href="#"class="btn">
		   							<img class="social_ad" src="img/twitter+button.PNG">
		   						
		   						</a>
								<a href="#"class="btn">
		   							<img class="social_ad" src="img/YouTube_icon.PNG">
		   						
		   						</a> </p>
		   						
										</div>
									</div>	
								</div>
							</div>	
							<a class="left carousel-control" href="#theCarousel" role="button" data-slide="prev">
								<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
								<span class="sr-only">Previous</span>
							</a>
			 
							<a class="right carousel-control" href="#theCarousel" role="button" data-slide="next">
								<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
								<span class="sr-only">Next</span>
							</a>
				
						</div><!-- Fim do codigo do carousel -->


        	<img src="<?echo "$caminho";?>" alt="" width="470px" height="300px">

        	<br>
        	
        </td>
        <td>

        <h2><label class='label label-success col-md-12'>Categoria:</label>
        	<select name="categoria" required>
        		<option selected></option>
	    		<?
				// ============================================
				// Monta a consulta MySQL para saber quantos registros serão encontrados
				$sql = "SELECT * FROM `categorias`";
				// Executa a consulta
				$query = mysql_query($sql);
        		while ($resultado = mysql_fetch_assoc($query)) {
        			$categorias=$resultado['nome_categoria'];
        			echo "<option value='$categorias'>$categorias</option>";
        		};
				// ============================================
				?> 
        	</select>
        </h2>
        <br>
        <br>
        <h2><label class='label label-success col-md-12'>Preco:</label>
        	<input type="number" name="Preco" ng-model="userInfo.Preco" ng-required="true"class="form-control" placeholder="Preco do produto anunciado" aria-describedby="sizing-addon1">
        </h2>
        <br>
        <br>
        <h2><label class='label label-success col-md-12'>Detalhes do Produto:</label></h2>
        <textarea name="detalhe_produto" style="resize: none;" rows="5" placeholder="Breve descrição do seu produto." class="col-md-12"></textarea>
        </td>
        
  </table>
  <table class='table table-bordered'>
  <tr>
  		<h2><label class='label label-success col-md-12'>Contato:(Mínimo 1)</label></h2>
        
        <h3><label class='label label-success col-md-6'>Skype:</label></h3>
        <input name="Skype" ng-model="userInfo.Skype" ng-required="true"class="form-control" placeholder="Meio de Contato com o comprador" aria-describedby="sizing-addon1">

        <h3><label class='label label-success col-md-6'>Facebook:</label></h3>
        <input name="Facebook" ng-model="userInfo.Facebook" ng-required="true"class="form-control" placeholder="Meio de Contato com o comprador" aria-describedby="sizing-addon1">

        <h3><label class='label label-success col-md-6'>WhaatsApp:</label></h3>
        <input name="WhaatsApp" ng-model="userInfo.WhaatsApp" ng-required="true"class="form-control" placeholder="Meio de Contato com o comprador" aria-describedby="sizing-addon1">
        
        <h2><label class='label label-success col-md-12'>Descrição do Anuncio</label></h2>
        <div class='well well-md'>
        <textarea name="descricao" style="resize: none;" rows="5" cols="155" placeholder="Descrição completa do produto."	></textarea>
        </div>
  </tr>
  <input name="cadastrar" type="submit" value="Cadastrar" class="btn btn-success btn-lg"/>
  </table>
<!--FIM DA TABELA DE CADASTRO DE ANUNCIOS-->
<!--</form>-->
</div><!--Jumbotron -->	
</div><!--Container do Jumbotron -->
<!--_________________________________FIM DA AREA DE CONTEUDO______________________________ -->

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
