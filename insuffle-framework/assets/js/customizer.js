/**
 * Customizer Live Preview
 *
 * @package Insuffle_Framework
 * @since 1.0.0
 */

(function($) {
  'use strict';

  // Site title
  wp.customize('blogname', function(value) {
    value.bind(function(to) {
      $('.site-title a').text(to);
    });
  });

  // Site description
  wp.customize('blogdescription', function(value) {
    value.bind(function(to) {
      $('.site-description').text(to);
    });
  });

  // Header CTA Text
  wp.customize('insuffle_header_cta_text', function(value) {
    value.bind(function(to) {
      if (to) {
        if ($('.header-cta-button').length) {
          $('.header-cta-button').text(to);
        }
      } else {
        $('.header-cta-button').remove();
      }
    });
  });

  // Primary color
  wp.customize('insuffle_primary_color', function(value) {
    value.bind(function(to) {
      $('head').append('<style id="insuffle-primary-color">:root { --insuffle-primary: ' + to + '; }</style>');
    });
  });

  // Secondary color
  wp.customize('insuffle_secondary_color', function(value) {
    value.bind(function(to) {
      $('head').append('<style id="insuffle-secondary-color">:root { --insuffle-secondary: ' + to + '; }</style>');
    });
  });

  // Accent color
  wp.customize('insuffle_accent_color', function(value) {
    value.bind(function(to) {
      $('head').append('<style id="insuffle-accent-color">:root { --insuffle-accent: ' + to + '; }</style>');
    });
  });

  // Base font size
  wp.customize('insuffle_base_font_size', function(value) {
    value.bind(function(to) {
      $('head').append('<style id="insuffle-base-font">:root { --insuffle-font-base: ' + to + 'px; }</style>');
    });
  });

  // Heading font weight
  wp.customize('insuffle_heading_weight', function(value) {
    value.bind(function(to) {
      $('head').append('<style id="insuffle-heading-weight">h1, h2, h3, h4, h5, h6 { font-weight: ' + to + '; }</style>');
    });
  });

  // Line height
  wp.customize('insuffle_line_height', function(value) {
    value.bind(function(to) {
      $('head').append('<style id="insuffle-line-height">:root { --insuffle-line-height-normal: ' + to + '; }</style>');
    });
  });

  // Container width
  wp.customize('insuffle_container_width', function(value) {
    value.bind(function(to) {
      $('head').append('<style id="insuffle-container-width">:root { --insuffle-max-width-7xl: ' + to + 'px; }</style>');
    });
  });

  // Border radius
  wp.customize('insuffle_border_radius', function(value) {
    value.bind(function(to) {
      $('head').append('<style id="insuffle-border-radius">:root { --insuffle-radius-lg: ' + to + 'px; }</style>');
    });
  });

  // Footer text
  wp.customize('insuffle_footer_text', function(value) {
    value.bind(function(to) {
      $('.site-info').html(to);
    });
  });

  // Show branding
  wp.customize('insuffle_show_branding', function(value) {
    value.bind(function(to) {
      if (to) {
        $('.insuffle-branding').show();
      } else {
        $('.insuffle-branding').hide();
      }
    });
  });

  // Header layout
  wp.customize('insuffle_header_layout', function(value) {
    value.bind(function(to) {
      $('.site-header').removeClass('header-layout-default header-layout-centered header-layout-minimal');
      $('.site-header').addClass('header-layout-' + to);
    });
  });

  // Sticky header
  wp.customize('insuffle_sticky_header', function(value) {
    value.bind(function(to) {
      if (to) {
        $('.site-header').addClass('sticky-header');
      } else {
        $('.site-header').removeClass('sticky-header');
      }
    });
  });

  // Blog layout
  wp.customize('insuffle_blog_layout', function(value) {
    value.bind(function(to) {
      $('.posts-wrapper').removeClass('layout-list layout-grid layout-card');
      $('.posts-wrapper').addClass('layout-' + to);
    });
  });

})(jQuery);
