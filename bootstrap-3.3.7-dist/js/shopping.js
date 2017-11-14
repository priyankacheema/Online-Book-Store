$(document).ready(function(){
	$('#searchResults .addtocartBtn').click(function(){
		console.log("add to cart clicked : "+$(this).data('isbn'));
		isbn = $(this).data('isbn');
		number = $(this).data('number');
		title = $(this).data('title');
		price = $(this).data('price');
		author = $(this).data('authorname');

		quantity_selector = "#"+isbn;
		qty = $(quantity_selector).val();
		console.log("qty = "+qty);
		if(qty>number){
			$(quantity_selector).addClass('qtyerr');
			return;	
		}
		$.ajax({
		  url: "/project4_Cheema/ajax/addtocart.php",
		  method: 'post',
		  data: {
		  	isbn : isbn,
		  	number : number,
		  	qty : qty,
		  	title: title,
		  	price: price,
		  	author: author
		  },
		  dataType: 'json'

		}).done(function(json) {
		  console.log("done success = %o",json.counter);
		  $(quantity_selector).removeClass('qtyerr');
		  $('#cartCounter').html("<span class='glyphicon glyphicon-shopping-cart'></span><span class='counterval'>"+json.counter+"</span>");
		}).fail(function(error){
		  console.error("something went wrong!",error);
		});
	});
});

