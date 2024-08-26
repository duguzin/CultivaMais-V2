const toggleInputOpen = () => document.body.classList.toggle("open-input");
const toggleCarrinhoOpen = () => document.body.classList.toggle("open-cart");
const toggleMenuOpen = () => document.body.classList.toggle("open-menu");
const toggleMenuPainel = () => document.body.classList.toggle("open-menu-painel");


/*window.onscroll = function() {scrollFunction()};

function scrollFunction() {
  var btnVoltarTopo = document.getElementById("btnVoltarTopo");
  if (document.body.scrollTop > 300 || document.documentElement.scrollTop > 300) {
    btnVoltarTopo.classList.add("show");
  } else {
    btnVoltarTopo.classList.remove("show");
  }
}

function voltarAoTopo() {
  document.documentElement.scrollTop = 0;
}*/

function incrementQuantity() {
  var quantityLabel = document.getElementById('quantity');
  var quantity = parseInt(quantityLabel.innerText);
  quantityLabel.innerText = quantity + 1;
}

function decrementQuantity() {
  var quantityLabel = document.getElementById('quantity');
  var quantity = parseInt(quantityLabel.innerText);
  if (quantity > 1) {
      quantityLabel.innerText = quantity - 1;
  }
}

function addToCart(productId) {
  var quantity = document.getElementById('quantity').innerText;

  var xhr = new XMLHttpRequest();
  xhr.open("POST", "add_to_cart.php", true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

  xhr.onreadystatechange = function () {
      if (xhr.readyState == 4 && xhr.status == 200) {
          // Ação após adicionar ao carrinho, ex: atualizar a contagem do carrinho
          alert("Produto adicionado ao carrinho!");
          window.location.reload();
      }
  };
  xhr.send("id=" + productId + "&quantity=" + quantity);
}

document.getElementById('dropdownButton').addEventListener('click', function() {
  var content = document.getElementById('dropdownContent');
  if (content.style.display === "none" || content.style.display === "") {
      content.style.display = "block";
  } else {
      content.style.display = "none";
  }
});

