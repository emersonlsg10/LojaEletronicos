<h1>CADASTRO DE CATEGORIAS</h1>
		<div class="cx-form">
		<div class="cx-pd">			

<form action="op/op_categoria.php" method="post">
		 
	
  <label>
	<strong>Título da Categoria</strong>
    <input type="text" name="txt_categoria" id="txt_categoria" value="" size="110">
  </label>
  
   <label>
	<strong>Slug da Categoria</strong>
    <input type="text" name="txt_slug_categoria" id="txt_slug_categoria" value="" size="110">
  </label>
<label>
	<strong>Ativo</strong>
	<select name="txt_ativo" class="tm3">
		<option value="S" >Sim</option>
		<option value="N" >Não</option>
  </select>
 
</label>

	
		<label>
		<div class="cx-but">
			<input type="hidden" name ="id" value="">							
			<input type="hidden" name ="acao" value="Cadastrar">										
			<input type="submit" name= "logar" id="logar" value = "Cadastrar" class="but" >	
		</div>
		</label>
</form>

		</div>
		</div>		