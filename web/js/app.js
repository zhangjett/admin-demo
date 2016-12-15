$(function () {
    $(document).on('icheck', function(){
        $('.mailbox-messages input[type="checkbox"]').iCheck({
            checkboxClass: 'icheckbox_flat-green',
            radioClass: 'iradio_flat-green'
        });
        $('form input[type="checkbox"]').iCheck({
            checkboxClass: 'icheckbox_flat-green',
            radioClass: 'iradio_flat-green'
        });
        $('.box-body input[type="radio"]').iCheck({
            checkboxClass: 'icheckbox_flat-green',
            radioClass: 'iradio_flat-green'
        });
    }).trigger('icheck'); // trigger it for page load

    $(document).on("click",".checkbox-toggle",function(){
        var clicks = $(this).data('clicks');
        if (clicks) {
            //Uncheck all checkboxes
            $(".mailbox-messages input[type='checkbox']").iCheck("uncheck");
            $(".fa", this).removeClass("fa-check-square-o").addClass('fa-square-o');
        } else {
            //Check all checkboxes
            $(".mailbox-messages input[type='checkbox']").iCheck("check");
            $(".fa", this).removeClass("fa-square-o").addClass('fa-check-square-o');
        }
        $(this).data("clicks", !clicks);
    });

    var html = '<span class="pull-right-container">'
        +'<small class="label pull-right bg-green">new</small>'
        +'</span>';
    $("#sidebar-menu-documentation").find("a").append(html);

    html = '<span class="pull-right-container">'
        +'<small class="label pull-right bg-yellow">12</small>'
        +'<small class="label pull-right bg-green">16</small>'
        +'<small class="label pull-right bg-red">5</small>'
        +'</span>';

    $("#sidebar-menu-calendar").find("a").append(html);
});