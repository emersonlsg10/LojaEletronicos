<?php

require_once '../../include/config.php';
require_once '../../include/crud.php';

@$id = (int) $_POST["id"];
@$acao = $_POST["acao"];

$dados = array(
    "categoria" => $_POST["txt_categoria"],
    "ativo_categoria" => $_POST["txt_ativo"]
);

$op = false;
$url_sucesso = URL_ADMIN . "index.php?link=2";
$url_erro = URL_ADMIN . "index.php?link=3";

//verifica a ação selecionada
if ($acao == "Cadastrar")
    $op = $inserir = inserir("categorias", $dados);
elseif ($acao == "Alterar")
    $op = alterar("categorias", $dados, "id_categoria = $id");
elseif ($acao == "Excluir")
    $op = deletar("categorias", "id_categoria = $id");


//verifica se deu tudo certo com a operação
if($op)
  print "<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=$url_sucesso'>
         <script type = 'text/javascript'>alert('Operação realizada com sucesso!')</script>";
else
  print "<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=$url_erro'>
         <script type = 'text/javascript'>alert('Operação não foi realizada!')</script>";
