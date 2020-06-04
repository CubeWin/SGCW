var cwMyCarousel = new PureJSCarousel({
    carousel: '.cw-carousel',
    slide: '.cw-slide',
    oneByOne: true,
    infinite: true
});

var dragItem = document.querySelector("#move");
var myItemChange = document.querySelector("#mydiv");
var container = document.querySelector("#content-zoom");
var active = false;
var currentX;
var currentY;
var initialX;
var initialY;
var xOffset = 0;
var yOffset = 0;
var zoomEstado = false;
var miniaturaEstado = false;
var audioPage = new Audio('public/audio/page-flip.mp3');
container.addEventListener("touchstart", dragStart, false);
container.addEventListener("touchend", dragEnd, false);
container.addEventListener("touchmove", drag, false);
container.addEventListener("mousedown", dragStart, false);
container.addEventListener("mouseup", dragEnd, false);
container.addEventListener("mousemove", drag, false);

function dragStart(e) {
    if (e.type === "touchstart") {
        initialX = e.touches[0].clientX - xOffset;
        initialY = e.touches[0].clientY - yOffset;
    } else {
        initialX = e.clientX - xOffset;
        initialY = e.clientY - yOffset;
    }
    if (e.target === dragItem) {
        active = true;
    }
}

function dragEnd(e) {
    initialX = currentX;
    initialY = currentY;
    active = false;
}

function drag(e) {
    if (active) {
        e.preventDefault();
        if (e.type === "touchmove") {
            currentX = e.touches[0].clientX - initialX;
            currentY = e.touches[0].clientY - initialY;
        } else {
            currentX = e.clientX - initialX;
            currentY = e.clientY - initialY;
        }
        xOffset = currentX;
        yOffset = currentY;
        setTranslate(currentX, currentY, dragItem);
    }
}

function setTranslate(xPos, yPos, el) {
    myItemChange.style.transform = "translate3d(" + xPos + "px, " + yPos + "px, 0)";
}
$('#btnZoom').click(function () {
    widthImagen = 500;
    heightImagen = 650;
    sizeRes = calculation(widthImagen, heightImagen);
    widthBox = $(window).width();
    displayBook = $("#magazine").turn("display");
    pageBook = $("#magazine").turn("page");
    pagesBook = $("#magazine").turn("pages");
    if (displayBook == 'double') {
        sizeRes[0] = sizeRes[0] / 2;
        if (pageBook == pagesBook || pageBook == 1) {
            $("#firstPage").attr("src", "public/img/pages/" + pageBook + ".jpg");
            $("#secondPage").addClass('d-none');
            $("#contentSecondPage").addClass('d-none');
            $("#secondPage").attr("src", "public/img/pages/" + pageBook + ".jpg");
        } else {
            $("#secondPage").removeClass('d-none');
            $("#contentSecondPage").removeClass('d-none');
            if (pageBook % 2 == 0) {
                $("#firstPage").attr("src", "public/img/pages/" + pageBook + ".jpg");
                $("#secondPage").attr("src", "public/img/pages/" + (pageBook + 1) + ".jpg");
            } else {
                $("#firstPage").attr("src", "public/img/pages/" + (pageBook - 1) + ".jpg");
                $("#secondPage").attr("src", "public/img/pages/" + pageBook + ".jpg");
            }
        }
    } else {
        $("#firstPage").attr("src", "public/img/pages/" + pageBook + ".jpg");
        $("#secondPage").addClass('d-none');
        $("#contentSecondPage").addClass('d-none');
    }
    $('#mydiv>div').css('width', sizeRes[0] * 1.8).css('height', sizeRes[1] * 1.8);
    $('#mydiv>div>img').css('width', sizeRes[0] * 1.8).css('height', sizeRes[1] * 1.8);
    if (zoomEstado == false) {
        zoomEstado = true;
        $('#content-magazine').addClass('d-none');
        $('#content-zoom').removeClass('d-none');
        $("#btnPageLeft").attr('disabled', true);
        $("#btnPageRight").attr('disabled', true);
        $("#btnMiniatura").attr('disabled', true);
        $("#btnPagIni").attr('disabled', true);
        $("#btnPagFin").attr('disabled', true);
        if (miniaturaEstado == true) {
            $("#btnMiniatura").trigger("click");
        }
    } else {
        zoomEstado = false;
        $('#content-zoom').addClass('d-none');
        $('#content-magazine').removeClass('d-none');
        $("#btnPageLeft").attr('disabled', false);
        $("#btnPageRight").attr('disabled', false);
        $("#btnMiniatura").attr('disabled', false);
        $("#btnPagIni").attr('disabled', false);
        $("#btnPagFin").attr('disabled', false);

        let bookPage = $('#magazine').turn('page');
        let bookPages = $('#magazine').turn('pages');
        btnPage(bookPage, bookPages);
    }
});
$(window).ready(function () {
    widthImagen = 500;
    heightImagen = 650;
    sizeRes = calculation(widthImagen, heightImagen);
    //console.log(sizeRes[0] + '--' + sizeRes[1] + '--' + sizeRes[2]);
    // if (sizeRes[0] > 768) {
    //     temporalWidth = sizeRes[0] / 4;
    // } else {
    //     temporalWidth = sizeRes[0];
    // }
    // console.log(temporalWidth);
    $('#content-magazine').width(sizeRes[0]);
    // $('#content-magazine').css('left', -temporalWidth);
    $('#magazine').turn({
        width: sizeRes[0],
        height: sizeRes[1],
        display: sizeRes[2],
        duration: 800,
        gradients: true,
        elevation: 50,
        when: {
            turning: function (e, page, view) {
                audioPage.pause();
                audioPage.currentTime = 0;
                audioPage.play();
                var book = $(this);
                pagesbo = book.turn('pages');
                btnPage(page, pagesbo);

                console.log(pagesbo);
            }
        }
    });
    let bookPage = $('#magazine').turn('page');
    let bookPages = $('#magazine').turn('pages');
    btnPage(bookPage, bookPages);
});


function btnPage(a, b) {
    widthImagen = 500;
    heightImagen = 650;
    sizeRes = calculation(widthImagen, heightImagen);
    if (sizeRes[0] > 768) {
        temporalWidth = sizeRes[0] / 4;
    } else {
        temporalWidth = '0'; // cero creo
    }
    if (a == 1) {
        $("#btnPageLeft").attr('disabled', true);
        $("#btnPagIni").attr('disabled', true);
        $("#btnPageRight").attr('disabled', false);
        $("#btnPagFin").attr('disabled', false);
        $('#content-magazine').css('left', -temporalWidth);
        $('#cw-prevpage').addClass('d-none');
        $('#cw-nextpage').removeClass('d-none');
    } else if (a == b) {
        $("#btnPageRight").attr('disabled', true);
        $("#btnPagFin").attr('disabled', true);
        $("#btnPageLeft").attr('disabled', false);
        $("#btnPagIni").attr('disabled', false);
        $('#content-magazine').css('left', temporalWidth);
        $('#cw-nextpage').addClass('d-none');
        $('#cw-prevpage').removeClass('d-none');
    } else {
        $("#btnPageLeft").attr('disabled', false);
        $("#btnPagIni").attr('disabled', false);
        $("#btnPageRight").attr('disabled', false);
        $("#btnPagFin").attr('disabled', false);
        $('#content-magazine').css('left', '0');
        setTimeout(function () {
            $('#cw-prevpage').removeClass('d-none');
            $('#cw-nextpage').removeClass('d-none');
        }, 200);
    }
}

$(window).resize(function () {
    widthImagen = 500;
    heightImagen = 650;
    sizeRes = calculation(widthImagen, heightImagen);
    $('#content-magazine').width(sizeRes[0]);
    page = $('#magazine').turn('page');
    pagesbo = $('#magazine').turn('pages');
    btnPage(page, pagesbo);
    // if (sizeRes[0] > 768) {
    //     temporalWidth = sizeRes[0] /4;
    // } else {
    //     temporalWidth = '0'; // cero creo
    // }
    $('#magazine').turn("options", {
        width: sizeRes[0],
        height: sizeRes[1],
        display: sizeRes[2]
    });
});

function calculation(widthImagen, heightImagen) {
    widthBox = $(window).width();
    heightBox = $(window).height();
    widthBoxBorder = widthBox - 10;
    heightBoxBorder = heightBox - 55;
    if (widthBox > 768) {
        display = 'double';
        widthImagen = widthImagen * 2;
    } else {
        display = 'single';
    }
    widthPercent = widthBoxBorder / widthImagen; //porcentaje
    heightPercent = heightBoxBorder / heightImagen; //porcentaje
    //console.log(widthPercent + '---' + heightPercent);
    if (widthPercent > heightPercent) {
        if (heightPercent < 1) {
            widthResult = widthImagen * heightPercent;
            heightResult = heightImagen * heightPercent;
        } else {
            widthResult = widthImagen;
            heightResult = heightImagen;
        }
    } else if (widthPercent == heightPercent) {
        widthResult = widthImagen * widthPercent;
        heightResult = heightImagen * heightPercent;
    } else {
        if (widthPercent < 1) {
            heightResult = heightImagen * widthPercent;
            widthResult = widthImagen * widthPercent;
        } else {
            heightResult = heightImagen;
            widthResult = widthImagen;
        }
    }
    //console.log('width: ' + widthResult + '-- height: ' + heightResult + '-- display: ' + display);
    resultSize = new Array(widthResult, heightResult, display);
    return resultSize;
}
$(window).bind('keydown', function (e) {
    // if (e.keyCode == 37)
    //     $('#btnPageLeft').trigger('click');
    // else if (e.keyCode == 39)
    //     $('#btnPageRight').trigger('click');
    // else 
    if (e.keyCode == 27)
        if (zoomEstado == true)
            $('#btnZoom').trigger('click');
});
$("#btnPageLeft").click(function () {
    $('#magazine').turn('previous');
})
$("#btnPageRight").click(function () {
    $('#magazine').turn('next');
})
$("#btnMiniatura").click(function () {
    if (miniaturaEstado == false) {
        miniaturaEstado = true;
        $("#cw-miniatura").css("height", "190px");
    } else {
        miniaturaEstado = false;
        $("#cw-miniatura").css("height", "0");
    }
})
$('#cw-prev-slider').click(function () {
    cwMyCarousel.goToPrevSlide();
})
$('#cw-next-slider').click(function () {
    cwMyCarousel.goToNextSlide();
})
$("#btnPagIni").click(function () {
    $("#magazine").turn("page", 1);
})
$("#btnPagFin").click(function () {
    fin = $("#magazine").turn("pages");
    $("#magazine").turn("page", fin);
})

function pagTrun(a) {
    $('#magazine').turn("page", a);
}