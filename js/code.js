var expanded = false;

function showCheckboxes() {
  var checkboxes = document.getElementById("checkboxes");
  if (!expanded) {
    checkboxes.style.display = "block";
    expanded = true;
  } else {
    checkboxes.style.display = "none";
    expanded = false;
  }
}

function onAjaxSuccess(data) {
  // получаем данные, отправленные сервером и выводим их на экран
  if (data.length > 0) {
    $('#returnedAjax').html(data)
  } else {
    $('#returnedAjax').html('')
  }
}

var arr = []
$(document).ready(function () {
  var checkboxs = document.querySelectorAll('input');

  checkboxs.forEach(checkbox => {
    checkbox.onclick = () => {
      var elems = document.querySelectorAll('input:checked')
      arr = [].map.call(elems, function (obj) {
        return obj.id
      });
      console.log(arr)
    }
  })

  $('input').on('click', function (e) {
    $.post(
        "server.php",
        {
          inputId: arr
        },
        onAjaxSuccess
    )
  })
})