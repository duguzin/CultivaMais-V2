<?php

include("conexao.php");

session_start(); // Inicie a sessão antes de acessar ou definir variáveis de sessão

// Verificar se o usuário está logado e se o ID do usuário está definido
if (!isset($_SESSION["logado"]) || $_SESSION["logado"] !== true || !isset($_SESSION["usuario_id"])) {
    // Redirecionar o usuário para a página de login ou exibir uma mensagem de erro
    header("Location: login.php");
    exit();
}

// Recuperar o ID do usuário da sessão
$usuario_id = $_SESSION['usuario_id'];

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

        .logo img {
           width: 45px;
           height: 45px;
      }
     
        body {
            background-color: #f0f2f5;           
        }

        span#nome-nav-login {
        color: #000;
        position: absolute;
        right: 60px;
        font-size: 16px;
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


        .container-table {
            width: 100%;
            background: white;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            /* overflow: hidden; */
        }
        .table-header {
            background-color: #046136;
            color: white;
            font-size: 20px;
            padding: 20px 15px;
            text-align: center;
        }
        table {
            width: 100%;
            border-spacing: 0;
        }
        th, td {
            text-align: left;
            padding: 15px;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #097945;
            color: white;
            font-size: 16px;
            font-weight: 500;
        }
        tbody tr:nth-child(odd) {
            background-color: #eee;
        }
        .product-img {
            width: 60px;
            height: 60px;
            border-radius: 30px;
            object-fit: cover;
        }
        .action-icons {
            cursor: pointer;
            font-size: 18px;
        }
        .edit-icon {
            color: #f6b93b;
            margin-right: 20px;
        }
        .delete-icon {
            color: #e55039;
        }

        .edit-btn, .delete-btn {
          border: none;
          background: transparent;
          cursor: pointer;
          font-size: 16px;
          transition: .3s ease;
        }

        .edit-btn:hover, .delete-btn:hover {
          transform: scale(1.1);
        }

        .desc-table {
          width: 100px;
          height: 40px;
          overflow: hidden;
          text-overflow: ellipsis;
        }


        @media screen and (max-width: 768px) {
            th, td {
            display: block;
            text-align: right;
            }
            th {
            display: none;
            }
            td {
            text-align: right;
            padding-left: 50%;
            position: relative;
            }
            td:before {
            content: attr(data-label);
            position: absolute;
            left: 0;
            width: 50%;
            padding-left: 15px;
            font-weight: bold;
            text-align: left;
            }
            .product-img {
            width: 40px;
            height: 40px;
            border-radius: 20px;
            }
        }
    
        
        @media screen and (max-width: 1010px) {
          .section-add-product {
              padding-top: 7rem;
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
          .form-container {
            padding: 1rem;
          }
        }

        @media (max-width: 1010px) {
        .section-main {
          padding-top: 10rem;
        }
        .svg-menu-painel {
          border: none;
          padding: 0;
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

          <div class="input-pesquisa">
            <input type="text" class="input-pesquisa-active" placeholder="O que você está procurando?">
            <svg xmlns="http://www.w3.org/2000/svg" onclick="toggleInputOpen()" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352a144 144 0 1 0 0-288 144 144 0 1 0 0 288z"/></svg>
          </div>

          <div class="div-fantasma"></div>

          <a href="./index.html" class="logo"><img src="./logo6.png" alt=""></a>

          <!-- <div class="div-input-cart-nav"> 
            <div class="svg-carrinho-mobile" onclick="toggleCarrinhoOpen()">
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path d="M0 24C0 10.7 10.7 0 24 0H69.5c22 0 41.5 12.8 50.6 32h411c26.3 0 45.5 25 38.6 50.4l-41 152.3c-8.5 31.4-37 53.3-69.5 53.3H170.7l5.4 28.5c2.2 11.3 12.1 19.5 23.6 19.5H488c13.3 0 24 10.7 24 24s-10.7 24-24 24H199.7c-34.6 0-64.3-24.6-70.7-58.5L77.4 54.5c-.7-3.8-4-6.5-7.9-6.5H24C10.7 48 0 37.3 0 24zM128 464a48 48 0 1 1 96 0 48 48 0 1 1 -96 0zm336-48a48 48 0 1 1 0 96 48 48 0 1 1 0-96z"/></svg>
            </div>
          </div> -->

          <div style="display: flex; gap: 1rem;">
            
            <div class="svg-carrinho" onclick="toggleCarrinhoOpen()">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M0 24C0 10.7 10.7 0 24 0H69.5c22 0 41.5 12.8 50.6 32h411c26.3 0 45.5 25 38.6 50.4l-41 152.3c-8.5 31.4-37 53.3-69.5 53.3H170.7l5.4 28.5c2.2 11.3 12.1 19.5 23.6 19.5H488c13.3 0 24 10.7 24 24s-10.7 24-24 24H199.7c-34.6 0-64.3-24.6-70.7-58.5L77.4 54.5c-.7-3.8-4-6.5-7.9-6.5H24C10.7 48 0 37.3 0 24zM128 464a48 48 0 1 1 96 0 48 48 0 1 1 -96 0zm336-48a48 48 0 1 1 0 96 48 48 0 1 1 0-96z"/></svg>
                <p>( 0 )</p>
            </div>

            <?php if (isset($_SESSION["email"])): // Verifica se o usuário está logado ?>

              <?php if ($_SESSION["tipo_conta"] == "vendedor"): // Usuário é um vendedor ?>

                <!-- Conteúdo para vendedores -->
                <div class="svg-menu-painel" onclick="toggleMenuPainel()">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                        <!-- Ícone representando 'Minha Loja' -->
                        <path d="M64 0C28.7 0 0 28.7 0 64V352c0 35.3 28.7 64 64 64H240l-10.7 32H160c-17.7 0-32 14.3-32 32s14.3 32 32 32H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H346.7L336 416H512c35.3 0 64-28.7 64-64V64c0-35.3-28.7-64-64-64H64zM512 64V288H64V64H512z"/>
                    </svg>
                    <!-- <p>Minha Loja</p> -->
                </div>

              <?php else: // Usuário é um consumidor ?>

                <!-- Conteúdo para consumidores -->
                <!-- Link para a página de login -->
                <form action="" method="post">
                  <button type="submit" name="logout" class="svg-menu-painel">
                      <svg xmlns="http://www.w3.org/2000/svg" height="1.5em" viewBox="0 0 448 512">
                          <!-- Ícone de logout -->
                          <path d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512H418.3c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304H178.3z"/>
                      </svg>
                      <p>Sair</p>
                  </button>
                </form>

              <?php endif; ?>

              <?php else: // Usuário não está logado ?>

                <!-- Link para a página de login -->
                <a class="link-perfil" href="./login.php">
                    <svg xmlns="http://www.w3.org/2000/svg" height="1.5em" viewBox="0 0 448 512">
                        <!-- Ícone de login -->
                        <path d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512H418.3c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304H178.3z"/>
                    </svg>
                </a>

              <?php endif; ?>

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
        <li class="nav-list"><a href="./add-product.php" class="nav-links">Ofertas</a></li>
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

        <div class="div-input-pesquisa-mobile">
          <div class="input-pesquisa-mobile">
            <svg xmlns="http://www.w3.org/2000/svg" onclick="toggleInputOpen()" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352a144 144 0 1 0 0-288 144 144 0 1 0 0 288z"/></svg>
              <input type="text" placeholder="O que você está procurando?">
          </div>
        </div>

    </header>

    <main>
        <section class="section-add-product">
          <div class="menu-painel-left">
            <li><a href="./add_product.php">Add. produtos</a></li>
            <li id="active"><a href="./meus-produtos.html">Meus produtos</a></li>
            <li><a href="./minha_loja.php">Minha Loja</a></li>
            <li><a href="./meus-clientes.html">Meus Clientes</a></li>
            <li><a href="./status-pedido.html">Meus Pedidos</a></li>
        </div>

        <div class="container-table">
            <div class="table-header">
                <h2>Meus Produtos</h2>
            </div>
            <?php
              // Consulta SQL para buscar os produtos do usuário logado
              $sql = "SELECT * FROM produtos WHERE usuario_id = ?";
              $stmt = $conn->prepare($sql);
              $stmt->bind_param("i", $usuario_id);
              $stmt->execute();
              $result = $stmt->get_result();

              // Verifique se a consulta foi bem-sucedida
if ($result) {
    // Verifique se existem produtos
    if ($result->num_rows > 0) {
        ?>
        <table>
            <thead>
                <tr>
                    <th>Imagem</th>
                    <th>Nome</th>
                    <th>Descrição</th>
                    <th>Preço</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <?php
                    $produto_id = $row['id'];

                    // Busque todas as imagens relacionadas ao produto
                    $sql_imagens = "SELECT imagem_path FROM produto_imagens WHERE produto_id = ?";
                    $stmt_imagens = $conn->prepare($sql_imagens);
                    $stmt_imagens->bind_param("i", $produto_id);
                    $stmt_imagens->execute();
                    $result_imagens = $stmt_imagens->get_result();

                    // Obtenha todas as imagens do produto
                    $imagens = [];
                    while ($imagem_row = $result_imagens->fetch_assoc()) {
                        $imagens[] = htmlspecialchars($imagem_row['imagem_path']);
                    }
                    ?>
                    <tr>
                        <td data-label="Imagem">
                            <?php if (!empty($imagens)): ?>
                                <img src="<?= htmlspecialchars($imagens[0]) ?>" alt="Produto" class="product-img">
                            <?php else: ?>
                                <img src="path/to/default/image.jpg" alt="Sem imagem" class="product-img">
                            <?php endif; ?>
                        </td>
                        <td data-label="Nome"><?= htmlspecialchars($row['nome']) ?></td>
                        <td data-label="Descrição"><div class="desc-table"><?= htmlspecialchars($row['descricao']) ?>...</div></td>
                        <td data-label="Preço">R$ <?= number_format($row['preco'], 2, ',', '.') ?></td>
                        <td data-label="Ações">
                            <button class="edit-btn" data-id="<?= $produto_id ?>"><i class="fas fa-edit edit-icon"></i></button>
                            <button class="delete-btn" data-id="<?= $produto_id ?>"><i class="fas fa-trash delete-icon"></i></button>
                        </td>
                    </tr>
                    <?php
                    // Feche a consulta de imagens
                    $stmt_imagens->close();
                    ?>
                <?php endwhile; ?>
            </tbody>
        </table>
        <?php
    } else {
        echo "<p>Nenhum produto encontrado.</p>";
    }
} else {
    echo "<p>Erro na consulta SQL.</p>";
}

// Feche a conexão
$stmt->close();
$conn->close();
?>

        </div>
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
    });

    // EDITAR OU EXCLUIR PRODUTOS 

    document.addEventListener("DOMContentLoaded", function () {
        // Adiciona um ouvinte de evento para os botões de edição
        const editButtons = document.querySelectorAll('.edit-btn');
        editButtons.forEach(button => {
            button.addEventListener('click', function () {
                const productId = button.getAttribute('data-id');
                window.location.href = 'editar_produto.php?id=' + productId; 
            });
        });

        // Adiciona um ouvinte de evento para os botões de exclusão
        const deleteButtons = document.querySelectorAll('.delete-btn');
        deleteButtons.forEach(button => {
            button.addEventListener('click', function () {
                const productId = button.getAttribute('data-id');
                if (confirm('Tem certeza de que deseja excluir este produto?')) {
                    window.location.href = 'excluir_produto.php?id=' + productId; 
                }
            });
        });
    });

</script>


</body>
</html>