<script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <script src="http://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
  <script src="base64.js"></script>
  <script type="text/javascript" charset="iso-8859-1" src="ajax.js"></script>
  <script type="text/javascript">
  $(document).ready(function () {
    $('#table').DataTable( {
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
              "options": "texto"
            }
          },
          "columns": [
              { "data": "idQ" },
              { "data": "posicao" },
              { "data": "texto" },
              { "data": "convertido" },
              { "data": "checkedId" },
              { "data": "btnId" },
          ],
          "columnDefs": [
              {
                "render": function ( data, type, row ) {
                  return Base64.encode(data);
                },
                "targets": 3
              },
              {
                "render": function ( data, type, row ) {
                    return '<input type="checkbox" name="check" value="' + data + '" data-id="' + row.posicao + '"/>';
                },
                "targets": 4
              },
              {
                "render": function (data, type, row) {
                  return '<div class="btn-group" role="group">' +
                    '<button type="button" class="btn btn-primary" data-id="' + data + '"><i class="material-icons">remove_red_eye</i></button>' +
                    '<button type="button" class="btn btn-success edit" data-id="' + data + '"><i class="material-icons">edit</i></button>' +
                    '<button type="button" class="btn btn-danger delete" data-id=' + data + '><i class="material-icons">delete</i></button>' +
                    '<div>';
                },
                "targets": 5
              }
          ],
          "lengthMenu": [ 10, 25, 75, 100, 250,300 ]
      } );
  });
  </script>

</body>
</html>