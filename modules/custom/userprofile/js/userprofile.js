jQuery(document).ready(function($) {
	$('.cat-news-load').on('click',function(){
		var cat_id = $(this).attr('data-id');
		var username = $('.tag').data('username');
		$.ajax({
			url: "/linqmd/get_category_news",
			method: "POST",
			cache: false,
			data:{
				"cat_id":cat_id,
				"username": username
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


	$('.testimonial-load').on('click',function(){
		var cat_id = $(this).attr('data-id');
		var username = $('.testimonial-load').data('username');
		$.ajax({
			url: "/linqmd/get_category_testimonials",
			method: "POST",
			cache: false,
			data:{
				"cat_id":cat_id,
				"username": username,
			},
			success: function (data) {
				$(".testimonials_cls").html(data.html);
			}
		});
	});

	$('.test-search').on('click',function(){
		var search = $("#tstsearch").val();
		$.ajax({
			url: "/linqmd/get_search_testimonials",
			method: "POST",
			cache: false,
			data:{
				"search":search,
			},
			success: function (data) {
				$(".testimonials_cls").html(data.html);
			}
		});
	});


	$('.faq-load').on('click',function(){
		var cat_id = $(this).attr('data-id');
		var username = $('.faq-load').data('username');
		$.ajax({
			url: "/linqmd/get_category_faq",
			method: "POST",
			cache: false,
			data:{
				"cat_id":cat_id,
				"username": username,
			},
			success: function (data) {
				$(".faq_cls").html(data.html);
			}
		});
	});

	

	$('.faq-search').on('click',function(){
		var search = $("#faqsearch").val();
		$.ajax({
			url: "/linqmd/get_search_faq",
			method: "POST",
			cache: false,
			data:{
				"search":search,
			},
			success: function (data) {
				$(".faq_cls").html(data.html);
			}
		});
	});

});
