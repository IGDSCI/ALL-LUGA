<?php
session_start();
include_once('conexao.php');



if ((!isset($_SESSION['login']) == true) and (!isset($_SESSION['senha']) == true)) {
  //se os registros forem diferentes ira redirecionar para pagina de login e nao ira iniciar a sessao.
  unset($_SESSION['login']);
  unset($_SESSION['senha']);
  header('Location: login.php');
}

$login = $_SESSION['login'];



if (isset($_FILES['foto'])) 
{
  $extensao = strtolower(substr($_FILES['foto']['name'], -4)); //pega o nome da extensao do arquivo exemplo .jpg
  $novoNome = uniqid() . $extensao; //define o nome do arquivo
  $diretorio = "arquivos/"; //define o diretorio para onde enviaremos o arquivo


  move_uploaded_file($_FILES['foto']['tmp_name'], $diretorio.$novoNome); //faz o upload
}

//inserindo dados do produto no BD
if (isset($_POST['submit'])) {

  $nome = mysqli_real_escape_string($conexao, $_POST['nome']);
  $descricao = mysqli_real_escape_string($conexao, $_POST['descricao']);
  $preco = mysqli_real_escape_string($conexao, $_POST['preco']);
  $novoNome = mysqli_real_escape_string($conexao, $diretorio.$novoNome);
  $categoria = mysqli_real_escape_string($conexao, $_POST['categoria']);

  // Recupera o ID do usuário a partir do login
  $result2 = mysqli_query($conexao, "SELECT ID_Usuario FROM tb_usuario WHERE Login = '$login'");
  $row = mysqli_fetch_assoc($result2);
  $id_usuario = $row['ID_Usuario'];

  // Insere os dados na tabela tb_produto
  $result1 = mysqli_query($conexao, "INSERT INTO tb_produto (Nome, Descricao, Preco, Proprietario, Foto, ID_TipoCat)
    VALUES ('$nome', '$descricao', '$preco', '$id_usuario', '$novoNome', '$categoria')");

  if ($result1) {
    $sucesso = "Produto cadastrado com sucesso!";
  } else {
    $sucesso = "Erro ao cadastrar produto!";
  }
}
?>

<html lang="pt-br">

<head>
  <title> All Luga </title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP&display=swap" rel="stylesheet">
  <link href='http://fonts.googleapis.com/css?family=Sintony:400,700' rel='stylesheet' type='text/css'>
  <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600,700' rel='stylesheet' type='text/css'>
  <link rel="stylesheet" href="Css/main.css">
</head>

<body>

  <section class="main-container">
    <section class="left-container">
      <div class="img-div">
      <a href="principal.php"> <img id="logo" src="Images/LOGOALLLUGA.png"></a>
      </div>
      <section class="content-container">
        <div class="container-title">
          <h1>Cadastre aqui seu produto</h1>
          <h2 class="fade-in-image">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore.</h2>
          <div class="form-container">
          <h2><?php if (isset($result1)) echo $sucesso ?></h2>
            <form enctype="multipart/form-data" class="form" action="anuncio.php" method="POST">
              <input type="text" class="input-text" id="nome" name="nome" placeholder="Nome do Produto" required>

              <input type="text" class="input-text" id="descricao" name="descricao" placeholder="Descrição" required>

              <input type="number" step="any" class="input-text" id="preco" name="preco" placeholder="Preço" required>

              <div class="input-text">
                <h3 id="file-name">Foto do produto</h3>
                <input type="file" class="input-photo input-text" id="foto" name="foto" placeholder="Foto do Produto" onchange='uploadFile(this)' required>
                <div class="photo-button">
                  <img src="Images/Grupo 9.png" alt="">
                </div>
              </div>

              <div class="categories">
                <p></p>
                <div class="categories-button">
                  <img src="Images/Grupo 13.png" alt="">
                </div>
                <div class="custom-select">
                  
                  <select name="categoria" required>
                    <option value="1">Eletrônicos</option>
                    <option value="2">Eletrodomésticos</option>
                    <option value="3">Utensílios</option>
                    <option value="4">Esportes</option>
                    <option value="5">Imóvel</option>
                    <option value="6">Veículo</option>
                    <option value="7">Vestimentas</option>
                    <option value="8">Artigos de festas</option>
                  </select>
                </div>
                <br><br>
                <div class="submit-button" type="submit" name="submit" id="submit">
                  <button type="submit" name="submit" id="submit">
                    <img src="Images/Icon ionic-ios-send.png" alt="">
                  </button>
                  
                </div>
              </div>
              
            </form>
          </div>


      </section>
    </section>
    <section class="img-container">
      <img src="Images/Grupo 12.png">
    </section>

    <div class="container-icons fade-in-image" id="containerIcons">
      <div class="line-container">
        <img src="Images/Retângulo 5.png" alt="">
      </div>

    </div>
  </section>
  <script src="js/main.js"></script>
  <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/lottie-web@5.7.8/build/player/lottie.min.js"></script>
</body>

</html>

<script>
  function uploadFile(target) {
    document.getElementById("file-name").innerHTML = target.files[0].name;
  }
</script>

<script>
  var x, i, j, l, ll, selElmnt, a, b, c;
  /*look for any elements with the class "custom-select":*/
  x = document.getElementsByClassName("custom-select");
  l = x.length;
  for (i = 0; i < l; i++) {
    selElmnt = x[i].getElementsByTagName("select")[0];
    ll = selElmnt.length;
    /*for each element, create a new DIV that will act as the selected item:*/
    a = document.createElement("DIV");
    a.setAttribute("class", "select-selected");
    a.innerHTML = selElmnt.options[selElmnt.selectedIndex].innerHTML;
    x[i].appendChild(a);
    /*for each element, create a new DIV that will contain the option list:*/
    b = document.createElement("DIV");
    b.setAttribute("class", "select-items select-hide");
    for (j = 1; j < ll; j++) {
      /*for each option in the original select element,
      create a new DIV that will act as an option item:*/
      c = document.createElement("DIV");
      c.innerHTML = selElmnt.options[j].innerHTML;
      c.addEventListener("click", function(e) {
        /*when an item is clicked, update the original select box,
        and the selected item:*/
        var y, i, k, s, h, sl, yl;
        s = this.parentNode.parentNode.getElementsByTagName("select")[0];
        sl = s.length;
        h = this.parentNode.previousSibling;
        for (i = 0; i < sl; i++) {
          if (s.options[i].innerHTML == this.innerHTML) {
            s.selectedIndex = i;
            h.innerHTML = this.innerHTML;
            y = this.parentNode.getElementsByClassName("same-as-selected");
            yl = y.length;
            for (k = 0; k < yl; k++) {
              y[k].removeAttribute("class");
            }
            this.setAttribute("class", "same-as-selected");
            break;
          }
        }
        h.click();
      });
      b.appendChild(c);
    }
    x[i].appendChild(b);
    a.addEventListener("click", function(e) {
      /*when the select box is clicked, close any other select boxes,
      and open/close the current select box:*/
      e.stopPropagation();
      closeAllSelect(this);
      this.nextSibling.classList.toggle("select-hide");
      this.classList.toggle("select-arrow-active");
    });
  }

  function closeAllSelect(elmnt) {
    /*a function that will close all select boxes in the document,
    except the current select box:*/
    var x, y, i, xl, yl, arrNo = [];
    x = document.getElementsByClassName("select-items");
    y = document.getElementsByClassName("select-selected");
    xl = x.length;
    yl = y.length;
    for (i = 0; i < yl; i++) {
      if (elmnt == y[i]) {
        arrNo.push(i)
      } else {
        y[i].classList.remove("select-arrow-active");
      }
    }
    for (i = 0; i < xl; i++) {
      if (arrNo.indexOf(i)) {
        x[i].classList.add("select-hide");
      }
    }
  }
  /*if the user clicks anywhere outside the select box,
  then close all select boxes:*/
  document.addEventListener("click", closeAllSelect);
</script>