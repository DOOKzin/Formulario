<?php
$erroNome ="";
$erroEmail = "";
$erroSenha ="";
$erroRepeteSenha ="";

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        //VERIFICAÇÃO SE O CAMPO NOME ESTÁ VAZIO
        if(empty($_POST['nome'])){
            $erroNome = "Digite um nome valido!";
        }else{
            $nome = clear($_POST['nome']);
            if(!preg_match("/^[a-zA-Z-' ]*$/", $nome)){
                $erroNome = "Apenas aceitamos letras e espaços em branco";
            }
        }
        //VERIFICAÇÃO SE O CAMPO EMAIL ESTÁ VAZIO
        if(empty($_POST['email'])){
            $erroEmail = "Digite um email valido!";
        }else{
            $email = clear($_POST['email']);
            if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                $erroEmail = "Email inválido!";
            }
        }
        //VERIFICAÇÃO SE O CAMPO SENHA ESTÁ VAZIO
        if(empty($_POST['senha'])){
            $erroSenha = "Digite uma senha valida!";
        }else{
            $senha = clear($_POST['senha']);
            if(strlen($senha) <6){
                $erroSenha = "A senha precisa ter no minimo 6 digitos!";
            }
        }
        //VERIFICAÇÃO SE O CAMPO REPETE_SENHA ESTÁ VAZIO
        if(empty($_POST['repete_senha'])){
            $erroRepeteSenha = "Por favor, informe a mesma senha digitada a cima!";
        }else{
            $repetesenha = clear($_POST['repete_senha']);
            if($repetesenha !== $senha){
                $erroRepeteSenha = "As senhas não são as mesmas!";
            }
        }
        if(($erroNome=="") && ($erroEmail=="") && ($erroSenha=="") && ($erroRepeteSenha=="")){
            header('Location: obrigado.php');
        }
        

    }
    

    function clear($valor){
        $valor = trim($valor);
        $valor = stripslashes($valor);
        $valor = htmlspecialchars($valor);
        return $valor;
    }
    
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teste de Formulário</title>
    <link href="CSS/estilo.css" type="text/css" rel="stylesheet">
</head>
<body>
    <main>
    <h1><span>Formulário</span><br>Validação de Formulário</h1>

     <form method="post">

        <!-- NOME COMPLETO -->
        <label> Nome Completo </label>
        <input type="text" <?php if(!empty($erroNome)){echo "class= 'invalido'";} ?> <?php if (isset($_POST['nome'])){echo "value='".$_POST['nome']."'";} ?> name="nome" placeholder="Digite seu nome" >
        <br><span class="erro"><?php echo $erroNome; ?></span>

        <!-- EMAIL -->
        <label> E-mail </label>
        <input type="email" <?php if(!empty($erroEmail)){echo "class= 'invalido'";} ?> <?php if (isset($_POST['email'])){echo "value='".$_POST['email']."'";} ?> name="email" placeholder="email@provedor.com" >
        <br><span class="erro"><?php echo $erroEmail; ?></span>

        <!-- SENHA -->
        <label> Senha </label>
        <input type="password" <?php if(!empty($erroSenha)){echo "class= 'invalido'";} ?> <?php if (isset($_POST['senha'])){echo "value='".$_POST['senha']."'";} ?> name="senha" placeholder="Digite uma senha" >
        <br><span class="erro"><?php echo $erroSenha; ?></span>

        <!-- REPETE SENHA -->
        <label> Repete Senha </label>
        <input type="password" <?php if(!empty($erroRepeteSenha)){echo "class= 'invalido'";} ?> <?php if (isset($_POST['repete_senha'])){echo "value='".$_POST['repete_senha']."'";} ?> name="repete_senha" placeholder="Repita a senha" >
        <br><span class="erro"><?php echo $erroRepeteSenha; ?></span>

        <button type="submit"> Enviar Formulário </button>

      </form>
    </main>
</body>
</html>