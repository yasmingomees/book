<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width">
  <title>replit</title>


  <!-- Css do Bootstrap -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
    integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

  <!-- Css do Material Icons -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

  <link href="style.css" rel="stylesheet" type="text/css" />
  <!-- JK do Bootstrap 
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>

  -->

  <script src="script.js" defer></script>
</head>

<body>




  <header>


    <aside>

      <form action="">
        <div class="form-group">
          <label for="txt_email">e-mail</label>
          <input type="email" name="txt_email" id="txt_email" class="form-control">
        </div>

        <div class="form-group">
          <label for="txt_senha">senha</label>
          <input type="password" name="txt_senha" id="txt_senha" class="form-control">
        </div>
        <a href="#">Esqueci a senha</a>
        <div>

          <input type="submit" value="Login" class="btn btn-primary">
          <a href="#" class="btn btn-primary">
            Cadastre-se
          </a>
        </div>
      </form>
    </aside>
    <h1> <?="Books" ?> </h1>
    <h2> <?php echo "oiiiii" ?> <h2>
  </header>
  <main>
    <form action="ws/salvar-livro.php" class="form-inline justify-content-center">
      <div class="form-group">
        <input type="text" name="txt_livro" id="txt_livro" class="form-control">

        <input type="button" value="Salvar" class="btn btn-primary" onclick="criarLivro()">
      </div>
    </form>

    <div id="livros"> 
        
      <?php 
      require_once "model/Conexao.php";
      $sql = "SELECT * FROM book;";
        if(!Conexao::execWithReturn($sql)){
            echo Conexao::getErro();
            exit(1);
        } 
       // print_r(Conexao::getData());
        foreach(Conexao::getData() as $livro):  
      ?>
    
    
      <article id = "sessaoDeLivros">
        <div>
          <img src="img/book.jpg" alt="Foto do livro">
        </div>

        <div class="livro-dados">
          <h3>Livro: <span id = "livro-nome"> <?= $livro["nome"] ?></span>
          </h3>
          
          <h3>Páginas: <span id = "livro-paginas"> <?= $livro["paginas"] ?></span>
          </h3>
          
          <h3>Autor /a/as/es:
            <span id = "livro-autores"> <?= $livro["autor"] ?></span>
          </h3>
          
        </div>

        <div>
          <div class="marcador">
            <span class="material-icons">book</span>
            <span class="contador">12</span>
          </div>

          <div class="marcador">
            <span class="material-icons">favorite</span>
            <span class="contador">12</span>
          </div>
        </div>

      </article>
      <?php endforeach; ?>

  </main>


</body>

</html>