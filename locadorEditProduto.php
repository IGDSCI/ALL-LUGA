<?php

if (!empty($_GET['ID_Produto'])) {
    include_once('conexao.php');

    $ID_Produto = $_GET['ID_Produto'];

    $sqlSelect = "SELECT * FROM tb_produto INNER JOIN tb_categoria ON tb_produto.ID_TipoCat = tb_categoria.ID_Categoria WHERE ID_Produto=$ID_Produto";

    $result = $conexao->query($sqlSelect);
    
    if ($result->num_rows > 0) {
        while ($linha = mysqli_fetch_assoc($result)) {
            $nome = $linha['Nome'];
            $descricao = $linha['Descricao'];
            $preco = $linha['Preco'];
            $categoria = $linha['TipoCategoria'];
        }
    }
} else {
    header('Location: locadorPerfil.php');
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
  <button button><a href="login2.php">Voltar</a></button>
  <section class="main-container">
    <section class="left-container">
      <section class="content-container">
        <div class="container-title">
          <h1>Cadastre aqui seu produto</h1>
          <h2 class="fade-in-image">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore.</h2>
          <div class="form-container">
          <h2><?php if (isset($sucesso)) echo $sucesso ?></h2>
            <form enctype="multipart/form-data" class="form" action="locadorSalvaEditProduto.php" method="POST">
              <input type="text" class="input-text" id="nome" name="nome" placeholder="Nome do produto" value="<?php echo $nome?>" required>

              <input type="text" class="input-text" id="descricao" name="descricao" placeholder="Descrição" value="<?php echo $descricao?>" required>

              <input type="number" step="any" class="input-text" id="preco" name="preco" placeholder="Preco" value="<?php echo $preco?>" required>

              <div class="input-text">
                <h3 id="file-name">Foto do produto</h3>
                <input type="file" class="input-photo input-text" id="foto" name="foto" placeholder="Foto do Produto" onchange='uploadFile(this)' readonly>
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
                  <label for="">Categorias: </label>
                  <select name="categoria"  required>
                    <option value="1">Eletrônicos</option>
                    <option value="2">Eletrodomésticos</option>
                    <option value="3">Utensílios</option>
                    <option value="4">Esportes</option>
                  </select>
                </div>
                
                    <div class="submit-button" type="submit" name="submit" id="submit">
                        <input type="hidden" name="ID_Produto" value="<?php echo $ID_Produto?>">
                        <button type="submit" name="update" id="submit">
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
      <div class="footer-icons">
        <img src="Images/Icon awesome-facebook.png" alt="">
        <img src="Images/Icon awesome-pinterest.png" alt="">
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