<div class="conteudo margin-topo">
	<!-- menu lateral-->
	<?php include"menu-lateral.php"?>
	
	<div class="lado-dir">
	<title class="migalha">Loja Virtual / Cadastro</title>
	<div class="base-cadastro">
		
		<form action="op_cliente.php" method="post">
		<h1><span>Dados para acesso</span></h1>	
			<label>
				<strong>Nome:</strong>
				<input type="text" name="txt_cliente" value="<?php echo @$_SESSION["LJCLIENTE"]["cliente"] ?>">
			</label>
			<label class="fl">
				<strong>Senha:</strong>
				<input type="text" name="txt_senha" value="">
			</label>
			<label class="fl">
				<strong>Email:</strong>
				<input type="text" name="txt_email" value="<?php echo @$_SESSION["LJCLIENTE"]["email"] ?>">
			</label>
			
			
			
			<div class="limpar">
			<p>&nbsp;</p>
			<p>&nbsp;</p>
			</div>
			
			
			<h1><span>Dados pessoais</span></h1>
			<label>
				<strong>Endereço:</strong>
				<input type="text" name="txt_endereco" value="<?php echo @$_SESSION["LJCLIENTE"]["endereco"]?>">
			</label>
			<label>
				<strong>Bairro:</strong>
				<input type="text" name="txt_bairro" value="<?php echo @$_SESSION["LJCLIENTE"]["bairro"]?>">
			</label>
			
			<label class="fl">
				<strong>CEP:</strong>
				<input type="text" name="txt_cep" value="<?php echo @$_SESSION["LJCLIENTE"]["cep"]?>">
			</label>
			<label class="fl">
				<strong>Cidade:</strong>
				<input type="text" name="txt_cidade" value="<?php echo @$_SESSION["LJCLIENTE"]["cidade"] ?>">
			</label>
			
			<label class="fl">
				<strong>Telefone:</strong>
				<input type="text" name="txt_fone" value="<?php echo @$_SESSION["LJCLIENTE"]["fone"] ?>">
			</label>
			<label class="fl">
				<strong>UF:</strong>
				<input type="text" name="txt_uf" value="<?php echo @$_SESSION["LJCLIENTE"]["uf"] ?>">
			</label>
			
			<label>
				<!--<input type="text" name="txt_uf" value="">-->
				<input type="submit" class="cadastrar">
			</label>
		</form>
	</div>
	</div>
</div>