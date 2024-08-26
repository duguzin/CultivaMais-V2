
<?php
session_start();
include('./conexao.php');

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
    <title>Faça login</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=AR+One+Sans:wght@400..700&family=Noto+Sans:ital,wght@0,100..900;1,100..900&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap');

        * {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
            /* font-family: 'Nunito', sans-serif; */
            font-family: 'AR One Sans', 'sans-serif';
        }
        
        body {
            overflow: hidden;
        }
       
        .section-login {
            background-image: url(./fundo-login.jpg);
            background-position: center;
            background-size: cover;
            background-repeat: no-repeat;
            width: 100%;
            height: 100vh;
            margin-left: 6rem;
        }

        .logo img {
            width: 60px;
            height: 60px;
            margin-bottom: 10px;
        }
        
     
        .form-container {
            width: 500px;
            height: 100%;
            background-color: #fff;
            box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
            padding: 2rem 3rem;
            position: absolute;
            top: 0;
            left: 0;
            z-index: 1;
            text-align: center;
        }  

        .form {
            width: 100%;
            display: flex;
            flex-direction: column;
            gap: 18px;
            margin-bottom: 15px;
        }

        .form-container h1 {
            text-align: center;
            font-size: 26px;
            font-weight: 800;
            color: #004E29;
            margin-bottom: 30px;
            letter-spacing: 2px;
        }

        .form-container h2 {
            text-align: center;
            font-size: 16px;
            font-weight: 800;
            color: #004E29;
            margin-bottom: 20px;
            letter-spacing: 2px;
        }

        .input-login {
            width: 100%;
            height: 55px;
            border-radius: 3px;
            border: 1px solid #c0c0c0;
            outline: 0;
            box-sizing: border-box;
            padding: 1rem;
            margin: 10px 0 20px 0;
        }

        .page-link {
            text-decoration: underline;
            margin: 0;
            text-align: end;
            color: #747474;
            text-decoration-color: #747474;
        }

        .page-link-label {
            font-size: 9px;
            font-weight: 700;
        }

        .page-link-label:hover {
            color: #000;
        }

        .button-entrar {
            padding: 1rem;
            border-radius: 3px;
            border: 0;
            outline: 0;
            background-color: #004E29;
            color: #fff;
            cursor: pointer;
            /* box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px; */
            font-size: 16px;
        }

        .form-btn:active {
            box-shadow: none;
        }

        .sign-up-label {
            margin: 0;
            font-size: 16px;
            color: #747474;
        }

        .sign-up-link {
            margin-left: 1px;
            font-size: 14px;
            text-decoration: underline;
            text-decoration-color: #004E29;
            color: #004E29;
            cursor: pointer;
            font-weight: 800;
        }

        .buttons-container {
            width: 100%;
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            margin-top: 20px;
            gap: 15px;
        }

        .div-input-login {
            text-align: left;
        }

        .span-login {
            font-size: 16px;
            color: #676767;
        }

        .div-senha {
            justify-content: space-between;
            display: flex;
        }

        .div-senha a {
            color: #004E29;
            font-size: 14px;
        }

        .apple-login-button,
        .google-login-button {
            border-radius: 3px;
            box-sizing: border-box;
            padding: 10px 15px;
            /* box-shadow: rgba(0, 0, 0, 0.16) 0px 10px 36px 0px,
                    rgba(0, 0, 0, 0.06) 0px 0px 0px 1px; */
            cursor: pointer;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 16px;
            gap: 5px;
            width: 100%;
            height: 55px;
        }

        .apple-login-button {
            background-color: #000;
            color: #fff;
            border: 2px solid #000;
        }

        .google-login-button {
            border: 2px solid #747474;
        }

        .apple-icon,
        .google-icon {
            font-size: 20px;
            margin-bottom: 1px;
        }
        /* @media screen and (max-width: 762px) {
            .form-container {
                width: 60%;
            }
        } */

        @media screen and (max-width: 800px) {
            .form-container {
                width: 100%;
                box-shadow: none;    
            }
            .section-login {
                background-image: none;
                margin-left: 0;
            }
        }

        @media screen and (max-width: 450px) {
            .form-container {
                padding: 2rem 1rem;  
            }
            
        }
    </style>
</head>
<body>
    <section class="section-login">
        <div class="form-container">
            <!-- <h2>BEM-VINDO DE VOLTA!</h2> -->
            <a href="./index.php" class="logo"><img src="./logo6.png" alt="logo"></a>
           
            <h1>Entre em Sua Conta</h1>

            <form class="form" action="./Processos_PHP/processar_login.php" method="POST">

                <div class="div-input-login">

                    <span class="span-login">E-mail</span>
                    <input type="email" name="email" class="input-login" placeholder="seunome@exemplo.com">

                    <div class="div-senha">
                        <span class="span-login">Senha</span>
                        <a href="./index.php">Esqueceu a senha?</a>
                    </div>

                    <input type="password" name="senha" class="input-login" placeholder="Digite 6 caracteres ou mais">

                    <p style="color: red;">E-mail ou senha incorretos.</p>
                    
                </div>
                            
                <button type="submit" class="button-entrar">Entrar</button>

            </form>

            <p class="sign-up-label">
                Não tem uma conta? <a href="./index.php" class="sign-up-link">Criar uma</a>
            </p>

        
            <div class="buttons-container">

              <div class="apple-login-button">
                <svg stroke="currentColor" fill="currentColor" stroke-width="0" class="apple-icon" viewBox="0 0 1024 1024" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
                  <path d="M747.4 535.7c-.4-68.2 30.5-119.6 92.9-157.5-34.9-50-87.7-77.5-157.3-82.8-65.9-5.2-138 38.4-164.4 38.4-27.9 0-91.7-36.6-141.9-36.6C273.1 298.8 163 379.8 163 544.6c0 48.7 8.9 99 26.7 150.8 23.8 68.2 109.6 235.3 199.1 232.6 46.8-1.1 79.9-33.2 140.8-33.2 59.1 0 89.7 33.2 141.9 33.2 90.3-1.3 167.9-153.2 190.5-221.6-121.1-57.1-114.6-167.2-114.6-170.7zm-105.1-305c50.7-60.2 46.1-115 44.6-134.7-44.8 2.6-96.6 30.5-126.1 64.8-32.5 36.8-51.6 82.3-47.5 133.6 48.4 3.7 92.6-21.2 129-63.7z"></path>
                </svg>

                <span>Entrar com Apple</span>

              </div>

              <div class="google-login-button">
                <svg stroke="currentColor" fill="currentColor" stroke-width="0" version="1.1" x="0px" y="0px" class="google-icon" viewBox="0 0 48 48" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
                  <path fill="#FFC107" d="M43.611,20.083H42V20H24v8h11.303c-1.649,4.657-6.08,8-11.303,8c-6.627,0-12-5.373-12-12
          c0-6.627,5.373-12,12-12c3.059,0,5.842,1.154,7.961,3.039l5.657-5.657C34.046,6.053,29.268,4,24,4C12.955,4,4,12.955,4,24
          c0,11.045,8.955,20,20,20c11.045,0,20-8.955,20-20C44,22.659,43.862,21.35,43.611,20.083z"></path>
                  <path fill="#FF3D00" d="M6.306,14.691l6.571,4.819C14.655,15.108,18.961,12,24,12c3.059,0,5.842,1.154,7.961,3.039l5.657-5.657
          C34.046,6.053,29.268,4,24,4C16.318,4,9.656,8.337,6.306,14.691z"></path>
                  <path fill="#4CAF50" d="M24,44c5.166,0,9.86-1.977,13.409-5.192l-6.19-5.238C29.211,35.091,26.715,36,24,36
          c-5.202,0-9.619-3.317-11.283-7.946l-6.522,5.025C9.505,39.556,16.227,44,24,44z"></path>
                  <path fill="#1976D2" d="M43.611,20.083H42V20H24v8h11.303c-0.792,2.237-2.231,4.166-4.087,5.571
          c0.001-0.001,0.002-0.001,0.003-0.002l6.19,5.238C36.971,39.205,44,34,44,24C44,22.659,43.862,21.35,43.611,20.083z"></path>
                </svg>

                <span>Entrar com Google</span>

              </div>
            </div>
          </div>
    </section>
        
</body>
</html>



