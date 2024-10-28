<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $avaliacao = $_POST['avaliacao'] ?? 'Não especificado';
    $corFavorita = $_POST['corFavorita'] ?? 'Não especificada';
    $comentarios = htmlspecialchars(trim($_POST['comentarios'])) ?? 'Nenhum comentário';
    $nome = htmlspecialchars(trim($_POST['nome'])) ?? 'Não especificado';
    $email = filter_var(trim($_POST['email']), FILTER_VALIDATE_EMAIL);
    $fone = htmlspecialchars(trim($_POST['fone'])) ?? 'Não especificado';
    $newsletter = isset($_POST['newsletter']);

    $errors = [];
    if (empty($nome)) {
        $errors[] = "Nome é um campo obrigatório.";
    }
    if (!$email) {
        $errors[] = "O e-mail fornecido é inválido.";
    }

    if (!empty($errors)) {
        echo "<h1>Erros:</h1><ul>";
        foreach ($errors as $error) {
            echo "<li>$error</li>";
        }
        echo "</ul>";
    } else {
        echo "<h2>Dados Recebidos</h2>";
        echo "<ul>";
        echo "<li><strong>Avaliação do site:</strong> $avaliacao</li>";
        echo "<li><strong>Cor favorita:</strong> $corFavorita</li>";
        echo "<li><strong>Comentários:</strong> $comentarios</li>";
        echo "<li><strong>Nome:</strong> $nome</li>";
        echo "<li><strong>Email:</strong> $email</li>";
        echo "<li><strong>Telefone:</strong> $fone</li>";
        echo "</ul>";

        if ($email) {
            $provedor = explode('@', $email)[1];
            echo "<h2>Seu provedor de email é: <strong>$provedor</strong></h2>";
        }

        if ($newsletter) {
            echo "<h2>Enviaremos para você semanalmente todas as novidades</h2>";
        }

        $palavrasPositivas = ['Gostei', 'legal', 'bom', 'interessante', 'feliz'];
        foreach ($palavrasPositivas as $palavra) {
            if (stripos($comentarios, $palavra) !== false) {
                echo "<h2>Ficamos felizes que você deixou observações positivas sobre nosso site.</h2>";
                break;
            }
        }
        if (strcasecmp($corFavorita, 'preto') === 0) {
            echo "<script>
                alert('O preto no geral representa tristeza, solidão, medo e isolamento. Caso você não esteja bem e precisando de ajuda, acesse o site: https://cvv.org.br/');
            </script>";
        }
    }
} else {
    echo "<h2>Nenhum dado foi enviado.</h2>";
}
?>
