/**
 * Main JavaScript
 *
 * @package Insuffle_Framework
 * @since 1.0.0
 */

(function($) {
  'use strict';

  $(document).ready(function() {

    /**
     * Skip link focus fix
     */
    $('.skip-link').on('click', function(e) {
      const target = $(this).attr('href');

      if ($(target).length) {
        e.preventDefault();
        $(target).attr('tabindex', '-1').focus();

        $(target).on('blur focusout', function() {
          $(this).removeAttr('tabindex');
        });

        $('html, body').animate({
          scrollTop: $(target).offset().top
        }, 300);
      }
    });

    /**
     * Responsive tables
     */
    $('.entry-content table').each(function() {
      if (!$(this).parent('.table-wrapper').length) {
        $(this).wrap('<div class="table-wrapper"></div>');
      }
    });

    /**
     * Responsive videos
     */
    $('.entry-content').fitVids({
      customSelector: 'iframe[src*="youtube.com"], iframe[src*="vimeo.com"], iframe[src*="dailymotion.com"]'
    });

    /**
     * Add class to body when scrolling
     */
    let didScroll = false;

    $(window).on('scroll', function() {
      didScroll = true;
    });

    setInterval(function() {
      if (didScroll) {
        const scrollTop = $(window).scrollTop();

        if (scrollTop > 100) {
          $('body').addClass('scrolled');
        } else {
          $('body').removeClass('scrolled');
        }

        didScroll = false;
      }
    }, 250);

    /**
     * Back to top button
     */
    const $backToTop = $('<button class="back-to-top" aria-label="Retour en haut"><span aria-hidden="true">↑</span></button>');
    $('body').append($backToTop);

    $(window).on('scroll', function() {
      if ($(window).scrollTop() > 300) {
        $backToTop.addClass('show');
      } else {
        $backToTop.removeClass('show');
      }
    });

    $backToTop.on('click', function() {
      $('html, body').animate({
        scrollTop: 0
      }, 600);
    });

    /**
     * Lazy load images (native lazy loading fallback)
     */
    if ('loading' in HTMLImageElement.prototype) {
      const images = document.querySelectorAll('img[loading="lazy"]');
      images.forEach(img => {
        if (img.dataset.src) {
          img.src = img.dataset.src;
        }
      });
    } else {
      // Fallback for browsers that don't support lazy loading
      const script = document.createElement('script');
      script.src = 'https://cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/lazysizes.min.js';
      document.body.appendChild(script);
    }

    /**
     * External links - open in new tab
     */
    $('a[href^="http"]').not('[href*="' + location.hostname + '"]').attr({
      target: '_blank',
      rel: 'noopener noreferrer'
    });

    /**
     * Add animation on scroll (fade in)
     */
    const observerOptions = {
      threshold: 0.1,
      rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver(function(entries) {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          entry.target.classList.add('animate-in');
          observer.unobserve(entry.target);
        }
      });
    }, observerOptions);

    document.querySelectorAll('.post, .page, article').forEach(el => {
      observer.observe(el);
    });

    /**
     * Form validation enhancement
     */
    $('input[type="email"]').on('blur', function() {
      const email = $(this).val();
      const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

      if (email && !emailRegex.test(email)) {
        $(this).addClass('error');
        if (!$(this).next('.error-message').length) {
          $(this).after('<span class="error-message">Adresse e-mail invalide</span>');
        }
      } else {
        $(this).removeClass('error');
        $(this).next('.error-message').remove();
      }
    });

    /**
     * Accessible dropdown menus (keyboard navigation)
     */
    $('.main-navigation a').on('focus blur', function() {
      $(this).parents('li').toggleClass('focus');
    });

  }); // End document ready

  /**
   * Window load events
   */
  $(window).on('load', function() {
    // Remove preloader if exists
    $('.preloader').fadeOut('slow');

    // Trigger resize to ensure proper layout
    $(window).trigger('resize');
  });

})(jQuery);

/**
 * FitVids - Responsive video embeds
 * Simplified version
 */
(function($) {
  $.fn.fitVids = function(options) {
    const settings = {
      customSelector: null,
      ignore: null
    };

    if (!document.getElementById('fit-vids-style')) {
      const head = document.head || document.getElementsByTagName('head')[0];
      const css = '.fluid-width-video-wrapper{width:100%;position:relative;padding:0;}.fluid-width-video-wrapper iframe,.fluid-width-video-wrapper object,.fluid-width-video-wrapper embed {position:absolute;top:0;left:0;width:100%;height:100%;}';
      const div = document.createElement('div');
      div.innerHTML = '<p>x</p><style id="fit-vids-style">' + css + '</style>';
      head.appendChild(div.childNodes[1]);
    }

    if (options) {
      $.extend(settings, options);
    }

    return this.each(function() {
      const selectors = [
        'iframe[src*="player.vimeo.com"]',
        'iframe[src*="youtube.com"]',
        'iframe[src*="youtube-nocookie.com"]',
        'iframe[src*="kickstarter.com"][src*="video.html"]',
        'object',
        'embed'
      ];

      if (settings.customSelector) {
        selectors.push(settings.customSelector);
      }

      const ignoreList = '.fitvidsignore';

      if (settings.ignore) {
        ignoreList = ignoreList + ', ' + settings.ignore;
      }

      const $allVideos = $(this).find(selectors.join(','));
      $allVideos = $allVideos.not('object object');
      $allVideos = $allVideos.not(ignoreList);

      $allVideos.each(function() {
        const $this = $(this);
        if ($this.parents(ignoreList).length > 0) {
          return;
        }
        if (this.tagName.toLowerCase() === 'embed' && $this.parent('object').length || $this.parent('.fluid-width-video-wrapper').length) {
          return;
        }
        if ((!$this.css('height') && !$this.css('width')) && (isNaN($this.attr('height')) || isNaN($this.attr('width')))) {
          $this.attr('height', 9);
          $this.attr('width', 16);
        }
        const height = (this.tagName.toLowerCase() === 'object' || ($this.attr('height') && !isNaN(parseInt($this.attr('height'), 10)))) ? parseInt($this.attr('height'), 10) : $this.height();
        const width = !isNaN(parseInt($this.attr('width'), 10)) ? parseInt($this.attr('width'), 10) : $this.width();
        const aspectRatio = height / width;
        if (!$this.attr('name')) {
          const videoName = 'fitvid' + Math.floor(Math.random() * 999999);
          $this.attr('name', videoName);
        }
        $this.wrap('<div class="fluid-width-video-wrapper"></div>').parent('.fluid-width-video-wrapper').css('padding-top', (aspectRatio * 100) + '%');
        $this.removeAttr('height').removeAttr('width');
      });
    });
  };
})(jQuery);
