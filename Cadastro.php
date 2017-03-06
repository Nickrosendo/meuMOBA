<?php
  session_start();
  session_name("minha_sessao");
  $_SG['servidor'] = 'localhost';    // Servidor MySQL
$_SG['usuario'] = 'admin';          // Usuário MySQL
$_SG['senha'] = 'admin';                // Senha MySQL
$_SG['banco'] = 'meumoba';            // Banco de dados MySQL
$_SG['tabela'] = 'anuncios';       // Nome da tabela onde os usuários são salvos
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
<!-- CONTEUDO PRINCIPAL DO SITE_____________________________________ -->
<div ng-controller="userCtrl">
<form name="userForm" action="Cadastra.php" method="post">
<div class="page-header">
<h1 class="h1_Cadastro">Cadastro de Usuários<br/></h1>
<h3><span class="label label-danger">* Campos obrigatorios</span></h3>

<a href="https://www.facebook.com/nicolasoliveira.rosendo"class="btn pull-right"data-toggle="tooltip" title="Cadastre-se com o facebook"><span >
<img class="social_cadastro" src="img/social_icon/facebook_signin.PNG">
</span>
</a>
<a data-toggle="tooltip" title="Cadastre-se com o Google Plus" href="https://www.facebook.com/nicolasoliveira.rosendo"class="btn pull-right"><span class="social_buttons">
<img class="social_cadastro" src="img/social_icon/g+_signin.PNG">
</span>
</a>
<a data-toggle="tooltip" title="Cadastre-se com o Twitter" href="https://www.facebook.com/nicolasoliveira.rosendo"class="btn pull-right	"><span class="social_buttons">
<img class="social_cadastro" src="img/social_icon/twitter_signin.PNG">
</span>
</a>

<br/>
<br/>				
</div>
<div class="well well-lg">
<div class="row">
<div class="col-md-4">
<div class="input-group input-group-lg">
<span class="input-group-addon" id="sizing-addon1">*Nome: </span>
<input name="Nome" ng-model="userInfo.Nome" ng-required="true" maxlength="25" class="form-control" placeholder="ex:seu Nome" aria-describedby="sizing-addon1">
</div>
</div>	

<div class="col-sm-6 col-md-7">
<div class="input-group input-group-lg">
<span class="input-group-addon" id="sizing-addon1">*SobreNome: </span>
<input name="SobreNome" ng-model="userInfo.SobreNome" ng-required="true"  maxlength="37" type="text" class="form-control" placeholder="ex:seu SobreNome" aria-describedby="sizing-addon1">
</div>
</div>	
</div>
<div class="row">
<div class="col-xs-12 col-sm-12 col-md-6">
<span class="error-message label label-danger" ng-show="userForm.Nome.$dirty
&& userForm.Nome.$error.required">Campo Nome em branco
</span>
</div>


<div class="col-sm-6 col-md-6">
<span class="error-message label label-danger" ng-show="userForm.SobreNome.$dirty
&& userForm.SobreNome.$error.required">Campo SobreNome em branco
</span>

</div>
<br/>
<br/>
<div class="row">
<div class="col-sm-12 col-md-12 col-lg-3">
<div class="input-group input-group-lg">
<span class="input-group-addon" id="sizing-addon1">*Data de Nascimento</span>
<a></a>
</div>
</div>	

<div class="col-sm-12 col-md-12 col-lg-3">
<div class="input-group input-group-lg">

<span class="input-group-addon" id="sizing-addon1">Dia:</span>
<input ng-blur="Valida_Data(userInfo)"type="number"name="Dia" placeholder="ex:30" ng-model="userInfo.Dia" ng-required="true"min="1" class="form-control">	
</div>
</div>
<div class="col-sm-12 col-md-12 col-lg-3">
<div class="input-group input-group-lg">
<span class="input-group-addon" id="sizing-addon1"> Mês:   </span>
<input ng-blur="Valida_Data(userInfo)" id="txtmes"type="number" min="1" max="12" name="Mes" ng-model="userInfo.Mes" ng-required="true" maxlength="2" class="form-control" placeholder="ex:12" aria-describedby="sizing-addon1">
</div>
</div>
<div class="col-sm-12 col-md-12 col-lg-3">
<div class="input-group input-group-lg">
<span class="input-group-addon" id="sizing-addon1"> Ano:   </span>
<input ng-blur="Valida_Data(userInfo)" id="txtano" type="number" min="1850" max="valida_futuro(ano)" name="Ano" ng-model="userInfo.Ano" ng-required="true" class="form-control" placeholder="ex:1997" aria-describedby="sizing-addon1">
</div>
</div>			
</div>
<div class="row">
<div class="col-xs-12 col-sm-12 col-md-3"></div>
<div class="col-xs-12 col-sm-12 col-md-3">
<span class="error-message label label-danger" ng-show="userForm.Dia.$dirty && userForm.Dia.$invalid">Campo Dia inválido</span>
</div>

<div class="col-sm-6 col-md-3">
<span class="error-message label label-danger" ng-show="userForm.Mes.$dirty && userForm.Mes.$invalid">Campo Mes inválido</span>
</div>

<div class="col-sm-6 col-md-3">
<span class="error-message label label-danger" ng-show="userForm.Ano.$dirty && userForm.Ano.$invalid">Campo Ano inválido</span>
</div>
</div>	
<br/>
<br/>
<div class="row">
<div class="col-sm-12 col-md-12 col-lg-3">
<div class="btn-group btn-group-lg" role="group" aria-label="Sexo">
<div class="input-group input-group-lg">
<span class="input-group-addon" id="sizing-addon1">*Sexo: </span>

<div class="dropup">	

<select class="btn btn-default btn-lg dropdown-toggle" name="Sexo" ng-model="userInfo.Sexo" ng-required="true" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
</span>
<option value="Feminino">Feminino</option>
<option value="Masculino">Masculino</option>
</select>
</div>
</div>	
</div><!-- btn group -->
</div><!-- col -->
</div><!-- row -->	
<br/>
<br/>
<div class="row">
<div class="col-xs-12 col-sm-12 col-md-5">
<div class="input-group input-group-lg">
<span class="input-group-addon" id="sizing-addon1">*Telefone 1: </span>
<input id="txttelefone" ng-model="userInfo.Telefone1" 
onkeyup="formataCel(this, event);" ng-required="true" name="Telefone1" type="phone"  maxlength="15" class="form-control" placeholder="ex: (11) 1234-5678" aria-describedby="sizing-addon1">
</div>
</div>

<div class="col-xs-12 col-sm-12 col-md-6">
<div class="input-group input-group-lg">
<span class="input-group-addon" id="sizing-addon1">(Opcional)Telefone 2: </span>
<input id="txttelefone2" onkeyup="formataCel(this, event);" name="Telefone2" type="phone" maxlength="15" class="form-control" placeholder="ex: (11) 1234-5678" aria-describedby="sizing-addon1">
</div>
</div>
</div>
<div class="row">
<div class="col-xs-12 col-sm-12 col-md-3">
<span class="error-message label label-danger"  ng-show="userForm.Telefone1.$dirty && userForm.Telefone1.$error.required">Campo Telefone em branco</span>
</div>
</div>
<br/>
<br/>
<div class="row">
<div class="col-sm-6 col-md-9">
<div class="input-group input-group-lg">
<span class="input-group-addon" id="sizing-addon1">*Email: </span>
<input id="txtemail" type="email" name="Email" ng-model="userInfo.Email" ng-required="true" maxlength="90" class="form-control" placeholder="ex:user@grades.com" aria-describedby="sizing-addon1">
</div>
</div>
<div class="col-xs-12 col-sm-12 col-md-3">
<span class="error-message label label-danger" ng-show="userForm.Email.$dirty && userForm.Email.$error.required">Campo Email em branco
</span>
<span class="error-message label label-danger" ng-show="userForm.Email.$dirty && userForm.Email.$invalid">Campo Email inválido
</span>
</div>

</div>
<br/>
<br/>
<br/>
<div class="row">	
<div class="col-sm-6 col-md-9">
<div class="input-group input-group-lg">
<span class="input-group-addon" id="sizing-addon1">*Confirmação de Email:  </span>
<input ng-blur="checkEmail(userInfo)" id="txtconfirmaemail" name="ConfirmaEmail" ng-model="userInfo.ConfirmaEmail" ng-required="true" maxlength="90" type="text" class="form-control" placeholder="ex:user@grades.com" aria-describedby="sizing-addon1">

</div>	
</div>

</div>
<div class="row">
<div class="col-xs-12 col-sm-12 col-md-3">
<span class="error-message label label-danger" ng-show="userForm.ConfirmaEmail.$dirty && userForm.ConfirmaEmail.$error.required">Campo de Confirmação de Email em branco
</span>
<span class="error-message label label-danger" ng-show="userForm.ConfirmaEmail.$dirty && userForm.ConfirmaEmail.$invalid">Emails não coincidem
</span>
</div>

</div>
<br/>
<br/>
<div class="row">

<div class="col-xs-12 col-sm-12 col-md-5">
<div class="input-group input-group-lg">
<span class="input-group-addon" id="sizing-addon1">*Senha: </span>
<input id="txtsenha" minlength="8"  type="password" name="Senha" ng-model="userInfo.Senha" ng-required="true" class="form-control" placeholder="Max15digitos" aria-describedby="sizing-addon1">
</div>
</div>

<div class="col-xs-12 col-sm-12 col-md-5">
<div class="input-group input-group-lg">
<span class="input-group-addon" id="sizing-addon1">*Confirma Senha: </span>
<input ng-blur="checkSenha(userInfo)"  id="txtconfirmasenha" name="ConfirmaSenha" ng-model="userInfo.ConfirmaSenha" ng-required="true" type="password" class="form-control" placeholder="ex:userpassword" aria-describedby="sizing-addon1">
</div>
</div>

</div>
<div class="row">
<div class="col-xs-12 col-sm-12 col-md-5">
<span class="error-message label label-danger" ng-show="userForm.Senha.$dirty && userForm.Senha.$invalid">Senha muito curta(no mínimo 8 dígitos )
</span>
</div>
<div class="col-xs-12 col-sm-12 col-md-5">
<span class="error-message label label-danger" ng-show="userForm.ConfirmaSenha.$dirty && userForm.ConfirmaSenha.$invalid">As senhas não coincidem.
</span>
</div>
</div>
<br/>
<br/>
<div class="row">
<div class="container">
<input id="cbtermos" name="Termos" ng-model="userInfo.Termos" ng-true-value="'agreed'" ng-false-value="'disagreed'" ng-required="true" type="checkbox" aria-label="Termos"> Aceito os Termos de Uso e a Política de Privacidade.

<input id="cbfeed" type="checkbox" name="Feed" ng-model="userInfo.Feed" value="1" aria-label="Feed"> Aceito receber notícias do site no e-mail fornecido nesse cadastro.
</div>
</div>
<br/>
<br/>




<button id="btncadastro" type="submit" value="cadastra" ng-disabled="userForm.$invalid" class="btn btn-success btn-lg center-block">
<h4><span class="glyphicon glyphicon-thumbs-up" aria-hidden="true"> 	 Cadastrar
</span>
</h4>
</button>

</form>
</div><!-- ng-controller -->
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
