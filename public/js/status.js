$(function() {
    $('.sendme').click(function() {
        var h = $(this).parent().find('.getid').val();
        var button = $(this).html();

        if ($(this).hasClass('label label-success label-mini')) {

            $(this).removeClass('label label-success label-mini');
            $(this).addClass('label label-warning label-mini');

            var status = 1;

            $.ajax({
                url: "timeslot",
                type: "post",
                data: {
                    '_token': $('input[name = _token]').val(),
                    h: h,
                    st: status

                },
                success: function(d) {

                }
            });
            if (button == 'Enable') {
                $(this).text('Disable');
            }

        } else {

            $(this).removeClass('label label-warning label-mini');
            $(this).addClass('label label-success label-mini');

            var status = 0;

            $.ajax({
                url: "timeslot",
                type: "post",
                data: {
                    '_token': $('input[name = _token]').val(),
                    h: h,
                    st: status
                },
                success: function(d) {

                }
            });
            if (button == 'Disable') {
                $(this).text('Enable');
            }
        }
    });
});