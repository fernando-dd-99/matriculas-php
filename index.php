<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <title>Título da página</title>
    <meta charset="utf-8">
  </head>
  <body>
    <h1>Meu Título!</h1>
    <p>Aqui vai o código HTML que fará seu site aparecer.</p>
    <p>Link para o Google: <a href= "https://google.com">Google</a></p>
    <table border= "1">
        <tr> <!-- Cria uma linha com dois cabeçalhos -->
            <th>ID do Curso</th>
            <th>Nome do Curso</th>
        </tr>
        <tr><!-- Cria uma segunda linha com os dados -->
            <td>1</td>
            <td>Técnico em Informática</td>
        </tr>
    </table>
    <h2>Listas</h2>
    <p><strong>Exemplo de lista ordenada (ol):</strong></p>
    <ol>
        <li>Item 1
        <ol>
            <li><i>Sub-Item1</i></li>
        </ol>
        </li>
        <li>Item 2</li>
    </ol>
    <p><strong>Exemplo de lista não-ordenada (ul):</strong></p>
    <ul>
        <li>Item 1</li>
        <li>Item 2</li>
    </ul>
    <p>Exemplo de formulário usando HTML.</p>
    <form>
        <fieldset>
            <legend><strong>Informações de cadastro</strong></legend>
            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome">
            <br>
            Sexo:
            <input type="radio" id="masculino" name="sexo" value="M">
            <label for="masculino">Masculino</label>
            <input type="radio" id="feminino" name="sexo" value="F">
            <label for="feminino">Feminino</label>
            <br>
            <label for="cursos">Curso de Interesse:</label>
            <select id="cursos" name="cursos">
                <option value="0">--- Selecione um curso ---</option>
                <option value="1">Técnico em Informática</option>
            </select>
            <br>
            <input type="submit">
            <input type="reset">
        </fieldset>
    </form>    
  </body>
</html>