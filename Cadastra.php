<?
$HOST="localhost";
$USER="admin";
$PSW="admin";
$bd="meumoba";

//variaveis recebidas do cadastro.html
$Nome= ucfirst($_POST['Nome']);
$SobreNome= ucwords($_POST['SobreNome']);
$Dia= $_POST['Dia'];
$Mes= $_POST['Mes'];
$Ano= $_POST['Ano'];
$Sexo= $_POST['Sexo'];
$Telefone1= $_POST['Telefone1'];
$Telefone2= $_POST['Telefone2'];
$Email= $_POST['Email'];
$Senha= md5($_POST['Senha']);
$Feed= $_POST['Feed'];
$Data_Nascimento= $Dia .'/'.$Mes.'/'.$Ano;

$link = mysql_connect($HOST,$USER,$PSW)or die("<script language='javascript' type='text/javascript'>alert('Erro ao conectar com o servidor');window.location.href='Cadastro.php'</script>");
$conexao=mysql_select_db($bd,$link) or die("<script language='javascript' type='text/javascript'>alert('Erro ao conectar com o banco de dados');window.location.href='Cadastro.php'</script>"); 
$cadastro="Insert into usuarios
			(nome,sobrenome,data_nascimento,sexo,telefone1,telefone2,email,senha,feed) values
			('$Nome',
			'$SobreNome',
			'$Data_Nascimento',
			'$Sexo',
			'$Telefone1',
			'$Telefone2',
			'$Email',
			'$Senha',
			'$Feed');";
$confere_email="SELECT * FROM `usuarios` WHERE `email`='$Email'";
$query_email=mysql_query($confere_email);	
$linhas=mysql_num_rows($query_email);
$resultado=mysql_fetch_array($query_email);
if ($resultado[7]!="") {
die("<script language='javascript' type='text/javascript'>alert('Email: ".$Email." ja cadastrado');window.location.href='Cadastro.php'</script>");
}else{
	$query=mysql_query($cadastro) or die("<script language='javascript' type='text/javascript'>alert('Erro no Cadastro');window.location.href='Cadastro.php'</script>");
mysql_close($link);
echo"<script language='javascript' type='text/javascript'>alert('Cadastro realizado com sucesso');window.location.href='Cadastro.php'</script>"; 
}


?> 