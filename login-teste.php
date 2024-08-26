<?php
session_start();
include('conexao.php');

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["email"]) && isset($_POST["senha"])) {
    $email = $_POST["email"];
    $senha = $_POST["senha"];

    $sql = "SELECT id_usuario, nome, tipo_conta FROM usuarios WHERE email = ? AND senha = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $email, $senha);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $_SESSION["id_usuario"] = $row["id_usuario"];
        $_SESSION["nome"] = $row["nome"];
        $_SESSION["tipo_conta"] = $row["tipo_conta"];

        header("Location: index.php");
        exit();
    } else {
        header("Location: login_erro.php");
        exit();
    }
}
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Entrar</title>
    
    <style>
    @import url('https://fonts.googleapis.com/css2?family=AR+One+Sans:wght@400..700&family=Noto+Sans:ital,wght@0,100..900;1,100..900&display=swap');
        
        * {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
            font-family: 'AR One Sans', 'sans-serif';
            
        }

        body {
            background-color: #fff;
            /* background-image: url(https://img.freepik.com/fotos-premium/campo-de-amadurecimento-verde-paisagem-agricola-o-conceito-de-agricultura-natural-generative-ai_87561-1886.jpg); 
            background-position: center;
            background-size: cover; */
        }

        main {
            padding: 8rem 10rem;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .container-main-login {
            width: 80%;
            height: 450px;
            background-color: #fff;
            display: flex;
            padding: 2rem 3rem;
            border-radius: 5px;
            gap: 2rem;
            border: 1px solid #676767;
            border-bottom-left-radius: 20px;
            border-top-right-radius: 20px;
        }

        .container-login-left {
            width: 50%;
            background-color: #fff;
        }

        .container-login-left h1 {
            color: #000;
            /* color: #004E29; */
            font-size: 34px;
            font-weight: 400;
            margin-top: 20px;
        }
    
        .container-login-left h2 {
            color: #676767;
            font-size: 18px;
            font-weight: 400;
            margin-top: 20px;
        }

        .form-container {
            width: 50%; 
            padding-top: 4rem;
        }

        .logo-login img {
            width: 45px;
            height: 45px;
        }

        #input-login {
            width: 100%;
            height: 60px;
            font-size: 16px;
            border-radius: 5px;
            border: #676767 solid 1px;
            padding: 1rem;
            margin-bottom: 20px;
            outline: none;
        }

        #input-login:focus {
            border: 2px solid #004E29;
        }

        .buttons-login {
            display: flex;
            align-items: center;
            gap: 20px;
            justify-content: end;
            margin-top: 80px;
        }

        .a-criar-conta {
            text-decoration: none;
            cursor: pointer;
            color: #000;
            font-size: 18px;
            font-weight: 500;
        }

        .button-avançar {
            background-color: #004E29;
            color: #fff;
            border-radius: 5px;
            border: none;
            font-size: 16px;
            width: 40%;
            height: 40px;
            cursor: pointer;
        }

        .button-avançar a {
            text-decoration: none;
            color: #fff;
        }

        .linha {
            width: 1px;
            height: 100%;
            background-color: #676767;
        }

        .menu-tipo-conta {
            width: 200px;
            height: 100px;
            background-color: #eee;
            border-radius: 5px;
            box-shadow: 5px 5px 5px rgba(0, 0, 0, 0.1);
            padding: 1rem;
        }

        .menu-tipo-conta li {
            list-style-type: none;
            margin-bottom: 1rem;
        }

        .menu-tipo-conta li a {
            text-decoration: none;
            color: #676767;
            font-size: 18px;
            font-weight: 500;
            letter-spacing: 1px;
        }

        @media screen and (max-width: 1500px) {
            main {
                padding: 8rem 6rem;
            }
        }

        @media screen and (max-width: 1200px) {
            main {
                padding: 8rem 4rem;
            }
        }

        @media screen and (max-width: 960px) {
            body {
                background-color: #fff;
            }
            main {
                padding: 0;
            }
            .container-main-login {
                height: 100vh;
                width: 100%;
            }

        }

        @media screen and (max-width: 660px) {
            body {
                background-color: #eee;
            }
            main {
                padding: 2rem 3rem;
            }
            .container-main-login {
                flex-wrap: wrap;
                height: 100vh;
                width: 100%;
            }
            .container-login-left, .form-container {
                width: 100%;
            }
            .form-container {
                padding-top: 1rem;
            }
            .buttons-login {
                justify-content: space-between;
            }

        }

        @media screen and (max-width: 560px) {
            body {
                background-color: #fff;
            }
            main {
                padding: 0;
            }
            .container-main-login {
                flex-wrap: wrap;
                padding: 2rem;
                height: 100vh;
                width: 100%;
            }
            .container-login-left, .form-container {
                width: 100%;
            }
            .form-container {
                padding-top: 1rem;
            }
            .buttons-login {
                justify-content: space-between;
               
            }

        }
        </style>

</head>
<body>
    <main>
        <div class="container-main-login">
            <div class="container-login-left">
              <a href="./index.html" class="logo-login"><img src="./logo6.png" alt=""></a>
              <h1>Fazer Login</h1>
              <h2>Entre na sua Conta</h2>
            </div>

            <div class="form-container">
                <form action="Processos_PHP/processar_login.php" method="POST">
                    <input type="text" name="email" placeholder="E-mail ou Telefone" id="input-login" required>
                    <input type="password" name="senha" placeholder="Senha" id="input-login" required>
                    
                    <!-- Exibir a mensagem de erro -->
                    <?php if (!empty($mensagem_erro)) { ?>
                        <p style="color: red;"><?php echo $mensagem_erro; ?></p>
                    <?php } ?>
                    
                    <div class="buttons-login">
                        <a href="./sign.php" class="a-criar-conta">Criar conta</a>
                        <button type="submit" class="button-avançar">Entrar</button>
                    </div>
                </form>
                </div>


        </div>
    </main>
</body>
</html>



