const months = [
    'January', 'February', 'March', 'April', 'May', 'June',
    'July', 'August', 'September', 'October', 'November', 'December'
];

let currentViewDate = new Date();

$(document).ready(function() {
    loadMonthsCarousel();
    loadDatesCarousel();
    hidePassedSlots();
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
        navText: ['<i class="fas fa-chevron-left owl-left"></i>', '<i class="owl-right fas fa-chevron-right"></i>'],
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
           
            const dayElement = $('<div class="day text-center"></div>').html(`
                <span class="day-month">${date.toLocaleString('en-us', { weekday: 'short' }).toUpperCase()} / ${date.toLocaleString('en-us', { month: 'short' }).toUpperCase()}</span><br>
                <span class="date-number">${date.getDate()}</span>
            `);
            const dateElement = $('<div class="date text-center"></div>').append(dayElement);

            dateWrapper.attr('data-date', date.getDate());
            dateWrapper.attr('data-month', date.getMonth() + 1);
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
            navText: ['<i class="fas fa-chevron-left owl-left"></i>', '<i class="owl-right fas fa-chevron-right"></i>'],
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
    currentViewDate.setDate(currentViewDate.getDate() + offset);
    if (currentViewDate < today) {
        currentViewDate = new Date(today);
    }
    loadDatesCarousel();
}

function updateMonthCarousel() {
    $('.monthslider2').trigger('to.owl.carousel', [currentViewDate.getMonth(), 300]);
}

// function attachDateSelectListener() {
//     $(document).off('click', '.current_date_select').on('click', '.current_date_select', function() {
//         var current_date = $(this).attr('data-date');
//         var target_id = $(this).attr('data-target_id');
//         $('.current_date_select').removeClass('activedates date-highlight');
//         $(this).addClass('activedates date-highlight');
//         $.ajax({
//             url: "/get_booking_time_slot",
//             method: "POST",
//             cache: false,
//             data: {
//                 "target_id": target_id,
//                 "current_date": current_date,
//             },
//             success: function (data) {
//                 $(".time_slots").html(data.html);
//                 setTimeout(hidePassedSlots, 0);
//             }
//         });
//     });
// }

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