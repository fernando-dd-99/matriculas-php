<?php
include_once("conexaodb.php");

// Exibe os dados recebidos via GET
var_dump($_GET);

// Captura o nome do curso
$nome_curso = $_GET["nome_curso"];

// Validação: nome do curso não pode estar vazio
if (empty($nome_curso)) {
    echo "Erro: O nome do curso não pode estar vazio.<br>";
    die("<a href='javascript:history.back()'>Voltar</a>");
}

// Verifica se o curso já existe no banco
try {
    $stmt = $pdo->prepare("SELECT * FROM cursointeresse WHERE Nome = :nome_curso");
    $stmt->bindParam(':nome_curso', $nome_curso);
    $stmt->execute();

    $dados = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if (count($dados) >= 1) {
        echo "Erro: O curso informado já existe no banco de dados.<br>";
        die("<a href='javascript:history.back()'>Voltar</a>");
    }
} catch (PDOException $e) {
    echo "Erro ao verificar curso: " . $e->getMessage();
}

// Insere o novo curso no banco
try {
    $stmt = $pdo->prepare("INSERT INTO cursointeresse (Nome) VALUES (:nome_curso)");
    $stmt->bindParam(':nome_curso', $nome_curso);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        echo "O curso '" . $nome_curso . "' foi adicionado com sucesso ao banco de dados.<br>";
        echo "Você será redirecionado automaticamente à página anterior após 5 segundos.<br>";
        echo "<script>
                setTimeout(function(){
                    history.back();
                }, 5000);
              </script>";
        echo "Caso não seja redirecionado automaticamente, <a href='javascript:history.back()'>clique aqui</a>.";
    }
} catch (PDOException $e) {
    echo "Erro ao inserir curso: " . $e->getMessage();
}