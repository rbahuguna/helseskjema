(function ($) {

	"use strict";
	
	var nowTemp = new Date();
	var now = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate(), 0, 0, 0, 0);

    var nowMinus18 = new Date()
    nowMinus18.setFullYear(nowMinus18.getFullYear() - 18);

	var fodselsnr = $('input[name=fodselsnr]').datepicker({
        onRender: function(date) {
            return date.valueOf() > now.valueOf() ? 'disabled' : '';
        }
        , dateFormat: "dd.mm.yy"
        , defaultDate: nowMinus18
        , changeMonth: true
        , changeYear: true
        , yearRange: "-100:+0"
        , maxDate: "+0D"
        , onSelect: function(dateText) {
            $('input[name=personnummer]').focus();
        }
    }).data('datepicker');

})(window.jQuery); // JavaScript Document