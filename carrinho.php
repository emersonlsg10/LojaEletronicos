<?php
@$id_produto = strip_tags(filter_input(INPUT_POST, "id_produto"));
@$preco = strip_tags(filter_input(INPUT_POST, "txt_preco"));
@$qtde = strip_tags(filter_input(INPUT_POST, "txt_qtde"));
$data = date("Y-m-d");
$id_cliente = 0;

if (($id_produto != "") || ($id_produto != 0)) {
    if (($idPedido == "") || ($idPedido == 0)) {
        $dados = array("data_pedido" => $data, "id_cliente" => $id_cliente);
        $idPedido = inserir("pedidos", $dados, true);
        if ($idPedido)
            $_SESSION["LJPEDIDO"] = $idPedido;
    }

    $existe = consultar("carrinho", "id_produto = $id_produto and id_pedido = $idPedido");

    //VERIFICA SE JÁ EXISTE O PRODUTO NO CARRINHO.SE EXISTIR, AUMENTA A QUANTIDADE
    if ($existe) {
        executar("UPDATE carrinho SET quantidade = quantidade + 1 WHERE id_produto = $id_produto and id_pedido = $idPedido");
    } else {
        inserir("carrinho", array("id_produto" => $id_produto, "id_pedido" => $idPedido, "valor" => $preco, "quantidade" => 1));
    }
}
//VERIFICA E LISTA OS PEDIDOS NO CARRINHO
if ($idPedido) {
    if (@$_POST["atualiza"] == "S") {
        $valores = $_POST["codProduto"];

        //pega chaves do  array
        $chave = array_keys($valores);
        for ($i = 0; $i < sizeof($chave); $i++) {
            $indice = $chave[$i];
            if ($valores[$indice]["quantidade"] > 0) {
                alterar("carrinho", array("quantidade" => $valores[$indice]['quantidade']), "id_produto = " . $valores[$indice]["ID"] . " and id_pedido = $idPedido");
            }
        }
    }
    //metodo para excluir
    if (@$_GET["p"]) {
        deletar("carrinho", "id_pedido = $idPedido and id_produto = " . $_GET["p"]);
    }
    $lst_carrinho = consultar("carrinho c, produtos p", " c.id_produto = p.id_produto and id_pedido = $idPedido");
}

if ($lst_carrinho) {
    ?>
    <div class="conteudo">
        <?php include"menu-lateral.php" ?>
        <div class="lado-dir">
            <title class="migalha">Lista de Produtos do seu Carrinho</title>
            <div class="base-carrinho">
                <div class="prog1"></div>
                <p>&nbsp;</p>


                <div class="caixa-carrinho">			
                    <form action="" method="post">
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <thead>
                                <tr>
                                    <th width="50%" align="center">Produto</th>
                                    <th width="14%" align="center">Quantidade</th>
                                    <th width="18%" align="center">Valor unitario</th>
                                    <th width="18%" align="center">Valor total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $somaTotal = 0;
                                $i = 0;
                                foreach ($lst_carrinho as $carrinho) {
                                    $subTotal = $carrinho["valor"] * $carrinho["quantidade"];
                                    $somaTotal += $subTotal;
                                    //$codProduto[$i++] = $carrinho["id_produto"];
                                    ?>
                                    <tr>
                                        <td rowspan="2"><img src="<?php echo URL_BASE ?>produtos/<?php echo $carrinho["imagem"] ?>" title="<?php echo limita_caracteres($carrinho["produto"], 40) ?>" rel="<?php echo $carrinho["produto"] ?>"><?php echo $carrinho["produto"] ?></td>
                                        <td rowspan="2" align="center"><input type="Number" name="codProduto[<?php echo $i ?>][quantidade]" id="textfield" value="<?php echo $carrinho["quantidade"] ?>" min="1" class="cont"/></td>
                                        <td rowspan="2" align="center"><h3>R$ <?php echo $carrinho["valor"] ?></h3></td>
                                        <td align="center"><h3>R$ <?php echo $carrinho["valor"] * $carrinho["quantidade"] ?></h3></td>
                                <input type="hidden" name="codProduto[<?php echo $i ?>][ID]" value="<?php echo $carrinho["id_produto"] ?>">
                                <input type="hidden" name="atualiza" value="S">  
                                </tr>
                                <tr>
                                    <td align="center">
                                        <input type="submit" value="atualizar">
                                        <a href="<?php echo URL_BASE . "carrinho/&p=" . $carrinho["id_produto"] ?>" class="excluir">Excluir</a></td>
                                </tr>
                                <?php
                                $i++;
                            }
                            ?>
                            </tbody>
                        </table>

                        <h3 class="total">Valor Total: R$ <?php echo $somaTotal ?></h3>

                        <div class="limpar"></div>
                        <div class="base-btns">
                            <a href="<?php echo URL_BASE ?>" class="produtos">ESCOLHER MAIS PRODUTOS</a>
                            <div class="botoes">
                                <a href="<?php echo URL_BASE ?>pagamento" class="comprar">Finalizar Compra</a>
                            </div>
                        </div>
                    </form>	
                </div>
            </div>

            <!--Recomendados para você-->	
            <div class="recomendamos">

                <div class="cx-base-home">
                    <h1><span>Recomendados para você</span></h1> 
                    <?php
                    $recomendados = consultar("produtos", "id_categoria = " . $lst_carrinho[0]["id_categoria"]
                            . " ORDER BY rand() LIMIT 6");
                    if ($recomendados) {
                        foreach ($recomendados as $recomendado) {
                            ?>
                            <div class="caixa-prod-home quatro-colunas">
                                <div class="cx-img">
                                    <a href="<?php echo URL_BASE ?>produto/&p=<?php echo $recomendado["id_produto"] ?>"><img src="<?php echo URL_BASE . "produtos/" . $recomendado["imagem"] ?>"></a>
                                </div>
                                <div class="limpar"></div>		
                                <h2><a href="<?php echo URL_BASE ?>produto/&p="<?php echo $recomendado["id_produto"] ?>><?php echo $recomendado["produto"] ?></a></h2>
                                <div class="prc-ant">De <small>R$ <?php echo $recomendado["preco_alto"] ?></small>&nbsp; Por</div>
                                <h3>R$ <?php echo $recomendado["preco"] ?></h3>

                                <div class="cx-botoes">
                                    <form id="form1" name="frmcarrinho" method="post" action="<?php echo URL_BASE ?>carrinho">
                                        <input name="txt_preco" 	type="hidden" id="txt_preco" value = "<?php echo $recomendado["preco"] ?>" />
                                        <input name="txt_qtde" 		type="hidden" id="txt_qtde" value = "1" />
                                        <input type="hidden" 		name="id_produto" value = "<?php echo $recomendado["id_produto"] ?>"/>
                                        <input type="submit" 		name="imageField" class="bot-comprar" value="Comprar"  />
                                    </form>
                                    <div class="cx-frete"><b class="frete">FRETE</b><b class="val-frete">GRÁTIS</b></div>
                                </div>
                            </div>
                            <?php
                        }
                    } else {
                        echo "Sem produtos cadastrados";
                    }
                    ?>
                </div>
            </div>

        </div>
    </div>
<?php
} else {
    unset($_SESSION["LJPEDIDO"]);
    ?>
    <div class="conteudo margin-topo">
        <!-- menu lateral-->
    <?php include"menu-lateral.php" ?>

        <div class="lado-dir">
            <title class="migalha">Carrinho/ vazio</title>

            <!---- carrinho vazio-------->
            <div class="base-carrinho">
                <div class="vazio">
                    <img src="<?php echo URL_BASE . "imagens/img-carrinho-vazio.png" ?>">
                    <span>
                        <h2>Seu carrinho está vazio</h2>
                        <a href="<?php echo URL_BASE ?>">Voltar para página inicial</a>
                    </span>
                </div>
            </div>

        </div>

    </div>
<?php } ?>
