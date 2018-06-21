$(document).ready(function(){
	cat();
	brand();
	product();
	function cat(){
		$.ajax({
			url	:	"adminaction.php",
			method:	"POST",
			data	:	{category:1},
			success	:	function(data){
				$("#get_category").html(data);
				
			}
		})
	}
	function brand(){
		$.ajax({
			url	:	"adminaction.php",
			method:	"POST",
			data	:	{brand:1},
			success	:	function(data){
				$("#get_brand").html(data);
			}
		})
	}
		function product(){
		$.ajax({
			url	:	"adminaction.php",
			method:	"POST",
			data	:	{getProduct:1},
			success	:	function(data){
				$("#get_product").html(data);
			}
		})
	}
$("body").delegate(".category","click",function(event){
		$("#get_product").html("<h3>Loading...</h3>");
		event.preventDefault();
		var cid = $(this).attr('cid');
		
			$.ajax({
			url		:	"adminaction.php",
			method	:	"POST",
			data	:	{get_seleted_Category:1,cat_id:cid},
			success	:	function(data){
				$("#get_product").html(data);
				if($("body").width() < 480){
					$("body").scrollTop(683);
				}
			}
		})
	
	})
	$("body").delegate(".selectBrand","click",function(event){
		event.preventDefault();
		$("#get_product").html("<h3>Loading...</h3>");
		var bid = $(this).attr('bid');
		
			$.ajax({
			url		:	"adminaction.php",
			method	:	"POST",
			data	:	{selectBrand:1,brand_id:bid},
			success	:	function(data){
				$("#get_product").html(data);
				if($("body").width() < 480){
					$("body").scrollTop(683);
				}
			}
		})
	
	})
	$("#search_btn").click(function(){
		$("#get_product").html("<h3>Loading...</h3>");
		var keyword = $("#search").val();
		if(keyword != ""){
			$.ajax({
			url		:	"adminaction.php",
			method	:	"POST",
			data	:	{search:1,keyword:keyword},
			success	:	function(data){ 
				$("#get_product").html(data);
				if($("body").width() < 480){
					$("body").scrollTop(683);
				}
			}
		})
		}
	})
	cart_count();
	$("body").delegate("#product","click",function(event){
		event.preventDefault();
		var p_id = $(this).attr('pid');
		$.ajax({
			url : "adminaction.php",
			method : "POST",
			data : {addToProduct:1,proId:p_id},
			success : function(data){
				$("#product_msg").html(data);
				cart_count();
			}
		})
	})
	cart_container();
	function cart_container(){
		$.ajax({
			url : "adminaction.php",
			method : "POST",
			data : {get_cart_product:1},
			success : function(data){
				$("#cart_product").html(data);
			}	
		})
		
	};
	function cart_count(){
		$.ajax({
			url : "adminaction.php",
			method : "POST",
			data : {cart_count:1},
			success : function(data){
				$(".badge").html(data);
			}	
		})
	}
	$("#cart_container").click(function(event){
		event.preventDefault();
		$.ajax({
			url : "adminaction.php",
			method : "POST",
			data : {get_cart_product:1},
			success : function(data){
				$("#cart_product").html(data);
			}	
		})
	})
	cart_checkout();
	function cart_checkout(){
		$.ajax({
			url : "adminaction.php",
			method : "POST",
			data : {cart_checkout:1},
			success : function(data){
				$("#cart_checkout").html(data);
			}
		})
	}
	$("body").delegate(".qty","keyup",function(){
		var pid = $(this).attr("pid");
		var qty = $("#qty-"+pid).val();
		var price = $("#price-"+pid).val();
		var total = qty * price;
		$("#total-"+pid).val(total);
	})
	$("body").delegate(".remove","click",function(event){
		event.preventDefault();
		var pid = $(this).attr("remove_id");
		$.ajax({
			url : "adminaction.php",
			method : "POST",
			data : {removeFromCart:1,removeId:pid},
			success : function(data){
				$("#cart_msg").html(data);
				cart_checkout();
			}
		})
	})
	$("body").delegate(".update","click",function(event){
		event.preventDefault();
		var pid = $(this).attr("update_id");
		var qty = $("#qty-"+pid).val();
		var price = $("#price-"+pid).val();
		var total = $("#total-"+pid).val();
		$.ajax({
			url : "adminaction.php",
			method : "POST",
			data : {updateProduct:1,updateId:pid,qty:qty,price:price,total:total},
			success : function(data){
				$("#cart_msg").html(data);
				cart_checkout();
			}
		})
	})
	page();
	function page(){
		$.ajax({
			url : "adminaction.php",
			method : "POST",
			data : {page:1},
			success : function(data){
				$("#pageno").html(data);
			}
		})
	}
	$("body").delegate("#page","click",function(){
		var pn = $(this).attr("page");
		$.ajax({
			url : "adminaction.php",
			method : "POST",
			data : {getProduct:1,setPage:1,pageNumber:pn},
			success : function(data){
				$("#get_Product").html(data);
			}
		})
	})
})




















