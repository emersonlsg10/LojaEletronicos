<?php

$data = date("Y-m-d");
$dadosVenda = array("id_cliente" => $idCliente, "data_venda" => $data, "pago" => 'N', "forma_pagamento" => "tranferencia");

$idVenda = inserir("vendas", $dadosVenda, true);

$lst_carinhho = consultar("carrinho ", " id_pedido = $idPedido ");

foreach ($lst_carinhho as $carrinho) {
    $subtotal = $carrinho["valor"] * $carrinho["quantidade"];
    inserir("itens", array(
        "id_venda" => $idVenda,
        "id_produto" => $carrinho["id_produto"],
        "valor_item" => $carrinho["valor"],
        "qtde_item" => $carrinho["quantidade"],
        "subtotal" => $subtotal));
}

deletar("carrinho", "id_pedido = $idPedido");
deletar("pedidos", "id_pedido = $idPedido");
unset($_SESSION["LJPEDIDO"]);
$idPedido = null;

echo "<script type='text/javascript'> location.href='".URL_BASE."compra-finalizada/&v=$idVenda'</script>";

