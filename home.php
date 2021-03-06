    
﻿<!--banner topo-->
<div class="cx-banner-topo">
    <div class="conteudo">
        <section class="slide">
            <div class="slide_nav">
                <div class="slide_nav_item b"></div>
                <div class="slide_nav_item g"></div>
            </div>


            <article class="slide_item first">
                <div class="base-bn">
                    <a href="<?php echo URL_BASE ?>/produto/&p=15"><img src="banner/03.png" alt="banner 01" title="banner 01"></a>
                </div>    
            </article>
            <article class="slide_item">
                <div class="base-bn">
                    <a href="<?php echo URL_BASE ?>/produto/&p=10"><img src="banner/02.png" alt="banner 01" title="banner 01"></a>
                </div>    
            </article>
        </section>

        <!-- slideshow-->
        <script src="//code.jquery.com/jquery-2.1.3.min.js"></script>
        <script src="js/js.js" async></script>
    </div>
</div>

<!--mais vendidos-->

<div class="conteudo">	
    <div class="base-maisvendido">
        <h1><span>Destaques</span></h1>
        <?php
        $lst_destaques = consultar("produto", "destaque = 'S' AND ativo_produto = 'S' ORDER BY rand() LIMIT 3");
        if ($lst_destaques) {
            foreach ($lst_destaques as $lst_destaque) {
                ?>
                <div class="cx-maisvendido">
                    <div class="prod"><a href="<?php echo URL_BASE ?>/produto/&p=2"><img src="produtos/<?php echo $lst_destaque["imagem"] ?>" title="<?php echo $lst_destaque["produto"]?>"></a></div>
                    <div class="del">
                        <h2><a href="<?php echo URL_BASE ?>/produto/&p="<?php echo $lst_destaque["id_produto"] ?>><?php echo limita_caracteres($lst_destaque["produto"],40) ?></a></h2>
                        <div class="prc-ant">De <small> R$ <?php echo $lst_destaque["preco_alto"] ?></small><font> Por</font></div>
                        <span>R$ <?php echo $lst_destaque["preco"] ?></span>
                        <form id="form1" name="frmcarrinho" method="post" action="<?php echo URL_BASE ?>/carrinho">
                            <input name="txt_preco" 	type="hidden" id="txt_preco" value = "<?php echo $lst_destaque["preco"] ?>" />
                            <input name="txt_qtde" 		type="hidden" id="txt_qtde" value = "1" />
                            <input type="hidden" 		name="id_produto" value = "<?php echo $lst_destaque["id_produto"] ?>"/>
                            <input type="submit" 		name="imageField" class="comprar" value="Comprar"  />
                        </form>
                        <div class="cx-frete"><b class="frete">FRETE</b><b class="val-frete">GRÁTIS</b></div>

                    </div>
                </div>	
            <?php }
        }
        ?>
    </div>
</div>

<div class="conteudo">
<?php include"menu-lateral.php" ?>	
    <div class="lado-dir">
        <div class="base-home">	

            <!-- com quatro produtos-->	

            <?php
            $lst_categorias = selecionar("SELECT * FROM categoria WHERE id_categoria IN (select distinct id_categoria FROM produto)"
                    . "ORDER BY rand() LIMIT 5");
            foreach ($lst_categorias as $lst_categoria) {
                ?>
                <div class="cx-base-home">
                    <h1><span><?php echo $lst_categoria["categoria"] ?></span></h1>
                    <?php
                    $idCategoria = $lst_categoria["id_categoria"];
                    $lst_produtos = consultar("produto", "id_categoria = $idCategoria LIMIT 4");
                    foreach ($lst_produtos as $lst_produto){
                    ?>
                    <div class="caixa-prod-home quatro-colunas">
                        <div class="cx-img">
                            <a href="<?php echo URL_BASE ?>produto/&p="<?php echo $lst_produto["id_produto"] ?>><img src="produtos/<?php echo $lst_produto["imagem"]?>" title="<?php echo $lst_produto["produto"]?>"></a>
                        </div>		
                        <h2><a href="<?php echo URL_BASE ?>produto/&p="<?php echo $lst_produto["id_produto"]?>>
                            <?php echo limita_caracteres($lst_produto["produto"], 40)?></a></h2>
                        <div class="prc-ant">De R$ <small><?php echo $lst_produto["preco_alto"]?></small> Por R$</div>
                        <h3><?php echo $lst_produto["preco"]?></h3>

                        <div class="cx-botoes">
                            <form id="form1" name="frmcarrinho" method="post" action="<?php echo URL_BASE ?>carrinho">
                                <input name="txt_preco" 	type="hidden" id="txt_preco" value = "<?php echo $lst_produto["preco"]?>" />
                                <input name="txt_qtde" 		type="hidden" id="txt_qtde" value = "1" />
                                <input type="hidden" 		name="id_produto" value = "<?php echo $lst_produto["id_produto"]?>"/>
                                <input type="submit" 		name="imageField" class="bot-comprar" value="Comprar"  />
                            </form>
                            <div class="cx-frete"><b class="frete">FRETE</b><b class="val-frete">GRÁTIS</b></div>
                            <div class="bandeiras none" ><font><b>10x</b> nos cartões</font><img src="imagens/bandeiras2.png"></div>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            <?php }?> 
        </div>
         
    <?php include"sidebar.php" ?>
    </div>			
</div>
</div>