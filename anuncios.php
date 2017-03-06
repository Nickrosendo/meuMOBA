<?php
  session_start();
  session_name("minha_sessao");
  $_SG['servidor'] = 'localhost';    // Servidor MySQL
$_SG['usuario'] = 'admin';          // Usuário MySQL
$_SG['senha'] = 'admin';                // Senha MySQL
$_SG['banco'] = 'meumoba';            // Banco de dados MySQL
$_SG['tabela'] = 'anuncios';       // Nome da tabela onde os usuários são salvos

// Verifica se alguma categoria foi selecionada
// Caso contrario, redireciona o visitante pra home
if (!isset($_GET['categoria'])) {
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
</form>
<br>


<div class="container">
  

<?php  

// Salva o que foi buscado em uma variável
$categoria = mysql_real_escape_string($_GET['categoria']);
// ============================================
// Registros por página
$por_pagina = 15;
// Monta a consulta MySQL para saber quantos registros serão encontrados
$condicoes = "(`ativa` = 1) AND ((`categoria` LIKE '%{$categoria}%') OR ('%{$categoria}%'))";
$sql = "SELECT COUNT(*) AS total FROM `anuncios` WHERE {$condicoes}";
// Executa a consulta
$query = mysql_query($sql);
// Salva o valor da coluna 'total', do primeiro registro encontrado pela consulta
$total = mysql_result($query, 0, 'total');
// Calcula o máximo de paginas
$paginas =  (($total % $por_pagina) > 0) ? (int)($total / $por_pagina) + 1 : ($total / $por_pagina);
// ============================================
//verifica se a url tem a requisiçao GET informando o numero da pagina
if (isset($_GET['pagina'])) {
  $pagina = (int)$_GET['pagina'];
} else {
  $pagina = 1;
}
$pagina = max(min($paginas, $pagina), 1);
$offset = ($pagina - 1) * $por_pagina;
// ============================================
// Monta outra consulta MySQL, agora a que fará a busca com paginação
$sql = "SELECT * FROM `anuncios` WHERE {$condicoes} ORDER BY `premium` DESC, RAND() LIMIT {$offset}, {$por_pagina}";
// Executa a consulta
$query = mysql_query($sql);
// ============================================
// verifica se existe o GET do filtro, se existir faz uma query com o valor se não o filtro recebe vazio
if (isset($_GET['filtro'])) {
  $filtro = $_GET['filtro'];
  // Monta outra consulta MySQL, agora a que fará a busca com paginação e com filtro
$condicoes = "(`ativa` = 1) AND ((`categoria` LIKE '%{$categoria}%') OR ('%{$categoria}%')) AND ((`descricao` LIKE '%{$filtro}%') OR ('%{$filtro}%')) ";
$sql = "SELECT * FROM `anuncios` WHERE {$condicoes} ORDER BY `premium` DESC, RAND() LIMIT {$offset}, {$por_pagina}";
// Executa a consulta
$query = mysql_query($sql);
}else{$filtro="";};

// ============================================
// Começa a exibição dos resultados
echo "<span class='label label-success'>".min($total, ($offset + $por_pagina))." de ".$total." resultados encontrados para '".$_GET['categoria']."' </span> <br><br>";
if ($categoria=='Venda_de_Conta') {
echo "

<div class='btn-group'>
          <button type='button' class='btn btn-success btn-md dropdown-toggle glyphicon glyphicon-menu-hamburger' data-toggle='dropdown' aria-haspopup='true' aria-expanded='true'>
              Filtros <span class='caret'></span>
          </button>
           
            <ul class='dropdown-menu'>
              <li><a href='anuncios.php?categoria=Venda_de_Conta&pagina=1&filtro='>Sem Filtro</a></li>
              <li><a href='anuncios.php?categoria=Venda_de_Conta&pagina=1&filtro=unranked'>Unranked</a></li>
              <li><a href='anuncios.php?categoria=Venda_de_Conta&pagina=1&filtro=bronze'>Bronze</a></li>
              <li><a href='anuncios.php?categoria=Venda_de_Conta&pagina=1&filtro=prata'>Prata</a></li>
              <li><a href='anuncios.php?categoria=Venda_de_Conta&pagina=1&filtro=ouro'>Ouro</li>
              <li><a href='anuncios.php?categoria=Venda_de_Conta&pagina=1&filtro=platina'>Platina</a></li>
              <li><a href='anuncios.php?categoria=Venda_de_Conta&pagina=1&filtro=diamante'>Diamante</a></li>
              <li><a href='anuncios.php?categoria=Venda_de_Conta&pagina=1&filtro=mestre'>Mestre</a></li>
              <li><a href='anuncios.php?categoria=Venda_de_Conta&pagina=1&filtro=desafiante'>Desafiante</a></li>
            </ul></div>&nbsp;&nbsp;<span class='label label-success'> Filtro Ativo:</span>&nbsp;&nbsp;<span class='label label-success'>$filtro</span> <br><br>";

};
// Links de paginação
// Começa a exibição dos paginadores  
if ($total > 0) {
  echo "<div class='borda_frame_menu'><span class='label label-success'> Página: </span>";
  for ($n = 1; $n <= $paginas; $n++) {
    echo "<a class='texto_menu label label-success' href='anuncios.php?categoria={$_GET['categoria']}&pagina={$n}'>{$n}</a>";
  }
  echo "</div>";
}


while ($resultado = mysql_fetch_assoc($query)) {
  $titulo = utf8_encode($resultado['titulo']);
  $imagem = utf8_encode($resultado['imagem']);
  $descricao= utf8_encode($resultado['descricao']);
  $preco=$resultado['preco'];
  $link = 'detalhes.php?id='.utf8_encode($resultado['id']);
  
   echo"<div class='col-sm-6 col-md-12 borda_frame_menu'>";
      echo"<div class='thumbnail'>";
        echo"<h2><label class='label label-success col-md-12'>{$titulo}</label></h2>";
      
        echo"<div class='caption'>
        <table class='table table-bordered'>
          <tr>
              <td style='width:150px;'><img src='{$imagem}' width='150px'></td>
              <td><i>{$descricao}</i></td>
          </tr>    
        </table>  
              <h3><label class='label label-success'>R$:{$preco}</label></h3>
              <p><a href='{$link}' class='btn btn-primary' role='button'>Mais informação</a>
                 <a href='#' class='btn btn-success' role='button'>Dar Offerta</a>
              </p>
             </div>
            </div>  
            </div>
       ";
};
?>
<?
// Links de paginação
// Começa a exibição dos paginadores
if ($total > 0) {
  echo "<div class='borda_frame_menu'><span class='label label-success'> Página: </span>";
  for ($n = 1; $n <= $paginas; $n++) {
    echo "<a class='texto_menu label label-success' href='anuncios.php?categoria={$_GET['categoria']}&pagina={$n}'>{$n}</a>";
  }
  echo "</div>";
}
?>
<!--</div><!-- jumbotron -->
</div><!--  container do jumbotron-->
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