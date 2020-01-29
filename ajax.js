$('body').on('click', '.delete', deleteItem);
function deleteItem(){
  var el = $(this);
  var id = $(this).data("id");//id do item

  $.ajax({
    url: 'remove.php',
    type: 'POST',
    data: { id:id },
    success: function(response){
      if(response == 1){
        //Remove row from HTML Table
        el.closest('tr').css('background','tomato');
        el.closest('tr').fadeOut(800,function(){
          $(this).remove();
        });
      } else {
        alert('Invalid ID.');
      }
    }
  });
}

$('body').on('click', '.edit', editItem);
function editItem(){
  var el = $(this);
  var id = $(this).data("id");//id do item
  var option = $("input[name='options']:checked").val();
  var isBase64 = $("input[name='isBase64']:checked").val();

  $('.modal').modal();

  $.ajax({
    url: 'dadoById.php',
    type: 'POST',
    async:false,
    data: { id:id, option:option },
    success: function(data){
      var json = data;
      obj = JSON.parse(json);
      //verifica se está codificado
      if(isBase64 == "1"){
        code = Base64.decode(obj[option]);
      } else {
        code = Base64.encode(obj[option]);
      }
      $('.modal-title').html('Questão: ' + obj.idQ);
      $('.modal-body label:first').val(option);
      $('#tipo_option').val(option);
      $('#id').val(obj.idQ);
      $('#option').html(obj[option]);
      $('#convert').html(code);

    },
    error: function(data){
      console.log('erro: ', data);
    }
  });
}

$("#form").submit(function(event) {
  event.preventDefault();
  var id          = $('#id').val();
  var option      = $('#option').val();
  var tipoOption  = $('#tipo_option').val();
  var convert     = $('#convert').val();
  $.ajax({
    url: 'update.php',
    type: 'post',
    dataType: 'json',
    data: {id: id, option: option, convert: convert, tipoOption: tipoOption},
    success: function(data) {
      if(data == 1)
        console.log("Sucesso", data);
      else
        console.log("Erro 200: ", data );

    },
    error: function(data){
      console.log("Erro", data);
    }
  });
});

$('.checkAll').on('click', function (e) {
  if($(".checkAll").is(":checked")){
    $('tbody :checkbox').prop("checked", true);
  } else {
    $('tbody :checkbox').prop("checked", false);
  }
});

$('tbody :checkbox').on('click', function () {
  $(this).closest('tr').toggleClass('selected', this.checked); //Classe de seleção na row
  $(this).closest('table').find('.checkAll').prop('checked', ($(this).closest('table').find('tbody :checkbox:checked').length == $(this).closest('table').find('tbody :checkbox').length)); //Tira / coloca a seleção no .checkAll
});

$('.editAll').on('click', function () {
  var elements = $(this).closest('table').find('tbody :checkbox:checked');
  var tipoOption = $("input[name='tipoOption']").val();
  var isBase64 = $("input[name='isBase64']:checked").val();
  
  var arr = [];
  for (var i = 0; i < elements.length; i++) {

    var id = elements[i].value;
    var idCorrecao = elements[i].dataset.id;
    arr.push({ id: id, tipoOption: tipoOption, idCorrecao: idCorrecao });
    }

  //console.log(arr);
  $.ajax({
    url: 'updateConversaoNovo.php',
    type: 'POST',
    //async:false,
    data: { arr:arr },
    success: function(data){
      //alert('Finalizado');
    },
    error: function(data){
      console.log('erro: ', data);
    }
  });
});

var b64 = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=';
function base64_encode(data) {
  var o1, o2, o3, h1, h2, h3, h4, bits, i = 0, ac = 0, tmp_arr = [], enc = '';
  if (!data) return data;
  do { // pack three octets into four hexets
    o1 = data.charCodeAt(i++);
    o2 = data.charCodeAt(i++);
    o3 = data.charCodeAt(i++);
    bits = o1 << 16 | o2 << 8 | o3;
    h1 = bits >> 18 & 0x3f;
    h2 = bits >> 12 & 0x3f;
    h3 = bits >> 6 & 0x3f;
    h4 = bits & 0x3f;
    // use hexets to index into b64, and append result to encoded string
    tmp_arr[ac++] = b64.charAt(h1) + b64.charAt(h2) + b64.charAt(h3) + b64.charAt(h4);
  } while (i < data.length);
  enc = tmp_arr.join('');
  var r = data.length % 3;
  return (r ? enc.slice(0, r - 3) : enc) + '==='.slice(r || 3);
}
function base64_decode(data) {
  var o1, o2, o3, h1, h2, h3, h4, bits, i = 0, ac = 0, tmp_arr = [], dec = '';
  if (!data)
  return data;
  data += '';
  do { // unpack four hexets into three octets using index points in b64
    h1 = b64.indexOf(data.charAt(i++));
    h2 = b64.indexOf(data.charAt(i++));
    h3 = b64.indexOf(data.charAt(i++));
    h4 = b64.indexOf(data.charAt(i++));
    bits = h1 << 18 | h2 << 12 | h3 << 6 | h4;
    o1 = bits >> 16 & 0xff;
    o2 = bits >> 8 & 0xff;
    o3 = bits & 0xff;
    if (h3 == 64) {
      tmp_arr[ac++] = String.fromCharCode(o1);
    } else if (h4 == 64) {
      tmp_arr[ac++] = String.fromCharCode(o1, o2);
    } else {
      tmp_arr[ac++] = String.fromCharCode(o1, o2, o3);
    }
  } while (i < data.length);
  dec = tmp_arr.join('');
  return dec;
}

//metodo usado no sapien com problemas usado para decodificar strings ja codificadas
function base64_decode(data) {
  var o1, o2, o3, h1, h2, h3, h4, bits, i=0, ac=0, tmp_arr=[], dec='';
  if(!data)
    return data;
  data += '';
  do { // unpack four hexets into three octets using index points in b64
    h1 = b64.indexOf(data.charAt(i++));
    h2 = b64.indexOf(data.charAt(i++));
    h3 = b64.indexOf(data.charAt(i++));
    h4 = b64.indexOf(data.charAt(i++));
    bits = h1<<18|h2<<12|h3<<6|h4;
    o1 = bits>>16&0xff;
    o2 = bits>>8&0xff;
    o3 = bits&0xff;
    if(h3==64) {
      tmp_arr[ac++] = String.fromCharCode(o1);
    } else if(h4==64) {
      tmp_arr[ac++] = String.fromCharCode(o1, o2);
    } else {
      tmp_arr[ac++] = String.fromCharCode(o1, o2, o3);
    }
  } while(i<data.length);
  dec = tmp_arr.join('');
  return dec;
}
