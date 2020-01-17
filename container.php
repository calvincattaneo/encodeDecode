<div class="container">
    <h3>Convers&atilde;o de dados</h3>
    <div class="row">
      <div class="col-sm">
        <p>Selecione o tipo desejado: </p>
        <div class="btn-group">
            <a href="http://localhost/conversao/index.php" class="btn btn-secondary" role="button">T&iacute;tulo</a>
            <input type="hidden" name="tipoOption" value="texto">
            <a href="http://localhost/conversao/indexTexto.php" class="btn btn-secondary" role="button">Texto</a>
            <a href="http://localhost/conversao/indexPrompt.php" class="btn btn-secondary" role="button">Prompt</a>
            <a href="http://localhost/conversao/indexItens.php" class="btn btn-secondary" role="button">Itens</a>
        </div>
      </div>
      <div class="col-sm">
        <p>Marcar todos</p>
        <input type="checkbox" class="checkAll" name="checkAll" />
      </div>
    </div>
    <table id="table" class="table table-bordered table-striped">
      <thead>
        <tr>
          <th scope="col">idQ</th>
          <th scope="col" style="width:40%" id="posicao">Posi&ccedil;&atilde;o</th>
          <th scope="col" style="width:40%" id="posicao">Texto</th>
          <th scope="col" style="width:40%" id="convertido">Convertido</th>
          <th>#</th>
          <th scope="col">
            <button type="button" class="btn btn-success editAll"><i class="material-icons">edit</i></button>
          </th>
        </tr>
      </thead>
      <tbody>
      </tbody>
      <tfoot>
        <tr>
          <th scope="col">idQ</th>
          <th scope="col" style="width:40%" id="posicao">Posi&ccedil;&atilde;o</th>
          <th scope="col" style="width:40%" id="posicao">Texto</th>
          <th scope="col" style="width:40%" id="convertido">Convertido</th>
          <th>#</th>
          <th scope="col">
            <button type="button" class="btn btn-success editAll"><i class="material-icons">edit</i></button>
          </th>
        </tr>
      </tfoot>
    </table>
  </div><!-- /div container -->