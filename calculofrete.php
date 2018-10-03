<?php

$valores = array();
$valores["nCdEmpresa"] = "";
$valores["sDsSenha"] = "";
$valores["nCdServico"] = "40010";
$valores["sCepOrigem"] = "70002900";
$valores["sCepDestino"] = "71090960";
$valores["nVlPeso"] = "1";
$valores["nCdFormato"] = "1";
$valores["nVlComprimento"] = "30";
$valores["nVlAltura"] = "30";
$valores["nVlLargura"] = "30";
$valores["nVlDiametro"] = "0";
$valores["sCdMaoPropria"] = "n";
$valores["nVlValorDeclarado"] = "0";
$valores["sCdAvisoRecebimento"] = "n";
$valores["StrRetorno"] = "xml";

$valores = http_build_query($valores);
$url = "http://ws.correios.com.br/calculador/CalcPrecoPrazo.aspx";

//envia os dados para o sistema dos correios e retorna um xml com os dados
$curl = curl_init($url."?".$valores);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
$retorno = curl_exec($curl);
$retorno = simplexml_load_string($retorno);

foreach ($retorno as $resultado) {
    if ($retorno->Erro == 0)
        echo $resultado->valor;
    else
        echo $resultado->MsgErro;
}

