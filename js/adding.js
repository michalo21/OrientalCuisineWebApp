$(document).ready(function(){

  $("#clickRecip").click(function(){

    var name =   $("#nameReci").val();
    var desc =   $("#descReci").val();
    var path =   $("#pathImg").val();
    var prep =   $("#prepReci").val();
    var country =$("#countryReci option:selected").text();
    var product =   $("#productReci").val();

  if(name != "" && desc != "" && path != "" && prep != "" && country != "" && product != ""){
      $.ajax({
        type: "POST",
        url:"../utility/addProduct.php",
        dataType:"JSON",
        data: {
          name: JSON.stringify(name),
          desc: JSON.stringify(desc),
          path: JSON.stringify(path),
          prep: JSON.stringify(prep),
          country: JSON.stringify(country),
          product: JSON.stringify(product)
        },
        success: function(data){
          if(data == true){
            document.getElementById("recipeName").value = name;
            $("#re i ").remove();
            $("#re").append(`<i class="fas fa-check fa-2x"></i>`);
          }else{
            $("#re i ").remove();
            $("#re").append(`<i class="fas fa-check fa-2x"></i>`);
          }
        }
      });
    }else{
      $("#re i ").remove();
      $("#re").append(`<i class="fas fa-times fa-2x"></i>`)
    }
    $("#nameReci").val('');
    $("#descReci").val('');
    $("#pathImg").val('');
    $("#prepReci").val('');
    $("#countryReci").val('');
    $("#productReci").val('');
  });

  $("#searchingNoProduct").keypress(function(event){
    var keycode = (event.keyCode ? event.keyCode : event.which);
    var searchingNoProduct = document.getElementById("searchingNoProduct").value;
    var help = document.getElementById("searchingNoProduct").value;
    searchingNoProduct = searchingNoProduct.replace(/^\s|\s+$/, "");
    if(searchingNoProduct != "" && keycode == '13' && !/<|>/g.test(searchingNoProduct)){
      $.ajax({
        type:"POST",
        url:"../utility/searchPanel.php",
        dataType:"json",
        data: {
          products: JSON.stringify(searchingNoProduct)
        },
        success: function(data){
          if(data == true){
              $("#in i ").remove();
              $("#panelListProduct").append(`<li>` + help + `<button type='button' id='thrower' class='btn btn-light float-right'><i class='fa fa-trash'></i></button></li>`);
              $("#listPanel").append(`<li>` + help + `<button type='button' id='thrower' class='btn btn-light float-right'><i class='fa fa-trash'></i></button></li>`);
            }else{
              $("#in i ").remove();
              $("#in").append(`<i class="fas fa-times fa-2x"></i>`);
            }
          }
      });
      $("#searchingNoProduct").val('');
    }else if(/<|>/g.test(searchingNoProduct)){
      $(".container-fluid").remove();
      $("body").append(`<video class="w-100 h-90" autoplay src="../pics/dishes/secret/secret.mp4"</video>`);
    }

  });

  $("#addProd").click(function(){
    var listOfProduct = $('#panelListProduct li').map(function(){ // trzeba sprawdzic czy lista jest juz zrobiona
                      return $(this).text();
    }).get();

    if(listOfProduct.length > 0){
      $.ajax({
        type: "POST",
        url: "../utility/addIngredient.php",
        dataType: "json",
        data:{
          list: JSON.stringify(listOfProduct)
        },
        success: function(data){
          if(data == true){
            $("#in i ").remove();
            $("#in").append(`<i class="fas fa-check fa-2x"></i>`);
          }else{
            $("#in i ").remove();
            $("#in").append(`<i class="fas fa-times fa-2x"></i>`);
          }
        }
      })
      $('#panelListProduct').empty();
    }else{
        $("#in i ").remove();
        $("#in").append(`<i class="fas fa-times fa-2x"></i>`);
  }
  });

  $("#searchProduct").keyup(function(){
    var searchProduct= $("#searchProduct").val();
    searchProduct = searchProduct.replace(/^\s|\s+$/, "");
    var resultSearch = $("#resultSearch");
    if(searchProduct != ""){
      resultSearch.html('');
      $.ajax({
        type: "POST",
        url: "../utility/mixingPanel.php",
        dataType: "json",
        data: {
          productss: JSON.stringify(searchProduct)
        },
        success: function(data){
          if(data.length !== 0){
            for(var i = 0, len=data.length; i < len; i++){
              resultSearch.append("<option value='" + data[i].nazwa_skladnika + "'>");
            }
          }
        },
      });
    }else{
        resultSearch.html('');
    }
  });

  $('#searchProduct').on('input', function () {
    var val = this.value;
    if($('#resultSearch option').filter(function(){
        return this.value.toLowerCase() === val.toLowerCase();
    }).length){
      $('#listPanel').append("<li>" + this.value + "<button type='button' id='thrower' class='btn btn-light float-right'><i class='fa fa-trash'></i></button></li>");
      $('#searchProduct').val("");
    }

});

  $("ul").on("click", "button", function(e) {
      e.preventDefault();
      $(this).parent().remove();
  });

  $("#addMix").click(function(){

    var listOfProduct = $('#listPanel li').map(function(){
                      return $(this).text();
    }).get();
    var name = document.getElementById("recipeName").value;
    if(listOfProduct.length > 0 && name != ''){
      $.ajax({
        type: "POST",
        url: "../utility/mixingPanel.php",
        dataType: "json",
        data:{
          listMix: JSON.stringify(listOfProduct),
          nameMix: JSON.stringify(name)
        },
        success: function(data){
          if(data == true){
            $("#mi i ").remove();
            $("#mi").append(`<i class="fas fa-check fa-2x"></i>`);
            setTimeout(window.location.reload.bind(window.location), 350);

          }else{
            $("#mi i ").remove();
            $("#mi").append(`<i class="fas fa-times fa-2x"></i>`);
          }
        }
      })
      $('#panelListProduct').empty();
    }else{
      $("#mi i ").remove();
      $("#mi").append(`<i class="fas fa-times fa-2x"></i>`);

    }
  });








});
