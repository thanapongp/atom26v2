$(document).ready(function () {
    $('.home-carousel').flickity({
        wrapAround: true,
        setGallerySize: false,
        pageDots: false
    });

    $('#news-carousel, #gallery-carousel').flickity({
        wrapAround: false,
        pageDots: false
    });

    initializeClock('May 27 2017');
});

function getTimeRemaining(endtime){
    const t = Date.parse(endtime) - Date.parse(new Date());
    const seconds = Math.floor((t / 1000) % 60);
    const minutes = Math.floor((t / 1000 / 60) % 60);
    const hours = Math.floor((t / (1000 * 60 * 60)) % 24);
    const days = Math.floor(t / (1000 * 60 * 60 * 24));
    return {
        'total': t,
        'days': days,
        'hours': hours,
        'mins': minutes,
        'secs': seconds
    };
}

function initializeClock(endtime){
    const timeinterval = setInterval(function () {
        const t = getTimeRemaining(endtime);

        $('span#clock-days').html(t.days + ' วัน');
        $('span#clock-hours').html(('0' + t.hours).slice(-2));
        $('span#clock-mins').html(('0' + t.mins).slice(-2));
        $('span#clock-secs').html(('0' + t.secs).slice(-2));

        if (t.total <= 0) {
            clearInterval(timeinterval);
        }
    }, 1000);
}