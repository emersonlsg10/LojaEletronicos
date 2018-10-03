	
<h1>CADASTRO DE CAPÍTULO</h1>
<div class="cx-form">
	<div class="cx-pd">
	<form action="op/op_subcategoria.php" method="post">
<label class="esq">		
<strong>Categoria</strong>
    <select name="txt_id_categoria">
	<option value=1  > Smartphone</option><option value=2  > Tablet</option><option value=3  > Hardware</option><option value=4  > Periféricos</option><option value=5  > Computadores</option><option value=6  > Câmeras Digitais</option><option value=7  > Gamer</option>         
      </select>
</label>
   
<label class="dir">
<strong class="tm-02">Ativo</strong>
	<select name="txt_ativo">
	<option value="S" >Sim</option>
	<option value="N" >Não</option>
  </select>
</label>
  
	
  <label><strong class="tm-02">Título do subcategoria</strong>
    <input type="text" name="txt_subcategoria" id="txt_subcategoria" value="" size="110">
  

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