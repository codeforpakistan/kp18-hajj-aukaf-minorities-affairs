/*
 * form_wizard.js
 *
 * Demo JavaScript used on Form Wizard-page.
 */

"use strict";

$(document).ready(function () {

    //===== Form Wizard =====//

    // Config
    var form = $('#sample_form');
    var wizard = $('#form_wizard');
    var error = $('.alert-danger', form);
    var success = $('.alert-success', form);
    var flag = 1;

    form.validate({
        doNotHideMessage: true, // To display error/ success message on tab-switch
        focusInvalid: false, // Do not focus the last invalid input
        invalidHandler: function (event, validator) {
            // Display error message on form submit

            success.hide();
            error.show();
        },
        submitHandler: function (form) {

            success.show();
            error.hide();
//            $("#sample_form .form-control").each(function () {
//                alert($(this).attr('name')+'=>'+$(this).val());
//            });
            form.submit();
            // Maybe you want to add some Ajax here to submit your form
            // Otherwise just call form.submit() or remove this submitHandler to submit the form without ajax
        }
    });

    // Functions
    let displayConfirm = function () {
        $('#tab4 .form-control-static', form).each(function () {
            var input = $('[name="' + $(this).attr("data-display") + '"]', form);
            let qualification_level = Number($('#qualification_level').val());
            let _grading_system = $('#grading_system').val();
            let education_system = $('#education_system').val();

            let hide_grading_systems = {
                // for cgpa, hide following
                'cgpa' : [
                    '._total_marks',
                    '._obtained_marks'
                ],

                // for marks, hide following
                'marks' : [
                    '._total_cgpa',
                    '._obtained_cgpa',
                    '._percentage'
                ]
            };

            // let hide_profession_inputs = [
            //     '._profession',
            //     '._monthly_income',
            //     '._dependent_family_members'
            // ];

            // if(subCategoryId === 2)
            // {
            //     for(let hideElm of hide_profession_inputs)
            //     {
            //         $(hideElm).hide();
            //     }

            // }
            
            if(_grading_system)
            {
                for(let hideElm of hide_grading_systems[_grading_system])
                {
                    $(hideElm).hide();
                }
            }

            let element = $(this).attr("data-display");
            if(element === 'ApplicantContact[mob_number][]')
            {
                let mobileNumbers = $('[name="ApplicantContact[mob_number][]"]').map(function(){return $(this).val();}).get();
                $(this).html(mobileNumbers.toString());

            }
            else if (input.is(":radio") && input.is(":checked")) {
                $(this).html(input.attr("data-title"));
            }
            else if (input.is('input') || input.is('textarea')) {
                $(this).html(input.val());
            }
            else if (input.is("select")) {
                $(this).html(input.find('option:selected').text());
            }
            if(qualification_level > 2)
            {
                $("._institute_name").hide();
                $('[name="Qualification[discipline_id]"]').val($('[name="Discipline[discipline]"]').val());
                $("._discipline_id p").html($('[name="Discipline[discipline]"]').find('option:selected').text());
            }
        });
    }

    var handleTitle = function (tab, navigation, index) {
        var total = navigation.find('li').length;
        var current = index + 1;

        // Set widget title
        $('.step-title', wizard).text('Step ' + (index + 1) + ' of ' + total);

        // Set done steps
        $('li', wizard).removeClass("done");

        var li_list = navigation.find('li');
        for (var i = 0; i < index; i++) {
            $(li_list[i]).addClass("done");
        }

        if (current == 1) {
            wizard.find('.button-previous').hide();
        } else {
            wizard.find('.button-previous').show();
        }

        if (current >= total) {
            wizard.find('.button-next').hide();
            wizard.find('.button-submit').show();
            displayConfirm();
        } else {
            wizard.find('.button-next').show();
            wizard.find('.button-submit').hide();
        }
    }

    // Form wizard example
    wizard.bootstrapWizard({
        'nextSelector': '.button-next',
        'previousSelector': '.button-previous',
        onTabClick: function (tab, navigation, index, clickedIndex) {
            success.hide();
            error.hide();

            if (clickedIndex >= index && form.valid() == false) {
                return false;
            }
            handleTitle(tab, navigation, clickedIndex);
        },
        onNext: function (tab, navigation, index) {
            success.hide();
            error.hide();

            if (form.valid() == false) {
                return false;
            }

            handleTitle(tab, navigation, index);
        },
        onPrevious: function (tab, navigation, index) {
            success.hide();
            error.hide();

            handleTitle(tab, navigation, index);
        },
        onTabShow: function (tab, navigation, index) {
            // To set progressbar width
            var total = navigation.find('li').length;
            var current = index + 1;
            var $percent = (current / total) * 100;
            wizard.find('.progress-bar').css({
                width: $percent + '%'
            });
        }
    });

    wizard.find('.button-previous').hide();
    $('#form_wizard .button-submit').click(function () {
        alert('You just finished the wizard. :-)');
    }).hide();

});