$(function () {
    var lastTab = null;

    $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
        lastTab = $(e.relatedTarget).attr('id');
    });

    $("div ul.nav").on('shown.bs.tab', "li.disabled a", function (event) {
        var myLastTab = lastTab;
        if (myLastTab) {
            $('#' + myLastTab).tab('show');
        }
        return false;
    });
    $("div ul.nav").off('shown.bs.tab', "li:not(.disabled) a");
});
