<?php
// Escreve o conteúdo recebido pelo formulário na tela.
var_dump($_GET);

$nome_usuario = $_GET["nome_usuario"];
$senha = $_GET["senha"];
$id_perfil = $_GET["id_perfil"];

echo "O nome de usuário é: " . $nome_usuario . "<br>";
echo "A senha é: " . $senha . "<br>";
echo "O perfil é: " . $id_perfil;

switch ($id_perfil){
    case 1:
        echo"Administrador";
        break;
    case 2:
        echo"Auxiliar de matriculas";
        break;
    case 3:
        echo"Atendente";
        break;
    default:
        echo ("Erro! Perfil inválido. <br>");
        die("<a href='javascript:history.back()'>Voltar</a>");
}

if(empty($nome_usuario)){
    echo ("Erro: O nome do usuário não pode estar vazio.");
    die("<a href='javascript:history.back()'>Voltar</a>")
}