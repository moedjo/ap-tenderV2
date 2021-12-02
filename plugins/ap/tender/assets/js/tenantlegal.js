(function () { // DON'T EDIT BELOW THIS LINE
    console.log($('.kbli-label'));
})();

$(document).ready(function() {
    $('.kbli-label label:first').before(
        '<i class="icon-info-circle kbli-info" data-control="popover" data-placement="top" id="btn1"></i>'
    );

    $('#btn1').on('showing.oc.popover', function (e, popover) {
        popover.options.content = '<div class="popover-body">Ini adalah deskripsi KBLI</div>'
    })
})
