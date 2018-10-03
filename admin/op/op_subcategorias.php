<?php
require_once '../../include/config.php';
require_once '../../include/crud.php';

@$id = (int) $_POST["id"];
@$acao = $_POST["acao"];

$dados = array(
    "id_categoria" => $_POST["txt_id_categoria"],
    "subcategoria" => $_POST["txt_subcategoria"],
    "ativo_subcategoria" => $_POST["txt_ativo"]
);

$op = false;
$url_sucesso = URL_ADMIN . "index.php?link=4";
$url_erro = URL_ADMIN . "index.php?link=5";

//verifica a ação selecionada
if ($acao == "Cadastrar")
    $op = $inserir = inserir("subcategorias", $dados);
elseif ($acao == "Alterar")
    $op = alterar("subcategorias", $dados, "id_subcategoria = $id");
elseif ($acao == "Excluir")
    $op = deletar("subcategorias", "id_subcategoria = $id");


//verifica se deu tudo certo com a operação
if($op)
  print "<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=$url_sucesso'>
         <script type = 'text/javascript'>alert('Operação realizada com sucesso!')</script>";
else
  print "<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=$url_erro'>
         <script type = 'text/javascript'>alert('Operação não foi realizada!')</script>";

