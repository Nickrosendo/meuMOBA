<?
session_start();
//salva em uma variavel o id do usuario logado
$id_usu=$_SESSION['usuarioID'];
$foto1="";
$foto2="";
if (isset($_POST['abre_foto1'])) {
  	$foto1=$_POST['abre_foto1'];
}
if (isset($_POST['abre_foto2'])) {
  	$foto2=$_POST['abre_foto2'];
}  
	//confere se o botao da foto 1 foi clicado
	if (isset($foto1)) {
		setcookie("select_foto",$COOKIE['foto1']);
		$foto2="";
		header("Location: Cadastro_Anuncio.php?id=$id_usu");
	}
	//confere se o botao da foto 2 foi clicado
	if(isset($foto2)) {
		setcookie("select_foto",$COOKIE['foto2']);
		$foto1="";
		header("Location: Cadastro_Anuncio.php?id=$id_usu");
	}


?>
