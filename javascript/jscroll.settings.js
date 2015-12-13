/*
 * @category  JScroll Bar Settings
 * @file      jscroll.settings.js
 * @data      01/12/15
 * @author    Graham Murray <x13504987@student.ncirl.ie>
 * @copyright Copyright (c) 2015
 * @reference JScroll bar code taken from http://jscrollpane.kelvinluck.com/
*/

$(function()
{
    $('.scroll-pane').jScrollPane();
    $('.scroll-pane-arrows').jScrollPane(
    {
        showArrows: true,
        horizontalGutter: 10
    }
    );
});

