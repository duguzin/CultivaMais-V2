<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criar uma Conta</title>
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
            /* background-image: url(https://fontawesome.com/images/icons-gray-bg.svg); */
        }

        main {
            padding: 6rem 8rem;
        }

        .container-main-login {
            width: 100%;
            height: auto;
            background-color: #fff;
            padding: 2rem 3rem;
            border-radius: 5px;
            gap: 2rem;
            border: 1px solid #676767;
            border-bottom-left-radius: 20px;
            border-top-right-radius: 20px;
        }

        .container-login-left {
            width: 100%;
            background-color: #fff;
        }

        .container-login-left h1 {
            color: #000;
            /* color: #004E29; */
            font-size: 34px;
            font-weight: 500;
            margin-top: 20px;
        }
    
        .container-login-left h2 {
            color: #676767;
            font-size: 18px;
            font-weight: 400;
            margin-top: 20px;
        }

        .form-container {
            width: 100%; 
            padding-top: 4rem;
        }

        .logo-login img {
            width: 150px;
        }

        #input-sign-nome, #input-sign-sobrenome {
            width: 100%;
            height: 60px;
            font-size: 16px;
            border-radius: 5px;
            border: #676767 solid 1px;
            padding: 1rem;
            margin-bottom: 20px;
            outline: none;
        }

        #input-sign-nome:focus,
        #input-sign-sobrenome:focus,
        #input-sign-confirm-senha:focus,
        #input-sign-senha:focus,
        #input-sign-email:focus {
            border: 2px solid #004E29;
        }

        .buttons-sign {
            display: flex;
            align-items: center;
            gap: 20px;
            justify-content: end;
            margin-top: 80px;
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

        #data-nascimento, #input-sign-confirm-senha, 
        #input-sign-senha, #input-sign-email {
            width: 100%;
            height: 60px;
            border-radius: 5px;
            border: 1px solid #676767;
            padding: 1rem;
            font-size: 16px;
            color: #676767;
            margin-bottom: 20px;
        }

        #input-genero, #input-tipo-conta {
            width: 100%;
            height: 60px;
            border-radius: 5px;
            border: 1px solid #676767;
            padding: 1rem;
            font-size: 16px;
            color: #676767;
            margin-bottom: 20px;
            background-color: transparent;
        }

        .div-main-nome, .div-main {
            display: flex;
            gap: 1rem;
            width: 100%;
        }

        .div-nome, .div-nascimento, 
        .div-genero, .div-senha {
            width: 100%;
        }

        label {
            font-size: 16px;
            font-weight: 400;
            color: #000;
        }

        

        @media screen and (max-width: 960px) {
            body {
                background-color: #fff;
            }
            main {
                padding: 0;
            }
            .container-main-login {
                height: auto;
            }
            .div-main-nome, .div-main {
                flex-wrap: wrap;
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
                height: auto;
            }
            .container-login-left, .form-container {
                width: 100%;
            }
            .form-container {
                padding-top: 1rem;
            }
            .buttons-sign {
                justify-content: end;
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
                height: auto;
            }
            .container-login-left, .form-container {
                width: 100%;
            }
            .form-container {
                padding-top: 1rem;
            }
            .buttons-sign {
                justify-content: end;
               
            }

        }

    </style>
</head>
<body>
    <main>
        <div class="container-main-login">
            <div class="container-login-left">
              <a href="./index.html" class="logo-login"><img src="./logo.png" alt=""></a>
              <h1>Criar uma Conta</h1>
            </div>

            <div class="form-container">
                <form method="post" action="./Processos_PHP/processar_registro.php">
                    <div class="div-main-nome">
                        <div class="div-nome">
                            <label for="input-sign-nome">Nome:</label>
                            <input type="text" name="nome" placeholder="Nome" id="input-sign-nome" required>
                        </div>

                        <div class="div-nome">
                            <label for="input-sign-sobrenome">Sobrenome:</label>
                            <input type="text" name="sobrenome" placeholder="Sobrenome" id="input-sign-sobrenome">
                        </div>   
                    </div>
                   
                    <!-- <div class="div-main">
                        <div class="div-nascimento">
                            <label for="data-nascimento">Sua data de nascimento</label>
                            <input type="text" name="data_nascimento" id="data-nascimento">
                        </div>

                        <div class="div-genero">
                            <label for="input-genero">Seu gênero:</label>
                            <select name="genero" id="input-genero" required>
                                <option value="masculino">Masculino</option>
                                <option value="feminino">Feminino</option>
                            </select>
                        </div>
                    </div> -->
 
                    <label for="input-sign-email">E-mail:</label>
                    <input type="email" name="email" placeholder="Email" id="input-sign-email" required>

                    <div class="div-main">
                        <div class="div-senha">
                            <label for="input-sign-senha">Senha:</label>
                            <input type="password" name="senha" placeholder="Senha" id="input-sign-senha" required>
                        </div>

                        <div class="div-senha">
                            <label for="input-sign-confirm-senha">Confirme sua Senha:</label>
                            <input type="password" name="confirmar_senha" placeholder="Confirme Senha" id="input-sign-confirm-senha" required>
                        </div>
                    </div>

                    <label for="input-tipo-conta">Tipo de Conta:</label>
                    <select name="tipo_conta" id="input-tipo-conta" required>
                        <option value="consumidor">Consumidor</option>
                        <option value="vendedor">Vendedor</option>
                    </select> 

                    <div class="buttons-sign">
                        <button class="button-avançar" type="submit">Criar Conta</button>
                    </div>
                </form>
            </div>
        </div>
    </main>
</body>
</html>




