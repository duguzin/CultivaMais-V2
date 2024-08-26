<?php

include("./conexao.php");
// Inicie a sessão antes de acessar ou definir variáveis de sessão
session_start();

// Verifique se o usuário está logado
if (!isset($_SESSION["logado"]) || $_SESSION["logado"] !== true) {
    // Se o usuário não estiver logado, redirecione para a página de login
    header("login.php");
    exit(); // Certifique-se de sair do script após o redirecionamento
}
?>


<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./Css/style.css">
    <link rel="stylesheet" href="./Css/style_responsive.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <title>CultivaMais</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        span#nome-nav-login {
            color: #000;
            position: absolute;
            right: 60px;
            font-size: 16px;
        }
     
        body {
            background-color: #f0f2f5;           
        }
        .form-container {
            background: #fff;
            padding: 2rem;
            /* border-radius: 10px; */
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            width: 100%;
        }
        .form-header {
            margin-bottom: 20px;
            text-align: center;
        }
        .form-header h2 {
            font-size: 22px;
            font-weight: 500;
            color: #676767;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-size: 16px;
            font-weight: 500;
            color: #676767;
        }
        .form-group input, .form-group textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box; /* Added */
        }
        .form-group input[type="file"] {
            border: none;
            padding: 0;
        }
        .form-group button {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 5px;
            background-color: #004E29;
            color: white;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .form-group button:hover {
            background-color: #004E29;
        }
        .form-group i {
            margin-right: 5px;
        }
        
        .nav-add-product {
            background-color: #004E29;
            width: 100%;
            height: 60px;
            position: fixed;
            top: 0;
            left: 0;
            justify-content: space-between;
            align-items: center;
            display: flex;
            padding: 2rem;
        }
    
    
        .section-add-product {
            padding-top: 1rem;
            display: flex;
            gap: 2rem;
        }
    
        .menu-painel-left {
            background-color: #fff;
            height: 100vh;
            width: 300px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            padding: 2rem 1rem;
        }
    
        .menu-painel-left li {
            list-style: none;
            margin-bottom: 20px;
            width: 100%;
            background-color: #fff;
            height: 40px;
            border-radius: 5px;
            padding: 10px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
    
        .menu-painel-left li a {
            text-decoration: none;
            color: #000;
            font-size: 16px;
        }
    
    
        .link-perfil {
            background-color: #fff;
            border-radius: 50%;
            padding: 5px 10px;
        }
        
        .link-perfil svg {
            fill: #004E29;
        }

        .div-input-pesquisa-mobile {
            box-shadow: none;
        }
    
        
        @media screen and (max-width: 1010px) {
          .section-add-product {
              padding-top: 6rem;
          }
          .form-container {
            padding: 2rem 3rem;
          }
        }

        @media screen and (max-width: 700px) {
          .section-add-product {
              padding-top: 5rem;
          }
          .form-container {
            padding: 2rem;
          }
        }

        @media screen and (max-width: 500px) {
          .form-header h2 {
              margin-bottom: 20px;
              font-size: 20px;
          }
        }

        @media screen and (max-width: 500px) {
          .section-add-product {
              padding-top: 6rem;
          }
        }
    </style>
</head>
<body>
    <header>
    
      <nav class="nav-main">
        <div class="navbar-overlay" onclick="toggleCarrinhoOpen()"></div>
        <div class="navbar-overlay-mobile" onclick="toggleMenuOpen()"></div>
        <div class="navbar-overlay-input" onclick="toggleInputOpen()"></div>

          <div class="button-menu" onclick="toggleMenuOpen()">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M0 96C0 78.3 14.3 64 32 64H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32C14.3 128 0 113.7 0 96zM0 256c0-17.7 14.3-32 32-32H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32c-17.7 0-32-14.3-32-32zM448 416c0 17.7-14.3 32-32 32H32c-17.7 0-32-14.3-32-32s14.3-32 32-32H416c17.7 0 32 14.3 32 32z"/></svg>
          </div>

          <form class="input-pesquisa" action="pesquisar.php" method="GET">
              <input type="text" name="termo" class="input-pesquisa-active" placeholder="O que você está procurando?" required>
              <svg xmlns="http://www.w3.org/2000/svg" onclick="toggleInputOpen()" viewBox="0 0 512 512" id="svg-input"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352a144 144 0 1 0 0-288 144 144 0 1 0 0 288z"/></svg>
              <button type="submit" id="button-serch"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352a144 144 0 1 0 0-288 144 144 0 1 0 0 288z"/></svg></button>
          </form>

          <div class="div-fantasma"></div>

          <a href="./index.html" class="logo"><img src="./logo6.png" alt=""></a>

          <div class="div-input-cart-nav"> 
            <div class="svg-carrinho-mobile" onclick="toggleCarrinhoOpen()">
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M0 24C0 10.7 10.7 0 24 0H69.5c22 0 41.5 12.8 50.6 32h411c26.3 0 45.5 25 38.6 50.4l-41 152.3c-8.5 31.4-37 53.3-69.5 53.3H170.7l5.4 28.5c2.2 11.3 12.1 19.5 23.6 19.5H488c13.3 0 24 10.7 24 24s-10.7 24-24 24H199.7c-34.6 0-64.3-24.6-70.7-58.5L77.4 54.5c-.7-3.8-4-6.5-7.9-6.5H24C10.7 48 0 37.3 0 24zM128 464a48 48 0 1 1 96 0 48 48 0 1 1 -96 0zm336-48a48 48 0 1 1 0 96 48 48 0 1 1 0-96z"/></svg>
            </div>
          </div>

          <div style="display: flex;">
          <div class="svg-carrinho" onclick="toggleCarrinhoOpen()">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M0 24C0 10.7 10.7 0 24 0H69.5c22 0 41.5 12.8 50.6 32h411c26.3 0 45.5 25 38.6 50.4l-41 152.3c-8.5 31.4-37 53.3-69.5 53.3H170.7l5.4 28.5c2.2 11.3 12.1 19.5 23.6 19.5H488c13.3 0 24 10.7 24 24s-10.7 24-24 24H199.7c-34.6 0-64.3-24.6-70.7-58.5L77.4 54.5c-.7-3.8-4-6.5-7.9-6.5H24C10.7 48 0 37.3 0 24zM128 464a48 48 0 1 1 96 0 48 48 0 1 1 -96 0zm336-48a48 48 0 1 1 0 96 48 48 0 1 1 0-96z"/></svg>
            <p>( 0 )</p>
          </div>
          <a class="link-perfil" href="./login.html">
            <svg xmlns="http://www.w3.org/2000/svg" height="1.5em" viewBox="0 0 448 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512H418.3c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304H178.3z"/></svg>
          </a>
          </div>
          
          <div class="menu-carrinho">
            <div class="header-menu-carrinho">
              <h1>Seu carrinho</h1>
            </div>
            <div class="item-carrinho">
              <span>Seu carrinho ainda está vazio</span>
            </div>
          </div>
      </nav>

      <nav class="nav-menu">

        <li class="nav-list"><a href="./index.html" class="nav-links">Início</a></li>
        <li class="nav-list"><a href="./add-product.html" class="nav-links">Ofertas</a></li>
        <li class="nav-list"><a href="./meus-produtos.html" class="nav-links">Vender</a></li>
        <li class="nav-list"><a href="./painel.html" class="nav-links">Contato</a></li>
        
        <?php
          // Verifique se o usuário está logado
          if (isset($_SESSION["email"])) {
              // Se estiver logado, exiba a mensagem de boas-vindas com a classe desejada
              echo "<span id='nome-nav-login'>Olá, " . $_SESSION["nome"] . "!</span>";
          }
        ?>
      </nav>

      <nav class="nav-menu-mobile">
        <li class="nav-list"><a href="./add_product.php" class="nav-links">Adicionar produtos</a></li>
        <li class="nav-list"><a href="./meus_produtos.php" class="nav-links">Meus produtos</a></li>
        <li class="nav-list"><a href="#" class="nav-links">Minha Loja</a></li>
        <li class="nav-list"><a href="./meus-clientes.html" class="nav-links">Meus Clientes</a></li>
        <li class="nav-list"><a href="./status-pedido.html" class="nav-links">Meus Pedidos</a></li>
      </nav>

        <div class="swiper-text textSwiper" style="--swiper-navigation-color: #fff; --swiper-pagination-color: #2ca0da">
         <div class="swiper-wrapper">
           <div class="swiper-slide" id="swiper-slide-text">
                <p>Frete grátis a partir de R$150</p>
            </div>
           <div class="swiper-slide" id="swiper-slide-text">
                <p>Temos os melhores padrões de qualidade</p>
            </div>
        </div>

        <form class="div-input-pesquisa-mobile" action="pesquisar.php" method="GET">
            <div class="input-pesquisa-mobile">
              <input type="text" name="termo" placeholder="O que você está procurando?">
                <button id="button-serch-mobile" type="submit">
                  <svg xmlns="http://www.w3.org/2000/svg" onclick="toggleInputOpen()" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352a144 144 0 1 0 0-288 144 144 0 1 0 0 288z"/></svg>
                </button>
            </div>
        </form>

    </header>

    <main>
        <section class="section-add-product">
            <div class="menu-painel-left">
                <li id="active"><a href="#">Adicionar produtos</a></li>
                <li><a href="./meus-produtos.html">Meus produtos</a></li>
                <li><a href="#">Minha Loja</a></li>
                <li><a href="./meus-clientes.html">Meus Clientes</a></li>
                <li><a href="./status-pedido.html">Meus Pedidos</a></li>
            </div>

          <?php
                    // Verifique se um ID de produto foi fornecido
                    if (isset($_GET['id']) && !empty($_GET['id'])) {
                        $produto_id = $_GET['id'];

                        // Consulta SQL para buscar os dados do produto com base no ID fornecido
                        $sql = "SELECT * FROM produtos WHERE id = ?";
                        $stmt = $conn->prepare($sql);
                        $stmt->bind_param("i", $produto_id);
                        $stmt->execute();
                        $result = $stmt->get_result();

                        // Verifique se o produto foi encontrado
                        if ($result->num_rows > 0) {
                            // Recupere os dados do produto
                            $produto = $result->fetch_assoc();
                            $produto_nome = $produto['nome'];
                            $produto_descricao = $produto['descricao'];
                            $produto_preco = $produto['preco'];

                            // Exiba um formulário preenchido com os dados do produto
            ?>

            <div class="form-container">
                <div class="form-header">
                    <h2><i class="fas fa-plus-square"></i> Editar Produto</h2>
                </div>
                <form action="atualizar_produto.php" method="POST">
                    <div class="form-group">
                        <label for="produto_nome">Nome do Produto:</label>
                        <input type="hidden" name="produto_id" value="<?php echo $produto_id; ?>">
                        <input type="text" name="produto_nome" value="<?php echo $produto_nome; ?>">
                    </div>
                    <div class="form-group">
                        <label for="produto_nome">Descrição:</label>
                        <textarea name="produto_descricao"><?php echo $produto_descricao; ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="productPrice">Preço:</label>
                        <input type="text" name="produto_preco" value="<?php echo $produto_preco; ?>"><br>
                    </div>

                    <div class="form-group">
                        <button type="submit" value="Atualizar Produto"><i class="fas fa-cloud-upload-alt"></i> Atualizar Produto</button>
                    </div>
                </form>
            </div>

            <?php
                    } else {
                      echo "Produto não encontrado.";
                    }

                        // Feche a conexão e libere os recursos
                        $stmt->close();
                        $conn->close();
                    } else {
                        echo "ID do produto não fornecido.";
                    }
            ?>


        </section>
    </main>
    
    <script src="./Js/script.js"></script>
    <script type="module">
        import Swiper from 'https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.esm.browser.js'
  
        var swiper = new Swiper(".cardSwiper", {
          autoplay: {
          delay: 30000,
          disableOnInteraction: false,
        },
        navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
      },
    slidesPerView: 1,
    spaceBetween: 30,
    grabCursor: true,
    pagination: {
      el: ".swiper-pagination-card",
      clickable: true,
    },
    breakpoints: {
      1230: {
        slidesPerView: 4,
        spaceBetween: 30,
      },
      992: {
        slidesPerView: 3,
        spaceBetween: 20,
      },
      768: {
        slidesPerView: 2,
        spaceBetween: 20,
      }
    }
  });
  
  window.addEventListener('resize', function () {
    swiper.update(); // Atualiza o swiper quando a janela for redimensionada
  });
  var swiper = new Swiper(".swiper-card-img-item ", {
          autoplay: {
          delay: 30000,
          disableOnInteraction: false,
        },
        navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
      },
    slidesPerView: 1,
    spaceBetween: 30,
    grabCursor: true,
    pagination: {
      el: ".swiper-pagination-card",
      clickable: true,
    },
    breakpoints: {
      1230: {
        slidesPerView: 4,
        spaceBetween: 30,
      },
      992: {
        slidesPerView: 3,
        spaceBetween: 20,
      },
      768: {
        slidesPerView: 2,
        spaceBetween: 20,
      }
    }
  });
  
  window.addEventListener('resize', function () {
    swiper.update(); // Atualiza o swiper quando a janela for redimensionada
  });

  var swiper = new Swiper(".textSwiper", {
        autoplay: {
        delay: 10000,
        disableOnInteraction: false,
      },
      keyboard: {
        enabled: true,
      },
      speed: 600,
      parallax: true,
      direction: 'horizontal',
      loop: true,
      // pagination: {
      //   el: ".swiper-pagination",
      //   clickable: true,
      //   centeredSlides: true,

      // },
      // navigation: {
      //   nextEl: ".swiper-button-next",
      //   prevEl: ".swiper-button-prev",
      // },
    });
</script>


</body>
</html>