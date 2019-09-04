<?php
$project_company = "WeON";
$project_dir = "./project";
$desc = '
<div dir="ltr">
    Olá, conforme conversamos segue abaixo o teste de seleção,
    <br>
    <br>O teste consiste em criar um sistema bem pequeno, este sistema deve possuir uma tela de login e uma tela para manter usuários. Deve ser desenvolvido em PHP. O banco de dados a ser utilizado deve ser o PostgreSQL.
    <br>
    <br>Pontos que serão avaliados
    <br>
    <br>Conceito aplicado em OOP
    <br>Modelagem das classes
    <br>Clareza do código
    <br>Métodos e lógica de programação
    <br>Nome de variáveis deve ser em inglês
    <br>Nome de classes e métodos deve ser em inglês
    <br>Utilizar um framework PHP (Laravel)
    <br>
    <br>Diferencial
    <br>
    <br>Implementar todas as regras de negócio
    <br>Utilizar um framework JavaScript como jQuery, jQuery UI
    <br>Utilizar um framework HTML como Bootstrap
    <br>Utilizar AJAX para a criação do usuário, alterar, etc.
    <br>
    <br>Em anexo segue o dump com a criação da estrutura do banco de dados, bem como os dados básicos. Também segue um protótipo das telas com as suas regras.
    <br>
    <br>Qualquer dúvida estou a disposição, me confirme o recebimento do e-mail por gentileza.
    <div>
        <br>
    </div>
    <div>O código-fonte deve ser hospeado no Github e deve ser enviado no meu e-mail até Terça-Feira (03/08/2019) 18:00h.
        <br>
        <div>
            <br>Abraços e boa sorte
            <br>--
            <br>

        </div>
    </div>
</div>
';
?>
<!doctype html>
<html>
<head>
   <title>Project Details <?=$project_company ?></title>
</head>
<body>

<?php
$link_proj= "<a href='".$project_dir."'>Go to project</a><br><hr><br><h2>Project Details</h2>";
echo nl2br($link_proj.$desc);

?>
</body>
</html>
