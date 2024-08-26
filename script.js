const toggleInputOpen = () => document.body.classList.toggle("open-input");
const toggleCarrinhoOpen = () => document.body.classList.toggle("open-cart");
const toggleMenuOpen = () => document.body.classList.toggle("open-menu");


window.onscroll = function() {scrollFunction()};

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
}