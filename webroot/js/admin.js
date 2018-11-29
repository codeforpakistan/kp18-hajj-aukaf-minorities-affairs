<<<<<<< HEAD
if("undefined"==typeof jQuery)throw new Error("jQuery plugins need to be before this file");$.AdminBSB={},$.AdminBSB.options={colors:{red:"#F44336",pink:"#E91E63",purple:"#9C27B0",deepPurple:"#673AB7",indigo:"#3F51B5",blue:"#2196F3",lightBlue:"#03A9F4",cyan:"#00BCD4",teal:"#009688",green:"#4CAF50",lightGreen:"#8BC34A",lime:"#CDDC39",yellow:"#ffe821",amber:"#FFC107",orange:"#FF9800",deepOrange:"#FF5722",brown:"#795548",grey:"#9E9E9E",blueGrey:"#607D8B",black:"#000000",white:"#ffffff"},leftSideBar:{scrollColor:"rgba(0,0,0,0.5)",scrollWidth:"4px",scrollAlwaysVisible:!1,scrollBorderRadius:"0",scrollRailBorderRadius:"0",scrollActiveItemWhenPageLoad:!0,breakpointWidth:1170},dropdownMenu:{effectIn:"fadeIn",effectOut:"fadeOut"}},$.AdminBSB.leftSideBar={activate:function(){var e=this,t=$("body"),o=$(".overlay");$(window).click(function(n){var a=$(n.target);"i"===n.target.nodeName.toLowerCase()&&(a=$(n.target).parent()),!a.hasClass("bars")&&e.isOpen()&&0===a.parents("#leftsidebar").length&&(a.hasClass("js-right-sidebar")||o.fadeOut(),t.removeClass("overlay-open"))}),$.each($(".menu-toggle.toggled"),function(e,t){$(t).next().slideToggle(0)}),$.each($(".menu .list li.active"),function(e,t){var o=$(t).find("a:eq(0)");o.addClass("toggled"),o.next().show()}),$(".menu-toggle").on("click",function(e){var t=$(this),o=t.next();if($(t.parents("ul")[0]).hasClass("list")){var n=$(e.target).hasClass("menu-toggle")?e.target:$(e.target).parents(".menu-toggle");$.each($(".menu-toggle.toggled").not(n).next(),function(e,t){$(t).is(":visible")&&($(t).prev().toggleClass("toggled"),$(t).slideUp())})}t.toggleClass("toggled"),o.slideToggle(320)}),e.setMenuHeight(!0),e.checkStatusForResize(!0),$(window).resize(function(){e.setMenuHeight(!1),e.checkStatusForResize(!1)}),Waves.attach(".menu .list a",["waves-block"]),Waves.init()},setMenuHeight:function(e){if(void 0!==$.fn.slimScroll){var t=$.AdminBSB.options.leftSideBar,o=$(window).height()-($(".legal").outerHeight()+$(".user-info").outerHeight()+$(".navbar").innerHeight()),n=$(".list");if(e||n.slimscroll({destroy:!0}),n.slimscroll({height:o+"px",color:t.scrollColor,size:t.scrollWidth,alwaysVisible:t.scrollAlwaysVisible,borderRadius:t.scrollBorderRadius,railBorderRadius:t.scrollRailBorderRadius}),$.AdminBSB.options.leftSideBar.scrollActiveItemWhenPageLoad){var a=$(".menu .list li.active")[0];if(a){var i=a.offsetTop;i>150&&n.slimscroll({scrollTo:i+"px"})}}}},checkStatusForResize:function(e){var t=$("body"),o=$(".navbar .navbar-header .bars"),n=t.width();e&&t.find(".content, .sidebar").addClass("no-animate").delay(1e3).queue(function(){$(this).removeClass("no-animate").dequeue()}),n<$.AdminBSB.options.leftSideBar.breakpointWidth?(t.addClass("ls-closed"),o.fadeIn()):(t.removeClass("ls-closed"),o.fadeOut())},isOpen:function(){return $("body").hasClass("overlay-open")}},$.AdminBSB.rightSideBar={activate:function(){var e=this,t=$("#rightsidebar"),o=$(".overlay");$(window).click(function(n){var a=$(n.target);"i"===n.target.nodeName.toLowerCase()&&(a=$(n.target).parent()),!a.hasClass("js-right-sidebar")&&e.isOpen()&&0===a.parents("#rightsidebar").length&&(a.hasClass("bars")||o.fadeOut(),t.removeClass("open"))}),$(".js-right-sidebar").on("click",function(){t.toggleClass("open"),e.isOpen()?o.fadeIn():o.fadeOut()})},isOpen:function(){return $(".right-sidebar").hasClass("open")}};var $searchBar=$(".search-bar");$.AdminBSB.search={activate:function(){var e=this;$(".js-search").on("click",function(){e.showSearchBar()}),$searchBar.find(".close-search").on("click",function(){e.hideSearchBar()}),$searchBar.find('input[type="text"]').on("keyup",function(t){27==t.keyCode&&e.hideSearchBar()})},showSearchBar:function(){$searchBar.addClass("open"),$searchBar.find('input[type="text"]').focus()},hideSearchBar:function(){$searchBar.removeClass("open"),$searchBar.find('input[type="text"]').val("")}},$.AdminBSB.navbar={activate:function(){var e=$("body"),t=$(".overlay");$(".bars").on("click",function(){e.toggleClass("overlay-open"),e.hasClass("overlay-open")?t.fadeIn():t.fadeOut()}),$('.nav [data-close="true"]').on("click",function(){var e=$(".navbar-toggle").is(":visible"),t=$(".navbar-collapse");e&&t.slideUp(function(){t.removeClass("in").removeAttr("style")})})}},$.AdminBSB.input={activate:function(e){(e=e||$("body")).find(".form-control").focus(function(){$(this).closest(".form-line").addClass("focused")}),e.find(".form-control").focusout(function(){var e=$(this);e.parents(".form-group").hasClass("form-float")?""==e.val()&&e.parents(".form-line").removeClass("focused"):e.parents(".form-line").removeClass("focused")}),e.on("click",".form-float .form-line .form-label",function(){$(this).parent().find("input").focus()}),e.find(".form-control").each(function(){""!==$(this).val()&&$(this).parents(".form-line").addClass("focused")})}},$.AdminBSB.select={activate:function(){$.fn.selectpicker&&$("select:not(.ms)").selectpicker()}},$.AdminBSB.dropdownMenu={activate:function(){var e=this;$(".dropdown, .dropup, .btn-group").on({"show.bs.dropdown":function(){var t=e.dropdownEffect(this);e.dropdownEffectStart(t,t.effectIn)},"shown.bs.dropdown":function(){var t=e.dropdownEffect(this);t.effectIn&&t.effectOut&&e.dropdownEffectEnd(t,function(){})},"hide.bs.dropdown":function(t){var o=e.dropdownEffect(this);o.effectOut&&(t.preventDefault(),e.dropdownEffectStart(o,o.effectOut),e.dropdownEffectEnd(o,function(){o.dropdown.removeClass("open")}))}}),Waves.attach(".dropdown-menu li a",["waves-block"]),Waves.init()},dropdownEffect:function(e){var t=$.AdminBSB.options.dropdownMenu.effectIn,o=$.AdminBSB.options.dropdownMenu.effectOut,n=$(e),a=$(".dropdown-menu",e);if(n.length>0){var i=n.data("effect-in"),r=n.data("effect-out");void 0!==i&&(t=i),void 0!==r&&(o=r)}return{target:e,dropdown:n,dropdownMenu:a,effectIn:t,effectOut:o}},dropdownEffectStart:function(e,t){t&&(e.dropdown.addClass("dropdown-animating"),e.dropdownMenu.addClass("animated dropdown-animated"),e.dropdownMenu.addClass(t))},dropdownEffectEnd:function(e,t){e.dropdown.one("webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend",function(){e.dropdown.removeClass("dropdown-animating"),e.dropdownMenu.removeClass("animated dropdown-animated"),e.dropdownMenu.removeClass(e.effectIn),e.dropdownMenu.removeClass(e.effectOut),"function"==typeof t&&t()})}};var edge="Microsoft Edge",ie10="Internet Explorer 10",ie11="Internet Explorer 11",opera="Opera",firefox="Mozilla Firefox",chrome="Google Chrome",safari="Safari";$.AdminBSB.browser={activate:function(){""!==this.getClassName()&&$("html").addClass(this.getClassName())},getBrowser:function(){var e=navigator.userAgent.toLowerCase();return/edge/i.test(e)?edge:/rv:11/i.test(e)?ie11:/msie 10/i.test(e)?ie10:/opr/i.test(e)?opera:/chrome/i.test(e)?chrome:/firefox/i.test(e)?firefox:navigator.userAgent.match(/Version\/[\d\.]+.*Safari/)?safari:void 0},getClassName:function(){var e=this.getBrowser();return e===edge?"edge":e===ie11?"ie11":e===ie10?"ie10":e===opera?"opera":e===chrome?"chrome":e===firefox?"firefox":e===safari?"safari":""}},$(function(){$.AdminBSB.browser.activate(),$.AdminBSB.leftSideBar.activate(),$.AdminBSB.rightSideBar.activate(),$.AdminBSB.navbar.activate(),$.AdminBSB.dropdownMenu.activate(),$.AdminBSB.input.activate(),$.AdminBSB.select.activate(),$.AdminBSB.search.activate(),setTimeout(function(){$(".page-loader-wrapper").fadeOut()},50)});
=======
if (typeof jQuery === "undefined") {
    throw new Error("jQuery plugins need to be before this file");
}

$.AdminBSB = {};
$.AdminBSB.options = {
    colors: {
        red: '#F44336',
        pink: '#E91E63',
        purple: '#9C27B0',
        deepPurple: '#673AB7',
        indigo: '#3F51B5',
        blue: '#2196F3',
        lightBlue: '#03A9F4',
        cyan: '#00BCD4',
        teal: '#009688',
        green: '#4CAF50',
        lightGreen: '#8BC34A',
        lime: '#CDDC39',
        yellow: '#ffe821',
        amber: '#FFC107',
        orange: '#FF9800',
        deepOrange: '#FF5722',
        brown: '#795548',
        grey: '#9E9E9E',
        blueGrey: '#607D8B',
        black: '#000000',
        white: '#ffffff'
    },
    leftSideBar: {
        scrollColor: 'rgba(0,0,0,0.5)',
        scrollWidth: '4px',
        scrollAlwaysVisible: false,
        scrollBorderRadius: '0',
        scrollRailBorderRadius: '0',
        scrollActiveItemWhenPageLoad: true,
        breakpointWidth: 1170
    },
    dropdownMenu: {
        effectIn: 'fadeIn',
        effectOut: 'fadeOut'
    }
}

/* Left Sidebar - Function =================================================================================================
*  You can manage the left sidebar menu options
*  
*/
$.AdminBSB.leftSideBar = {
    activate: function () {
        var _this = this;
        var $body = $('body');
        var $overlay = $('.overlay');

        //Close sidebar
        $(window).click(function (e) {
            var $target = $(e.target);
            if (e.target.nodeName.toLowerCase() === 'i') { $target = $(e.target).parent(); }

            if (!$target.hasClass('bars') && _this.isOpen() && $target.parents('#leftsidebar').length === 0) {
                if (!$target.hasClass('js-right-sidebar')) $overlay.fadeOut();
                $body.removeClass('overlay-open');
            }
        });

        $.each($('.menu-toggle.toggled'), function (i, val) {
            $(val).next().slideToggle(0);
        });

        //When page load
        $.each($('.menu .list li.active'), function (i, val) {
            var $activeAnchors = $(val).find('a:eq(0)');

            $activeAnchors.addClass('toggled');
            $activeAnchors.next().show();
        });

        //Collapse or Expand Menu
        $('.menu-toggle').on('click', function (e) {
            var $this = $(this);
            var $content = $this.next();

            if ($($this.parents('ul')[0]).hasClass('list')) {
                var $not = $(e.target).hasClass('menu-toggle') ? e.target : $(e.target).parents('.menu-toggle');

                $.each($('.menu-toggle.toggled').not($not).next(), function (i, val) {
                    if ($(val).is(':visible')) {
                        $(val).prev().toggleClass('toggled');
                        $(val).slideUp();
                    }
                });
            }

            $this.toggleClass('toggled');
            $content.slideToggle(320);
        });

        //Set menu height
        _this.setMenuHeight(true);
        _this.checkStatusForResize(true);
        $(window).resize(function () {
            _this.setMenuHeight(false);
            _this.checkStatusForResize(false);
        });

        //Set Waves
        Waves.attach('.menu .list a', ['waves-block']);
        Waves.init();
    },
    setMenuHeight: function (isFirstTime) {
        if (typeof $.fn.slimScroll != 'undefined') {
            var configs = $.AdminBSB.options.leftSideBar;
            var height = ($(window).height() - ($('.legal').outerHeight() + $('.user-info').outerHeight() + $('.navbar').innerHeight()));
            var $el = $('.list');

            if (!isFirstTime) {
                $el.slimscroll({
                    destroy: true
                });
            }

            $el.slimscroll({
                height: height + "px",
                color: configs.scrollColor,
                size: configs.scrollWidth,
                alwaysVisible: configs.scrollAlwaysVisible,
                borderRadius: configs.scrollBorderRadius,
                railBorderRadius: configs.scrollRailBorderRadius
            });

            //Scroll active menu item when page load, if option set = true
            if ($.AdminBSB.options.leftSideBar.scrollActiveItemWhenPageLoad) {
                var item = $('.menu .list li.active')[0];
                if (item) {
                    var activeItemOffsetTop = item.offsetTop;
                    if (activeItemOffsetTop > 150) $el.slimscroll({ scrollTo: activeItemOffsetTop + 'px' });
                }
            }
        }
    },
    checkStatusForResize: function (firstTime) {
        var $body = $('body');
        var $openCloseBar = $('.navbar .navbar-header .bars');
        var width = $body.width();

        if (firstTime) {
            $body.find('.content, .sidebar').addClass('no-animate').delay(1000).queue(function () {
                $(this).removeClass('no-animate').dequeue();
            });
        }

        if (width < $.AdminBSB.options.leftSideBar.breakpointWidth) {
            $body.addClass('ls-closed');
            $openCloseBar.fadeIn();
        }
        else {
            $body.removeClass('ls-closed');
            $openCloseBar.fadeOut();
        }
    },
    isOpen: function () {
        return $('body').hasClass('overlay-open');
    }
};
//==========================================================================================================================

/* Right Sidebar - Function ================================================================================================
*  You can manage the right sidebar menu options
*  
*/
$.AdminBSB.rightSideBar = {
    activate: function () {
        var _this = this;
        var $sidebar = $('#rightsidebar');
        var $overlay = $('.overlay');

        //Close sidebar
        $(window).click(function (e) {
            var $target = $(e.target);
            if (e.target.nodeName.toLowerCase() === 'i') { $target = $(e.target).parent(); }

            if (!$target.hasClass('js-right-sidebar') && _this.isOpen() && $target.parents('#rightsidebar').length === 0) {
                if (!$target.hasClass('bars')) $overlay.fadeOut();
                $sidebar.removeClass('open');
            }
        });

        $('.js-right-sidebar').on('click', function () {
            $sidebar.toggleClass('open');
            if (_this.isOpen()) { $overlay.fadeIn(); } else { $overlay.fadeOut(); }
        });
    },
    isOpen: function () {
        return $('.right-sidebar').hasClass('open');
    }
}
//==========================================================================================================================

/* Searchbar - Function ================================================================================================
*  You can manage the search bar
*  
*/
var $searchBar = $('.search-bar');
$.AdminBSB.search = {
    activate: function () {
        var _this = this;

        //Search button click event
        $('.js-search').on('click', function () {
            _this.showSearchBar();
        });

        //Close search click event
        $searchBar.find('.close-search').on('click', function () {
            _this.hideSearchBar();
        });

        //ESC key on pressed
        $searchBar.find('input[type="text"]').on('keyup', function (e) {
            if (e.keyCode == 27) {
                _this.hideSearchBar();
            }
        });
    },
    showSearchBar: function () {
        $searchBar.addClass('open');
        $searchBar.find('input[type="text"]').focus();
    },
    hideSearchBar: function () {
        $searchBar.removeClass('open');
        $searchBar.find('input[type="text"]').val('');
    }
}
//==========================================================================================================================

/* Navbar - Function =======================================================================================================
*  You can manage the navbar
*  
*/
$.AdminBSB.navbar = {
    activate: function () {
        var $body = $('body');
        var $overlay = $('.overlay');

        //Open left sidebar panel
        $('.bars').on('click', function () {
            $body.toggleClass('overlay-open');
            if ($body.hasClass('overlay-open')) { $overlay.fadeIn(); } else { $overlay.fadeOut(); }
        });

        //Close collapse bar on click event
        $('.nav [data-close="true"]').on('click', function () {
            var isVisible = $('.navbar-toggle').is(':visible');
            var $navbarCollapse = $('.navbar-collapse');

            if (isVisible) {
                $navbarCollapse.slideUp(function () {
                    $navbarCollapse.removeClass('in').removeAttr('style');
                });
            }
        });
    }
}
//==========================================================================================================================

/* Input - Function ========================================================================================================
*  You can manage the inputs(also textareas) with name of class 'form-control'
*  
*/
$.AdminBSB.input = {
    activate: function ($parentSelector) {
        $parentSelector = $parentSelector || $('body');

        //On focus event
        $parentSelector.find('.form-control').focus(function () {
            $(this).closest('.form-line').addClass('focused');
        });

        //On focusout event
        $parentSelector.find('.form-control').focusout(function () {
            var $this = $(this);
            if ($this.parents('.form-group').hasClass('form-float')) {
                if ($this.val() == '') { $this.parents('.form-line').removeClass('focused'); }
            }
            else {
                $this.parents('.form-line').removeClass('focused');
            }
        });

        //On label click
        $parentSelector.on('click', '.form-float .form-line .form-label', function () {
            $(this).parent().find('input').focus();
        });

        //Not blank form
        $parentSelector.find('.form-control').each(function () {
            if ($(this).val() !== '') {
                $(this).parents('.form-line').addClass('focused');
            }
        });
    }
}
//==========================================================================================================================

/* Form - Select - Function ================================================================================================
*  You can manage the 'select' of form elements
*  
*/
$.AdminBSB.select = {
    activate: function () {
        if ($.fn.selectpicker) { $('select:not(.ms)').selectpicker(); }
    }
}
//==========================================================================================================================

/* DropdownMenu - Function =================================================================================================
*  You can manage the dropdown menu
*  
*/

$.AdminBSB.dropdownMenu = {
    activate: function () {
        var _this = this;

        $('.dropdown, .dropup, .btn-group').on({
            "show.bs.dropdown": function () {
                var dropdown = _this.dropdownEffect(this);
                _this.dropdownEffectStart(dropdown, dropdown.effectIn);
            },
            "shown.bs.dropdown": function () {
                var dropdown = _this.dropdownEffect(this);
                if (dropdown.effectIn && dropdown.effectOut) {
                    _this.dropdownEffectEnd(dropdown, function () { });
                }
            },
            "hide.bs.dropdown": function (e) {
                var dropdown = _this.dropdownEffect(this);
                if (dropdown.effectOut) {
                    e.preventDefault();
                    _this.dropdownEffectStart(dropdown, dropdown.effectOut);
                    _this.dropdownEffectEnd(dropdown, function () {
                        dropdown.dropdown.removeClass('open');
                    });
                }
            }
        });

        //Set Waves
        Waves.attach('.dropdown-menu li a', ['waves-block']);
        Waves.init();
    },
    dropdownEffect: function (target) {
        var effectIn = $.AdminBSB.options.dropdownMenu.effectIn, effectOut = $.AdminBSB.options.dropdownMenu.effectOut;
        var dropdown = $(target), dropdownMenu = $('.dropdown-menu', target);

        if (dropdown.length > 0) {
            var udEffectIn = dropdown.data('effect-in');
            var udEffectOut = dropdown.data('effect-out');
            if (udEffectIn !== undefined) { effectIn = udEffectIn; }
            if (udEffectOut !== undefined) { effectOut = udEffectOut; }
        }

        return {
            target: target,
            dropdown: dropdown,
            dropdownMenu: dropdownMenu,
            effectIn: effectIn,
            effectOut: effectOut
        };
    },
    dropdownEffectStart: function (data, effectToStart) {
        if (effectToStart) {
            data.dropdown.addClass('dropdown-animating');
            data.dropdownMenu.addClass('animated dropdown-animated');
            data.dropdownMenu.addClass(effectToStart);
        }
    },
    dropdownEffectEnd: function (data, callback) {
        var animationEnd = 'webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend';
        data.dropdown.one(animationEnd, function () {
            data.dropdown.removeClass('dropdown-animating');
            data.dropdownMenu.removeClass('animated dropdown-animated');
            data.dropdownMenu.removeClass(data.effectIn);
            data.dropdownMenu.removeClass(data.effectOut);

            if (typeof callback == 'function') {
                callback();
            }
        });
    }
}
//==========================================================================================================================

/* Browser - Function ======================================================================================================
*  You can manage browser
*  
*/
var edge = 'Microsoft Edge';
var ie10 = 'Internet Explorer 10';
var ie11 = 'Internet Explorer 11';
var opera = 'Opera';
var firefox = 'Mozilla Firefox';
var chrome = 'Google Chrome';
var safari = 'Safari';

$.AdminBSB.browser = {
    activate: function () {
        var _this = this;
        var className = _this.getClassName();

        if (className !== '') $('html').addClass(_this.getClassName());
    },
    getBrowser: function () {
        var userAgent = navigator.userAgent.toLowerCase();

        if (/edge/i.test(userAgent)) {
            return edge;
        } else if (/rv:11/i.test(userAgent)) {
            return ie11;
        } else if (/msie 10/i.test(userAgent)) {
            return ie10;
        } else if (/opr/i.test(userAgent)) {
            return opera;
        } else if (/chrome/i.test(userAgent)) {
            return chrome;
        } else if (/firefox/i.test(userAgent)) {
            return firefox;
        } else if (!!navigator.userAgent.match(/Version\/[\d\.]+.*Safari/)) {
            return safari;
        }

        return undefined;
    },
    getClassName: function () {
        var browser = this.getBrowser();

        if (browser === edge) {
            return 'edge';
        } else if (browser === ie11) {
            return 'ie11';
        } else if (browser === ie10) {
            return 'ie10';
        } else if (browser === opera) {
            return 'opera';
        } else if (browser === chrome) {
            return 'chrome';
        } else if (browser === firefox) {
            return 'firefox';
        } else if (browser === safari) {
            return 'safari';
        } else {
            return '';
        }
    }
}
//==========================================================================================================================

$(function () {
    $.AdminBSB.browser.activate();
    $.AdminBSB.leftSideBar.activate();
    $.AdminBSB.rightSideBar.activate();
    $.AdminBSB.navbar.activate();
    $.AdminBSB.dropdownMenu.activate();
    $.AdminBSB.input.activate();
    $.AdminBSB.select.activate();
    $.AdminBSB.search.activate();

    setTimeout(function () { $('.page-loader-wrapper').fadeOut(); }, 50);
});
>>>>>>> parent of 5c021008... code cleaned
