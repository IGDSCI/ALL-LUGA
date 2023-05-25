function buscaCep() {
    let cep = document.getElementById('cep').value;
    if (cep !== "") {
      let url = "https://brasilapi.com.br/api/cep/v1/" + cep;
  
      let req = new XMLHttpRequest();
      req.open("GET", url);
      req.send();
  
      // tratar a resposta da requisição
      req.onload = function () {
        if (req.status === 200) {
          let endereco = JSON.parse(req.response);
          document.getElementById("cidade").value = endereco.city;
          document.getElementById("estado").value = endereco.state;
        }
        else if (req.status === 404) {
          alert("CEP inválido!");
          document.getElementById("cep").value = '';
          document.getElementById("cidade").value = '';
          document.getElementById("estado").value = '';
        }
        else {
          alert("Erro ao fazer requisição!");
          document.getElementById("cep").value = '';
          document.getElementById("cidade").value = '';
          document.getElementById("estado").value = '';
        }
      }
    }
  }
  
  window.onload = function () {
    let cep = document.getElementById("cep");
    cep.addEventListener("blur", buscaCep);
  }

window.onload = function(){
    let cep = document.getElementById("cep");
    cep.addEventListener("blur", buscaCep);
}