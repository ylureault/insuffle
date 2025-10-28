/**
 * Navigation & Mobile Menu
 *
 * @package Insuffle_Framework
 * @since 1.0.0
 */

(function() {
  'use strict';

  // Mobile menu toggle
  const menuToggle = document.querySelector('.menu-toggle');
  const mainNavigation = document.querySelector('.main-navigation');

  if (menuToggle && mainNavigation) {
    menuToggle.addEventListener('click', function() {
      const expanded = menuToggle.getAttribute('aria-expanded') === 'true';
      menuToggle.setAttribute('aria-expanded', !expanded);
      mainNavigation.classList.toggle('toggled');

      // Prevent body scroll when menu is open
      if (!expanded) {
        document.body.style.overflow = 'hidden';
      } else {
        document.body.style.overflow = '';
      }
    });

    // Close menu when clicking outside
    document.addEventListener('click', function(event) {
      const isClickInsideMenu = mainNavigation.contains(event.target);
      const isClickOnToggle = menuToggle.contains(event.target);

      if (!isClickInsideMenu && !isClickOnToggle && mainNavigation.classList.contains('toggled')) {
        menuToggle.setAttribute('aria-expanded', 'false');
        mainNavigation.classList.remove('toggled');
        document.body.style.overflow = '';
      }
    });

    // Close menu on escape key
    document.addEventListener('keydown', function(event) {
      if (event.key === 'Escape' && mainNavigation.classList.contains('toggled')) {
        menuToggle.setAttribute('aria-expanded', 'false');
        mainNavigation.classList.remove('toggled');
        document.body.style.overflow = '';
        menuToggle.focus();
      }
    });
  }

  // Submenu toggle for mobile (accessibility)
  const menuItems = document.querySelectorAll('.main-navigation .menu-item-has-children');

  menuItems.forEach(function(item) {
    // Add button for keyboard navigation
    const link = item.querySelector('a');
    const submenu = item.querySelector('ul');

    if (link && submenu) {
      // Create toggle button
      const toggleButton = document.createElement('button');
      toggleButton.classList.add('submenu-toggle');
      toggleButton.setAttribute('aria-expanded', 'false');
      toggleButton.setAttribute('aria-label', 'Toggle submenu');
      toggleButton.innerHTML = '<span aria-hidden="true">▾</span>';

      // Insert button after link
      link.insertAdjacentElement('afterend', toggleButton);

      // Toggle submenu on button click
      toggleButton.addEventListener('click', function(e) {
        e.preventDefault();
        e.stopPropagation();

        const expanded = toggleButton.getAttribute('aria-expanded') === 'true';
        toggleButton.setAttribute('aria-expanded', !expanded);
        submenu.style.display = expanded ? '' : 'block';
      });
    }
  });

  // Sticky header on scroll
  const siteHeader = document.querySelector('.site-header.sticky-header');

  if (siteHeader) {
    let lastScroll = 0;
    const headerHeight = siteHeader.offsetHeight;

    window.addEventListener('scroll', function() {
      const currentScroll = window.pageYOffset;

      if (currentScroll > headerHeight) {
        siteHeader.classList.add('scrolled');

        // Hide on scroll down, show on scroll up
        if (currentScroll > lastScroll && !mainNavigation.classList.contains('toggled')) {
          siteHeader.style.transform = 'translateY(-100%)';
        } else {
          siteHeader.style.transform = 'translateY(0)';
        }
      } else {
        siteHeader.classList.remove('scrolled');
        siteHeader.style.transform = 'translateY(0)';
      }

      lastScroll = currentScroll;
    });
  }

  // Smooth scroll to anchor links
  const anchorLinks = document.querySelectorAll('a[href^="#"]');

  anchorLinks.forEach(function(link) {
    link.addEventListener('click', function(e) {
      const targetId = this.getAttribute('href');

      if (targetId === '#' || targetId === '') {
        return;
      }

      const targetElement = document.querySelector(targetId);

      if (targetElement) {
        e.preventDefault();

        // Close mobile menu if open
        if (mainNavigation && mainNavigation.classList.contains('toggled')) {
          menuToggle.setAttribute('aria-expanded', 'false');
          mainNavigation.classList.remove('toggled');
          document.body.style.overflow = '';
        }

        // Smooth scroll
        const headerOffset = siteHeader ? siteHeader.offsetHeight : 0;
        const elementPosition = targetElement.getBoundingClientRect().top;
        const offsetPosition = elementPosition + window.pageYOffset - headerOffset - 20;

        window.scrollTo({
          top: offsetPosition,
          behavior: 'smooth'
        });

        // Update URL
        if (history.pushState) {
          history.pushState(null, null, targetId);
        }

        // Focus target element for accessibility
        targetElement.focus();
        if (document.activeElement !== targetElement) {
          targetElement.setAttribute('tabindex', '-1');
          targetElement.focus();
        }
      }
    });
  });
})();
