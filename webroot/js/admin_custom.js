// load disciplines
function callForDisciplines(qualification_level) {
//    alert(qualification_level);
//    return false;
    if (location.host == 'localhost') {
        var url = location.protocol + "//" + location.host + '/kp18-hajj-aukaf-minorities-affairs/applicants/services';
    } else {
        var url = location.protocol + "//" + location.host + '/applicants/services';

    }
    $.ajax({
        type: "GET",
        contentType: 'json',
        url: url,
        data: "qualification_level=" + qualification_level,
        success: function (data) {
            data = JSON.parse(data);
            if (data == '') {
                $('#discipline').empty();
                $('#discipline').append($('<option>').text("Select Discipline").attr('value', ''));
            } else {
                $('#discipline').empty();
                $('#discipline').append($('<option>').text("Select Discipline").attr('value', ''));
                $.each(data, function (index, value) {
                    // alert(index);
                    $('#discipline').append($('<option>').text(value).attr('value', index));
                });
            }
        }, error: function (error) {
            alert(json.stringify(error));
        }
    });
}
// end disiplines

//edit qualification
function uncheck_fields(id) {
//    alert($('#checkbox_' + id).val());
    $('#qualification_details :checkbox:not("#checkbox_' + id + '")').attr('checked', false);
    $.ajax({
        type: "GET",
        contentType: 'json',
        url: "services",
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
//                $("input[name='Qualifications[education_system]']").removeAttr('checked');
                $("input[name='Qualifications[education_system]'][value='" + data.education_system + "']").prop('checked', true);
//                $("input[name='Qualifications[grading_system]']").removeAttr('checked');
                $("input[name='Qualifications[grading_system]'][value='" + data.grading_system + "']").prop('checked', true);
//                alert(data.grading_system);
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
//            $("#school_fields :input").attr('required', true).val('');
                        $("#city_dropdown").attr('required', true);
                        $("#degree_awarding_id").attr('required', true);
                        $("#institue_name").attr('required', true);

//            hide the fields and disable required attr
                        $('#university_fields').fadeOut();
                        $("#institute_id").attr('required', false).val('');
                        $("#university_fields :input").attr('required', false).val('');
                        callForDisciplines($('#qualification_level').val());

                    } else {
                        $('.select2-chosen').text('');
                        $('#school_fields').fadeOut();
//                        $("#school_fields :input").attr('required', false).val('');

                        $('#school_fields').find('input:text, select').attr('required', false).val('');
                        $('#school_fields').find('input:radio').attr('required', false).prop('checked', false);
//            show the fields and disable required attr
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
//                    alert(data.institute.institute_type_id);
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

//                $('#degree_awarding_id').val(data.degree_awarding_id);
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
        $("#institue_name").attr('required', true).val('');
//            hide the fields and disable required attr
        $('#university_fields').fadeOut();
        $("#institute_id").attr('required', false).val('');
//        $("#university_fields :input").attr('required', false).val('');
        $('#discipline_field').val('').attr('required', false);
        callForDisciplines(qualification_level);

    } else {
        $('#school_fields').fadeOut();
        $('#school_fields').find('input:text, select').attr('required', false).val('');
        $('#school_fields').find('input:radio').attr('required', false).prop('checked', false);
//            show the fields and disable required attr
        $('#university_fields').fadeIn();
        $("#institute_id").attr('required', true).val('');
        $("#discipline_field").attr('required', true).val('');
        $('#discipline').empty();
        $('#discipline').append($('<option>').text("Select Discipline").attr('value', ''));
    }
}
$(function () {
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
//    alert($('#affiliated_with_board').checked);
    $('#add_more').click(function () {
        $('#student_table').append('<tr><td> <div class="input text"><input name="instituteclasses[class_no][]" class="form-control" required="required" id="class-no" type="text"></div> </td> <td> <div class="input text"><input name="instituteclasses[total_students][]" class="form-control" required="required" id="total-students" type="text"></div> </td> <td> <div class="input text"><input name="instituteclasses[minority_students][]" class="form-control" required="required" id="minority-students" type="text"></div> </td> <td> <div class="input text"><input name="instituteclasses[needy_students][]" class="form-control" required="required" id="needy-students" type="text"></div> </td> <td> <div class="input text"><input name="instituteclasses[textbook_cost][]" class="form-control" required="required" id="textbook-cost" type="text"></div> </td> <td> <div class="input text"><input name="instituteclasses[boys_uniform][]" class="form-control" required="required" id="boys-uniform" type="text"></div> </td> <td> <div class="input text"><input name="instituteclasses[girls_uniform][]" class="form-control" required="required" id="girls-uniform" type="text"></div> </td> <td><a href="#" class="btn btn-danger btn-xs s_number">Remove</a></td></tr>');
        $('#student_table tr:last').attr('id', 'class_row' + $('.s_number').length);
        $('.s_number').last().attr('onclick', 'remove_row(' + $(".s_number").length + ')');
        $("html, body").animate({scrollTop: $(document).height()}, 1000);
    });
    $('#add_contact_row').click(function () {
        $('<div class="form-group has-success" style="margin-bottom: 0;"><label class="col-md-3 control-label">Mobile Number<span class="required"> *</span></label><div class="col-md-5"><div class="input text"><input name="Applicantcontacts[mob_number][]" class="form-control has-success" data-mask="0399 9999 999" required="required" id="applicantcontacts-mob-number" type="text"></div><span class="help-block">03xx xxxx xxx</span></div></div>').insertBefore($(this).parent());
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
            $('#passing_date').val('').parent().parent().after('<p id="invalid_date" style="color:red">Invalid Date format</p>');
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

        if (qualification_level == 1 || qualification_level == 2) {
            $('#school_fields').fadeIn();
            $("#institue_name").attr('required', true);
//            hide the fields and disable required attr
            $('#university_fields').fadeOut();
            $("#institute_id").attr('required', false).val('');
//        $("#university_fields :input").attr('required', false).val('');
            $('#discipline_field').attr('required', false);
//            callForDisciplines(qualification_level);

        } else {
            $('#school_fields').fadeOut();
            $('#school_fields').find('input:text, select').attr('required', false).val('');
            $('#school_fields').find('input:radio').attr('required', false).prop('checked', false);
//            show the fields and disable required attr
            $('#university_fields').fadeIn();
            $("#institute_id").attr('required', true);
            $("#discipline_field").attr('required', true);
//            $('#discipline').empty();
//            $('#discipline').append($('<option>').text("Select Discipline").attr('value', ''));
        }
    }

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
    $('input[type=radio][name="Qualifications[education_system]"]').on('change', function () {
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
    if ($('input[type=radio][name="Qualifications[grading_system]"]').val()) {
        var grading_system = $('input[type=radio][name="Qualifications[grading_system]"]:checked').val();
        if (grading_system == 'cgpa') {
            $("#cgpa_fields :input").attr('required', true);
            $("#marks_fields :input").attr('required', false).val('');
            $("#percentage_div :input").attr('required', true);


            $('#cgpa_fields').show();
            $('#marks_fields').hide();
            $('#percentage_div').show();

        } else if (grading_system == 'marks') {
            $("#cgpa_fields :input").attr('required', false).val('');
            $("#percentage_div :input").attr('required', false);
            $("#marks_fields :input").attr('required', true);

            $('#cgpa_fields').hide();
            $('#marks_fields').show();
            $('#percentage_div').hide();
        }
    }
    $('input[type=radio][name="Qualifications[grading_system]"]').on('change', function () {
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
    $('#obtained_cgpa').change(function () {
        var total = $('#total_cgpa').val();
        if (total == '') {
            $('#obtained_cgpa').val('0.00');
            return false;
        }
//        alert(+$('#obtained_cgpa').val() > +total);
        if (+$('#obtained_cgpa').val() > +total + '.00') {
            $('#obtained_cgpa').val('0.00');
            $('#obtained_cgpa_error').text('Value can not be gratter then total CGPA').attr('style', 'color:red');
        }
    });
    $('#percentage').change(function () {
        if ($(this).val() > 100.00) {
            $('#percentage').val('0.00');
            $('#percentage_error').text('Invalid Percentage').attr('style', 'color:red');

        }
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