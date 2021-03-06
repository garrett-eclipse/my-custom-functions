/*
 * Plugin JavaScript and jQuery code for the admin pages of website
 *
 * @package     My Custom Functions
 * @uthor       Arthur Gareginyan
 * @link        https://www.arthurgareginyan.com
 * @copyright   Copyright (c) 2016-2017 Arthur Gareginyan. All Rights Reserved.
 * @since       4.6
 */


jQuery(document).ready(function($) {

    "use strict";

    // Find all textareas on page
    $('textarea').each(function(index, elements) {

        // Change textarea to CodeMirror editor
        var editor = CodeMirror.fromTextArea( elements , {
            lineNumbers: true,
            firstLineNumber: 1,
            matchBrackets: true,
            indentUnit: 4,
            mode: 'text/x-php',
            styleActiveLine: true
        });

        // Refresh CodeMirror editor after 1 second
        setTimeout(function() {
            editor.refresh();
        },1);
    });

    // Remove the 'successful' message after 3 seconds
    if ('.updated') {
        setTimeout(function() {
            $('.updated').fadeOut();
        }, 3000);
    }

    // Add dynamic content to page tabs. Needed for having an up to date content.
    $('.include-tab-author').load('https://www.spacexchimp.com/assets/dynamic-content/plugins.html #include-tab-author');
    $('.include-tab-store').load('https://www.spacexchimp.com/assets/dynamic-content/plugins.html #include-tab-store');

    // Add questions and answers into spoilers and color them in different colors
    $('.panel-group .panel').each(function(i) {
         $('.question-' + (i+1) ).appendTo( $('h4', this) );
         $('.answer-' + (i+1) ).appendTo( $('.panel-body', this) );

         if ( $(this).find('h4 div').hasClass('question-red') ) {
             $(this).addClass('panel-danger');
         } else {
             $(this).addClass('panel-info');
         }
    });

});
