$(function () {
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