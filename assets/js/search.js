/**
 * Front-end scripts for WP Athletes Plugin.
 * Path: wp-athletes-plugin/assets/js/search.js
 * Description: Handles the interactive search functionality on the front-end, making AJAX calls to filter and display athlete profiles based on user inputs.
 */

jQuery(document).ready(function ($) {
    var searchForm = $('.athlete-search-form');
    var searchResults = $('#search-results');

    searchForm.submit(function (event) {
        event.preventDefault();

        var formData = $(this).serialize();

        $.ajax({
            url: wpAthletesAjax.ajaxurl,
            type: 'POST',
            data: formData + '&action=athlete_search',
            success: function (response) {
                searchResults.html(response);
            },
            error: function () {
                searchResults.html('<p>An error occurred while fetching the results.</p>');
            }
        });
    });
});
