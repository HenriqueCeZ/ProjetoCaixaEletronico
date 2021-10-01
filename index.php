
<?php

	session_start();
	require 'config.php';

	if(isset($_SESSION['banco']) && empty($_SESSION['banco']) == false){

			$id = $_SESSION['banco'];
			$sql = $pdo->prepare("SELECT * FROM contas WHERE id = :id");
			$sql->bindValue(":id", $id);
			$sql->execute();

			if($sql->rowCount() > 0){

				$info = $sql->fetch();	

			}else{

				header("Location:login.php");
				exit;
			}

	}else{
		header("Location:login.php");
		exit;
	}
 ?>
<html>

<head>		
		<title>Caixa Eletrônico</title>



</head>

<body>
	<h1>Banco X y Z</h1>
	Titular: <?php echo $info['titular']; ?> <br>
	Agência: <?php echo $info['agencia']; ?> <br>
	Conta: <?php echo $info['conta']; ?> <br>
	Conta: <?php echo $info['saldo']; ?> <br>
	<a href="sair.php">Sair</a>
	<hr>
	<h3>Movimentação/Extrato</h3>

	<a href="add-transacao.php">Adicionar Transação</a><br><br>
	<table border= "1" width ="400px">
		<tr>

			<th>Data</th>
			<th>Valor</th>

		</tr>
		<?php $sql = $pdo->prepare("SELECT * FROM historico WHERE id_conta = :id_conta");
		$sql->bindvalue(":id_conta",$id);
		$sql->execute();

		if($sql->rowCount() > 0){

			foreach ($sql->fetchAll() as $item) :
				?>
					<tr>
						<td><?php echo date('d/m/y H:i', strtotime($item['data_operacao'])); ?></td>
						<td><?php if($item['tipo'] == '0'): ?>
							<span color="green"></span>	
							R$ <?php echo $item['valor'] ;?>
						<?php else: ?>
						<span color="red"></span>	
							R$ <?php echo $item['valor'] ;?>
						<?php endif;?> 
						</td>


					</tr>
				<?php 

			endforeach;
}
				
			

		
?>
	</table>
</body>



</html>