/*
 * jQuery FlexSlider v1.7
 * http://flex.madebymufffin.com
 * Copyright 2011, Tyler Smith
 * Free to use under the MIT license.
 */
(function ($) {
    $.flexslider = function (el, options) {
        const slider = el;
        slider.init = function () {
            // Merge default settings with user-defined options
            slider.vars = $.extend({}, $.flexslider.defaults, options);
            slider.data("flexslider", true);

            // Initialize slider elements
            slider.container = $(".slides", slider);
            slider.slides = $(".slides > li", slider);
            slider.count = slider.slides.length;
            slider.animating = false;
            slider.currentSlide = slider.vars.slideToStart;
            slider.atEnd = slider.currentSlide === 0;
            slider.eventType = "ontouchstart" in window ? "touchstart" : "click";

            // Clone slides for infinite looping
            if (slider.vars.animation.toLowerCase() === "slide" && slider.vars.animationLoop) {
                slider.cloneCount = 2;
                slider.cloneOffset = 1;
                slider.container.append(slider.slides.first().clone().addClass("clone"));
                slider.container.prepend(slider.slides.last().clone().addClass("clone"));
            }

            // Set up controls
            if (slider.vars.controlNav) {
                slider.setupControlNav();
            }
            if (slider.vars.directionNav) {
                slider.setupDirectionNav();
            }

            // Bind events
            slider.bindEvents();

            // Start the slideshow
            if (slider.vars.slideshow) {
                slider.startSlideshow();
            }

            // Trigger the start callback
            slider.vars.start(slider);
        };

        slider.setupControlNav = function () {
            const controlNav = $("<ol class='flex-control-nav'></ol>");
            for (let i = 1; i <= slider.count; i++) {
                controlNav.append(`<li><a>${i}</a></li>`);
            }
            slider.append(controlNav);
            slider.controlNav = $(".flex-control-nav li a", slider);
            slider.controlNav.eq(slider.currentSlide).addClass("active");
        };

        slider.setupDirectionNav = function () {
            const directionNav = $(
                `<ul class="flex-direction-nav">
                    <li><a class="prev" href="#">${slider.vars.prevText}</a></li>
                    <li><a class="next" href="#">${slider.vars.nextText}</a></li>
                </ul>`
            );
            slider.append(directionNav);
            slider.directionNav = $(".flex-direction-nav li a", slider);
        };

        slider.bindEvents = function () {
            // Touch swipe support
            if (slider.vars.touchSwipe && "ontouchstart" in window) {
                slider.on("touchstart", slider.handleTouchStart);
                slider.on("touchmove", slider.handleTouchMove);
            }

            // Keyboard navigation
            if (slider.vars.keyboardNav) {
                $(document).on("keydown", slider.handleKeydown);
            }

            // Pause/play functionality
            if (slider.vars.pausePlay) {
                slider.setupPausePlay();
            }
        };

        slider.startSlideshow = function () {
            slider.animatedSlides = setInterval(() => {
                slider.animateSlides();
            }, slider.vars.slideshowSpeed);
        };

        slider.animateSlides = function () {
            const nextSlide = slider.currentSlide === slider.count - 1 ? 0 : slider.currentSlide + 1;
            slider.flexAnimate(nextSlide);
        };

        slider.flexAnimate = function (targetSlide, pauseOnAction) {
            if (!slider.animating) {
                slider.animating = true;

                // Update active slide
                slider.currentSlide = targetSlide;
                slider.atEnd = targetSlide === 0 || targetSlide === slider.count - 1;

                // Trigger before callback
                slider.vars.before(slider);

                // Animate slides
                if (slider.vars.animation.toLowerCase() === "slide") {
                    slider.animateSlidePosition(targetSlide);
                } else {
                    slider.fadeSlides(targetSlide);
                }

                // Trigger after callback
                slider.vars.after(slider);
                slider.animating = false;
            }
        };

        slider.animateSlidePosition = function (targetSlide) {
            const newPosition = -1 * (targetSlide + slider.cloneOffset) * slider.slides.first().width();
            slider.container.animate(
                { marginLeft: `${newPosition}px` },
                slider.vars.animationDuration,
                () => {
                    slider.vars.after(slider);
                }
            );
        };

        slider.fadeSlides = function (targetSlide) {
            slider.slides.eq(slider.currentSlide).fadeOut(slider.vars.animationDuration);
            slider.slides.eq(targetSlide).fadeIn(slider.vars.animationDuration, () => {
                slider.vars.after(slider);
            });
        };

        slider.handleTouchStart = function (event) {
            // Handle touch start logic
        };

        slider.handleTouchMove = function (event) {
            // Handle touch move logic
        };

        slider.handleKeydown = function (event) {
            if (event.key === "ArrowRight") {
                slider.animateSlides();
            } else if (event.key === "ArrowLeft") {
                const prevSlide = slider.currentSlide === 0 ? slider.count - 1 : slider.currentSlide - 1;
                slider.flexAnimate(prevSlide);
            }
        };

        slider.setupPausePlay = function () {
            const pausePlay = $('<div class="flex-pauseplay"><span></span></div>');
            slider.append(pausePlay);
            slider.pausePlay = $(".flex-pauseplay span", slider);
            slider.pausePlay.on("click", () => {
                if (slider.pausePlay.hasClass("pause")) {
                    slider.pause();
                } else {
                    slider.resume();
                }
            });
        };

        slider.pause = function () {
            clearInterval(slider.animatedSlides);
            slider.pausePlay.removeClass("pause").addClass("play").text("play");
        };

        slider.resume = function () {
            slider.startSlideshow();
            slider.pausePlay.removeClass("play").addClass("pause").text("pause");
        };

        slider.init();
    };

    $.flexslider.defaults = {
        animation: "fade",
        slideshow: true,
        slideshowSpeed: 7000,
        animationDuration: 600,
        directionNav: true,
        controlNav: true,
        keyboardNav: true,
        touchSwipe: true,
        prevText: "Previous",
        nextText: "Next",
        pausePlay: false,
        randomize: false,
        slideToStart: 0,
        animationLoop: true,
        pauseOnAction: true,
        pauseOnHover: false,
        controlsContainer: "",
        manualControls: "",
        start: function () {},
        before: function () {},
        after: function () {},
        end: function () {},
    };

    $.fn.flexslider = function (options) {
        return this.each(function () {
            const $this = $(this);
            if ($this.find(".slides li").length > 1 && !$this.data("flexslider")) {
                new $.flexslider($this, options);
            }
        });
    };
})(jQuery);
