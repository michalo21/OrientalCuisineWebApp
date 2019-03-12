$(document).ready(function(){
  $('#searchProduct').keyup(function(){
    var searchProduct= $('#searchProduct').val();
    searchProduct = searchProduct.replace(/^\s|\s+$/, "");
    var resultSearch = $('#resultSearch');
    if(searchProduct != ""){
      resultSearch.html('');
      $.ajax({
        type:"POST",
        url:"search.php",
        dataType:"json",
        data: {
          products: searchProduct
        },
        success: function(data){
          if(data.length === 0){
          }else{
            for(var i = 0, len=data.length; i < len; i++){
              resultSearch.append("<option value='" + data[i].nazwa_skladnika + "'>");
            }
           }
          }
      });
    }else{
        resultSearch.html('');
    }
  });
});
