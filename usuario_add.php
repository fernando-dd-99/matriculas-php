<?php
include_once("conexaodb.php");
// Escreve o conteúdo recebido pelo formulário na tela.
var_dump($_GET);

$nome_usuario = $_GET["nome_usuario"];
$senha = md5($_GET["senha"]);
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
    die("<a href='javascript:history.back()'>Voltar</a>");
}

if(empty($senha)){
    echo ("Erro: O campo de senha não pode estar vazia.");
    die("<a href='javascript:history.back()'>Voltar</a>");
}

// Verifica se o nome de usuário informado já existe no banco.
try{
    $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE NomeUsuario = :nome_usuario");
    $stmt->bindParam(':nome_usuario', $nome_usuario);
    $stmt->execute();

    // Retorna as linhas de resultados como um vetor (Array) associativo ao invés de tornar "array[0]"
    // para 1ª coluna, ele retorna "array[idUsuarios]", ou seja, um array associativo vincula o nome da coluna aos resultados retornados.
    $resultados = $stmt->setFetchMode(PDO::FETCH_ASSOC);

    // Pegue osresultados.
    $dados = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if(count($dados) >=1){
        echo "Erro: O nome de usuário informado já existe no banco de dados.";
        die("<a href='javascript:history.back()'>Voltar</a>");
    }
} catch(PODException $e){
    echo "Erro: ". $e->getMessage();
}

// Depois de todas as validações realizadas, criar o novo usuário no banco de dados.
try{
    $stmt = $pdo->prepare("INSERT INTO `usuarios` (`NomeUsuario`, `Senha`, `idPerfil`) VALUES (:nome_usuario, :senha, :id_perfil)");
    $stmt->bindParam(':nome_usuario', $nome_usuario);
    $stmt->bindParam(':senha', $senha);
    $stmt->bindParam(':id_perfil', $id_perfil);
    $stmt->execute();

    // Se o comando foi executado com sucesso, o número de linhas adicionadas é maior que zero.
    if($stmt->rowCount() > 0){
        echo "O usuário '" . $nome_usuario . "' foi adicionado com sucesso ao banco de dados. <br>";
        echo "Você será redirecionado automaticamente a página anterior após 5 segundos. <br>";
        // Retorna a página anterior após 5 segundos usando JavaScript.
        echo "<script>
            setTimeout(function(){
                histpry.back();
            }, 5000);
            </script>";
        echo "Caso você não seja redirecionado automaticamente, <a href='javascript:history.back()'>clique aqui</a>.";
    }
} catch(PODException $e){
    echo "Erro: ". $e->getMessage();
}