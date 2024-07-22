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
		var username = $('.uname').data('username');
		$.ajax({
			url: "/linqmd/get_search_news",
			method: "POST",
			cache: false,
			data:{
				"search":search,
				"uid": username
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
		var username = $('.uname').data('username');
		$.ajax({
			url: "/linqmd/get_search_testimonials",
			method: "POST",
			cache: false,
			data:{
				"search":search,
				"uid": username
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
		var username = $('.uname').data('username');
		$.ajax({
			url: "/linqmd/get_search_faq",
			method: "POST",
			cache: false,
			data:{
				"search":search,
				"uid": username
			},
			success: function (data) {
				$(".faq_cls").html(data.html);
			}
		});
	});


	$('#email-capture-form').on('submit', function(event) {
		event.preventDefault(); 
	
		var emailtocapture = $(".emailtocapture").val();
		$.ajax({
			url: "/linqmd/capture_email",
			method: "POST",
			cache: false,
			data: {
				"emailid": emailtocapture
			},
			success: function(data) {
				console.log("Email captured successfully:", data);
				Swal.fire({
					title: 'Thank You!',
					text: 'We appreciate your interest. We will contact you shortly with more information.',
					icon: 'success',
					confirmButtonText: 'OK'
				});
				$(".emailtocapture").val('');
			},
			error: function(xhr, status, error) {
				console.error("Error capturing email:", error);
			}
		});
	});












	$(".book_appointment").click(function(){
		$(".time_slots").html('');
		$('.current_date_select').removeClass('activedates');
	});






	$(document).ready(function() {
		function clickTodayAndSelect() {
			$('.highlight-today').click();
			setTimeout(function() {
				$('.highlight-today.current_date_select').click();
			}, 100);
		}
	
		clickTodayAndSelect();
	
		$(document).on('click', '.clinicname', function() {
			var targetId = $(this).data('target_id');
			$('.dateslider').attr('data-active-target-id', targetId);
			clickTodayAndSelect();
		});
	
		$(document).on('click', '.highlight-today', function() {
			if (!$(this).hasClass('current_date_select')) {
				$(this).click();
			}
		});
	
		$(document).on('click', '.current_date_select', function() {
			var current_date = $(this).attr('data-date');
			var month = $(this).attr('data-month');
			var year = $(this).attr('data-year');
			var target_id = $('.nav-link.clinicname.active').data('target_id');
			$('.current_date_select').removeClass('activedates date-highlight');
			$(this).addClass('activedates date-highlight');
	
			$.ajax({
				url: "/linqmd/get_booking_time_slot",
				method: "POST",
				cache: false,
				data: {
					"target_id": target_id,
					"current_date": current_date,
					"month": month,
					"year": year,
				},
				success: function (data) {
					$(".time_slots").html(data.html);
					filterAndUpdateTimeSlots(year, month, current_date);
				}
			});
		});
	
	});


	function filterAndUpdateTimeSlots(year, month, current_date) {
		var now = new Date();
		var selectedDate = new Date(year, month - 1, current_date);
		var isToday = selectedDate.toDateString() === now.toDateString();
		var clinicName = $('.clinicname.active').text().trim();
		var formattedDate = selectedDate.toLocaleDateString('en-US', { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' });
	
		if (isToday) {
			var currentTime = now.getHours() * 60 + now.getMinutes();
	
			$(".time_slots .ap-book").each(function() {
				var slotTime = $(this).find('b').text().trim();
				var [hours, minutes, period] = slotTime.match(/(\d+):(\d+)\s*(AM|PM)/).slice(1);
				var slotMinutes = parseInt(hours) * 60 + parseInt(minutes);
				if (period === 'PM' && hours != '12') {
					slotMinutes += 12 * 60;
				}
				if (slotMinutes <= currentTime) {
					$(this).remove();
				}
			});
		}
	
		var totalVisibleSlots = 0;
	
		$('.morning-slot, .afternoon-slot, .evening-slot').each(function() {
			var $section = $(this);
			var $header = $section.find('.fs-3 b');
			var sectionName = $header.text().split('(')[0].trim();
			var visibleSlots = $section.find('.ap-book').length;
	
			totalVisibleSlots += visibleSlots;
	
			if (visibleSlots === 0) {
				$section.hide();
			} else {
				$section.show();
				$header.text(sectionName + ' (' + visibleSlots + ' slots)');
			}
		});
	
		if (totalVisibleSlots === 0) {
			$('.no-slots-message').remove();
			$('.time_slots').append('<p class="no-slots-message fs-5 text-center pt-4">No slots available on the selected <b>' + formattedDate + '</b> at the <b>' + clinicName + '</b>.</p>');
		} else {
			$('.no-slots-message').remove();
		}
	}








	$(document).on("click",".openPopup",function(){
		$(".overlay").show();
		$(".popup").show(); 
		var clinicname =$(this).attr('data-clinicname');
		var target_id =$(this).attr('data-target_id');
		var time_slot =$(this).attr('data-time-slot');
		var slot_name =$(this).attr('data-slot-name');
		var date =$(this).attr('data-date');


		$('.selecteddate').text(date);
		$('.selectedtimename').text(slot_name);
		$('.selectedtime').text(time_slot);

		$("#clinicname").val(clinicname);
		$("#clinic_target_id").val(target_id);
		$("#bookingtimeslot").val(time_slot);
		$("#bookingtime").val(slot_name);
		$(".booking_details").html('Please fill in details to Request an appointment with Dr. Murali Mohan S on '+date+' at '+time_slot+'.')
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
			var clinicnumber = $('.clinicnumber').data('clinicnumber');

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
						doctor_type:doctor_type,
						clinic_phone_number:clinicnumber
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



	



	
	var otpVerified = false;

    function isValidPhoneNumber(phone) {
        return /^[6-9]\d{9}$/.test(phone);
    }

    function toggleOtpButton() {
        var phone = $("#phonenumber").val();
        $("#generate_otp").prop("disabled", !isValidPhoneNumber(phone));
    }

    $("#phonenumber").on("input", function() {
        var phone = $(this).val();
        if (!isValidPhoneNumber(phone)) {
            $("#phonenumber-error").text("Please enter a valid 10-digit mobile number starting with 6, 7, 8, or 9.").show();
        } else {
            $("#phonenumber-error").hide();
        }
        toggleOtpButton();
    });

    $(".generate_otp").click(function(){
        var phonenumber = $("#phonenumber").val();
        var type = $(this).attr('data-type');
		var doc_name = $(this).data('field-name');
        $("#phonenumber-error").html('');

        if(!isValidPhoneNumber(phonenumber)){
            $("#phonenumber-error").html('Please enter a valid 10-digit mobile number starting with 6, 7, 8, or 9.').addClass("error-message");
            return; 
        }

        $.ajax({
            url: "/linqmd/generate-otp",
            method: "POST",
            cache: false,
            data: {
                phonenumber: phonenumber,
                type: type,
				doc_name: doc_name
            }, 
            success: function (data) {
                $(".generate_otp").hide();
                $(".resend_otp").show();
                $(".otp_cls").show();
                $(".otp_msg").html(data.message);
            }
        });
    });

  

    $("#verify_otp").keypress(function(e){
        if(e.which == 13) { 
            e.preventDefault();  
            $("#verify_otp_btn").click();  
            return false;
        }
    });

    $("#verify_otp_btn").click(function(){
        var otp = $("#verify_otp").val();
        $.ajax({
            url: "/linqmd/otp-verify-booking-appointment",
            method: "POST",
            cache: false,
            data: {
                otp: otp,
            }, 
            success: function (data) {
                if(data.status === "success" || data.message === "OTP verify.") {
                    $(".otp_msg1").html("OTP verified successfully").removeClass("error-message").addClass("success-message");
                    $(".otp_cls").hide();
                    $("#additional_fields").show();
                    otpVerified = true;  
                    $("#bookAppointmentButton").prop('disabled', false);  
                } else {
                    $("#verify_otp-error").show();
                    $("#verify_otp-error").html(data.error || "Invalid OTP");
                    $(".otp_msg1").html(data.message || "OTP verification failed").removeClass("success-message").addClass("error-message");
                    otpVerified = false;  
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log("AJAX error:", textStatus, errorThrown); 
                $("#verify_otp-error").show();
                $("#verify_otp-error").html("An error occurred while verifying OTP").addClass("error-message");
                otpVerified = false;  
            }
        });
    });

    $("#booking_form").submit(function(e) {
        var phone = $("#phonenumber").val();
        if (!isValidPhoneNumber(phone)) {
            e.preventDefault();
            $("#phonenumber-error").text("Please enter a valid 10-digit mobile number starting with 6, 7, 8, or 9.").show();
            return false;
        }
        if(!otpVerified){
            e.preventDefault();  
            alert("Please verify your OTP before booking an appointment.");
            return false;
        }
    });
    $("#bookAppointmentButton").prop('disabled', true);









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
	if($('#otp_verify_form').length > 0){
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
	}
	
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
	var base_url = window.location.origin+'/doctor-dashboard/';
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
				var query_url = '';

				if (user_id !== undefined) {
					query_url += '&doctor=' + user_id;
				}
				if (data.doctor_clinics !== undefined) {
					query_url += '&hospital=' + data.doctor_clinics;
				}
				var full_url = base_url + '?' + query_url.substring(1);
				window.location.href = full_url;
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
						$('#comment-form')[0].reset();
						location.reload();
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