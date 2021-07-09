function open_modal(sub_categories, fund_id) {
    if (sub_categories == 2) {
        if ($('#groom_or_bride_name').val() == '') {
            $('#show_bride_name_field').show();
            $('#groom_or_bride_name').attr('required', true).show();
        }
    } else {
        $('#show_bride_name_field').hide();
        $('#groom_or_bride_name').attr('required', false).hide();
    }
    $('#sub_category_id').val(sub_categories);
    $('#fund_id').val(fund_id);

    var url = baseUrl + '/admin/services';
    $.ajax({
        type: "GET",
        contentType: 'json',
        url: url,
        data: "attachments=" + sub_categories,
        success: function (data) {
            data = JSON.parse(data);
            $('#required_attachments').text(data);
            $('#myModal').modal('show');
        }, error: function (error) {
            alert(json.stringify(error));
        }
    });
}

// load disciplines
function callForDisciplines(qualification_level) {
    var url = baseUrl + '/qualification/disciplines';
    axios({
        url: url,
        params : {
            qualification_level : qualification_level
        }
    }).then((response) => {
        $('#discipline').empty();
        $('#discipline_field').empty();
        if(response.data.disciplines.length)
        {
            let data = response.data.disciplines;
            $.each(data, function (index, discipline) {
                $('#discipline').append($('<option>').text(discipline.discipline).attr('value', discipline.id));
                $('#discipline_field').append($('<option>').text(discipline.discipline).attr('value', discipline.id));
            });
        }
        else{
            $('#discipline').append($('<option>').text('Select Discipline').attr('value', ''));
            $('#discipline_field').append($('<option>').text('Select Discipline').attr('value', ''));
        }
    }).catch((error) => {
        console.log(error);
    });
}
// end disiplines

//edit qualification
function uncheck_fields(id) {
    // alert($('#checkbox_' + id).val());
    $('#qualification_details :checkbox:not("#checkbox_' + id + '")').attr('checked', false);
    var url = baseUrl + '/admin/services';
    $.ajax({
        type: "GET",
        contentType: 'json',
        url: url,
        data: "qualification_id=" + id,
        success: function (data) {
            data = JSON.parse(data);
            if (data) {

                $('#qualification_id').val(data.id);
                if (data.completed) {
                    $('#completed').prop('checked', true);
                    $('#div_passing_date').show();
                    $('#passing_date').attr('required', true);
                } else {
                    $('#completed').prop('checked', false);
                    $('#div_passing_date').hide();
                    $('#passing_date').attr('required', false);
                }
                if (data.passing_date) {
                    $('#passing_date').val(data.passing_date);
                } else {
                    $('#passing_date').val('');
                }
                $("input[name='Qualification[education_system]'][value='" + data.education_system + "']").prop('checked', true);
                $("input[name='Qualification[grading_system]'][value='" + data.grading_system + "']").prop('checked', true);
                if (data.grading_system == 'marks') {
                    $('#total_marks').val(data.total_marks);
                    $('#obtained_marks').val(data.obtained_marks);
                    $("#cgpa_fields :input").attr('required', false).val('');
                    $("#percentage_div :input").attr('required', false).val('');
                    $("#marks_fields :input").attr('required', true);
                    $('#cgpa_fields').hide();
                    $('#marks_fields').show();
                    $('#percentage_div').hide();
                } else {
                    $('#total_cgpa').val(data.total_cgpa);
                    $('#obtained_cgpa').val(data.obtained_cgpa);
                    $('#percentage').val(data.percentage);
                    $("#cgpa_fields :input").attr('required', true);
                    $("#percentage_div :input").attr('required', true);
                    $("#marks_fields :input").attr('required', false).val('');
                    $('#cgpa_fields').show();
                    $('#marks_fields').hide();
                    $('#percentage_div').show();
                }
                // qualifications details
                if (data.qualification_level_id) {
                    $('#qualification_level').val(data.qualification_level_id);

                    if (data.qualification_level_id == 1 || data.qualification_level_id == 2) {
                        $('#school_fields').fadeIn();
                        // $("#school_fields :input").attr('required', true).val('');
                        $("#city_dropdown").attr('required', true);
                        $("#degree_awarding_id").attr('required', true);
                        $("#institue_name").attr('required', true);

                        // hide the fields and disable required attr
                        $('#university_fields').fadeOut();
                        $("#institute_id").attr('required', false).val('');
                        $("#university_fields :input").attr('required', false).val('');
                        callForDisciplines($('#qualification_level').val());

                    } else {
                        $('.select2-chosen').text('');
                        $('#school_fields').fadeOut();
                        // $("#school_fields :input").attr('required', false).val('');

                        $('#school_fields').find('input:text, select').attr('required', false).val('');
                        $('#school_fields').find('input:radio').attr('required', false).prop('checked', false);
                        // show the fields and disable required attr
                        $('#university_fields').fadeIn();
                        $("#institute_id").attr('required', true);
                        $("#discipline_field").attr('required', true);
                    }
                }
                if (data.discipline.qualification_level_id == 1 || data.discipline.qualification_level_id == 2) {
                    $('#discipline_id').val('');
                    $('#discipline_field').val('');
                    setTimeout(function () {
                        $('#discipline').val(data.discipline_id);
                    }, 1000);

                } else {
                    $('#discipline_id').val(data.discipline.id);
                    $('#discipline_field').val(data.discipline.discipline);
                }
                if (data.institute.institute_type_id != 2) {
                    // alert(data.institute.institute_type_id);
                    $('#i_id').val(data.institute.id);
                    $('#institue_name').val(data.institute.name);
                    $("#city_dropdown").select2("val", data.institute.city_id); //set the value
                    $("input[name='Institutes[institute_sector]'][value=" + data.institute.institute_sector + "]").prop('checked', true);
                } else {
                    $('#institute_id').select2('val', data.institute_id);
                    $('#i_id').val('');
                    $('#institue_name').val('');
                    $("#city_dropdown").select2("data", false); //set the value
                    $("input[name='Institutes[institute_sector]'][value=" + data.institute.institute_sector + "]").prop('checked', false);
                }

                // $('#degree_awarding_id').val(data.degree_awarding_id);
                $("#degree_awarding_id").select2("val", data.degree_awarding_id); //set the value
                $('.select2-search-choice-close').remove();

            }

        }, error: function (error) {
            alert(json.stringify(error));
        }
    });
    $('#education_form').slideDown();
}
// End qualification

//reset form
function reset_qualification_form() {
    $('#education_form').trigger("reset");
    $('#education_form').find('input:text, select:not(#institutefunddetails-fund-id), textarea').val('');
    $('#education_form').find('input:radio, input:checkbox').prop('checked', false);
    $('#city_dropdown').select2('data', null);
    $('#domicile').select2('data', null);

    $('#degree_awarding_id').select2('data', null);
    $('#institute_id').select2('data', null);
    $('#qualification_id').val('');
    $('#i_id').val('');
    $('#discipline_id').val('');
}
// end reset form
function remove_row(row_id) {
    $("#class_row" + row_id).remove();
}

function change_fields(qualification_level) {
    if (qualification_level == 1 || qualification_level == 2) {

        $('#school_fields').fadeIn();
        // $("#school_fields :input").attr('required', true).val('');
        // $("#city_dropdown").attr('required', true).val('');
        // $("#degree_awarding_id").attr('required', true).val('');
        $("#city_dropdown").select2("data", null); //set the value
        $("#degree_awarding_id").select2("data", null); //set the value

        $("#institue_name").attr('required', true).val('');

        // hide the fields and disable required attr
        $('#university_fields').fadeOut();
        $("#institute_id").attr('required', false).val('');
        // $("#university_fields :input").attr('required', false).val('');
        $('#institute_id').select2('data', null).attr('required', false);
        $('#discipline').val('').attr('required', false);

    } else {
        $('.select2-chosen').text('');
        $('#school_fields').fadeOut();
        // $("#school_fields :input").attr('required', false).val('');
        $('#school_fields').find('input:text, select').attr('required', false).val('');
        $('#school_fields').find('input:radio').attr('required', false).prop('checked', false);

        // show the fields and disable required attr
        $('#university_fields').fadeIn();
        $("#institute_id").attr('required', true).val('');
        $("#discipline_field").attr('required', true).val('');
        $('#discipline').empty();
        $('#discipline').append($('<option>').text("Select Discipline").attr('value', ''));
    }
    changeClasses();
    callForDisciplines(qualification_level);
}

let classes = {
    'term' : ['1st','2nd', '3rd', '4th','Other'],

    'semester' : ['1st','2nd','3rd','4th','5th','6th','7th','8th','9th','10th','Other'],

    'annual' : [
        [], // no zero qualification level
        // For Matric
        [
            '9th',
            '10th',
            'Other'
        ],
        // For FA, FSc, DAE
        [
            '1st Year',
            '2nd Year',
            '3rd Year',
            'Other'
        ],
        // For Bs, MS, PHD
        [
            '1st Year',
            '2nd Year',
            '3rd Year',
            '4th Year',
            '5th Year',
            'Other'
        ],

    ]
};

function changeClasses(){
    let qualification_level = $('#qualification_level').val();
    let education_system = $('#education_system').val();
    if(qualification_level != '' && education_system != '')
    {
        if ((qualification_level == 1 || qualification_level == 2) && education_system === 'annual') {
            
            console.log('OK1');
            $('#current_class').empty();
            $('#recent_class').empty();
            for(let clas of classes[education_system][qualification_level]){
                $('#current_class').append($('<option>').text(clas).attr('value', clas));
                $('#recent_class').append($('<option>').text(clas).attr('value', clas));
            }

        }
        else if(education_system == 'annual'){
            console.log('OK2');
            $('#current_class').empty();
            $('#recent_class').empty();
            if(classes[education_system])
            {
                console.log(Number(qualification_level));
                qualification_level = Number(qualification_level) > 2 ? 3 : qualification_level;
                console.log(qualification_level);
                for(let clas of classes[education_system][qualification_level]){
                    $('#current_class').append($('<option>').text(clas).attr('value', clas));
                    $('#recent_class').append($('<option>').text(clas).attr('value', clas));
                }
            }

        }
        else if(classes.hasOwnProperty(education_system) && education_system != 'annual'){
            console.log('OK3');
            console.log(classes[education_system]);
            $('#current_class').empty();
            $('#recent_class').empty();
            for(let clas of classes[education_system]){
                $('#current_class').append($('<option>').text(clas).attr('value', clas));
                $('#recent_class').append($('<option>').text(clas).attr('value', clas));
            }
        }
    }
}

function remove_button(fund_expired) {
    // $.ajax({
    //     type: "GET",
    //     contentType: 'json',
    //     url: "services",
    //     data: "fund_expired=" + fund_expired,
    //     success: function (data) {
    //         data = JSON.parse(data);
    //         if (data == 1) {
    //             if ($('button[name=check_status]').siblings('button').length == 0) {
    //                 var button = '<button class="btn btn-success pull-right" style="margin-left:5px;" type="submit">Click to Apply</button>';
    //                 $(button).insertBefore('button[name=check_status]');
    //             }
    //         } else {
    //             $('button[name=check_status]').siblings('button').remove();
    //         }
    //     }, error: function (error) {
    //         console.log(error.responseJSON);
    //     }
    // });
}
$(function () {
    if ($('#fund_id').val() != '') {
        var fund_expired = $('#fund_id').val();
        remove_button(fund_expired);
    }
    $('#fund_id').change(function () {
        var fund_expired = $(this).val();
        if ($('#fund_id').val() != '') {
            remove_button(fund_expired);
        }
    });
    $('#attachments').click(function () {
        $('#attachments').next('p').remove();
    });
    $('#applicantincomes-monthly-income').change(function () {
        var str = $(this).val();
        if (!$.isNumeric(str)) {
            $(this).val('');
            $('#applicantincomes-monthly-income').parent().siblings('span').attr('style', 'color:red');
        } else {
            $('#applicantincomes-monthly-income').parent().siblings('span').removeAttr('style');
        }

    });
    $('#applicanthouseholddetails-dependent-family-members').change(function () {
        var str = $(this).val();
        if (!$.isNumeric(str)) {
            $(this).val('');
            $('#applicanthouseholddetails-dependent-family-members').parent().siblings('span').attr('style', 'color:red');
        } else {
            $('#applicanthouseholddetails-dependent-family-members').parent().siblings('span').removeAttr('style');
        }

    });
    $('#attachments').change(function () {

        var s = $("#attachments")[0].files;
//        var error = '';
        $.each(s, function (index, value) {
            var img_size = $("#attachments")[0].files[index].size;
            if (img_size > 2097152) {
                $('#attachments').after('<p style="color:red;">Image size must be less then 2mb</p>');
                $('#attachments').val('');
            }
        });


    });

    $('#addapplicant').click(function () {
        $('#education_form').show();
    });
    $('#canceladdapplicant').click(function () {
        $('#education_form').hide();
    });
    // alert($('#affiliated_with_board').checked);
    $('#add_more').click(function () {
        $('#student_table').append('<tr><td> <div class="input text"><input name="instituteclasses[class_no][]" class="form-control" required="required" id="class-no" type="text"></div> </td> <td> <div class="input text"><input name="instituteclasses[total_students][]" class="form-control" required="required" id="total-students" type="text"></div> </td> <td> <div class="input text"><input name="instituteclasses[minority_students][]" class="form-control" required="required" id="minority-students" type="text"></div> </td> <td> <div class="input text"><input name="instituteclasses[needy_students][]" class="form-control" required="required" id="needy-students" type="text"></div> </td> <td> <div class="input text"><input name="instituteclasses[textbook_cost][]" class="form-control" required="required" id="textbook-cost" type="text"></div> </td> <td> <div class="input text"><input name="instituteclasses[boys_uniform][]" class="form-control" required="required" id="boys-uniform" type="text"></div> </td> <td> <div class="input text"><input name="instituteclasses[girls_uniform][]" class="form-control" required="required" id="girls-uniform" type="text"></div> </td> <td><a href="#" class="btn btn-danger btn-xs s_number">Remove</a></td></tr>');
        $('#student_table tr:last').attr('id', 'class_row' + $('.s_number').length);
        $('.s_number').last().attr('onclick', 'remove_row(' + $(".s_number").length + ')');
        $("html, body").animate({scrollTop: $(document).height()}, 1000);
    });
    $('#add_contact_row').click(function (e) {
        e.preventDefault();
        $('<div class="form-group has-success" style="margin-bottom: 0;"><label class="col-md-3 control-label">Mobile Number<span class="required"> *</span></label><div class="col-md-5"><div class="input text"><input name="ApplicantContact[mob_number][]" class="form-control has-success" pattern="[0-9]{4} [0-9]{7}" data-mask="0399 9999999" required="required" type="text"></div><span class="help-block">03xx xxxxxxx</span></div></div>').insertBefore($(this).parent());
    });

    if ($("#affiliated_with_board").prop('checked') == true) {
        $('#div_photo_of_affiliation').show();
//        $('#photo_of_affiliation').attr('required');
    } else {
        $('#div_photo_of_affiliation').hide();
        $('#photo_of_affiliation').attr('required', false);
    }
    $('#affiliated_with_board').change(function () {
        if (this.checked) {
//            alert($(this).val());
            $('#div_photo_of_affiliation').fadeIn();
            $('#photo_of_affiliation').attr('required', true);
        } else {
            $('#div_photo_of_affiliation').fadeOut();
            $('#photo_of_affiliation').attr('required', false);
//            $('#div_passing_date').fadeOut();
//            $('#passing_date').val('').attr('required', false);
        }

    });
    $('#passing_date').focus(function () {
        $('#invalid_date').text('');
    });
    $('#passing_date').change(function () {
        if (Date.parse($(this).val())) {
        } else {
            $('#passing_date').val('').after('<p id="invalid_date" style="color:red">Invalid Date format</p>');
        }
    });
    $('#myModal').on('hidden.bs.modal', function (e) {
        $('#sub_category_id').val('');
        $('#fund_id').val('');
        $('#attachments').val('');
    });

    $('#completed').change(function () {
        if (this.checked) {
            $('#div_passing_date').fadeIn();
            $('#passing_date').attr('required', true);
        } else {
            $('#div_passing_date').fadeOut();
            $('#passing_date').val('').attr('required', false);
        }
    });
    $('#clicktoadd').on('click', function () {
        reset_qualification_form();
        $('#education_form').slideDown();
    });
    $('#canceladd').on('click', function () {
        $('#education_form').slideUp();
        window.scrollTo(0, 0);
        reset_qualification_form();
        $('#qualification_details :checkbox').attr('checked', false);

    });

    if ($('#qualification_level').val() != '') {
        var qualification_level = $('#qualification_level').val();
        change_fields(qualification_level);
    }

    $('#education_system').on('change',function(){
        changeClasses();
    });

//    get disciplines
    $('.select2-search-choice-close').remove();
    $('#qualification_level').change(function () {
        $('.select2-search-choice-close').remove();
        var qualification_level = $(this).val();
        change_fields(qualification_level);
    });
//    /get Disciplines

    $('#completed').change(function () {
        if (this.checked) {
            $('#div_passing_date').fadeIn();
            $('#passing_date').attr('required', true);
        } else {
            $('#div_passing_date').fadeOut();
            $('#passing_date').attr('required', false);
        }
    });
    $('select[name="Qualification[education_system]"]').on('change', function () {
        $('#recent_class').val('');
        $('#current_class').val('');
        $('#passing_date').val('');


        if ($(this).val() == 'semester') {
            $('#div_passing_date').show();
            $('#div_passedclass').show();
            $('#div_currentclass').show();

            $('#label_passedclass').text('Recently Passed Semester');
            $('#label_currentclass').text('Current Semester');
        } else {
            $('#div_passing_date').show();
            $('#div_passedclass').show();
            $('#div_currentclass').show();
            $('#label_passedclass').text('Recently Passed Class');
            $('#label_currentclass').text('Current Class');


        }
    });
    $('select[name="Qualification[grading_system]"]').on('change', function () {
        if (this.value == 'cgpa') {
            $("#cgpa_fields :input").attr('required', true).val('');
            $("#percentage_div :input").attr('required', true).val('');
            $("#marks_fields :input").attr('required', false).val('');

            $('#cgpa_fields').show();
            $('#marks_fields').hide();
            $('#percentage_div').show();
        } else if (this.value == 'marks') {
            $("#cgpa_fields :input").attr('required', false).val('');
            $("#percentage_div :input").attr('required', false).val('');
            $("#marks_fields :input").attr('required', true).val('');

            $('#cgpa_fields').hide();
            $('#marks_fields').show();
            $('#percentage_div').hide();
        }
    });
    $('#obtained_cgpa').focus(function () {
        $('#obtained_cgpa_error').text('');
    });

    $('#obtained_cgpa').on('blur',function () {
        let trailingZeros = ['','.00','00','0',''];
        addZeros('obtained_cgpa',trailingZeros);
    });


    $('#total_cgpa').on('input',function () {
        $('#obtained_cgpa').val('');
        $('#percentage').val('');
    });

    $('#obtained_cgpa').on('input',function () {
        var total = parseFloat($('#total_cgpa').val());

        $(`#percentage_error`).text('');
        if (total == '' || total === NaN) {
            $('#obtained_cgpa').val('0.00');
            return;
        }
        
        if (parseFloat($('#obtained_cgpa').val()) > total){
            $('#obtained_cgpa').val(total + '.00');
            $('#obtained_cgpa_error').text('Value can not be gratter then total CGPA').attr('style', 'color:red');
        }

        if(parseFloat($('#obtained_cgpa').val()) < 0) {
            $('#obtained_cgpa').val('0.00');
        }
    });

    $('#percentage').on('input',function () {
        $(`#percentage_error`).text('');
        if ($(this).val() > 100.00) {
            $('#percentage').val('100.00');
            // $('#percentage_error').text('Invalid Percentage').attr('style', 'color:red');

        }
    });

    $('#percentage').on('blur',function () {
        let trailingZeros = ['','.00','00','0',''];
        addZeros('percentage',trailingZeros,true);
    });

    $('#percentage').focus(function () {
        $('#percentage_error').text('');
    });

    $('#obtained_marks').change(function () {
        var total_mks = parseInt($('#total_marks').val());
        var obtained_mks = parseInt($('#obtained_marks').val());
        if (total_mks == '') {
            $('#obtained_marks').val('');
            $('#obtained_marks_error').text('Please enter total marks first').attr({'style': 'color:red'});
            return false;

        }
        if (obtained_mks > total_mks) {
            $('#obtained_marks').val('');
            $('#obtained_marks_error').text('Value can not be gratter then total marks').attr('style', 'color:red');
            return false;
        }
    });
    $('#obtained_marks').focus(function () {
        $('#obtained_marks_error').text('');
    });
});

function addZeros(id,trailingZeros,percentage = false){
    let value = $(`#${id}`).val();
    if($.isNumeric(value))
    {
        value = parseFloat(value).toFixed(2).toString();
    }
    if(value.length < (trailingZeros.length) && value.length > 0)
    {
        if(percentage){
            if(parseFloat(value) >= 100)
            {
               value = '100.00'; 
            }
            else{
                value += trailingZeros[value.length];
            }
        }
        else{
            console.log(trailingZeros[value.length]);
            value += trailingZeros[value.length];
            // value = parseFloat(value).toFixed(2);
        }
        console.log(value);
    }
    $(`#${id}`).val(value);
    $(`#${id}_error`).text('');
}