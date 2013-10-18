$('table.paginated').each(function() {
    var currentPage = 0;
    var numPerPage = 10;
    var $table = $(this);
    $table.bind('repaginate', function() {
        $table.find('tbody tr').hide().slice(currentPage * numPerPage, (currentPage + 1) * numPerPage).show();
    });
    $table.trigger('repaginate');
    var numRows = $table.find('tbody tr').length;
    var numPages = Math.ceil(numRows / numPerPage);
    var $pager = $('<div class="pagination pagination-centered"><ul></ul></div>');
    for (var page = 0; page < numPages; page++) {
        $('<li></li>').append('<a href="#">' + (page + 1) + '</a>').bind('click', {
            newPage: page
        }, function(event) {
            currentPage = event.data['newPage'];
            $table.trigger('repaginate');
            $(this).addClass('active').siblings().removeClass('active');
        }).appendTo($pager.children('ul')).addClass('clickable');
    }
    $pager.insertBefore($table).find('span.page-number:first').addClass('active');
});