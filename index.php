<?php
require("./classes/Conecta.class.php");
$conexao= new Conecta();
$conexao->conecta_mysql();
  session_start();
  session_name("minha_sessao");
 ?>		
<!DOCTYPE html>
<html lang="en" ng-app="app3" ng-cloak>
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="img/meumoba2_xUw_icon.ico">
    <title>MeuMOBA v1.0 BETA</title>
    <link rel="stylesheet" href="css/bootstrap.css" >
    <link href="css/carousel.css" rel="stylesheet">
	
	<!-- Included when we wait to call AngularJS at the end of the document -->
    <style>
    [ng\:cloak], [ng-cloak], .ng-cloak {
      display: none;
    }
    </style>
</head>
<body>
<div class="background">
    
</div>



<div class="wrapper">
<br><br><br><br>

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
			<a class="pull-left" href="http://localhost:8080/meuMOBA/index.php"><img  src="img/meumoba2.PNG" width="100px"></a>
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
				<ul class="nav navbar-nav navbar-right" ng-controller="gListCtrl">
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
<br>

<form action="buscar.php" method="get">
<div class="row">
<div class="col-md-2"></div>
<div class="col-md-7">
          <input type="text" required="required" name="pesquisa" class="form-control" placeholder="Buscar">

</div>
<div class="col-md-1">
<button type="submit" class="btn btn-success glyphicon glyphicon-search">Buscar</button>
</div>
</div>
<BR>
</form>
	<table class=" tabela_menu">
 		<tr  id="header" class="default" >
			<td >
			
			<div class="btn-group-vertical borda_frame_menu" role="group" aria-label="...">
  			<a class="btn btn-success btn-lg" href="anuncios.php?categoria=Venda_de_Conta&pagina=1">Contas</a>
  			<a class="btn btn-success btn-lg" href="anuncios.php?categoria=Roupas&pagina=1">Roupas</a>
  			<a class="btn btn-success btn-lg" href="anuncios.php?categoria=E-Sport&pagina=1">E-Sport</a>
  			<a class="btn btn-success btn-lg" href="anuncios.php?categoria=Elo_Job&pagina=1">EloJob</a>
  			<a class="btn btn-success btn-lg" href="anuncios.php?categoria=Coaching&pagina=1">Coaching</a>
  			<a class="btn btn-success btn-lg" href="anuncios.php?categoria=Cosplay&pagina=1">Cosplay</a>
  			<a class="btn btn-success btn-lg" href="anuncios.php?categoria=Outros&pagina=1">Outros</a>
			</div>
			</td>
		    <td>
		    <?
// Monta a consulta MySQL
$condicoes = "(`ativa` = 1) AND (`premium`= '1')";
$sql = "SELECT * FROM `anuncios` WHERE {$condicoes} ORDER BY RAND()";
// Executa a consulta
$query = $conexao->query($sql);
$linhas= $query->num_rows;

// Começa a exibição dos resultados
?>
<div id="destaque" class="carousel slide" data-ride="carousel">
					<div class="carousel-inner" role="listbox">
						<div class="item active">
						<?if ($resultado=mysqli_fetch_assoc($query)) {
						$titulo = utf8_encode($resultado['titulo']);
						$imagem = utf8_encode($resultado['imagem']);
						$descricao= utf8_encode($resultado['descricao']);
						$preco=$resultado['preco'];
						$id_anunciante=utf8_encode($resultado['cod_anunciante']);
						$link = 'detalhes.php?id=' . utf8_encode($resultado['id']);
						$query_anunciante="SELECT * FROM `usuarios` WHERE `id`='$id_anunciante'";
						$select_anunciante=mysqli_query($query_anunciante);
						$resultado_anunciante=mysqli_fetch_assoc($select_anunciante);
						$nome=utf8_encode($resultado_anunciante['nome']);
						$sobrenome=utf8_encode($resultado_anunciante['sobrenome']);
						$anunciante=$nome." ".$sobrenome;
						$reputacao=utf8_encode($resultado_anunciante['reputacao']);
						echo "
						
						<div class='thumbnail'> 
						<h2><label class='label label-success col-md-12'>{$titulo}</label></h2><br>
				        <div class='caption'>
				        
				        <div class='col-md-5'></div>
						<label class='label col-md-2 label-success'>R$:{$preco}</label>
						<img class='center-block' src='{$imagem}'>
				        <div class='col-sm-4'></div>
        				<a href='{$link}' class='btn btn-primary  col-md-2 btn-sm' role='button'>
        				Mais Detalhes
        				</a>
        				<a href='{$link}' class='btn btn-primary  col-md-2 btn-sm' role='button'>
        				Reputacao:<span class='badge'>$reputacao</span>
        				</a>
             			</div>
						</div>";
						}?>
						</div>
						<?while($n<=$linhas){
						while($resultado = mysql_fetch_assoc($query)){
						$titulo = utf8_encode($resultado['titulo']);
						$imagem = utf8_encode($resultado['imagem']);
						$descricao= utf8_encode($resultado['descricao']);
						$preco=$resultado['preco'];
						$link = 'detalhes.php?id=' . utf8_encode($resultado['id']);
						?>
						<div class="item">
						<?
						echo "
						
						<div class='thumbnail'> 
						<h2><label class='label label-success col-md-12'>{$titulo}</label></h2><br>
				        <div class='caption'>
						<div class='col-md-5'></div>
						<label class='label col-md-2 label-success'>R$:{$preco}</label>
						<img class='center-block' src='{$imagem}'>
				        <div class='col-sm-4'></div>
        				<a href='{$link}' class='btn btn-primary  col-md-2 btn-sm' role='button'>
        				Mais Detalhes
        				</a>
        				<a href='{$link}' class='btn btn-primary  col-md-2 btn-sm' role='button'>
        				Reputacao:<span class='badge'>$reputacao</span>
        				</a>
             			
						</div>
						</div>";
						?>
						</div>
						<?};$n++;} ?>
					</div><!-- fim do carousel inner -->
					<a class="left carousel-control" href="#destaque" role="button" data-slide="prev">
					<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
					<span class="sr-only">Previous</span>
					</a>

					<a class="right carousel-control" href="#destaque" role="button" data-slide="next">
					<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
					<span class="sr-only">Next</span>
					</a>
					</div><!-- fim do carousel de destaques -->
		    			    
		    </td>
		</tr>
	</table>
	<br><br><br><br><br><br><br>
	
	
	<div class="well well-lg">
	<div class="page-header">
  		<h1 style="text-align: center;">Contas em destaque</h1>
	</div>
	<!-- testando o carousel de anuncios premiums em destaque !-->
<?
// Monta a consulta MySQL
$condicoes = "(`ativa` = 1) AND (`premium`= '1') AND (`categoria`= 'Venda_de_Conta')";
$sql = "SELECT * FROM `anuncios` WHERE {$condicoes} ORDER BY RAND() LIMIT 6";
// Executa a consulta
$query = mysql_query($sql);

// Começa a exibição dos resultados
						?><div class="row"><?
						while($resultado = mysql_fetch_assoc($query)){
						$titulo = utf8_encode($resultado['titulo']);
						$imagem = utf8_encode($resultado['imagem']);
						$descricao= utf8_encode($resultado['descricao']);
						$preco=$resultado['preco'];
						$id_anunciante=utf8_encode($resultado['cod_anunciante']);
						$link = 'detalhes.php?id=' . utf8_encode($resultado['id']);
						$query_anunciante="SELECT * FROM `usuarios` WHERE `id`='$id_anunciante'";
						$select_anunciante=mysql_query($query_anunciante);
						$resultado_anunciante=mysql_fetch_assoc($select_anunciante);
						$nome=utf8_encode($resultado_anunciante['nome']);
						$sobrenome=utf8_encode($resultado_anunciante['sobrenome']);
						$anunciante=$nome." ".$sobrenome;
						$reputacao=utf8_encode($resultado_anunciante['reputacao']);
						?>
						
  		<div class="col-sm-6 col-md-4">
	    <div class=" borda_frame_menu">
	    <div class=" thumbnail">
	      <h3><label class="label label-success col-md-12"><?echo"$titulo"?></label></h3>
	      <img src="<?echo"$imagem"?>" alt="erro ao carregar a foto">
	      <div class="caption">
	        
	        <i><?echo"<label class='label label-primary'>Anunciante: </label>
				        <a href='{$link}' class='btn btn-link btn-sm' role='button'>
        				$anunciante
        				</a>
        				<br> 
        				<a href='{$link}' class='btn btn-primary  col-md-5 btn-sm' role='button'>
        				Reputacao:<span class='badge'>$reputacao</span>
        				</a>
        				<br><br>
             			
             			<label class='label col-md-5 label-success'>Preço:</label>R$ $preco <br>
             			</i>
	        <p><a href='{$link}' class='btn btn-primary center-block' role='button'>Mais informação</a></p>"?>
	      </div>
	    </div>
	    </div>
	  	</div>
	  	<?}?>
						</div>
						
<a class="btn btn-success center-block" href="anuncios.php?categoria=Venda_de_Conta&pagina=1">Ver Mais...</a>
	</div><!-- well Contas Em Destaque -->


<div class="well well-lg">
	<div class="page-header">
  		<h1 style="text-align: center;">EloJobs em destaque</h1>
	</div>
	<!-- testando o carousel de anuncios premiums em destaque !-->
	<?
// Monta a consulta MySQL
$condicoes = "(`ativa` = 1) AND (`premium`= '1') AND (`categoria`= 'Elo_Job')";
$sql = "SELECT * FROM `anuncios` WHERE {$condicoes} ORDER BY RAND() LIMIT 6";
// Executa a consulta
$query = mysql_query($sql);

// Começa a exibição dos resultados
						?><div class="row"><?
						while($resultado = mysql_fetch_assoc($query)){
						$titulo = utf8_encode($resultado['titulo']);
						$imagem = utf8_encode($resultado['imagem']);
						$descricao= utf8_encode($resultado['descricao']);
						$preco=$resultado['preco'];
						$id_anunciante=utf8_encode($resultado['cod_anunciante']);
						$link = 'detalhes.php?id=' . utf8_encode($resultado['id']);
						$query_anunciante="SELECT * FROM `usuarios` WHERE `id`='$id_anunciante'";
						$select_anunciante=mysql_query($query_anunciante);
						$resultado_anunciante=mysql_fetch_assoc($select_anunciante);
						$nome=utf8_encode($resultado_anunciante['nome']);
						$sobrenome=utf8_encode($resultado_anunciante['sobrenome']);
						$anunciante=$nome." ".$sobrenome;
						$reputacao=utf8_encode($resultado_anunciante['reputacao']);
						?>
						
  		<div class="col-sm-6 col-md-4">
	    <div class=" borda_frame_menu">
	    <div class=" thumbnail">
	      <h3><label class="label label-success col-md-12"><?echo"$titulo"?></label></h3>
	      <img src="<?echo"$imagem"?>" alt="erro ao carregar a foto">
	      <div class="caption">
	        
	        <i><?echo"<label class='label label-primary'>Anunciante: </label>
				        <a href='{$link}' class='btn btn-link btn-sm' role='button'>
        				$anunciante
        				</a>
        				<br> 
        				<a href='{$link}' class='btn btn-primary  col-md-5 btn-sm' role='button'>
        				Reputacao:<span class='badge'>$reputacao</span>
        				</a>
        				<br><br>
             			
             			<label class='label col-md-5 label-success'>Preço:</label>R$ $preco <br>
             			</i>
	        <p><a href='{$link}' class='btn btn-primary center-block' role='button'>Mais informação</a></p>"?>
	      </div>
	    </div>
	    </div>
	  	</div>
	  	<?}?>
						</div>
<a class="btn btn-success center-block" href="anuncios.php?categoria=Elo_Job&pagina=1">Ver Mais...</a>		
	</div><!-- well EloJobs Em Destaque -->


	<div class="well well-lg">
	<div class="page-header">
  		<h1 style="text-align: center;">Coach's em destaque</h1>
	</div>
	<!-- testando o carousel de anuncios premiums em destaque !-->
	<?
// Monta a consulta MySQL
$condicoes = "(`ativa` = 1) AND (`premium`= '1') AND (`categoria`= 'Coaching')";
$sql = "SELECT * FROM `anuncios` WHERE {$condicoes} ORDER BY RAND() LIMIT 6";
// Executa a consulta
$query = mysql_query($sql);

// Começa a exibição dos resultados
						?><div class="row"><?
						while($resultado = mysql_fetch_assoc($query)){
						$titulo = utf8_encode($resultado['titulo']);
						$imagem = utf8_encode($resultado['imagem']);
						$descricao= utf8_encode($resultado['descricao']);
						$preco=$resultado['preco'];
						$id_anunciante=utf8_encode($resultado['cod_anunciante']);
						$link = 'detalhes.php?id=' . utf8_encode($resultado['id']);
						$query_anunciante="SELECT * FROM `usuarios` WHERE `id`='$id_anunciante'";
						$select_anunciante=mysql_query($query_anunciante);
						$resultado_anunciante=mysql_fetch_assoc($select_anunciante);
						$nome=utf8_encode($resultado_anunciante['nome']);
						$sobrenome=utf8_encode($resultado_anunciante['sobrenome']);
						$anunciante=$nome." ".$sobrenome;
						$reputacao=utf8_encode($resultado_anunciante['reputacao']);
						?>
						
  		<div class="col-sm-6 col-md-4">
	    <div class=" borda_frame_menu">
	    <div class=" thumbnail">
	      <h3><label class="label label-success col-md-12"><?echo"$titulo"?></label></h3>
	      <img src="<?echo"$imagem"?>" alt="erro ao carregar a foto">
	      <div class="caption">
	        
	        <i><?echo"<label class='label label-primary'>Anunciante: </label>
				        <a href='{$link}' class='btn btn-link btn-sm' role='button'>
        				$anunciante
        				</a>
        				<br> 
        				<a href='{$link}' class='btn btn-primary  col-md-5 btn-sm' role='button'>
        				Reputacao:<span class='badge'>$reputacao</span>
        				</a>
        				<br><br>
             			
             			<label class='label col-md-5 label-success'>Preço:</label>R$ $preco <br>
             			</i>
	        <p><a href='{$link}' class='btn btn-primary center-block' role='button'>Mais informação</a></p>"?>
	      </div>
	    </div>
	    </div>
	  	</div>
	  	<?}?>
						</div>
	<a class="btn btn-success center-block" href="anuncios.php?categoria=Coaching&pagina=1">Ver Mais...</a>
	</div><!-- well Coach Em Destaque -->

<div class="well well-lg">
	<div class="page-header">
  		<h1 style="text-align: center;">Roupas em destaque</h1>
	</div>
	<!-- testando o carousel de anuncios premiums em destaque !-->
	<?
// Monta a consulta MySQL
$condicoes = "(`ativa` = 1) AND (`premium`= '1') AND (`categoria`= 'Roupas')";
$sql = "SELECT * FROM `anuncios` WHERE {$condicoes} ORDER BY RAND() LIMIT 6";
// Executa a consulta
$query = mysql_query($sql);

// Começa a exibição dos resultados
						?><div class="row"><?
						while($resultado = mysql_fetch_assoc($query)){
						$titulo = utf8_encode($resultado['titulo']);
						$imagem = utf8_encode($resultado['imagem']);
						$descricao= utf8_encode($resultado['descricao']);
						$preco=$resultado['preco'];
						$id_anunciante=utf8_encode($resultado['cod_anunciante']);
						$link = 'detalhes.php?id=' . utf8_encode($resultado['id']);
						$query_anunciante="SELECT * FROM `usuarios` WHERE `id`='$id_anunciante'";
						$select_anunciante=mysql_query($query_anunciante);
						$resultado_anunciante=mysql_fetch_assoc($select_anunciante);
						$nome=utf8_encode($resultado_anunciante['nome']);
						$sobrenome=utf8_encode($resultado_anunciante['sobrenome']);
						$anunciante=$nome." ".$sobrenome;
						$reputacao=utf8_encode($resultado_anunciante['reputacao']);
						?>
						
  		<div class="col-sm-6 col-md-4">
	    <div class=" borda_frame_menu">
	    <div class=" thumbnail">
	      <h3><label class="label label-success col-md-12"><?echo"$titulo"?></label></h3>
	      <img src="<?echo"$imagem"?>" alt="erro ao carregar a foto">
	      <div class="caption">
	        
	        <i><?echo"<label class='label label-primary'>Anunciante: </label>
				        <a href='{$link}' class='btn btn-link btn-sm' role='button'>
        				$anunciante
        				</a>
        				<br> 
        				<a href='{$link}' class='btn btn-primary  col-md-5 btn-sm' role='button'>
        				Reputacao:<span class='badge'>$reputacao</span>
        				</a>
        				<br><br>
             			
             			<label class='label col-md-5 label-success'>Preço:</label>R$ $preco <br>
             			</i>
	        <p><a href='{$link}' class='btn btn-primary center-block' role='button'>Mais informação</a></p>"?>
	      </div>
	    </div>
	    </div>
	  	</div>
	  	<?}?>
						</div>
	<a class="btn btn-success center-block" href="anuncios.php?categoria=Roupas&pagina=1">Ver Mais...</a>
	</div><!-- well Roupas Em Destaque -->

<div class="well well-lg">
	<div class="page-header">
  		<h1 style="text-align: center;">Cosplay's em destaque</h1>
	</div>
	<!-- testando o carousel de anuncios premiums em destaque !-->
	<?
// Monta a consulta MySQL
$condicoes = "(`ativa` = 1) AND (`premium`= '1') AND (`categoria`= 'Cosplay')";
$sql = "SELECT * FROM `anuncios` WHERE {$condicoes} ORDER BY RAND() LIMIT 6";
// Executa a consulta
$query = mysql_query($sql);

// Começa a exibição dos resultados
						?><div class="row"><?
						while($resultado = mysql_fetch_assoc($query)){
						$titulo = utf8_encode($resultado['titulo']);
						$imagem = utf8_encode($resultado['imagem']);
						$descricao= utf8_encode($resultado['descricao']);
						$preco=$resultado['preco'];
						$id_anunciante=utf8_encode($resultado['cod_anunciante']);
						$link = 'detalhes.php?id=' . utf8_encode($resultado['id']);
						$query_anunciante="SELECT * FROM `usuarios` WHERE `id`='$id_anunciante'";
						$select_anunciante=mysql_query($query_anunciante);
						$resultado_anunciante=mysql_fetch_assoc($select_anunciante);
						$nome=utf8_encode($resultado_anunciante['nome']);
						$sobrenome=utf8_encode($resultado_anunciante['sobrenome']);
						$anunciante=$nome." ".$sobrenome;
						$reputacao=utf8_encode($resultado_anunciante['reputacao']);
						?>
						
  		<div class="col-sm-6 col-md-4">
	    <div class=" borda_frame_menu">
	    <div class=" thumbnail">
	      <h3><label class="label label-success col-md-12"><?echo"$titulo"?></label></h3>
	      <img src="<?echo"$imagem"?>" alt="erro ao carregar a foto">
	      <div class="caption">
	        
	        <i><?echo"<label class='label label-primary'>Anunciante: </label>
				        <a href='{$link}' class='btn btn-link btn-sm' role='button'>
        				$anunciante
        				</a>
        				<br> 
        				<a href='{$link}' class='btn btn-primary  col-md-5 btn-sm' role='button'>
        				Reputacao:<span class='badge'>$reputacao</span>
        				</a>
        				<br><br>
             			
             			<label class='label col-md-5 label-success'>Preço:</label>R$ $preco <br>
             			</i>
	        <p><a href='{$link}' class='btn btn-primary center-block' role='button'>Mais informação</a></p>"?>
	      </div>
	    </div>
	    </div>
	  	</div>
	  	<?}?>
						</div>
	<a class="btn btn-success center-block" href="anuncios.php?categoria=Cosplay&pagina=1">Ver Mais...</a>
	</div><!-- well Cosplay's Em Destaque -->

<div class="well well-lg">
	<div class="page-header">
  		<h1 style="text-align: center;">Diversos em destaque</h1>
	</div>
	<!-- testando o carousel de anuncios premiums em destaque !-->
<?
// Monta a consulta MySQL
$condicoes = "(`ativa` = 1) AND (`premium`= '1') AND (`categoria`= 'Outros')";
$sql = "SELECT * FROM `anuncios` WHERE {$condicoes} ORDER BY RAND() LIMIT 6";
// Executa a consulta
$query = mysql_query($sql);

// Começa a exibição dos resultados
						?><div class="row"><?
						while($resultado = mysql_fetch_assoc($query)){
						$titulo = utf8_encode($resultado['titulo']);
						$imagem = utf8_encode($resultado['imagem']);
						$descricao= utf8_encode($resultado['descricao']);
						$preco=$resultado['preco'];
						$id_anunciante=utf8_encode($resultado['cod_anunciante']);
						$link = 'detalhes.php?id=' . utf8_encode($resultado['id']);
						$query_anunciante="SELECT * FROM `usuarios` WHERE `id`='$id_anunciante'";
						$select_anunciante=mysql_query($query_anunciante);
						$resultado_anunciante=mysql_fetch_assoc($select_anunciante);
						$nome=utf8_encode($resultado_anunciante['nome']);
						$sobrenome=utf8_encode($resultado_anunciante['sobrenome']);
						$anunciante=$nome." ".$sobrenome;
						$reputacao=utf8_encode($resultado_anunciante['reputacao']);
						?>
						
  		<div class="col-sm-6 col-md-4">
	    <div class=" borda_frame_menu">
	    <div class=" thumbnail">
	      <h3><label class="label label-success col-md-12"><?echo"$titulo"?></label></h3>
	      <img src="<?echo"$imagem"?>" alt="erro ao carregar a foto">
	      <div class="caption">
	        
	        <i><?echo"<label class='label label-primary'>Anunciante: </label>
				        <a href='{$link}' class='btn btn-link btn-sm' role='button'>
        				$anunciante
        				</a>
        				<br> 
        				<a href='{$link}' class='btn btn-primary  col-md-5 btn-sm' role='button'>
        				Reputacao:<span class='badge'>$reputacao</span>
        				</a>
        				<br><br>
             			
             			<label class='label col-md-5 label-success'>Preço:</label>R$ $preco <br>
             			</i>
	        <p><a href='{$link}' class='btn btn-primary center-block' role='button'>Mais informação</a></p>"?>
	      </div>
	    </div>
	    </div>
	  	</div>
	  	<?}?>
						</div>
	<a class="btn btn-success center-block" href="anuncios.php?categoria=Outros&pagina=1">Ver Mais...</a>
	</div><!-- well Diversos Em Destaque -->

	<div class="well well-lg">
	<div class="page-header">
  		<h1 style="text-align: center;">E-Sports em destaque</h1>
	</div>
	<!-- testando o carousel de anuncios premiums em destaque !-->
<?
// Monta a consulta MySQL
$condicoes = "(`ativa` = 1) AND (`categoria`= 'E-Sport')";
$sql = "SELECT * FROM `anuncios` WHERE {$condicoes} ORDER BY RAND() ASC LIMIT 6";
// Executa a consulta
$query = mysql_query($sql);

// Começa a exibição dos resultados
						?><div class="row"><?
						while($resultado = mysql_fetch_assoc($query)){
						$titulo = utf8_encode($resultado['titulo']);
						$imagem = utf8_encode($resultado['imagem']);
						$descricao= utf8_encode($resultado['descricao']);
						$preco=$resultado['preco'];
						$id_anunciante=utf8_encode($resultado['cod_anunciante']);
						$link = 'detalhes.php?id=' . utf8_encode($resultado['id']);
						$query_anunciante="SELECT * FROM `usuarios` WHERE `id`='$id_anunciante'";
						$select_anunciante=mysql_query($query_anunciante);
						$resultado_anunciante=mysql_fetch_assoc($select_anunciante);
						$nome=utf8_encode($resultado_anunciante['nome']);
						$sobrenome=utf8_encode($resultado_anunciante['sobrenome']);
						$anunciante=$nome." ".$sobrenome;
						$reputacao=utf8_encode($resultado_anunciante['reputacao']);
						?>
						
  		<div class="col-sm-6 col-md-4">
	    <div class=" borda_frame_menu">
	    <div class=" thumbnail">
	      <h3><label class="label label-success col-md-12"><?echo"$titulo"?></label></h3>
	      <img src="<?echo"$imagem"?>" alt="erro ao carregar a foto">
	      <div class="caption">
	        
	        <i><?echo"<label class='label label-primary'>Anunciante: </label>
				        <a href='{$link}' class='btn btn-link btn-sm' role='button'>
        				$anunciante
        				</a>
        				<br> 
        				<a href='{$link}' class='btn btn-primary  col-md-5 btn-sm' role='button'>
        				Reputacao:<span class='badge'>$reputacao</span>
        				</a>
        				<br><br>
             			
             			<label class='label col-md-5 label-success'>Preço:</label>R$ $preco <br>
             			</i>
	        <p><a href='{$link}' class='btn btn-primary center-block' role='button'>Mais informação</a></p>"?>
	      </div>
	    </div>
	    </div>
	  	</div>
	  	<?}?>
						</div>
	<a class="btn btn-success center-block" href="anuncios.php?categoria=E-Sport&pagina=1">Ver Mais...</a>
	</div><!-- well e-sports Em Destaque -->

<div class="push"></div>

</div><!-- Fim do Wrapper -->
</div>
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
<script src="exam3.js"></script>
<!--_______________________________________________-->
</body> 
</html>
