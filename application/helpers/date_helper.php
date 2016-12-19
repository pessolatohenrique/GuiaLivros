<?php
/*Helper, criado pelo próprio desenvolvedor, com o objetivo de formatar datas*/
function convertToAmerican($data){
	$novaData = "";
	if($data != ""){
		$dataExplode = explode("/",$data);
		$novaData = $dataExplode[2]."-".$dataExplode[1]."-".$dataExplode[0];
	}
	return $novaData;
}
function convertToBrazilian($data){
	$dataExplode = explode("-",$data);
	$novaData = $dataExplode[2]."/".$dataExplode[1]."/".$dataExplode[0];
	return $novaData;
}