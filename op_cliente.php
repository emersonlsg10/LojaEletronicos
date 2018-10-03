<?php

session_start();
require ("include/config.php");
require ("include/crud.php");
require ("include/biblio.php");
if($_GET["venda"] == "s")
    $url_sucesso = URL_BASE . "pagamento";
else
    $url_sucesso = URL_BASE . "cadastro";

$url_erro = URL_BASE . "nao-logado";

$data = date("Y-m-d");

$nome = strip_tags(filter_input(INPUT_POST, "txt_cliente"));
$email = strip_tags(filter_input(INPUT_POST, "txt_email"));

$dados = array(
    "cliente" => trim(strip_tags(filter_input(INPUT_POST, "txt_cliente"))),
    "endereco" => trim(strip_tags(filter_input(INPUT_POST, "txt_endereco"))),
    "bairro" => trim(strip_tags(filter_input(INPUT_POST, "txt_bairro"))),
    "cep" => trim(strip_tags(filter_input(INPUT_POST, "txt_cep"))),
    "cidade" => trim(strip_tags(filter_input(INPUT_POST, "txt_cidade"))),
    "fone" => trim(strip_tags(filter_input(INPUT_POST, "txt_fone"))),
    "uf" => trim(strip_tags(filter_input(INPUT_POST, "txt_uf"))),
    "email" => trim(strip_tags(filter_input(INPUT_POST, "txt_email"))),
    "senha" => trim(strip_tags(filter_input(INPUT_POST, "txt_senha"))),
    "ativo_cliente" => "S",
    "data_cadastro" => $data,
);

if (($nome) && ($email)) {
    $cliente = consultar("clientes", "email = '$email'");

    //VERIFICA SE ESSE EMAIL JÁ FOI CADASTRADO
    if (!$cliente) {
        $ok = inserir("clientes", $dados);

        //seta os dados do cliente na SESSION
        $cliente = consultar("clientes", "email = '$email'");
        foreach ($cliente as $c) {
            $_SESSION["LJCLIENTE"] = $c;
        }
    } else {
        print "<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=$url_erro'>
<script type = 'text/javascript'> alert('Esse email já foi cadastrado. Utilize outro!') </script>";
    }
    if (@$ok) {
        print "<META HTTP-EQUIV=REFRESH CONTENT = '0; URL=$url_sucesso'>
<script type = 'text/javascript'> alert('Cadastro efetuado com sucesso') </script>";
    }
}
//else {
//    print "<META HTTP-EQUIV=REFRESH CONTENT = '0; URL=$url_erro'>
//<script type = 'text/javascript'> alert('Operação não realizada!') </script>";
//}