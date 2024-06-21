jQuery(document).ready(function($) {
    $('.athlete-search-form').on('submit', function(e) {
        e.preventDefault();

        var searchData = $(this).serialize();
        $.post(wpAthletes.ajaxurl, searchData, function(response) {
            $('.athlete-archive .athletes-list').html(response);
        });
    });
});
