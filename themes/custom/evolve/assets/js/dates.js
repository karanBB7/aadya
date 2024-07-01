const months = [
    'January', 'February', 'March', 'April', 'May', 'June',
    'July', 'August', 'September', 'October', 'November', 'December'
];

let currentViewDate = new Date();

$(document).ready(function() {
    loadMonthsCarousel();
    loadDatesCarousel();
});

function loadMonthsCarousel() {
    const monthCarousel = $('#month-carousel');
    monthCarousel.html('');
    months.forEach((month, index) => {
        const monthElement = $('<div class="month-wrapper text-center"></div>');
        monthElement.attr('data-month-index', index);
        monthElement.text(month);
        monthCarousel.append(monthElement);
    });

    $('.monthslider2').owlCarousel({
        loop: false,
        margin: 10,
        nav: true,
        items: 1,
        dots: false,
        startPosition: new Date().getMonth()
    });

    $('.month-wrapper').on('click', function() {
        const selectedMonth = parseInt($(this).data('month-index'));
        currentViewDate = new Date(currentViewDate.getFullYear(), selectedMonth, 1);
        loadDatesCarousel();
    });
}

function loadDatesCarousel() {
    $('.dateslider').each(function() {
        const dateContainer = $(this);
        const targetId = dateContainer.data('target_id');
        dateContainer.trigger('destroy.owl.carousel');
        dateContainer.html('');

        const today = new Date();
        let startDate = new Date(Math.max(today, currentViewDate));

        for (let i = 0; i < 7; i++) {
            const date = new Date(startDate);
            date.setDate(startDate.getDate() + i);

            const dateWrapper = $('<div class="item date-wrapper current_date_select text-center"></div>');
            const dayElement = $('<div class="day text-center"></div>').text(date.toLocaleString('en-us', {
                weekday: 'short'
            }).toUpperCase());
            const dateElement = $('<div class="date text-center"></div>').text(date.getDate());

            dateWrapper.attr('data-date', date.getDate());
            dateWrapper.attr('data-month', date.getMonth());
            dateWrapper.attr('data-year', date.getFullYear());
            dateWrapper.attr('data-target_id', targetId);

            if (date.toDateString() === today.toDateString()) {
                dateWrapper.addClass('highlight-today');
            }

            dateWrapper.append(dayElement);
            dateWrapper.append(dateElement);
            dateContainer.append(dateWrapper);
        }

        dateContainer.owlCarousel({
            loop: false,
            margin: 10,
            nav: true,
            navText: ['<i class="fas fa-chevron-left"></i>', '<i class="fas fa-chevron-right"></i>'],
            items: 7,
            dots: false,
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 7
                }
            },
            onInitialized: addCustomNavigation
        });
    });

    updateMonthCarousel();
    attachDateSelectListener();
}

function addCustomNavigation(event) {
    $('.dateslider .owl-nav').show();
    $('.dateslider .owl-next').off('click').on('click', function() {
        updateDates(1);
        return false;
    });

    $('.dateslider .owl-prev').off('click').on('click', function() {
        updateDates(-1);
        return false;
    });
}

function updateDates(offset) {
    const today = new Date();
    currentViewDate.setDate(currentViewDate.getDate() + offset * 7);
    if (currentViewDate < today) {
        currentViewDate = new Date(today);
    }
    loadDatesCarousel();
}

function updateMonthCarousel() {
    $('.monthslider2').trigger('to.owl.carousel', [currentViewDate.getMonth(), 300]);
}

function attachDateSelectListener() {
    $(document).off('click', '.current_date_select').on('click', '.current_date_select', function() {
        var current_date = $(this).attr('data-date');
        var target_id = $(this).attr('data-target_id');
        $('.current_date_select').removeClass('activedates');
        $(this).addClass('activedates');
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
            }
        });
    });
}











