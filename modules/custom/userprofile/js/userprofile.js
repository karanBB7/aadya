jQuery(document).ready(function($) {
	$('.cat-news-load').on('click',function(){
		var cat_id = $(this).attr('data-id');
		$.ajax({
			url: "/linqmd/get_category_news",
			method: "POST",
			cache: false,
			data:{
				"cat_id":cat_id,
			},
			success: function (data) {
				$(".news_cls").html(data.html);
			}
		});
	});
	$('.search_news_btn').on('click',function(){
		var search = $("#search").val();
		$.ajax({
			url: "/linqmd/get_search_news",
			method: "POST",
			cache: false,
			data:{
				"search":search,
			},
			success: function (data) {
				$(".news_cls").html(data.html);
			}
		});
	});

});