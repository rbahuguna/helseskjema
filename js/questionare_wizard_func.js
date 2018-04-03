	/*  Wizard */
	jQuery(document).ready(function ($) {
		"use strict";
       	$(window).on('load', function () { // makes sure the whole site is loaded
            if ($(".step").length > 1)
                setLocation("1/" + $(".step").length)
        })

		$("#wizard_container").wizard({
			stepsWrapper: "#helseskjema",
			submit: ".submit",
			beforeSelect: function (event, state) {
				if (!state.isMovingForward)
					return true;
				var inputs = $(this).wizard('state').step.find(':input');
				return !inputs.length || !!inputs.valid();
			}
		});
		//  progress bar
		$("#progressbar").progressbar();
		$("#wizard_container").wizard({
			afterSelect: function (event, state) {
                if ( (state.stepsPossible + 1) > 1)
                    setLocation((state.stepsComplete + 1) + "/" + (state.stepsPossible + 1))
				$("#progressbar").progressbar("value", state.percentComplete);
			}
		});
	});
    
    function setLocation(location) {
        $("#middle-wizard .wizard-step-current").text(location);
    }