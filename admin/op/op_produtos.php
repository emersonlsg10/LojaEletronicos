<?php
require_once '../../include/config.php';
require_once '../../include/crud.php';

@$id = (int) $_POST["id"];
@$acao = $_POST["acao"];

$dados = array(
    "id_categoria" => trim($_POST["txt_id_categoria"]),
    "id_subcategoria" => trim($_POST["txt_id_subcategoria"]),
    "id_fabricante" => trim($_POST["txt_id_fabricante"]),
    "ativo_produto" => trim($_POST["txt_ativo"]),
    "produto" => trim($_POST["txt_produto"]),
    "imagem" => trim($_POST["txt_imagem"]),
    "preco_alto" => trim($_POST["txt_preco_alto"]),
    "preco" => trim($_POST["txt_preco"]),
    "descricao" => trim($_POST["txt_descricao"]),
    "detalhes" => trim($_POST["txt_detalhes"]),
    "destaque" => trim($_POST["txt_destaque"])
);

$op = false;
$url_sucesso = URL_ADMIN . "index.php?link=6";
$url_erro = URL_ADMIN . "index.php?link=7";

//verifica a ação selecionada
if ($acao == "Cadastrar")
    $op = $inserir = inserir("produtos", $dados);
elseif ($acao == "Alterar")
    $op = alterar("produtos", $dados, "id_produto = $id");
elseif ($acao == "Excluir")
    $op = deletar("produtos", "id_produto = $id");


//verifica se deu tudo certo com a operação
if($op)
  print "<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=$url_sucesso'>
         <script type = 'text/javascript'>alert('Operação realizada com sucesso!')</script>";
else
  print "<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=$url_erro'>
         <script type = 'text/javascript'>alert('Operação não foi realizada!')</script>";

