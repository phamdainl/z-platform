/* global wp, jQuery */
/**
 * File customizer.js.
 *
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */


var customizer_dropdown_menu = document.querySelectorAll("#main-menu .dropdown-toggle");
customizer_dropdown_menu.forEach(link => link.href = "#");