const landingPageSubUrl = "/landing";
const landingContactPageSubUrl = "/contact-us";
const homePageSubUrl = "/home";
const adminPageSubUrl = '/admin';
const safeMargin = 200;
let lastScrollTop = 0;



/**
 * ------------------------------------------------------------------------------------
 * << Landing Page >>
 * ------------------------------------------------------------------------------------
 * @showElement()
 * @changeLandingActiveNav()
 * @initLandingScripts()
 * 
 */

/**
 * @function changeLandingActiveNav()
 * ------------------------------------------------------------------------------------
 * @description: 
 * Change the active navigation link based on the scroll position 
 * INPUT: scroll
 */
function changeLandingActiveNav() {
  const scrollPos = $(window).scrollTop();
  const navbarHeight = $('#nav').height() || 80;
  const domHeight = $(document).height();
  const safeArea = 10;
  let viewportBottomPos = $(window).scrollTop() + $(window).height();

  // Check if the Viewport Hit The Bottom Most Section
  if (viewportBottomPos >= domHeight - safeArea && window.location.href.includes(landingPageSubUrl)) {
    // Landing SideMenu
    $('.sidemenu-nav-link').removeClass('bg-brand-gradient-200 text-white').addClass('text-brand-text-tertiary bg-white');
    $(`.sidemenu-nav-link[href*="#contact-us-section"]`).addClass('bg-brand-gradient-200 text-white hover:bg-brand-main-bg').removeClass('text-brand-text-tertiary bg-white');
    // Landing Navigation
    $('.nav-link').removeClass('text-brand-gradient-200 border-b-brand-gradient-200 -translate-y-1').addClass('border-transparent');
    $(`.nav-link[href*="#contact-us-section"]`).addClass('text-brand-gradient-200 border-b-brand-gradient-200 -translate-y-1').removeClass('border-transparent');
  }

  // Get all the Section with ID Inside Main Element
  $('main > div > div[id]').each(function () {
    const sectionTop = $(this).offset().top - navbarHeight - safeArea;
    const sectionBottom = sectionTop + $(this).height();
    const id = $(this).attr('id');

    // Check if the Viewport Hit the Inbetween Section 
    if (scrollPos >= sectionTop && scrollPos < sectionBottom && window.location.href.includes(landingPageSubUrl)) {
      // Landing SideMenu
      $('.sidemenu-nav-link').removeClass('bg-brand-gradient-200 text-white').addClass('text-brand-text-tertiary bg-white');
      $(`.sidemenu-nav-link[href*="#${id}"]`).addClass('bg-brand-gradient-200 text-white').removeClass('text-brand-text-tertiary bg-white hover:bg-brand-main-bg');
      // Landing Navigation
      $('.nav-link').removeClass('text-brand-gradient-200 border-b-brand-gradient-200 -translate-y-1').addClass('border-transparent');
      $(`.nav-link[href*="#${id}"]`).addClass('text-brand-gradient-200 border-b-brand-gradient-200 -translate-y-1').removeClass('border-transparent');
    }
  });
}

/**
 * @function initLandingScripts()
 * ------------------------------------------------------------------------------------
 * @description: 
 * Initiate Scripts for Landing Page 
 * INPUT: scroll, page load, livewire:navigated
 */
function initLandingScripts() {
  showElement();
  changeLandingActiveNav();
}

/**
 * @function toggleLandingSideMenu()
 * ------------------------------------------------------------------------------------
 * @description: 
 * Toggle the side menu
 * INPUT: click "#landing-sidemenu-toggle"
 */
function toggleLandingSideMenu() {
  const $landingSidemenu = $('#landing-sidemenu-section');
  const $landingMainSection = $('#landing-main-section');

  // Open side menu
  if ($landingSidemenu.hasClass('-translate-x-full')) {
    $landingSidemenu.removeClass('-translate-x-full').addClass('translate-x-0');
    $landingMainSection.removeClass('brightness-100').addClass('brightness-70');
  }
  // Close side menu
  else {
    $landingSidemenu.removeClass('translate-x-0').addClass('-translate-x-full');
    $landingMainSection.removeClass('brightness-70').addClass('brightness-100');
  }
}


/**
 * ------------------------------------------------------------------------------------
 * << Admin Page >>
 * ------------------------------------------------------------------------------------
 * @toggleAdminTopbar()
 * @toggleAdminSideMenu()
 * 
 */

/**
 * @function toggleAdminTopbar()
 * ------------------------------------------------------------------------------------
 * @description: 
 * Toggle the admin top bar
 * INPUT: click "#admin-nav-toggle"
 */
function toggleAdminTopbar() {
  $('#admin-nav-link').toggleClass('hidden');
}

/**
 * @function toggleAdminSideMenu()
 * ------------------------------------------------------------------------------------
 * @description: 
 * Toggle the side menu
 * INPUT: click "#admin-sidemenu-toggle"
 */
function toggleAdminSideMenu() {
  const $adminSidemenu = $('#admin-sidemenu-section');
  const $adminMainSection = $('#admin-main-section');

  // Open side menu
  if ($adminSidemenu.hasClass('-translate-x-full')) {
    $adminSidemenu.removeClass('-translate-x-full').addClass('translate-x-0');
    $adminMainSection.removeClass('brightness-100').addClass('brightness-70');
  }
  // Close side menu
  else {
    $adminSidemenu.removeClass('translate-x-0').addClass('-translate-x-full');
    $adminMainSection.removeClass('brightness-70').addClass('brightness-100');
  }
}

/**
 * ------------------------------------------------------------------------------------
 * << General >>
 * ------------------------------------------------------------------------------------
 * @showElement()
 *  
 */

/**
 * @function showElement()
 * ------------------------------------------------------------------------------------
 * @description: 
 * Show element when scrolling
 * INPUT: scroll
 */
function showElement() {
  const viewportBottomPos = $(window).scrollTop() + $(window).height();
  const currentUrl = window.location.href;

  $('.invisible').each(function () {
    const elementTopPos = $(this).offset().top;
    if (viewportBottomPos > elementTopPos + safeMargin && (currentUrl.includes(homePageSubUrl) || currentUrl.includes(landingContactPageSubUrl))) {
      $(this).removeClass('invisible').addClass('wobble-fade-in-effect visible');
    }

    if (viewportBottomPos > elementTopPos + safeMargin) {
      $(this).removeClass('invisible').addClass('fade-in-effect visible');
    }
  });
}


/**
 * << Initiation and ActionListener >>
 */

// Toggle sidebar when clicking the toggle button (Desktop View)
$(document).on('click', '#admin-nav-toggle', toggleAdminTopbar);

// Toggle sidebar when clicking the toggle button
$(document).on('click', '#admin-sidemenu-toggle', function (e) {
  // Prevent the child element to trigger the parent event
  e.stopPropagation();
  toggleAdminSideMenu();
});

// Toggle sidebar when clicking the toggle button
$(document).on('click', '#landing-sidemenu-toggle', function (e) {
  // Prevent the child element to trigger the parent event
  e.stopPropagation();
  toggleLandingSideMenu();
});

// Close sidebar when clicking outside of it (for desktop view)
$(document).on('click', function (e) {
  const $adminSidemenu = $('#admin-sidemenu-section');
  const $landingSidemenu = $('#landing-sidemenu-section');

  if ($adminSidemenu.hasClass('translate-x-0') && !$adminSidemenu.is(e.target) && $adminSidemenu.has(e.target).length === 0) {
    toggleAdminSideMenu();
  } else if ($landingSidemenu.hasClass('translate-x-0') && !$landingSidemenu.is(e.target) && $landingSidemenu.has(e.target).length === 0) {
    toggleLandingSideMenu();
  }
});

// Add scroll effect and change the active nav link when scrolling
$(document).on('scroll', function () {
  let currURL = window.location.href;

  // Initiation for home landing page and 
  if (currURL.includes(landingPageSubUrl)) {
    initLandingScripts();
  }
});

// Initiated when the page loads
$(document).ready(function () {
  let currURL = window.location.href;

  // Initiation for home landing page
  if (currURL.includes(landingPageSubUrl)) {
    initLandingScripts();
  }
});


// Initiated when the page is navigated via Livewire
$(document).on('livewire:navigated', function () {
  let currURL = window.location.href;

  // Initiation for home landing page
  if (currURL.includes(landingPageSubUrl)) {
    initLandingScripts();
    toggleLandingSideMenu();
  }

  if (currURL.includes(adminPageSubUrl)) {
    toggleAdminSideMenu();
  }
});


