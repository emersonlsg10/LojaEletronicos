<?php

session_start();
require ("include/config.php");
require ("include/crud.php");
require ("include/biblio.php");

$url_sucesso = URL_BASE . "pagamento";
$url_erro = URL_BASE . "nao-logado";

$senha = strip_tags(filter_input(INPUT_POST, "tx_senha"));
$email = strip_tags(filter_input(INPUT_POST, "tx_email"));


if (($senha) && ($email)) {
    $cliente = consultar("clientes", "email = '$email' AND senha = '$senha'");

    if ($cliente) {
//        $idCliente = @$_SESSION["LJCLIENTE"]["id_cliente"];
        foreach ($cliente as $c) {
            $_SESSION["LJCLIENTE"] = $c;
        }
        echo "<script language = 'javascript'>window.location.href='$url_sucesso'</script>";
    } else {
        print "<META HTTP-EQUIV=REFRESH CONTENT = '0; URL=$url_erro'>
<script type = 'text/javascript'> alert('Usuário/Senha inválidos!') </script>";
    }
} else {
    print "<META HTTP-EQUIV=REFRESH CONTENT = '0; URL=$url_erro'>
<script type = 'text/javascript'> alert('Preencha os campos usuário e senha!') </script>";
}