$(document).ready(function(){
  $("ul").on("click", "button", function(e) {
      e.preventDefault();
      $(this).parent().remove();
  });
})
