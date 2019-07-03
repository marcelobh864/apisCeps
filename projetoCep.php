<?php 
	$cepPesquisa = isset($_POST['cep']) ? $_POST['cep'] : '';
	$url = "http://apps.widenet.com.br/busca-cep/api/cep.json?code=".$cepPesquisa;
	$cep = json_decode(file_get_contents($url));
	if (!empty($cepPesquisa) && ($cep->status == 1)) {
		
		
		$url = "http://apps.widenet.com.br/busca-cep/api/cep.json?code=".$cepPesquisa;
		$cep = json_decode(file_get_contents($url));
	}
	if ($cep->status == 0 && !empty($cepPesquisa)) {
	$cep->state = "";
	$cep->city = "";
	$cep->district = "";
	$cep->code = ""; ?>

		 <div class="erro">Cep Não encontrado!</div>
	<?php }
	
	if ($cep->status == 0) {
	$cep->state = "";
	$cep->city = "";
	$cep->district = "";
	$cep->address = "";
	$cep->code = "";
	}

?>
<!DOCTYPE html>
<html>
	<head>
		<title></title>
		<style type="text/css">
			body{
				background-image: url("cep10.jpg");
			    background-size: cover;  
			    background-attachment:  fixed;
			    background-position: center;
			    background-repeat: no-repeat;
			}
			#localidade{
				margin-top: 90px;
				margin-left: 150px;
				width: 400px;
				height: 420px;
  				padding-left: 330px;
			}
			#localidade h1{
				margin-bottom: 30px;
				color: #000000
				text-align: center;
			}
			#localidade h3{
				color: #000000
			}
			#localidade p{
				color: #000000
				font-weight: bold;
			}
		</style>
	</head>
	<body>
		<div id="localidade">
			<h1>Busca Localidades</h1>
			<form action="projetoCep.php" method="POST" name="consultar">
				<p><label>Informe o cep que você deseja consultar:</label></p>
				<p><input type="text" name="cep" size="26"> <input type="submit" value="Pesquisar"></p>
				<p><label>Estado do Cep:</label>&nbsp;&nbsp;&nbsp;&nbsp;
				<input type="text" name="" value="<?php echo $cep->state; ?>"></p>
				<p><label>Cidade do Cep:</label>&nbsp;&nbsp;&nbsp;&nbsp;
				<input type="text" name="" value="<?php echo $cep->city; ?>"></p>
				<p><label>Bairro do Cep:&nbsp;&nbsp;</label>&nbsp;&nbsp;&nbsp;&nbsp;
				<input type="text" name="" value="<?php echo $cep->district; ?>"></p>
				<p><label>Rua do Cep: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>&nbsp;&nbsp;&nbsp;&nbsp;
				<textarea rows="5" cols="22" style="resize: none;"><?php echo $cep->address; ?></textarea></p>
				<p><label>Cep consultado:&nbsp;&nbsp;</label>&nbsp;&nbsp;&nbsp;
				<input type="text" name="" value="<?php echo $cep->code; ?>"></p>
			</form>
		</div>
	</body>
</html>