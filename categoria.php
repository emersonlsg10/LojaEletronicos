<?php
$idCat = (int) $_GET["c"];
$catSelecionada = consultar("subcategoria", "id_categoria = $idCat AND ativo_subcategoria = 'S'");

//QUERY ALTERNATIVA, MAS ESTAVA DANDO ERRO DE LÓGICA AO OBTER DADOS DO BANCO --- IDÊNTICA AO DO PROF
//
//$catSelecionada = selecionar("SELECT * FROM subcategorias WHERE id_subcategoria in"
//." (SELECT id_subcategoria FROM produtos) AND id_categoria = $idCat AND ativo_subcategoria = 'S'");
//$catSelecionada;
?>
<div class="conteudo">
    <?php include "menu-lateral.php" ?>

    <div class="lado-dir">
        <div class="base-home">
            <!-- com tres produtos-->	

            <div class="cx-base-home categoria">
                <?php
                foreach ($catSelecionada as $listaSubcategoria) {
                    ?>
                    <h1><span><?php echo $listaSubcategoria["subcategoria"] ?></span></h1>
                    <?php
                    $idSubcategoria = $listaSubcategoria["id_subcategoria"];
                    $lst_produtos = consultar("produto", "id_subcategoria = $idSubcategoria AND ativo_produto = 'S'");
                    if($lst_produtos){
                    foreach ($lst_produtos as $lst_produto) {
                        ?>
                    <div class="quatro-colunas-cat">
                            <div class="cx-img">	
                                <a href="<?php echo URL_BASE."produto/&p=".$lst_produto["id_produto"] ?>"><img src="<?php echo URL_BASE ?>produtos/<?php echo $lst_produto["imagem"] ?>" title="<?php echo $lst_produto["produto"]?>"></a>
                            </div>						
                        <h2><a href="<?php echo URL_BASE."produto/&p=".$lst_produto["id_produto"] ?>"><?php echo limita_caracteres($lst_produto["produto"], 40) ?></a></h2>
                            <div class="prc-ant">De <small><?php echo $lst_produto["preco_alto"] ?></small> R$ <font> Por <?php echo $lst_produto["preco"] ?></font> R$</div>
                           
                            <div class="cx-botoes">
                                <form id="form1" name="frmcarrinho" method="post" action="<?php echo URL_BASE ?>carrinho">
                                    <input name="txt_preco" 	type="hidden" id="txt_preco" value = "<?php echo $lst_produto["preco"] ?>" />
                                    <input name="txt_qtde" 		type="hidden" id="txt_qtde" value = "1" />
                                    <input type="hidden" 		name="id_produto" value = "<?php echo $lst_produto["id_produto"] ?>"/>
                                    <input type="submit" 		name="imageField" class="bot-comprar" value="Comprar"  />
                                </form>
                                
                                <a href="<?php echo URL_BASE ?>produto/&p=1" class="bot-detalhe">Detalhes</a>
                                <div class="cx-frete"><b class="frete">FRETE</b><b class="val-frete">GRÁTIS</b></div>
                                <div class="bandeiras none"><font>Em até <b>10x</b> nos cartões</font><img src="<?php echo URL_BASE ?>imagens/bandeiras2.png"></div>			
                            </div>
                        </div>	
                    <?php }}?>
                    <div class="limpar"></div>
                <?php } ?>
            </div>
        </div>				
        <!--sidebar-->
        <?php include"sidebar.php" ?>
    </div>	
</div>