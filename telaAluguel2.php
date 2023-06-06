
<?php

session_start();

include_once('conexao.php');

// Verifica se o ID do produto foi fornecido na URL
if (isset($_GET['id'])) {
    $produtoID = $_GET['id'];

    // Consulta o produto com base no ID fornecido
    $sql = "SELECT tb_produto.*, tb_categoria.TipoCategoria, tb_usuario.Login AS Login
            FROM tb_produto
            INNER JOIN tb_categoria ON tb_produto.ID_TipoCat = tb_categoria.ID_Categoria
            INNER JOIN tb_usuario ON tb_produto.Proprietario = tb_usuario.ID_Usuario
            WHERE tb_produto.ID_Produto = $produtoID";
    $result = $conexao->query($sql);

    if ($result && $result->num_rows > 0) {
        // O produto foi encontrado, exiba os detalhes
        $produto = $result->fetch_assoc();

        // Aqui você pode criar o layout HTML para exibir os detalhes do produto
 
        // Use as informações do array $produto para preencher os campos

        // Exemplo:
        echo "<div class='main-container'>";
            echo "<a href='principal.php'><img class='logo' src='Images/LOGOALLLUGA.png'></a>";
            echo "<div class='left-img'>";
            echo "<form action='adicionaAluguelBD.php' method='POST'>";
            echo "<img class='product-photo' src='" . $_GET['imagem'] . "' alt='Imagem do Produto'>";
            echo "</div>";

            echo "<div class='content'>";
            echo "<p class='title'>" . $produto['Nome'] . "</p>";
            echo "<h1>Detalhes do produto:</h1>"; 
            echo "<br>";
            echo "<p>Nome: " . $produto['Nome'] . "</p>";
            echo "<br>";
            echo "<p>Descrição: " . $produto['Descricao'] . "</p>";
            echo "<br>";
            echo "<p>Preço (diário): R$" . $produto['Preco'] . "</p>";
            echo "<br>";
            echo "<p>Categoria: " . $produto['TipoCategoria'] . "</p>";
            echo "<br>";
            echo "<p>Proprietário: ".$produto['Login']."</p>";
            echo "<input type='hidden' name='produtoID' value='" . $_GET['id'] . "'>"; // Inclua o ID do produto como um campo oculto
            echo "<input type='hidden' name='nomeLocador' value='" .$produto['Login']. "'>"; 
            echo "<input type='hidden' name='valor' value='" .$produto['Preco']. "'>";
            echo "</form>";
            echo "</div>";

            echo "<div class='right-img'>";
            echo "<img src='Images/arte-abstrata-geometrica-marmoreio-colorido.png'>";
            echo "</div>";
        echo "</div>";

    } else {
        // O produto não foi encontrado, exiba uma mensagem de erro
        echo "Produto não encontrado.";
    }
} else {
    // ID do produto não foi fornecido, redirecione o usuário de volta para a página principal ou exiba uma mensagem de erro.
    header("Location: principal.php"); // Redireciona para a página principal
    exit(); // Encerra o script para evitar a execução de código adicional
}
?>




        <style>
            @import url('https://fonts.googleapis.com/css2?family=Krona+One&family=Montserrat&family=Roboto+Condensed:wght@300&display=swap');

*{
  padding: 0px;
  margin: 0px;
  font-family: 'Montserrat', sans-serif;
}
body{
    background-image: linear-gradient(to right, var(--cor-quaternaria), var(--cor-primaria));
}

:root {
  --cor-primaria: #0A2647;
  --cor-secundaria: #144272;
  --cor-terciaria: #205295;
  --cor-quaternaria: #2C74B3; 
  --cor-quintenaria: #d7d7d7;
}


    @font-face {
        font-family: 'Commuters Sans';
        src: local('js/Commuters Sans Regular'), local('Commuters-Sans-Regular'),
            url('Fonts/CommutersSans-Regular.ttf') format('woff2'),
            url('Fonts/CommutersSans-Regular.woff') format('woff'),
            url('Fonts/CommutersSans-Regular.woff2') format('truetype');
        font-weight: 400;
        font-style: normal;
        
    }

           .main-container{
            margin: 0 auto;
            width: 100%;
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
            text-transform: uppercase;
         
            
           }
           .logo{
            position: absolute;
            max-width: 10%;
            top: 1.5%;
            left: 1.5%;
           }
           .logo:hover{
            cursor: pointer;
            opacity: 0.7;
            transition: all 0.2s ease;
            -webkit-transition: all 0.2s ease;
            -moz-transition: all 0.2s ease;
            -ms-transition: all 0.2s ease;
           }
           .left-img{
            background-image:var(--cor-quintenaria);
            box-shadow: 1px 1px 1px 1px black;
            padding: 5px;
            margin-top: 5%;
            margin-right: 5%;
           }
           .left-img:hover{
            transform: scale(1.01);
           }
           .product-photo{
            width: 65vh;
            height:75vh;
            }
        
           .content{
            margin-right: 20%;
           }
           p{
            text-align: left;
            letter-spacing: 0px;
            color: var(--cor-quintenaria);
            opacity: 1;
           }
           .title{
            display:left;
            text-align: left;
            font-family: 'Montserrat', sans-serif;
            margin-bottom: 4%;
            font-size:43px;
            color: var(--cor-quintenaria);
            opacity: 1;
            white-space: nowrap;
            font-weight:bold;
           }
           .title-price{
            text-align: left;
            font-family: 'Montserrat', sans-serif;
            font-size: 30px;
            letter-spacing: 0px;
            color: var(--cor-quintenaria);
            opacity: 1;
            margin-top:6%;
            white-space: nowrap;
           }
           h1{
            text-align: left;
            font: normal normal normal 24px/30px Commuters Sans;
            letter-spacing: 0px;
            color: var(--cor-quintenaria);
            opacity: 1;
           }
           .right{
            margin-right:50%;
           }
           .right-img{ 
            float:right;
            height:100%;
           
           }
                
        .input-submit{
            height: 3.6em;
            background: #097FF5 0% 0% no-repeat padding-box;
            width: 80%;
            margin-left: 5%;
            text-align: center;
            font: normal normal normal 1.2em "Commuters Sans";
            letter-spacing: 2.9px;
            color: #FFFFFF;
            text-transform: uppercase;
            border: none;
            margin-top: 10%;
            padding: 0.4em 0.6em;
            box-shadow: 0px 3px 6px #00000029;
            border-radius: 1em;
            opacity: 1;
            position: relative;
            -webkit-transition: all 0.3s;
            -moz-transition: all 0.3s;
            transition: all 0.3s;

        }

        .input-submit:after {
            content: '';
            position: absolute;
            z-index: -1;
            -webkit-transition: all 0.3s;
            -moz-transition: all 0.3s;
            transition: all 0.3s;
        }
        
        .input-submit:before {
            font-family: 'Open Sans';
            speak: none;
            font-style: normal;
            font-weight: normal;
            font-variant: normal;
            text-transform: none;
            line-height: 1;
            position: relative;
            -webkit-font-smoothing: antialiased;
        }
        
        .input-submit:hover {
            background: #FFFFFF;
            color: #097FF5;
            transition: 0.5s ease;
            cursor: pointer;
        }
        
        .input-submit:active {
            background: #FFFFFF;
            top: 2px;
        }
        
        .input-submit:before {
            position: absolute;
            height: 100%;
            left: 0;
            top: 0;
            line-height: 3;
            font-size: 140%;
            width: 60px;
        }

        .fade-in-image {
    animation: fadeIn 3s;
    transition: all 0.2s ease;
    -webkit-transition: all 0.2s ease;
    -moz-transition: all 0.2s ease;
    -ms-transition: all 0.2s ease;
}

@keyframes fadeIn {
    0% { opacity: 0; }
    100% { opacity: 1; }
  }
        </style>