// Example starter JavaScript for disabling form submissions if there are invalid fields
(function () {
  'use strict'

  // Fetch all the forms we want to apply custom Bootstrap validation styles to
  var forms = document.querySelectorAll('.needs-validation')

  // Loop over them and prevent submission
  Array.prototype.slice.call(forms)
    .forEach(function (form) {
      form.addEventListener('submit', function (event) {
        if (!form.checkValidity()) {
          event.preventDefault()
          event.stopPropagation()
        }

        form.classList.add('was-validated')
      }, false)
    })
})();
function func_total(num) {
  var qty = Number($('#qty'+num).val());
  var price = Number($("#price" + num).val());
  var total = qty * price;
  $("#total" + num).html(total);
  grand_total();
}
function grand_total() {
var sum = 0;
$(".total").each(function(){
  sum += Number($(this).text());
});
$("#g_total").html(sum);
}
grand_total();