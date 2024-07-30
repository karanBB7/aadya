$(document).ready(function() {
    $('.star').on('click', function() {
        var value = parseInt($(this).data('value'));
        $('#ratingValue').text('You rated ' + value + ' stars.');
    });
});

$(document).ready(function () {

if($(".docslider").length > 0){
$('.docslider').owlCarousel({
    loop:false,
    margin:10,
    nav:true,
    responsive:{
        0:{
            items:1
        },
        600:{
            items:3
        },
        1000:{
            items:3
        }
    }
})
}
   
  
    if($(".dateslider").length > 0){
    $('.dateslider').owlCarousel({
        center: true,
        items: 2,
        loop: true,
        margin: 15,
        responsive: {
            600: {
                nav: true,
                items: 7
            },
            0: {
                items: 1,
                 nav:true
            }
        }
    });
}




  if($(".blogslider").length > 0){
    $('.blogslider').owlCarousel({
        center: true,
        loop: true,
        margin: 15,
        responsive: {
            0: {
                items: 1,
                nav:true
            }
        }
    });
}

    
    if($(".testimonial-slider").length > 0){
    $('.testimonial-slider').owlCarousel({
        loop: false,
        margin: 5,
        responsive: {
            0: {
                items: 1,
                nav:true
            },
            600:{
                items:2,
                nav:true
            },
            1000:{
                items:3,
                nav:true
            }
        }
    });
}

       if($(".patient").length > 0){ 
    $('.patient').owlCarousel({
        center: true,
        loop: true,
        margin: 15,
        items:1,
        nav:true
    });
}
  
  });
  
  
  
//   $(document).ready(function() {
//       $('.blogslider').owlCarousel({
//           loop: true,
//           margin: 15,
//           responsive: {
//               0: {
//                   items: 1
//               }
//           }
//       });
//   });
  
  
  
  $(".accordion .accordion-item .accordion-label").on("click", function () {
    let $clickedItem = $(this);
    if ($clickedItem.hasClass("cw-open")) {
        $clickedItem.removeClass("cw-open");
    } else {
        $(".accordion .accordion-item .accordion-label").removeClass("cw-open");
        $clickedItem.addClass("cw-open");
    }
  });
  
  
  
  
  $(document).ready(function () {
    $('.appbtn').click(function (e) {
  
        var targetSection = $('#sec3');
        $('html, body').animate({
            scrollTop: targetSection.offset().top
        }, 100);
    });
  });
  
  $(document).ready(function () {
      $('.appbtnred').click(function (e) {
    
          var targetSection = $('#p2sec3');
          $('html, body').animate({
              scrollTop: targetSection.offset().top
          }, 100);
      });
  });
    
    if($("#blogfix").length > 0){
        $('#blogfix').trigger('destroy.owl.carousel');
        $('#blogfix').owlCarousel();
    }
  
  
    $(document).ready(function() {
        $('.testimonial-content').each(function() {
            var content = $(this);
            var readMoreLink = content.siblings('.readMoreLink');
                var contentHeight = content[0].scrollHeight;
                if (contentHeight > 3 * parseInt(content.css('line-height'))) {
                content.addClass('collapsed');
                readMoreLink.show();
    
                readMoreLink.click(function(e) {
                    e.preventDefault();
                    content.toggleClass('expanded');
                    if (content.hasClass('expanded')) {
                        content.css('max-height', 'none');
                        readMoreLink.text('Read less');
                    } else {
                        content.css('max-height', '3em');
                        readMoreLink.text('Read more');
                    }
                });
            }
        });
    });
    



    // $(document).ready(function() {
    //     $('.readMore').on('click', function() {
    //         var articleContent = $(this).prev('.article-content');
    //         var buttonText = $(this).text();
    
    //         if (articleContent.hasClass('expanded')) {
    //             articleContent.removeClass('expanded');
    //             articleContent.css('max-height', '3em'); 
    //             $(this).text('Read More');
    //         } else {
    //             articleContent.addClass('expanded');
    //             articleContent.css('max-height', 'none');
    //             $(this).text('Read Less');
    //         }
    //     });
    // });


    
    $(document).ready(function() {
        $('#sec5 .tag').click(function() {
            $('#sec5 .tag').removeClass('active-tag1'); 
            $(this).addClass('active-tag1'); 
        });
        $('#p2sec5 .tag').click(function() {
            $('#p2sec5 .tag').removeClass('active-tag2'); 
            $(this).addClass('active-tag2'); 
        });

    
        $('body').on('click', '#sec6 .exp', function() {
            $('#sec6 .exp').removeClass('activeexperience1'); 
            $(this).addClass('activeexperience1');
        });
    
        $('body').on('click', '#p2sec6 .exp', function() {
            $('#p2sec6 .exp').removeClass('activeexperience2'); 
            $(this).addClass('activeexperience2');
        });


        $('body').on('click', '#sec7 .exp', function() {
            $('#sec7 .exp').removeClass('activeexperience1'); 
            $(this).addClass('activeexperience1');
        });
    
        $('body').on('click', '#p2sec7 .exp', function() {
            $('#p2sec7 .exp').removeClass('activeexperience2'); 
            $(this).addClass('activeexperience2');
        });

    });
    
    $(document).ready(function() {
        $('.overview-content').each(function() {
            var contentElement = $(this);
            var content = contentElement.text().trim();
            var words = content.split(/\s+/);
            var visibleWords = 50;
    
            if (words.length > visibleWords) {
                var visibleContent = words.slice(0, visibleWords).join(' ');
                var hiddenContent = words.slice(visibleWords).join(' ');
    
                contentElement.html(visibleContent + '<span class="more-content" style="display: none;"> ' + hiddenContent + '</span>');
                contentElement.next('.read-more-btn').show(); // Show the button if there is hidden content
    
                contentElement.next('.read-more-btn').on('click', function() {
                    $(this).prev('.overview-content').find('.more-content').toggle();
                    var btnText = $(this).text() === 'Read more' ? 'Read less' : 'Read more';
                    $(this).text(btnText);
                });
            }
        });
    });


    $(document).ready(function(){
        function generateStars(rating) {
            var fullStars = Math.floor(rating);
            var halfStar = (rating % 1) >= 0.5 ? 1 : 0;            
            var starsHTML = '';
            
            for (var i = 0; i < fullStars; i++) {
                starsHTML += '<i class="fas fa-star "></i>';
            }
            
            if (halfStar) {
                starsHTML += '<i class="fas fa-star-half-alt "></i>';
            }
            
            for (var j = fullStars + halfStar; j < 5; j++) {
                starsHTML += '<i class="far fa-star "></i>';
            }
            
            $('#star').html(starsHTML);
            $('#starsecondtheme').html(starsHTML);
        }
        var ratingValue = $('#star').data('rating');
        generateStars(ratingValue);
    });


    $(document).ready(function(){
        function setupReadMore(section, linkClass) {
            $(section).find('.exp-cont').each(function(){
                var content = $(this).html();
                if(content.length > 150){
                    var shortenedContent = content.substring(0, 150).trim() + '...';
                    $(this).data('fullText', content);
                    $(this).html(shortenedContent + ' <a href="#" class="' + linkClass + '">Read more</a>');
                }
            });
    
            $(document).on('click', '.' + linkClass, function(e){
                e.preventDefault();
                var $expCont = $(this).closest('.exp-cont');
                var fullText = $expCont.data('fullText');
                var isExpanded = $expCont.data('expanded') || false;
                if(isExpanded){
                    var shortenedContent = fullText.substring(0, 150).trim() + '...';
                    $expCont.html(shortenedContent + ' <a href="#" class="' + linkClass + '">Read more</a>');
                    $expCont.data('expanded', false);
                } else {
                    $expCont.html(fullText + ' <a href="#" class="' + linkClass + '">Show less</a>');
                    $expCont.data('expanded', true);
                }
            });
        }
        setupReadMore('#sec4', 'read-more-link');
        setupReadMore('#p2sec4 .secondtheme', 'read-more-link2');
    });



    
    function extractVideoID(url) {
        try {
            const urlObj = new URL(url);
            return urlObj.searchParams.get('v') || null;
        } catch (error) {
            // console.warn('Invalid URL:', url);
            return null;
        }
    }
    
    function setupYoutubeEmbeds(linkClass, iframeClass) {
        $(`.${linkClass}`).each(function(index) {
            const youtubeLink = $(this).text().trim();
            const videoID = extractVideoID(youtubeLink);
            if (videoID) {
                const iframeSrc = `https://www.youtube.com/embed/${videoID}?si=83oiblxyjFLcMFmN`;
                $(`.${iframeClass}`).eq(index).attr('src', iframeSrc);
            }
        });
    }
    
    $(document).ready(function() {
        setupYoutubeEmbeds('link', 'youtube-iframe');
        setupYoutubeEmbeds('link-overview', 'youtube-iframe-overview');
        setupYoutubeEmbeds('link-speciality', 'youtube-iframe-speciality');
        setupYoutubeEmbeds('link-patient', 'youtube-iframe-patient');
    });





    $(document).ready(function () {
        $('.blog-scroll').click(function (e) {
      
            var targetSection = $('#sec5');
            $('html, body').animate({
                scrollTop: targetSection.offset().top
            }, 100);
        });
      });
    
    
    
      $(document).ready(function () {
        $('.blog-scroll2').click(function (e) {
      
            var targetSection = $('#p2sec5');
            $('html, body').animate({
                scrollTop: targetSection.offset().top
            }, 100);
        });
      });
    
    




      $(document).ready(function() {
        const $navPills = $('#navPills');
        const $tabContent = $('#tabContent');
        const pillItems = $navPills.children().toArray();
        function isSmallDevice() {
            return $(window).width() <= 768; 
        }
    
        $navPills.on('click', 'a', function(event) {
            event.preventDefault();
            if (isSmallDevice()) {
                const $selectedPill = $(this).parent();
                const selectedPillIndex = pillItems.indexOf($selectedPill[0]);
                const $selectedPillContent = $(`#${$(this).attr('href').substring(1)}`);
                $navPills.find('.nav-link').removeClass('active');
                $(this).addClass('active');
                $tabContent.find('.tab-pane').removeClass('show active');
                $selectedPillContent.addClass('show active');
                $selectedPill.prependTo($navPills);
                $navPills.css('transform', `translateX(-${$selectedPill.position().left}px)`);
                const reorderedPillItems = pillItems.slice(selectedPillIndex).concat(pillItems.slice(0, selectedPillIndex));
                $.each(reorderedPillItems, function(index, item) {
                    $navPills.append(item);
                });
            }
        });
    });




    $(document).ready(function() {
        const $listWrapper = $('.clinic-list-wrapper');
        const $list = $('.clinic-list');
        
        if ($list.length === 0) {
            console.warn("Element with class 'clinic-list' not found");
            return;  // Exit the function early if the list is not found
        }
        
        const $items = $list.find('.nav-item');
        const $nextBtn = $('.next-clinic');
        const $prevBtn = $('.prev-clinic');
        
        if ($items.length === 0) {
            console.warn("No elements with class 'nav-item' found");
            return;  // Exit the function early if no items are found
        }
        
        let currentIndex = 0;
        
        function showClinic(index) {
            currentIndex = index;
            $items.each(function(i) {
                $(this).css('order', i >= index ? i - index : $items.length - index + i);
            });
            const $activeLink = $items.eq(index).find('.nav-link');
            if ($activeLink.length) {
                $activeLink.click();
            } else {
                console.warn(`No .nav-link found in item at index ${index}`);
            }
        }
        
        function rotateClinic(direction) {
            if (direction === 'next') {
                currentIndex = (currentIndex + 1) % $items.length;
            } else {
                currentIndex = (currentIndex - 1 + $items.length) % $items.length;
            }
            showClinic(currentIndex);
        }
        
        if ($items.length > 1) {
            $nextBtn.on('click', function() { rotateClinic('next'); });
            $prevBtn.on('click', function() { rotateClinic('prev'); });
            showClinic(currentIndex);
        } else {
            $nextBtn.hide();
            $prevBtn.hide();
        }
    });





    $(document).ready(function() {
        function setShareLinks() {
            var link = encodeURI(window.location.href);
            var msg = encodeURIComponent('Hey, I found this article');
            var title = encodeURIComponent('Article');
    
            var selectors = ['.fbshare', '.whatsappshare', '.linkedinshare', '.twittershare'];
            var urls = [
                'https://www.facebook.com/share.php?u=' + link,
                'https://api.whatsapp.com/send?text=' + msg + ': ' + link,
                'https://www.linkedin.com/sharing/share-offsite/?url=' + link,
                'http://twitter.com/share?&url=' + link + '&text=' + msg + '&hashtags=javascript,programming'
            ];
    
            var allFound = true;
            $.each(selectors, function(index, selector) {
                var $element = $(selector);
                if ($element.length) {
                    $element.attr('href', urls[index]);
                } else {
                    allFound = false;
                }
            });
    
            return allFound;
        }
    
        function extractVideoID(url) {
            if (!url || typeof url !== 'string') return null;
            try {
                var urlObj = new URL(url);
                return urlObj.searchParams.get('v') || null;
            } catch (error) {
                return null;
            }
        }

    });


