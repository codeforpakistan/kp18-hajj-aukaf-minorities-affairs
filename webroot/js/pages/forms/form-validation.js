<<<<<<< HEAD
$(function(){$("#form_validation").validate({rules:{checkbox:{required:!0},gender:{required:!0}},highlight:function(r){$(r).parents(".form-line").addClass("error")},unhighlight:function(r){$(r).parents(".form-line").removeClass("error")},errorPlacement:function(r,e){$(e).parents(".form-group").append(r)}}),$("#form_advanced_validation").validate({rules:{date:{customdate:!0},creditcard:{creditcard:!0}},highlight:function(r){$(r).parents(".form-line").addClass("error")},unhighlight:function(r){$(r).parents(".form-line").removeClass("error")},errorPlacement:function(r,e){$(e).parents(".form-group").append(r)}}),$.validator.addMethod("customdate",function(r,e){return r.match(/^\d\d\d\d?-\d\d?-\d\d$/)},"Please enter a date in the format YYYY-MM-DD."),$.validator.addMethod("creditcard",function(r,e){return r.match(/^\d\d\d\d?-\d\d\d\d?-\d\d\d\d?-\d\d\d\d$/)},"Please enter a credit card in the format XXXX-XXXX-XXXX-XXXX.")});
=======
$(function () {
    $('#form_validation').validate({
        rules: {
            'checkbox': {
                required: true
            },
            'gender': {
                required: true
            }
        },
        highlight: function (input) {
            $(input).parents('.form-line').addClass('error');
        },
        unhighlight: function (input) {
            $(input).parents('.form-line').removeClass('error');
        },
        errorPlacement: function (error, element) {
            $(element).parents('.form-group').append(error);
        }
    });

    //Advanced Form Validation
    $('#form_advanced_validation').validate({
        rules: {
            'date': {
                customdate: true
            },
            'creditcard': {
                creditcard: true
            }
        },
        highlight: function (input) {
            $(input).parents('.form-line').addClass('error');
        },
        unhighlight: function (input) {
            $(input).parents('.form-line').removeClass('error');
        },
        errorPlacement: function (error, element) {
            $(element).parents('.form-group').append(error);
        }
    });

    //Custom Validations ===============================================================================
    //Date
    $.validator.addMethod('customdate', function (value, element) {
        return value.match(/^\d\d\d\d?-\d\d?-\d\d$/);
    },
        'Please enter a date in the format YYYY-MM-DD.'
    );

    //Credit card
    $.validator.addMethod('creditcard', function (value, element) {
        return value.match(/^\d\d\d\d?-\d\d\d\d?-\d\d\d\d?-\d\d\d\d$/);
    },
        'Please enter a credit card in the format XXXX-XXXX-XXXX-XXXX.'
    );
    //==================================================================================================
});
>>>>>>> parent of 5c021008... code cleaned
