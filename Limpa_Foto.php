<?
session_start();
//confere se o usuario esta logado
if (!isset($_SESSION['usuarioID']) OR !isset($_SESSION['usuarioNome'])) {
  header("Location: index.php");
  exit;
}else{
		
		$id_usu=$_SESSION['usuarioID'];
			//limpa os cookies das imagens
						//apaga a foto1
						unlink($_COOKIE['foto1']);
        				setcookie("foto1","",time() - 3600);//apaga o cookie da foto1
        				//apaga a foto2
						unlink($_COOKIE['foto2']);
        				setcookie("foto2","",time() - 3600);//apaga o cookie da foto2
        				//apaga a foto3
						unlink($_COOKIE['foto3']);
        				setcookie("foto3","",time() - 3600);//apaga o cookie da foto3
        				//apaga a foto4
						unlink($_COOKIE['foto4']);
        				setcookie("foto4","",time() - 3600);//apaga o cookie da foto4
        				//apaga a foto5
						unlink($_COOKIE['foto5']);
        				setcookie("foto5","",time() - 3600);//apaga o cookie da foto5
        				unlink($_COOKIE['caminho_foto']);
        				setcookie("caminho_foto","",time() - 3600);//apaga a foto5
        				//salva em uma variavel o id do usuario logado
						$id_usu=$_SESSION['usuarioID'];  
        				header("Location: Cadastro_Anuncio.php?id=$id_usu");			
	 }		
?>