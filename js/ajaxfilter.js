$(document).ready(function(){
  var dataModal;
  var label;

  $('.form-check-input').on('change', function(){//za kazda zmiana filtra od kraju niech sie ajax odpala i przeszukuje dane
    var listOfProduct = $('#listProduct li').map(function(){ // trzeba sprawdzic czy lista jest juz zrobiona
                      return $(this).text();
    }).get();

    var checkBoxes =  $('.form-check-input:checked').map(function(){
      return this.value;
    }).get();


    if(listOfProduct.length > 0 && checkBoxes.length > 0){ // jezeli lista produktow jest zrobiona odpalamy ajaxa z filtrem kraju i listy

      $.ajax({
        type: "POST",
        url:"../utility/filtering.php",
        dataType:"JSON",
        data: {
          country:JSON.stringify(checkBoxes),
          list:JSON.stringify(listOfProduct)
        },
        success: function(data){
          addItemToCarousel(data);
          dataModal = data;
        }
      })
    }else if(checkBoxes.length > 0 && listOfProduct.length == 0){//pusta lista sprawdzamy same potrawy na podstwie kraju
      $.ajax({
        type: "POST",
        url:"../utility/filtering.php",
        dataType:"JSON",
        data: {
          country:JSON.stringify(checkBoxes),
        },
        success: function(data){
          addItemToCarousel(data);
          dataModal = data;
         }
      })
    }else if(checkBoxes.length == 0 && listOfProduct.length > 0){//puste kraj sprawdzamy same potrawy na podstwie listy
      $.ajax({
        type: "POST",
        url:"../utility/filtering.php",
        dataType:"JSON",
        data: {
          list:JSON.stringify(listOfProduct),
        },
        success: function(data){
          addItemToCarousel(data);
          dataModal = data;
         }
      })
    }
  });
   $('#listProduct').bind('DOMSubtreeModified',function(e){ // teraz ajax na zmainie listy

     var checkBoxes =  $('.form-check-input:checked').map(function(){// sprawdzic czy jest filtr kraju wybrany
       return this.value;
     }).get();

     var listOfProduct = $('#listProduct li').map(function(){
                          if($(this).text()!=label){
                            return $(this).text();
                          }
     }).get();



     if(listOfProduct.length > 0 && checkBoxes.length > 0 ){
       $.ajax({
         type: "POST",
         url:"../utility/filtering.php",
         dataType:"JSON",
         data: {
           country:JSON.stringify(checkBoxes),
           list:JSON.stringify(listOfProduct)
         },
         success: function(data){
           addItemToCarousel(data);
           dataModal = data;
         }
       })
     }else if(checkBoxes.length == 0 && listOfProduct.length > 0){ // sam filtr z produktami ze wszystkic krajow
       $.ajax({
         type: "POST",
         url:"../utility/filtering.php",
         dataType:"JSON",
         data: {
           list:JSON.stringify(listOfProduct)
         },
         success: function(data){
           addItemToCarousel(data);
           dataModal = data;
         }
       })
     }else if(checkBoxes.length > 0 && listOfProduct.length == 0){//pusta lista sprawdzamy same potrawy na podstwie kraju
       $.ajax({
         type: "POST",
         url:"../utility/filtering.php",
         dataType:"JSON",
         data: {
           country:JSON.stringify(checkBoxes),
         },
         success: function(data){
           addItemToCarousel(data);
           dataModal = data;
          }
       })
     }
   })

   function addItemToCarousel(data){
     $('.imgdeleter').remove();
     for(g = 0;  g < data.length; g++){
         if(g == 0){
           $('#carouselDishesInner').prepend(`
             <div class='carousel-item active imgdeleter'>
               <img data-toggle='modal'  data-target='#modalRecipe' data-numero='` + g + `' src=` + data[g].zdjecie_przepisu + `> </img>
             </div>
           `);
         }else{
           $('#carouselDishesInner').prepend(`
             <div class='carousel-item imgdeleter'>
               <img data-toggle='modal' data-target='#modalRecipe'  data-numero='` + g + `' src=` + data[g].zdjecie_przepisu + `> </img>
             </div>
           `);
         }
       }
     }

   $('#modalRecipe').on('show.bs.modal', function (event) { // modal ustawianie dynamiczne
        var g = $(event.relatedTarget).data('numero');
        var titleModal = dataModal[g].nazwa_przepisu;
        var imgModal = dataModal[g].zdjecie_przepisu;
        var productlistModal = dataModal[g].spis_produktow;
        var preparingModal = dataModal[g].przygotowanie_przepisu;
        var modal = $(this)

        modal.find('.modal-title').text(titleModal)
        modal.find('.modal-body').html(`
          <img src='` + imgModal + `'> </img>
          <br></br>
          <center><h1>Spis produktów</h1></center>
          <p>` +  productlistModal + ` </p>
          <br></br>
          <center><h1>Sposób przyrządzenia</h1></center>
          <p>` + preparingModal + `<p>
          `);
    });

    $("ul").on("click", "button", function(e) { // usuwanie elementow
        label = $(this).parent().text();
        $(this).parent().remove();
    });




});
