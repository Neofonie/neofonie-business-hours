"use strict";

jQuery.noConflict();
jQuery(document).ready(function($) {
    var year = (new Date).getFullYear();
    var currentNumberOfMonths;
    loadDatePickerByWidth();


    $(window).resize(function() {
        loadDatePickerByWidth();
    });

    function loadDatePickerByWidth() {
        if ($(window).width() < 1024 && currentNumberOfMonths !== 1) {
            $('.neo-businesshours_date').multiDatesPicker('destroy');
            currentNumberOfMonths = 1;
            setMultiDatePicker();
        } else if ($(window).width() >= 1024 && $(window).width() <= 1600 && currentNumberOfMonths !== [2, 2]) {
            $('.neo-businesshours_date').multiDatesPicker('destroy');
            currentNumberOfMonths = [2, 2]
            setMultiDatePicker();
        } else if ($(window).width() > 1600 && currentNumberOfMonths !== [3, 4]) {
            $('.neo-businesshours_date').multiDatesPicker('destroy');
            currentNumberOfMonths = [2, 6]
            setMultiDatePicker();
        }
    }

    function setMultiDatePicker() {
        $('.neo-businesshours_date').multiDatesPicker({
            dateFormat: 'dd.mm',
            numberOfMonths: currentNumberOfMonths,
            defaultDate: '01.01',
            yearRange: year + ':' + year
        });
    }
});