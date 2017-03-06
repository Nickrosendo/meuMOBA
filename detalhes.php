<?php
  session_start();
  session_name("minha_sessao");
  $_SG['servidor'] = 'localhost';    // Servidor MySQL
$_SG['usuario'] = 'admin';          // Usuário MySQL
$_SG['senha'] = 'admin';                // Senha MySQL
$_SG['banco'] = 'meumoba';            // Banco de dados MySQL
$_SG['tabela'] = 'anuncios';       // Nome da tabela onde os usuários são salvos

// Verifica se foi feita alguma busca
// Caso contrario, redireciona o visitante pra home
if (!isset($_GET['id'])) {
  header("Location: index.php");
  exit;
}

$_SG['link'] = mysql_connect($_SG['servidor'], $_SG['usuario'], $_SG['senha']) or die("MySQL: Não foi possível conectar-se ao servidor: [".$_SG['servidor']."].");
  mysql_select_db($_SG['banco'], $_SG['link']) or die("MySQL: Não foi possível conectar-se ao banco de dados: [".$_SG['banco']."].");

?>
<!DOCTYPE html>
<html lang="en" ng-app="app3" ng-cloak>
<head>
<meta charset="UTF-8">
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
<div>
        <!-- Modal Login -->
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
</div><!-- fim do modal de login -->

<div>
        <!-- Modal Contato -->
<div class="modal fade" id="contato" tabindex="-1" role="dialog" aria-labelledby="contato">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="contato">Entrar em contato com o anunciante</h4>
      </div>
      <div class="modal-body">
      <textarea style="resize: none;" rows="5" placeholder="Seu Texto aki..." class="col-md-12"></textarea>
        <form name="contatoForm" action="" method="post">
          <br><br><button type="submit" ng-disabled="loginForm.$invalid" class="btn btn-success glyphicon glyphicon-envelope">Enviar</button>

          <button type="button" class="btn btn-success" data-dismiss="modal">Cancelar</button>
        </form>
      </div>
      <div class="modal-footer">
      </div>
    </div>
  </div>
</div>
</div><!-- fim do modal de login2 -->
<? 
//Pega o id do anuncio requisitado pelo get passado para essa pagina
// Monta a consulta MySQL para saber quantos registros serão encontrados
$id= $_GET['id'];
$sql = "SELECT * FROM `anuncios` WHERE `id`='$id'";
$query= mysql_query($sql);
//-----------------------------------------------------------------------
//Exibição dos dados do anuncio
while ($resultado = mysql_fetch_assoc($query)) {
  $link = 'detalhes.php?id=' . utf8_encode($resultado['id']);
  $titulo = utf8_encode($resultado['titulo']);
  $imagem = utf8_encode($resultado['imagem']);
  $descricao= utf8_encode($resultado['descricao']);
  $preco=utf8_encode($resultado['preco']);
  $categoria=utf8_encode($resultado['categoria']);
  $cod_anunciante=utf8_encode($resultado['cod_anunciante']);
  $get_anunciante="SELECT * FROM `usuarios` WHERE `id`='$cod_anunciante'";
  $query_anunciante=mysql_query($get_anunciante);
  while ($dados_anunciante=mysql_fetch_assoc($query_anunciante)) {
  $reputacao=$dados_anunciante['reputacao'];
  $nome=utf8_encode($dados_anunciante['nome']);
  $sobrenome=utf8_encode($dados_anunciante['sobrenome']);
  $anunciante=$nome." ".$sobrenome;
  $contato=utf8_encode($dados_anunciante['email']);
  };
  echo "
  <table class='table table-bordered'>
      <tr>
      <h2><label class='label label-success col-md-12'>{$titulo}</label></h2>
      </tr>
      <tr>
        <td class='col-md-9'>
          <img class='col-md-11' src='{$imagem}' width='350px' height='450px'>
        </td>
        <td>
        <h1><label class='label label-success col-md-9'>R$ $preco</label></h1><br><br>
        <h2><label class='label label-success col-md-12'>Detalhes do Anunciante:</label></h2>
        <a href='{$link}' class='btn btn-success btn-sm' role='button'>
                Reputacao:<span class='badge'>$reputacao</span>
        </a><br>
        <label class='label label-success'>Anunciante: </label>
                <a href='{$link}' class='btn btn-link btn-sm' role='button'>
                $anunciante
                </a>
                <br>
        <label class='label label-success'>Contato:</label>$contato<br>
        <h2><label class='label label-success col-md-12'>Detalhes do Produto:</label></h2>
        <button class='btn btn-success btn-lg center-block'>
          <h3>
            <span class='glyphicon glyphicon-thumbs-up'> Ofertar
            </span>
          </h3>
        </button>
        </td>
        
  </table>
  <table class='table table-bordered'>
  <tr>
        <h2><label class='label label-success col-md-12'>Descrição do Anuncio</label></h2>
        <div class='well well-md'>$descricao</div>
  </tr>

  <tr>
  <h2><label class='label label-success col-md-12'>Comentários</label></h2>
  <div class='well well-md'>
  <div style='border: 1px solid black;' class='media'>
          <div class='media-left'>
            <a href='#'>
              <img class='media-object' width='65px' height='65px' src='img/img.jpg' alt='...'>
            </a>
          </div>
          <div class='media-body'>
            <h4 class='media-heading'>Usuario</h4>
            Comentário do Usuario
          </div>
  </div>
  </div>
  </tr>
  </table>
  ";
};
?>

<a data-toggle="modal" data-target="#contato" class="btn btn-success btn-lg botao_login center-block glyphicon glyphicon-login" role="button">Entrar em Contato
</a>



    

<div class="push"></div>

</div><!-- Fim do Wrapper -->
</div>
<br><br><br><br>
<div class="footer">
<div class="jumbotron_footer muda_cor">
<div class="row">
  <div class="col-md-1"></div> 
  <div class="col-md-6">
  <button onclick="window.document.location='';" type="button"  class="btn btn-primary btn-md botoes_rodape">
    <span class="glyphicon glyphicon-info-sign " aria-hidden="true">Sobre Nós</span>
  </button>
  <button onclick="window.document.location='';" type="button"  class="btn btn-primary btn-md ">
    <span class="glyphicon glyphicon-send" aria-hidden="true">Contato</span>
  </button>
  <button onclick="window.document.location='';" type="button"  class="btn btn-primary btn-md ">
    <span class="glyphicon glyphicon-question-sign" aria-hidden="true">FAQ</span>
  </button>

  <button onclick="window.document.location='file:///C:/Users/Abraao/Desktop/Boots_Site/Termos_de_Uso.html';" type="button"  class="btn btn-primary btn-sm">
  <span class="glyphicon glyphicon-file botoes_footer" aria-hidden="true"> 
  Termos de Uso!
  </span>
  </button>

  <button onclick="window.document.location=''" type="button"  class="btn btn-primary btn-sm">
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="js/bootstrap.js"></script>
<script src="js/angular.js"></script>
<script src="exam3.js"></script>
</body>
</html>  