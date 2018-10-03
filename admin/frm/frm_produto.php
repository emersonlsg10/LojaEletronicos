<!DOCTYPE html>
<?php
@$id = (int) $_GET["id"];
@$acao = $_GET["acao"];

if ($id) {
    $produto = consultar("produtos", "id_produto = $id");

    $id_categoria = $produto[0]["id_categoria"];
    $id_subcategoria = $produto[0]["id_subcategoria"];
    $id_fabricante = $produto[0]["id_fabricante"];
    $txt_produto = $produto[0]["produto"];
    $txt_preco_alto = $produto[0]["preco_alto"];
    $txt_preco = $produto[0]["preco"];
    $txt_descricao = $produto[0]["descricao"];
    $txt_detalhes = $produto[0]["detalhes"];
    $txt_imagem = $produto[0]["imagem"];
    $txt_destaque = $produto[0]["destaque"];
    $txt_ativo = $produto[0]["ativo_produto"];
}
?>
<h1>Cadastro de produtos</h1>
<div class="cx-form">
    <div class="cx-pd">		

        <form action="op/op_produtos.php" method="post">
           
            <label class="esq"> 
                <strong>Produto</strong><br>
            </label>
            <input type="text" name="txt_produto" value="<?php echo @$txt_produto ?>"><br>

            <label class="esq">
                <strong>Categoria</strong>
                <select name="txt_id_categoria">
                    <?php
                    $categorias = consultar("categorias");
                    foreach ($categorias as $categoria) {
                        $cod_categoria = $categoria["id_categoria"];
                        if ($cod_categoria == @$id_categoria)
                            $selecionado = "selected";
                        else
                            $selecionado = "";
                        echo "<option value='$categoria[id_categoria]' $selecionado>$categoria[categoria]</option>";
                    }
                    ?>         
                </select>
            </label>

            <label class="dir">
                <strong>Subcategoria</strong>
                <select name="txt_id_subcategoria">
                    <?php
                    $subcategorias = consultar("subcategorias");
                    foreach ($subcategorias as $subcategoria) {
                        $cod_subcategoria = $subcategoria["id_subcategoria"];
                        if ($cod_subcategoria == @$id_subcategoria)
                            $selecionado = "selected";
                        else
                            $selecionado = "";
                        echo "<option value='$subcategoria[id_subcategoria]' $selecionado>$subcategoria[subcategoria]</option>";
                    }
                    ?>
                </select>
            </label>

            <label class="esq">
                <strong>Fabricante</strong>
                <select name="txt_id_fabricante">
                    <?php
                    $fabricantes = consultar("fabricantes");
                    foreach ($fabricantes as $fabricante) {
                        $cod_fabricante = $fabricante["id_fabricante"];
                        if ($cod_fabricante == @$id_fabricante)
                            $selecionado = "selected";
                        else
                            $selecionado = "";
                        echo "<option value='$fabricante[id_fabricante]' $selecionado>$fabricante[fabricante]</option>";
                    }
                    ?>        
                </select>
            </label>
            <label class="dir">
                <strong>Ativo</strong>
                <select name="txt_ativo" class="tm3">
                    <option value="S" <?php if (@$txt_ativo == "5") echo "selected" ?>>Sim</option>
                    <option value="N" <?php if (@$txt_ativo) echo "selected" ?>>Não</option>
                </select>
            </label> 


            <!--            <label>
                            <strong>Título do produto</strong>
                            <input type="text" name="txt_titulo_produto" id="txt_titulo_produto" value="" size="109"/>
                        </label>-->

            <label>
                <strong>Buscar imagem</strong>
                <input type="file" name="txt_imagem" id="txt_imagem" value="<?php echo @$txt_imagem ?>" size="109"/>
            </label>

            <label>
                <strong>Imagem</strong>
                <input type="text" name="txt_imagem" value="<?php echo @$txt_imagem ?>" id="txt_imagem_produto" size="109"/><br>
            </label>
            <label class="esq">
                <strong>Preço alto</strong>
                <br><input type="text" name="txt_preco_alto" value="<?php echo @$txt_preco_alto ?>" id="txt_preco_alto" size="109" /><br>
            </label>
            <label class="dir">
                <strong>Valor atual</strong>
                <br><input type="text" name="txt_preco" value="<?php echo @$txt_preco ?>" id="txt_valor_produto" size="109" /><br>	
            </label>  

            <label>
                <strong>Descrição</strong>
                <textarea name="txt_descricao" id="txt_descricao_produto" class="ckeditor" rows="15" cols="70"><?php echo @$txt_descricao ?></textarea><br>
            </label>

            <label>
                <strong>Detalhes</strong>
                <br><textarea name="txt_detalhes" id="txt_detalhes_produto"  class="ckeditor" rows="15" cols="70"><?php echo @$txt_detalhes ?></textarea></br>
            </label>

            <label>
                <div  class="cx-but">
                    <input type="hidden" name="acao" value="<?php echo ($acao != '') ? $acao : 'Cadastrar' ?>"><br>
                    <input type="hidden" name="id" value="<?php echo @$id ?>"><br>
                    <input type="submit" name= "logar" id="logar" value="<?php echo ($acao != '') ? $acao : 'Cadastrar' ?>" class="but" >	
                </div>				
            </label>
        </form>

    </div>
</div>