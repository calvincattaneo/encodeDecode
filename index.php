<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html;charset=iso-8859-1">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title></title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="http://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <style>
  h3, table {margin-top: 10px; text-align: center;}
  .table-bordered td, .table-bordered th { border: 1px solid #dee2e6; word-wrap: break-word; max-width: 500px; }
  /*.modal-body p {word-wrap: break-word;}*/
  .modal-body label {text-transform: capitalize;}
  </style>
</head>
<body>
  <div class="container">
    <h3>Convers&atilde;o de dados</h3>
    <div class="row">
      <div class="col-sm">
        <p>Selecione o tipo desejado: </p>
        <div class="btn-group">
            <a href="http://localhost/conversao/index.php" class="btn btn-secondary" role="button">T&iacute;tulo</a>
            <input type="hidden" name="tipoOption" value="title">
            <a href="http://localhost/conversao/indexTexto.php" class="btn btn-secondary" role="button">Texto</a>
            <a href="http://localhost/conversao/indexPrompt.php" class="btn btn-secondary" role="button">Prompt</a>
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
          <th scope="col" style="width:40%" id="titulo">Titulo</th>
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
          <th scope="col" style="width:40%" id="titulo">Titulo</th>
          <th scope="col" style="width:40%" id="convertido">Convertido</th>
          <th>#</th>
          <th scope="col">
            <button type="button" class="btn btn-success editAll"><i class="material-icons">edit</i></button>
          </th>
        </tr>
      </tfoot>
    </table>
  </div><!-- /div container -->

  <!-- Modal -->
  <div class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <form name="form" id="form" method="post">
        <input type="hidden" name="id" id="id" value="">
        <input type="hidden" name="tipo_option" id="tipo_option" value="">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title"></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <label for="option">Title</label>
              <textarea class="form-control" id="option" disabled></textarea>
            </div>
            <div class="form-group">
              <label for="convert">Convertido</label>
              <textarea class="form-control" id="convert" disabled></textarea>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            <button type="submit" class="btn btn-primary">Salvar</button>
          </div>
        </div>
      </form>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <script src="http://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
  <script src="base64.js"></script>
  <script type="text/javascript" charset="iso-8859-1" src="ajax.js"></script>
  <script type="text/javascript">
  $(document).ready(function () {
    $('#table').DataTable( {
      "dom": '<"top"iflp<"clear">>rt<"bottom"iflp<"clear">>',
      "processing": true,
      "serverSide": true,
      "ordering": false,
      "pagingType": "full_numbers",
      "fixedHeader": {
              "header": true,
              "footer": true
          },
      "serverMethod": "post",
      "ajax": {
          "method": "post",
          "url": "dados.php",
          "data": {
              "options": "title"
            }
          },
          "columns": [
              { "data": "idQ" },
              { "data": "title" },
              { "data": "convertido" },
              { "data": "checkedId" },
              { "data": "btnId" },
          ],
          "columnDefs": [
              {
                "render": function ( data, type, row ) {
                  return Base64.encode(data);
                },
                "targets": 2
              },
              {
                "render": function ( data, type, row ) {
                    return '<input type="checkbox" name="check" value="' + data + '" />';
                },
                "targets": 3
              },
              {
                "render": function (data, type, row) {
                  return '<div class="btn-group" role="group">' +
                    '<button type="button" class="btn btn-primary" data-id="' + data + '"><i class="material-icons">remove_red_eye</i></button>' +
                    '<button type="button" class="btn btn-success edit" data-id="' + data + '"><i class="material-icons">edit</i></button>' +
                    '<button type="button" class="btn btn-danger delete" data-id=' + data + '><i class="material-icons">delete</i></button>' +
                    '<div>';
                },
                "targets": 4
              }
          ],
          "lengthMenu": [ 10, 25, 75, 100, 300, 500 ]
      } );
  });
  </script>
</body>
</html>
