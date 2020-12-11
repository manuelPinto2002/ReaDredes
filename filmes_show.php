<?php 
if ($_SERVER['REQUEST_METHOD']=="GET") {
	if (!isset($_GET['filme'])|| !is_numeric($_GET['filme'])) {
		echo "<script>alert('Erro ao abrir livro');</script>";
		echo "Aguarde um momento.A reencaminhar pagina";
		header("refresh:5;url=index.php");
	}
	$idFilme=$_GET['filme'];
	$con=new mysqli("localhost","root","","filmes");

	if ($con->connect_errno!=0) {
		echo "Ocorreu um erro no acesso à base de dados.<br>".$con->connect_error;
		exit;
	}
	else{
		$sql='select * from filmes where id_filme= ?';
		$stm=$con->prepare($sql);
		if ($stm!=false) {
			$stm->bind_param('i',$idFilme);
			$stm->excecute();
			$res=$stm->get_result();
			$filme=$res->fetch_assoc();
			$stm->close();

		}
		else{
			echo "<br>";
			echo ($con->error);
			echo "<br>";
			echo "Aguarde um momento. A reencaminhar pagina";
			echo "<br>";
			header("refresh:5; url=index.php");
		}
	}//end if 
}//if($_server...)
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Detalhes</title>
</head>
<body>
<h1>Detalhes do filme</h1>
<?php 
if (isset($filme)) {
	echo "<br>";
	echo $filme['titulo'];
	echo "<br>";
	echo $filme['sinopse'];
	echo "<br>";
	echo $filme['idioma'];
	echo "<br>";
	echo $filme['data_lancamento'];
	echo "<br>";
	echo $filme['quantidade'];
	echo "<br>";
}
else{
 echo "<h2>Parece que o filme selecionado nao existe. <br> confirme a sua seleção</h2>";
}
?>
</body>
</html>