/* Banner Section Slider S */
var owlContactSlideNumber = 1, owlContactClassName = '.banner_section';
var owlContactLoop = false,
        owlContactItemLength = $(owlContactClassName + ' .owl-carousel .item').length,
        owlContactBanner = $(owlContactClassName + ' .owl-carousel');
if (owlContactItemLength < owlContactSlideNumber) {
    $(owlContactClassName).find('.owl-controls').css('display', 'none');
}
if (owlContactItemLength > owlContactSlideNumber) {
    owlContactLoop = true;
} else {
    owlContactLoop = false;
}
owlContactBanner.owlCarousel({
    animateOut: 'fadeOut',
    animateIn: 'fadeIn',
    loop: owlContactLoop,
    mouseDrag: false,
    touchDrag: true,
    margin: 0,
    navText: ["<i class='icon-left_arrow' title='Previous'></i>", "<i class='icon-right-arrow' title='Next'></i>"],
    autoplay: true,
    autoplayHoverPause: false,
    autoplayTimeout: 5000,
    smartSpeed: 2000,
    responsive: {
        0: {items: 1, dots: true, nav: false},
        480: {items: 1, dots: true, nav: false},
        768: {items: 1, dots: true, nav: false},
        1024: {items: 1, dots: true, nav: false},
        1025: {items: 1, dots: false, nav: true}
    }
});
/* Banner Section Slider E */

/* Blog main page - Category Section Slider S */
var owlContactSlideNumber = 1, owlContactClassName = '.category-slider-main';
var owlContactLoop = false,
        owlContactItemLength = $(owlContactClassName + ' .owl-carousel .item').length,
        owlContactBanner = $(owlContactClassName + ' .owl-carousel');
if (owlContactItemLength < owlContactSlideNumber) {
    $(owlContactClassName).find('.owl-controls').css('display', 'none');
}
if (owlContactItemLength > owlContactSlideNumber) {
    owlContactLoop = true;
} else {
    owlContactLoop = false;
}
owlContactBanner.owlCarousel({
    loop: owlContactLoop,
    mouseDrag: false,
    touchDrag: true,
    margin: 0,
    navText: ["<i class='icon-left_arrow' title='Previous'></i>", "<i class='icon-right-arrow' title='Next'></i>"],
    autoplay: true,
    autoplayHoverPause: false,
    autoplayTimeout: 5000,
    smartSpeed: 2000,
    responsive: {
        0: {items: 1, dots: true, nav: false},
        480: {items: 1, dots: true, nav: false},
        768: {items: 1, dots: true, nav: false},
        1024: {items: 1, dots: true, nav: false},
        1025: {items: 1, dots: true, nav: false}
    }
});
/* Blog main page - Category Section Slider E */

/* Blog main page - most-descussed-slider Section Slider S */
var owlContactSlideNumber = 1, owlContactClassName = '.most-descussed-slider';
var owlContactLoop = false,
        owlContactItemLength = $(owlContactClassName + ' .owl-carousel .item').length,
        owlContactBanner = $(owlContactClassName + ' .owl-carousel');
if (owlContactItemLength < owlContactSlideNumber) {
    $(owlContactClassName).find('.owl-controls').css('display', 'none');
}
if (owlContactItemLength > owlContactSlideNumber) {
    owlContactLoop = true;
} else {
    owlContactLoop = false;
}
owlContactBanner.owlCarousel({
    loop: owlContactLoop,
    mouseDrag: false,
    touchDrag: true,
    margin: 30,
    navText: ["<i class='icon-left-arrow-second' title='Previous'></i>", "<i class='icon-right-arrow-second' title='Next'></i>"],
    autoplay: true,
    autoplayHoverPause: false,
    autoplayTimeout: 5000,
    smartSpeed: 2000,
    responsive: {
        0: {items: 1, dots: false, nav: true},
        480: {items: 1, dots: false, nav: true},
        768: {items: 2, dots: false, nav: true},
        1025: {items: 2, dots: false, nav: true}
    }
});
/* Blog main page - most-descussed-slider Section Slider E */

/* Tab Content Section - About TrippyWords S */
function openCity(evt, cityName) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(cityName).style.display = "block";
    if(Tabname == "Followers"){
        $("#defaulOpen_followers").addClass('active');
    }
    evt.currentTarget.className += " active";
}

// Get the element with id="defaultOpen" and click on it
if($("#defaultOpen").length > 0){
    document.getElementById("defaultOpen").click();
}
/* Tab Content Section - About TrippyWords E */

/* Login - Modal S */
$(document).ready(function () {
    $('.login_signup_modal.modal .form_section .input-group').css({
        "border-bottom": "1px solid #cfced3",
        "border-left": "1px solid transparent",
        "border-right": "1px solid transparent",
        "border-top": "1px solid transparent",

    });

    $("input.login_signup_input").focus(function () {
        $(this).parent('.login_signup_modal.modal .form_section .form-group > .input-group').css({"border": "1px solid rgba(33, 150, 243, 0.32)", "padding-left": "10px", "transition": "0.5s"});
    });

    $("input").focusout(function () {
        $(this).parent('.login_signup_modal.modal .form_section .form-group > .input-group').css({
            "border-bottom": "1px solid #cfced3",
            "border-left": "1px solid transparent",
            "border-right": "1px solid transparent",
            "border-top": "1px solid transparent",
            "padding-left": "0px",
            "transition": "0.5s",
        });
    });

    var slidesPerPage = 4; //globaly define number of elements per page
    var syncedSecondary = true;
    /* Blog Main Slider - one S */
    var even = $("#even").val();
    var odd = $("#odd").val();

    var even_val = 2;
    var odd_val = 1;

    var count = (even / 2);
    for (var i = 1; i <= count; i++) {
        window['sync' + odd_val] = $("#sync" + odd_val);
        window['sync' + even_val] = $("#sync" + even_val);

        window['sync' + odd_val].owlCarousel({
            items: 1,
            slideSpeed: 2000,
            nav: true,
            autoplay: true,
            dots: false,
            loop: true,
            margin: 30,
            responsiveRefreshRate: 200,
            navText: ["<i class='icon-left-arrow' title='Previous'></i>", "<i class='icon-right-arrow' title='Next'></i>"],
        }).on('changed.owl.carousel', syncPosition);

        window['sync' + even_val].on('initialized.owl.carousel', function () {
            window['sync' + even_val].find(".owl-item").eq(0).addClass("current");
        }).owlCarousel({
            /*items : slidesPerPage,*/
            dots: false,
            nav: false,
            loop: false,
            smartSpeed: 200,
            mouseDrag: false,
            touchDrag: false,
            autoWidth: true,
            slideSpeed: 500,
            responsiveClass: true,
            /*slideBy: slidesPerPage,*/ //alternatively you can slide by 1, this way the active slide will stick to the first item in the second carousel
            responsive: {
                0: {items: 1, dots: false, nav: false},
                480: {items: 1, dots: false, nav: false},
                768: {items: 3, dots: false, nav: false},
                1025: {items: 5, dots: false, nav: false}
            }
        }).on('changed.owl.carousel', syncPosition2);

        function syncPosition(el) {
            //if you set loop to false, you have to restore this next line
            //var current = el.item.index;

            //if you disable loop you have to comment this block
            var count = el.item.count - 1;
            var current = Math.round(el.item.index - (el.item.count / 2) - .5);

            if (current < 0) {
                current = count;
            }
            if (current > count) {
                current = 0;
            }
            //end block

            window['sync' + even_val].find(".owl-item").removeClass("current").eq(current).addClass("current");
            var onscreen = window['sync' + even_val].find('.owl-item.active').length - 1;
            var start = window['sync' + even_val].find('.owl-item.active').first().index();
            var end = window['sync' + even_val].find('.owl-item.active').last().index();

            if (current > end) {
                window['sync' + even_val].data('owl.carousel').to(current, 100, true);
            }
            if (current < start) {
                window['sync' + even_val].data('owl.carousel').to(current - onscreen, 100, true);
            }
        }

        function syncPosition2(el) {
            if (syncedSecondary) {
                var number = el.item.index;
                window['sync' + odd_val].data('owl.carousel').to(number, 100, true);
            }
        }

        window['sync' + even_val].on("click", ".owl-item", function (e) {
            e.preventDefault();
            var number = $(this).index();
            window['sync' + odd_val].data('owl.carousel').to(number, 300, true);
        });


        var even_val = even_val + 2;
        var odd_val = odd_val + 2;
    }
    /* Blog Main Slider - one E */

    /*if($("#wrapper").height() > $(document).height()){
        $("footer").removeClass('footer-height-custom');
    }else{
        $("footer").addClass('footer-height-custom');
    }
    $(window).resize(function(){
        if($("#wrapper").height() > $(window).height()){
            $("footer").removeClass('footer-height-custom');
        }else{
            $("footer").addClass('footer-height-custom');
        }
    });*/
    var window_height = $(window).height();
    var wrapper = $("#wrapper").height();
    var footer = $("footer").height();

    /*alert("window_height" + window_height + "wrapper" + wrapper +"footer" +footer);  */

    if($("#wrapper").height() <= ($(window).height() - $("footer").height())){
        $("footer").addClass('footer-height-custom');
    }else{
        $("footer").removeClass('footer-height-custom');
    }
    $(window).resize(function(){
        if($("#wrapper").height() <= ($(window).height() - $("footer").height())){
            $("footer").addClass('footer-height-custom');
        }else{
            $("footer").removeClass('footer-height-custom');
        }
    });

});
/* Login - Modal E */

/* Blog-slider S */
var owlContactSlideNumber = 1, owlContactClassName = '.blog_slider';
var owlContactLoop = false,
        owlContactItemLength = $(owlContactClassName + ' .owl-carousel .item').length,
        owlContactBanner = $(owlContactClassName + ' .owl-carousel');
if (owlContactItemLength < owlContactSlideNumber) {
    $(owlContactClassName).find('.owl-controls').css('display', 'none');
}
if (owlContactItemLength > owlContactSlideNumber) {
    owlContactLoop = true;
} else {
    owlContactLoop = false;
}
owlContactBanner.owlCarousel({

    animateOut: 'fadeOut',

    animateIn: 'fadeIn',

    loop: owlContactLoop,

    mouseDrag: false,

    touchDrag: true,

    margin: 0,

    navText: ["<i class='icon-left_arrow' title='Previous'></i>", "<i class='icon-right-arrow' title='Next'></i>"],

    autoplay: true,

    autoplayHoverPause: false,

    autoplayTimeout: 5000,

    smartSpeed: 2000,

    responsive: {

        0: {items: 1, dots: true, nav: false},

        480: {items: 1, dots: true, nav: false},

        768: {items: 1, dots: true, nav: false},

        1024: {items: 1, dots: true, nav: false},

        1025: {items: 1, dots: true, nav: true}

    }

});
/* Blog-slider E */


/* Tab Content Seciton - User Menu Page S */

function openTab(evt, Tabname) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(Tabname).style.display = "block";
    evt.currentTarget.className += " active";
}

// Get the element with id="defaultOpen" and click on it
// if($("#defaultOpen_usermenu").length > 0){
//     document.getElementById("defaultOpen_usermenu").click();
// }

/* Tab Content Seciton - User Menu Page E */

/* blog main page - sidebar-tab S */

function openCity(evt, cityName) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(cityName).style.display = "block";
    evt.currentTarget.className += " active";
}

// Get the element with id="defaultOpen" and click on it
if($("#defaultOpen").length > 0){
    document.getElementById("defaultOpen").click();
}

/* blog main page - sidebar-tab E */

/* Feeds carousel Start */

$(document).ready(function () {
    var itemsMainDiv = ('.MultiCarousel');
    var itemsDiv = ('.MultiCarousel-inner');
    var itemWidth = "";

    $('.leftLst, .rightLst').click(function () {
        var condition = $(this).hasClass("leftLst");
        if (condition)
            click(0, this);
        else
            click(1, this)
    });

    ResCarouselSize();




    $(window).resize(function () {
        ResCarouselSize();
    });

    //this function define the size of the items
    function ResCarouselSize() {
        var incno = 0;
        var dataItems = ("data-items");
        var itemClass = ('.item');
        var id = 0;
        var btnParentSb = '';
        var itemsSplit = '';
        var sampwidth = $(itemsMainDiv).width();
        var bodyWidth = $('body').width();
        $(itemsDiv).each(function () {
            id = id + 1;
            var itemNumbers = $(this).find(itemClass).length;
            btnParentSb = $(this).parent().attr(dataItems);
            itemsSplit = btnParentSb.split(',');
            $(this).parent().attr("id", "MultiCarousel" + id);


            if (bodyWidth >= 1200) {
                incno = itemsSplit[3];
                itemWidth = sampwidth / incno;
            }
            else if (bodyWidth >= 992) {
                incno = itemsSplit[2];
                itemWidth = sampwidth / incno;
            }
            else if (bodyWidth >= 768) {
                incno = itemsSplit[1];
                itemWidth = sampwidth / incno;
            }
            else {
                incno = itemsSplit[0];
                itemWidth = sampwidth / incno;
            }
            $(this).css({ 'transform': 'translateX(0px)', 'width': itemWidth * itemNumbers });
            $(this).find(itemClass).each(function () {
                $(this).outerWidth(itemWidth);
            });

            $(".leftLst").addClass("over");
            $(".rightLst").removeClass("over");

        });
    }

    //this function used to move the items
    function ResCarousel(e, el, s) {
        var leftBtn = ('.leftLst');
        var rightBtn = ('.rightLst');
        var translateXval = '';
        var divStyle = $(el + ' ' + itemsDiv).css('transform');
        var values = divStyle.match(/-?[\d\.]+/g);
        var xds = Math.abs(values[4]);
        if (e === 0) {
            translateXval = parseInt(xds) - parseInt(itemWidth * s);
            $(el + ' ' + rightBtn).removeClass("over");

            if (translateXval <= itemWidth / 2) {
                translateXval = 0;
                $(el + ' ' + leftBtn).addClass("over");
            }
        }
        else if (e == 1) {
            var itemsCondition = $(el).find(itemsDiv).width() - $(el).width();
            translateXval = parseInt(xds) + parseInt(itemWidth * s);
            $(el + ' ' + leftBtn).removeClass("over");

            if (translateXval >= itemsCondition - itemWidth / 2) {
                translateXval = itemsCondition;
                $(el + ' ' + rightBtn).addClass("over");
            }
        }
        $(el + ' ' + itemsDiv).css('transform', 'translateX(' + -translateXval + 'px)');
    }

    //It is used to get some elements from btn
    function click(ell, ee) {
        var Parent = "#" + $(ee).parent().attr("id");
        var slide = $(Parent).attr("data-slide");
        ResCarousel(ell, Parent, slide);
    }

});

/* Feeds carousel End */
