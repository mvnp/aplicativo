<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: text-html; charset:utf-8");
# header("Content-Type: text-html; charset:iso-8859-1");

$host = "mysql:host=wshare.com.br;dbname=wshareco_api";
$usuario = "wshareco_api";
$password = "marcos1986";

try {
    
    $conexao = new PDO($host, $usuario, $password);
    if(!$conexao) echo "Erro na conexão com o banco de dados.";

    $query = $conexao->prepare("SELECT * FROM produto ORDER BY idproduto ASC");
    $query->execute();

    $out = "[";

    while ($result = $query->fetch()) {
        
        if($out != "["){
            $out .= ",";
        }

        $out .= '{"codigo": "'.$result['idproduto'].'",';
        $out .= '"nome": "'.$result['nome_prod'].'",';
        $out .= '"descricao": "'.utf8_encode($result['descricao_prod']).'",';
        $out .= '"qtde": "'.$result['quantidade_prod'].'",';
        $out .= '"foto": "'.$result['foto_prod'].'",';
        $out .= '"valor": "'.$result['valor_prod'].'",';        
        $out .= '"status": "'.$result['status_prod'].'",';        
        $out .= '"cadastro": "'.$result['data_cadastro_prod'].'"}';
    }
    
    $out .= "]";
    echo $out;

} catch (PDOException $e) {
    echo "Erro: " . $e->getMessage();
}