<!DOCTYPE html>
<html lang="pt-br">
<head>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
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
    <h3>Formulário</h3>

    <form id="form">
      <div class="form-group">
        <label for="wstoken">Token</label>
        <input type="text" class="form-control" id="wstoken" placeholder="wstoken" value="0bfa7fb6d78d8f795a800dd7219775ee">
      </div>
      <div class="form-group">
        <label for="wsfunction">Function</label>
        <input type="text" class="form-control" id="wsfunction" placeholder="wsfunction" value="core_course_create_categories">
      </div>
      <div class="form-group">
        <label for="moodlewsrestformat">Rest Format</label>
        <input type="text" class="form-control" id="moodlewsrestformat" placeholder="moodlewsrestformat" value="json">
      </div>
      <div class="form-group">
        <label for="idnumber">users[0][idnumber]</label>
        <input type="text" class="form-control" id="idnumber" placeholder="idnumber" value="28787">
      </div>
      <button type="submit" class="btn btn-primary">Enviar</button>
    </form>

  </div><!-- /div container -->



  <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <script src="base64.js"></script>
  <script type="text/javascript">
    $("#form").submit(function(event) {
      event.preventDefault();
      var wstoken            = $('#wstoken').val();
      var wsfunction         = $('#wsfunction').val();
      var moodlewsrestformat = $('#moodlewsrestformat').val();
      var users = [
              {"name" : $('#categories').val()}
      ];
      console.log(categories);
      $.ajax({
        url: 'http://localhost/moodle/webservice/rest/server.php',
        type: 'post',
        dataType: 'json',
        data: {wstoken: wstoken, wsfunction: wsfunction, moodlewsrestformat: moodlewsrestformat, categories: categories},
        success: function(resp) {
          console.log("data", data);
          console.log("Sucesso", resp);
        },
        error: function(resp){
          console.log("data", data);
          console.log("Erro", resp);
        }
      });
    });
  </script>
</body>
</html>
