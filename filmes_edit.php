<?php
if ($_SERVER['REQUEST_METHOD']=="GET") {
	if (isset($_GET['filme'])&& is_numeric($_GET['filme'])) {
		$idFilme=$_GET['filme'];
		$con=new mysqli("localhost","root","","filmes");

		if ($con->connect_errno!=0) {
				echo "<h1>Ocorreu um erro no acesso a base de dados.<br>".$connect_eror."</h1>";
				exit();
		}
		$sql="Select * from filmes where id_filme=?";
		$stm=$con->prepare($sql);
		if ($stm!=false) {
				$stm->bind_param("i",$idFilme);
				$stm->execute();
				$res=$stm->get_result();
				$filme=$res->fetch_assoc();
				$stm->close();
		}
	
				  ?>
	  <!DOCTYPE html>
	  <html>
	  <head>
	  	<title>Editar filmes</title>
	  </head>
	  <body>
	  <h1>Editar Filmes</h1>

	  <form action="filmes_update.php" method="post">
	<label>Titulo</label><input type="text" name="titulo" required value="<?php echo $filme['titulo'];?>"><br>
	<label>Sinopse</label><input type="text" name="sinopse" value="<?php echo $filme['sinopse'];?>"><br>
	<label>Quantidade</label><input type="text" name="quantidade" value="<?php echo $filme['quantidade'];?>"><br>
	<label>Idioma</label><input type="text" name="numeric" value="<?php echo $filme['idioma'];?>"><br>
	<label>Data Lançamento</label><input type="date" name="data_lancamento" value="<?php echo $filme['data_lancamento'];?>"><br>
	<input type="hidden" name="data_lancamento" value="<?php echo $filme['data_lancamento'];?>"><br>
	<input type="submit" name="enviar">
</form>
	  </body>
	  </html>
	  <?php
	}	
else{
	echo ("<h1>houve um erro ao precessar o seu pedido.<br> Dentro de segundos sera reencaminhado!</h1>");
	header("refresh:5; url=index.php");
	}
}	
?>