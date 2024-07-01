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
	$(".book_appointment").click(function(){
		$(".time_slots").html('');
		$('.current_date_select').removeClass('activedates');
	});









$(document).on('click', '.current_date_select', function() {
    var current_date = $(this).attr('data-date');
    var target_id = $(this).attr('data-target_id');
    $('.current_date_select').removeClass('activedates date-highlight');
    $(this).addClass('activedates date-highlight');
    $.ajax({
        url: "/linqmd/get_booking_time_slot",
        method: "POST",
        cache: false,
        data: {
            "target_id": target_id,
            "current_date": current_date,
        },
        success: function (data) {
            $(".time_slots").html(data.html);
            setTimeout(hidePassedSlots, 0);
        }
    });
});
	
	$(document).ready(function() {
		hidePassedSlots();
	});

	function hidePassedSlots() {
		const now = new Date();
		const selectedDateElement = $('.current_date_select.activedates');
		const selectedDate = selectedDateElement.data('date');
		const selectedMonth = selectedDateElement.data('month');
		const selectedYear = selectedDateElement.data('year');
		const selectedDateTime = new Date(selectedYear, selectedMonth, selectedDate);
	
		const nowDate = new Date(now.getFullYear(), now.getMonth(), now.getDate());
		const selectedDateOnly = new Date(selectedDateTime.getFullYear(), selectedDateTime.getMonth(), selectedDateTime.getDate());
	
		if (selectedDateOnly.getTime() === nowDate.getTime()) {
			const currentHour = now.getHours();
			if (currentHour >= 12) {
				$('.morning-slot').addClass('slot-section-hidden');
			}
	
			if (currentHour >= 16) {
				$('.afternoon-slot').addClass('slot-section-hidden');
			}
	
			$('.ap-book').each(function() {
				const slotTime = $(this).data('time-slot');
				const [time, period] = slotTime.split(' ');
				let [hours, minutes] = time.split(':');
				hours = parseInt(hours);
				minutes = parseInt(minutes);
	
				if (period.toLowerCase() === 'pm' && hours !== 12) {
					hours += 12;
				} else if (period.toLowerCase() === 'am' && hours === 12) {
					hours = 0;
				}
	
				const slotDateTime = new Date(selectedYear, selectedMonth, selectedDate, hours, minutes);
	
				if (slotDateTime <= now) {
					$(this).hide();
				} else {
					$(this).show();
				}
			});
		} else {
			$('.ap-book').show();
			$('.morning-slot, .afternoon-slot, .evening-slot').removeClass('slot-section-hidden');
		}
	
		updateSlotSection('morning-slot', 0, 11);
		updateSlotSection('afternoon-slot', 12, 15);
		updateSlotSection('evening-slot', 16, 23);
	}
	
	function updateSlotSection(sectionClass, startHour, endHour) {
		const sectionElement = $(`.${sectionClass}`);
		const visibleSlots = sectionElement.find('.ap-book:visible').filter(function() {
			const slotTime = $(this).data('time-slot');
			const [time, period] = slotTime.split(' ');
			let [hours, ] = time.split(':');
			hours = parseInt(hours);
			if (period.toLowerCase() === 'pm' && hours !== 12) hours += 12;
			if (period.toLowerCase() === 'am' && hours === 12) hours = 0;
			return hours >= startHour && hours <= endHour;
		});
	
		const count = visibleSlots.length;
		if (count === 0) {
			sectionElement.addClass('slot-section-hidden');
		} else {
			sectionElement.removeClass('slot-section-hidden');
			const headingElement = sectionElement.find('.fs-3 b');
			const sectionName = headingElement.text().split('(')[0].trim();
			headingElement.text(`${sectionName} (${count} slots)`);
		}
	}



	





	
	$(document).on("click",".openPopup",function(){
		$(".overlay").show();
		$(".popup").show();
		var clinicname =$(this).attr('data-clinicname');
		var target_id =$(this).attr('data-target_id');
		var time_slot =$(this).attr('data-time-slot');
		var slot_name =$(this).attr('data-slot-name');
		$("#clinicname").val(clinicname);
		$("#clinic_target_id").val(target_id);
		$("#bookingtimeslot").val(time_slot);
		$("#bookingtime").val(slot_name);
	});
	if($("#booking_form").length > 0){
		$('#booking_form').validate({
			rules: {
				phonenumber: {
					required: true,
				},
				fullname: {
					required: true,
				},
				terms:{
					required: true,
				},
				reason:{
					required: true,	
				},
				otp:{
					required: true,	
				},
			},
			messages: {
				phonenumber: {
					required: "Please enter your phone number.",
				},
				fullname: {
					required: "Please enter your fullname.",
				},
				terms:{
					required: "Please select Terms and Conditions.",
				},
				reason:{
					required: "Please enter your reason for doctor visit.",
				},
				otp:{
					required: "Please enter otp.",	
				},
			},
			submitHandler: function(form) {
			var phonenumber = $("#phonenumber").val();
			var fullname = $("#fullname").val();
			var clinicname = $("#clinicname").val();
			var clinic_target_id = $("#clinic_target_id").val();
			var bookingtimeslot = $("#bookingtimeslot").val();
			var bookingtime = $("#bookingtime").val();
			var booking_date = $(".activedates").attr('data-date');
			var terms = $("#terms").val();
			var user_id = $("#user_id").val();
			var reason = $("#reason").val();
			var firsttime = $("#first-time").val();
			var doctor_type = $("#doctor_type").val();
				$.ajax({
					url: "/linqmd/booking-appointment",
					method: "POST",
					cache: false,
					data: {
						phonenumber:phonenumber,
						fullname:fullname,
						clinicname:clinicname,
						clinic_target_id:clinic_target_id,
						bookingtimeslot:bookingtimeslot,
						bookingtime:bookingtime,
						booking_date:booking_date,
						terms:terms,
						reason:reason,
						firsttime:firsttime,
						user_id:user_id,
						doctor_type:doctor_type
					}, 
					success: function (data) {
						$(".overlay").hide();
						$(".confirmation").html(data.html);
						$(".popup1").show();
						$(".popup").hide();
					}
				});
			}
		});
	}
	$(".generate_otp").click(function(){
		var phonenumber = $("#phonenumber").val();
		console.log(phonenumber);
		var type = $(this).attr('data-type');
		$("#phonenumber-error").html('');
		if(phonenumber == undefined){
			$("#phonenumber-error").html('Please enter your phone number.');
		}else{
			$.ajax({
				url: "/linqmd/generate-otp",
				method: "POST",
				cache: false,
				data: {
					phonenumber:phonenumber,
					type:type
				}, 
				success: function (data) {
					$(".generate_otp").hide();
					$(".resend_otp").show();
					$(".otp_cls").show();
					$(".otp_msg").html(data.message);
				}
			});
		}
		
	});
	$(document).on("focusout","#verify_otp",function(){
		var otp = $(this).val();
		$.ajax({
			url: "/linqmd/otp-verify-booking-appointment",
			method: "POST",
			cache: false,
			data: {
				otp:otp,
			}, 
			success: function (data) {
				$("#verify_otp-error").show();
				$("#verify_otp-error").html(data.error);
				$(".otp_msg1").html(data.message);
			}
		});
	});
	$(".resend_otp").click(function(){
		var phonenumber = $("#phonenumber").val();
		var type = $(this).attr('data-type');
		$("#phonenumber-error").html('');
		if(phonenumber == undefined){
			$("#phonenumber-error").html('Please enter your phone number.');
			return false;
		}
		$.ajax({
			url: "/linqmd/generate-otp",
			method: "POST",
			cache: false,
			data: {
				phonenumber:phonenumber,
				type:type
			}, 
			success: function (data) {
				$(".otp_msg").html(data.message);
				// $(".generate_otp").hide();
				// $(".resend_otp").show();
			}
		});
	});
	$('#otp_verify_form').validate({
		rules: {
			otp: {
				required: true,
			}
		},
		messages: {
			otp: {
				required: "Please enter otp",
			}
		},
		submitHandler: function(form) {
			var phonenumber = $("#phone").val();
			var fullname = $("#name").val();
			var clinicname = $("#clinicname").val();
			var clinic_target_id = $("#clinic_target_id").val();
			var bookingtimeslot = $("#bookingtimeslot").val();
			var bookingtime = $("#bookingtime").val();
			var booking_date = $(".activedates").attr('data-date');
			var otp = $("#otp").val();
			$.ajax({
				url: "/linqmd/otp-verify-booking-appointment",
				method: "POST",
				cache: false,
				data: {
					phonenumber:phonenumber,
					fullname:fullname,
					clinicname:clinicname,
					clinic_target_id:clinic_target_id,
					bookingtimeslot:bookingtimeslot,
					otp:otp,
					bookingtime:bookingtime,
					booking_date:booking_date,
				}, 
				success: function (data) {
					if(data.error != ''){
						$(".error").html(data.error);
					}else{
						$(".overlay").hide();
						$(".otp_form").hide();
						$(".otp_verify_cls").show();
						$(".otp_verify_cls").hide();
						$(".confirmation").html(data.html);
						$(".popup1").show();
						$(".popup").hide();
					}
				}
			});
		}
	});
	$(document).on('click',".close-btn",function(){
		$(".confirmation").html('');
		$(".popup1").hide();
		location.reload();
	});
	function getUrlParameter(name) {
		// var sPageURL = window.location.search.substring(1),
		// sURLVariables = sPageURL.split('&'),
		// sParameterName,
		// i;

		// for (i = 0; i < sURLVariables.length; i++) {
		// 	sParameterName = sURLVariables[i].split('=');

		// 	if (sParameterName[0] === sParam) {
		// 		return sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
		// 	}
		// }
		const urlParams = new URLSearchParams(window.location.search);
		const param1 = urlParams.get(name);
		return param1;
	}
	if($("#booking_appointment").length > 0){
		$('#booking_appointment').validate({
			rules: {
				paitent_name: {
					required: true,
				},
				phone_number: {
					required: true,
				}
			},
			messages: {
				paitent_name: {
					required: "Please enter your name.",
				},
				phone_number: {
					required: "Please enter your phone number",
				},
			},
			submitHandler: function(form) {
			var paitent_name = $("#paitent_name").val();
			var phone_number = $("#phone_number").val();
			var time_slot = $("#time_slot").val();
			var time_slot_name = $("#time_slot_name").val();
			var booking_date = $("#booking_date").val();
			var doctor = getUrlParameter('doctor');
			var hospital = getUrlParameter('hospital');
			var hospital_name = $(".hospital option:selected").text();
				$.ajax({
					url: "/linqmd/admin-booking-appointment",
					method: "POST",
					cache: false,
					data: {
						phone_number:phone_number,
						paitent_name:paitent_name,
						time_slot:time_slot,
						time_slot_name:time_slot_name,
						booking_date:booking_date,
						doctor:doctor,
						hospital:hospital,
						hospital_name:hospital_name
					}, 
					success: function (data) {
						location.reload();
					}
				});
			}
		});
	}
	$(document).on("click",".cancel_appoiment",function(){
		var id = $(this).attr('data-id');
		$.ajax({
			url: "/linqmd/cancel-appointment",
			method: "POST",
			cache: false,
			data:{
				"id":id,
			},
			success: function (data) {
				location.reload();
			}
		});
	});
	$('#morningBtn,#evening1Btn,#evening2Btn').click(function() {
	  var buttonText = $(this).find('strong').text();
	  $('#modalContent').text(buttonText);
	  var booking_date = $(this).attr('data-date');
	  var time_slot_name = $(this).attr('data-time-slot-name');
	  $('#time_slot').val(buttonText.trim());
	  $('#time_slot_name').val(time_slot_name);
	  $('#booking_date').val(booking_date);
	  $('.booking_popup').text(booking_date);
	});
	$(document).on("click",".open_booking_popup",function(){
		var id = $(this).attr('data-id');
		$.ajax({
			url: "/linqmd/get-appointment-data",
			method: "POST",
			cache: false,
			data:{
				"id":id,
			},
			success: function (data) {
				$(".booking_data").html(data.html);
			}
		});
	});
	var base_url = window.location.origin+'/linqmd/doctor-dashboard/';
	$(document).on("change", ".years, .hospital, #months", function() {
		var hospital = $(".hospital option:selected").val();
		var years = $(".years option:selected").val();
		var doctor_select = $(".doctor_select option:selected").val();
		var month = $("#months option:selected").val(); // Assuming months is a separate dropdown

		// Initialize query string
		var query_url = '';

		// Append parameters if they are defined
		if (years !== undefined) {
			query_url += '&year=' + years;
		}
		if (doctor_select !== undefined) {
			query_url += '&doctor=' + doctor_select;
		}
		if (hospital !== undefined) {
			query_url += '&hospital=' + hospital;
		}
		if (month !== undefined) {
			query_url += '&month=' + month;
		}

		// Construct the full URL with base_url
		var full_url = base_url + '?' + query_url.substring(1); // Remove leading '&' or '?'

		// Redirect to the constructed URL
		window.location.href = full_url;
	});
	$(document).on("change",".doctor_select",function(){
		var user_id = $(this).val();
		$.ajax({
			url: "/linqmd/get-hospital",
			method: "POST",
			cache: false,
			data: {
				user_id:user_id,
			}, 
			success: function (data) {
				$(".hospital").html(data.html);
			}
		});
	});
	if($("#scroller-container").length > 0){
		const container = document.getElementById("scroller-container");
		const prevBtn = document.getElementById("prevBtn");
		const nextBtn = document.getElementById("nextBtn");

		prevBtn.addEventListener("click", () => {
		  container.scrollLeft -= 200; // Adjust scrolling distance as needed
		});

		nextBtn.addEventListener("click", () => {
		  container.scrollLeft += 200; // Adjust scrolling distance as needed
		});
	}
	if($('#switch').length > 0){
		document.getElementById('switch').classList.add('on');
	}
	const link = encodeURI(window.location.href);
	console.log(link)
    const msg = encodeURIComponent('Hey, I found this article');
    const title = encodeURIComponent('Article');
    
    const fb = document.querySelector('.fbshare');
    fb.href = `https://www.facebook.com/share.php?u=${link}`;
    
    const whatsapp = document.querySelector('.whatsappshare');
    whatsapp.href = `https://api.whatsapp.com/send?text=${msg}: ${link}`;
    
    const linkedIn = document.querySelector('.linkedinshare');
    linkedIn.href = `https://www.linkedin.com/sharing/share-offsite/?url=${link}`;
    
    const twitter = document.querySelector('.twittershare');
    twitter.href = `http://twitter.com/share?&url=${link}&text=${msg}&hashtags=javascript,programming`;
    if($("#comment-form").length > 0){
		$('#comment-form').validate({
			rules: {
				username: {
					required: true,
				},
				email: {
					required: true,
					email:true,
				},
				comment:{
					required: true,
				}
			},
			messages: {
				username: {
					required: "Please enter name.",
				},
				email: {
					required: "Please enter email.",
					email:"Pleae enter valid email."
				},
				comment:{
					required: "Please enter comment.",
				}
			},
			submitHandler: function(form) {
				var username = $("#name").val();
				var email = $("#email").val();
				var comment = $("#comment").val();
				var node_id = $("#node_id").val();
				$.ajax({
					url: "/linqmd/comment-save",
					method: "POST",
					cache: false,
					data: {
						username:username,
						email:email,
						comment:comment,
						node_id:node_id,
					}, 
					success: function (data) {
						
					}
				});
			}
		});
	}
});
function toggleSwitch(element) {
	if(confirm("Are you sure you want switch?")){
		if (element.classList.contains('on')) {
			element.classList.remove('on');
			element.classList.add('off');
			var switch_data = 'out';
		} else {
			var switch_data = 'in';
			element.classList.remove('off');
			element.classList.add('on');
		}
		var date = element.dataset.date;
		var user_id = $(".clinic_date_data").attr("data-user-id");
		$.ajax({
			url: "/linqmd/doctor-availability",
			method: "POST",
			cache: false,
			data: {
				user_id:user_id,
				date:date,
				switch_data:switch_data,
			}, 
			success: function (data) {
				$(".hospital").html(data.html);
				location.reload();
			}
		});
	}else{
		return false;
	}

}