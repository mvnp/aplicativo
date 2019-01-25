<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: text-html; charset:utf-8");
# header("Content-Type: text-html; charset:iso-8859-1");

$host = "mysql:host=wshare.com.br;dbname=wshareco_api";
$usuario = "wshareco_api";
$password = "marcos1986";

if(isset($_GET["username"]) || isset($_GET["password"]) ){
    if(!empty($_GET["username"]) || !empty($_GET["password"])  ){

        $conexao = new PDO($host, $usuario, $password);

        $email = $_GET["username"];
        $senha = $_GET["password"];

	    $sql = $conexao->prepare("SELECT * FROM usuario where email_user='$email'  and senha_user='$senha'");
		$sql->execute();

        $outp = "";
        if($rs=$sql->fetch()) {

            if ($outp != "") {$outp .= ",";}
            $outp .= '{"idusuario":"'  . $rs["idusuario"] . '",';
            $outp .= '"nome":"'   . $rs["nome_user"]        . '",';
            $outp .= '"email":"'   . $rs["email_user"]        . '",';
            $outp .= '"senha":"'   . $rs["senha_user"]        . '",';
            $outp .= '"nivel":"'   . $rs["nivel_user"]        . '",';
            $outp .= '"status":"'   . $rs["status_user"]        . '",';
            $outp .= '"data_cadastro_user":"'. $rs["data_cadastro_user"]     . '"}';

            $outp ='{"msg": {"logado": "sim", "texto": "logado com sucesso!"}, "dados": '.$outp.'}';

        } else {

            $outp ='{"msg": {"logado": "nao", "texto": "login ou senha invalidos!"}, "dados": {'.$outp.'}}';
        }
		
        echo utf8_encode($outp);	
    }
}