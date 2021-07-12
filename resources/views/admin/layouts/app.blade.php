<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Auqaf, Hajj, Religious & Minority Affairs</title>
        <link rel="icon" href="{{ asset('img/index.png') }}" type="image/x-icon">

        <!-- Google Fonts -->
        <link href="{{ asset('css/font.css') }}" rel="stylesheet" type="text/css" >
        <link href="{{ asset('css/icon.css') }}" rel="stylesheet" type="text/css">
        <!-- Bootstrap Core Css -->
        <link href="{{ asset('plugins/bootstrap/css/bootstrap.css') }}" rel="stylesheet">

        <!-- Waves Effect Css -->
        <link href="{{ asset('plugins/node-waves/waves.css') }}" rel="stylesheet" />

        <!-- Animation Css -->
        <link href="{{ asset('plugins/animate-css/animate.css') }}" rel="stylesheet" />

        <!-- Sweet Alert Css -->
        <link href="{{ asset('css/sweetalert2.min.css') }}" rel="stylesheet" />

        <!-- Custom Css -->
        <link href="{{ asset('css/style.css') }}" rel="stylesheet">
       
        <!-- Bootstrap Select Css -->
       <!-- <link href="{{ asset('plugins/bootstrap-select/css/bootstrap-select.css') }}" rel="stylesheet" />-->

       @stack('css')

        <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
        <link href="{{ asset('css/themes/all-themes.css') }}" rel="stylesheet"  />
        <style>
            .slimScrollBar{ width:10px !important; }
            tr > th { padding-right: 0 !important; }
            .header_text{ font-size: 25px; color:white; }
            .haj_div{ padding: 15px 20px; }
            .haj_div > a:hover{ color: white !important; text-decoration: none;}
            .haj_div > a:active{ color: white !important; text-decoration: none; }
            .haj_div > a:visited{ color: white !important; text-decoration: none; }
            .c_b{ background-color: #607D8B; border: none; color: white; font-size: 12px; padding: 7px; margin-right: 5px; border-radius: 2px; }
            @media screen and (max-width: 768px) {
                .header_text{ font-size: 22px; }
                .navbar-header{ margin-bottom: unset !important; }
                .haj_div{ text-align: center; }
                .analysis{ margin-top: 125px !important; }
            }

            /* On screens that are 600px wide or less, the background color is olive */
            @media screen and (max-width: 500px) {
                .header_text{ font-size: 15px; }
                .navbar-header{ margin-bottom: unset !important; }
                .haj_div{ padding: 0; }
                .t_app{ border-bottom: 1px solid #ddd; border-right: unset !important; }
                .analysis{ margin-top: 125px !important; }
            }
        </style>
        <script>
            var baseUrl = "{{ route('guest.home.index') }}";
        </script>
    </head>
    @php
        $loguser = \Auth::user();
    @endphp
    <body class="theme-light-green">
        <!-- Overlay For Sidebars -->
        <div class="overlay"></div>
        <!-- #END# Overlay For Sidebars -->
        <!-- Search Bar -->
        <div class="search-bar">
            <div class="search-icon">
                <i class="material-icons">search</i>
            </div>
            <input type="text" placeholder="START TYPING...">
            <div class="close-search">
                <i class="material-icons">close</i>
            </div>
        </div>
        <!-- #END# Search Bar -->
        @include('admin.components.top-bar')

        <section>
            @include('admin.components.left-sidebar')
        </section>
        <div class="col-lg-9" style=" float: right;">
            {{-- <?= $this->Flash->render() ?> --}}
        </div>
        @yield('content')


        <!-- Jquery Core Js -->
        <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('js/vue.min.js') }}"></script>
        <script>
            
            $(window).on('load',function(){
                $(".buttons-reset").hide();
                $(".buttons-reset").on('click',function(){
                    $(".buttons-reset").hide();
                })
                $(".dataTables_filter input").on('input',function(e){
                    if(this.value.length){
                        $(".buttons-reset").show();
                    }
                    else{
                        $(".buttons-reset").hide();
                    }
                })
            });

            $(function () {
                $("#checkall").click(function () {
                    $('input:checkbox').not(this).prop('checked', this.checked);
                });
                $('#selected_form').submit(function () {
                    var amount_to_dis = 0;
                    var checked = $("[id^='selected']:checked");
                    checked.each(function () {
                        amount_to_dis += +$(this).parent().siblings('td').children('input').val();
                    });
                    if (amount_to_dis > $('#amount_remaining').text()) {
                        alert("You Does not have sufficient balance in the Fund");
                        return false;
                    }
                    var all_checkboxes = $("input[id^='selected']").length;
                    if (all_checkboxes != 0) {
                        var checked = $("[id^='selected']:checked").length;
                        if (checked == 0) {
                            alert("Please select any applicant to submit the form");
                            return false;
                        }
                    }
                    return confirm('Are you sure you want to submit the form');
                });

            });
            function deselect(id) {
                // alert(id);return false;
                if ($('#deselect' + id).prop('checked')) {
                    var cheque_no = 1;
                } else {
                    var cheque_no = 0;
                }
                console.log(cheque_no);
                $.ajax({
                    type: "GET",
                    contentType: 'json',
                    url: "{{ route('admin.dashboard.services') }}",
                    data: "id=" + id + '&deselect=' + cheque_no,
                    success: function (data) {
                        if (data != 0) {
                            $('#deselect' + id).parent().parent().hide();
                            $('<div class="alert alert-success"><strong>Success!</strong> The Appliant hasbeen deselected</div>').insertBefore($('.table')).fadeIn(1500).fadeOut(2500);
                        }
                    }, error: function (error) {
                        // alert(json.stringify(error));
                    }
                });

            }
            function update_cheque_no(id) {
                if ($('#cheque_no' + id).prop('checked')) {
                    var cheque_no = 1;
                } else {
                    var cheque_no = 0;
                }
                $.ajax({
                    type: "GET",
                    contentType: 'json',
                    url: "{{ route('admin.dashboard.services') }}",
                    data: "id=" + id + '&cheque_no=' + cheque_no,
                    success: function (data) {
                        if (data != 0) {
                           // $('#cheque_no' + id).parent().next('td').text(data);
                            if (cheque_no == 1) {
                                $('#cheque_no' + id).parent().next('td').text('distributed');
                            } else {
                                $('#cheque_no' + id).parent().next('td').text('');
                            }
                            $('<p style="color:green;">saved.</p>').insertAfter($('#cheque_no' + id).siblings('label')).fadeIn(1500).fadeOut(1500);
                        }
                    }, error: function (error) {
                        // alert(json.stringify(error));
                    }
                });

            }
            function count_all() {
                // $('.hidden_selected');
                if ($("#checkall").prop('checked') == true) {
                    var total_amount = $('#amounttotal').text();
                    var checked_selected = $('input[id^=selected]').length;
                    var sum_amount = 0;
                    $('input[id^=amount_recived]').each(function () {
                        sum_amount += +$(this).val();
                    });
                    $('#distribute_amount').text(sum_amount);
                    // alert(sum_amount);
                    $('#total_applicants').text(checked_selected);
                    $('#perhead_amount').text('Amount Per Person: ' + $('#total_amount').val() / checked_selected);
                    $('input[type="hidden"].hidden_selected').each(function () {
                        $(this).val(($(this).attr('valueifselected')));
                    });
                } else {
                    var total_amount = 0;
                    $('#distribute_amount').text(total_amount);
                    $('#total_applicants').text('0');
                    $('#perhead_amount').text('0');
                    $('#perhead_amount').text('Amount Per Person: 0');
                    $('input[type="hidden"].hidden_selected').each(function () {
                        $(this).val(0);
                    });
                }
            }
            function count_checked(id) {
                // $("#selected" + id).val($("#selected" + id).prop('checked') ? id : 0);
                $("#selected" + id).siblings('input').val($("#selected" + id).prop('checked') ? id : 0);
                // alert($("#selected" + id).val());
                if ($("#selected" + id).prop('checked') == true) {
                    var total_amount = +$('#amount_recived' + id).val() + +$('#distribute_amount').text();
                    $('#distribute_amount').text(total_amount);
                } else {
                    var total_amount = $('#distribute_amount').text() - $('#amount_recived' + id).val();
                    $('#distribute_amount').text(total_amount);
                }

                var checked_selected = $('input[id^=selected]:checked').length;
                if (checked_selected == 0) {
                    $('#total_applicants').text(checked_selected);
                    $('#perhead_amount').text('Amount Per Person: 0');

                } else {
                    $('#total_applicants').text(checked_selected);
                    $('#perhead_amount').text('Amount Per Person: ' + $('#total_amount').val() / checked_selected);
                }
            }
            function swap_fields(fund_id) {

                $.ajax({
                    type: "GET",
                    contentType: 'json',
                    url: "{{ route('admin.dashboard.services') }}",
                    data: "fund_subcategory=" + fund_id,
                    success: function (data) {
                        if (data == 3) {
                            $('#filter_div').find('input:text, select').val('');
                            $('#limit_div').attr('style', 'padding-left: 0;');

                            $('#merit_div').show();
                            $('#filter_div').hide();
                        } else {
                            $('#merit_div').find('input:text, select').val('');
                            $('#limit_div').attr('style', 'padding: 0px 20px 0px 10px !important;');
                            $('#filter_div').show();
                            $('#merit_div').hide();
                        }
                    }, error: function (error) {
                        // alert(json.stringify(error));
                    }
                });
            }
            
            $(function () {
                $('#amount_recived').focus(function () {
                    $('#amountinaccount').removeAttr('style');
                });
                $('#amount_recived').change(function () {

                    if (+$(this).val() > +$('#amount_recived').attr('max')) {
                        $('#amount_recived').val('');
                        $('#amountinaccount').attr('style', 'color:red');
                        $('<p style="color:red;">Not enough amount in the account.</p>').insertAfter($('#amount_recived')).fadeIn(2500).fadeOut(2500);
                        return false;
                    }
                    $('#perhead_amount').text('Total: ' + $('#amount_recived').val() * $('#total_applicants').text());
                });

                $('#amount_for_all').change(function () {
                    var checked_selected = $('input[id^=amount_recived]');
                    checked_selected.each(function () {
                        $(this).val($('#amount_for_all').val());
                    })
                });


                $('#DataTables_Table_0_wrapper').attr('style', 'overflow:auto');
                if ($('#fund_id').val() != '') {
                    swap_fields($('#fund_id').val());
                }
                if ($('#total_applicants').text() != 0) {
                    $('#perhead_amount').text('Total: ' + $('#amount_recived').val() / $('#total_applicants').text());
                } else {
                    $('#perhead_amount').text('Total: 0');

                }
                $('#fund_id').change(function () {
                    var fund_id = $(this).val();
                    swap_fields(fund_id);

                });
            });
        </script>
        <!-- Bootstrap Core Js -->
        <script src="{{ asset('plugins/bootstrap/js/bootstrap.js') }}"></script>

        <!-- Select Plugin Js -->
        <!--<script src="{{ asset('plugins/bootstrap-select/js/bootstrap-select.min.js') }}"></script>-->

        <!-- Slimscroll Plugin Js -->
        {{-- <script src="{{ asset('plugins/jquery-slimscroll/jquery.slimscroll.js') }}"></script> --}}

        <!-- Jquery Validation Plugin Css -->
        <script src="{{ asset('plugins/jquery-validation/jquery.validate.js') }}"></script>

        <!-- JQuery Steps Plugin Js -->
        <script src="{{ asset('plugins/jquery-steps/jquery.steps.js') }}"></script>

        <!-- Sweet Alert Plugin Js -->
        <script src="{{ asset('js/sweetalert2.min.js') }}"></script>

        <!-- Waves Effect Plugin Js -->
        <script src="{{ asset('plugins/node-waves/waves.js') }}"></script>

        <!-- Custom Js -->
        <script src="{{ asset('js/admin.js') }}"></script>
        <script src="{{ asset('js/pages/forms/form-validation.js') }}"></script>

        <!-- Demo Js -->
        <script src="{{ asset('js/demo.js') }}"></script>
        <!--<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>-->
        <script src="{{ asset('js/jquery-ui.js') }}"></script>
        <script src="{{ asset('js/helpers.js') }}"></script>
        <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js"></script>
        <script>
            $("#form-validate").validate();
            $(function () {
                $(".datepicker").datepicker({dateFormat: 'yy-mm-dd'});
            });
        </script>
        @if (request()->input('action') == 'reporting') {
            <script>
                $(function () {
                    $('<button type="button" class="c_b" data-toggle="modal" data-target="#myModal">Change PDF Header</button>').insertAfter($('#DataTables_Table_0_wrapper > .dt-buttons > .buttons-pdf'));
                });
            </script>
        @endif
        <script>
            $(window).load(function(){
                @if(session()->has('error'))
                    Swal.fire(
                        "Oh noes!!",
                        "{{session()->get('error')}}",
                        "error"
                    );
                @endif
                @if(session()->has('success'))
                    Swal.fire(
                        "Poof!",
                        "{{session()->get('success')}}",
                        "success"
                    );
                @endif
                @if(session()->has('create-success'))
                    Swal.fire(
                        "Poof!",
                        "The record has been created!",
                        "success"
                    );
                @endif
                @if(session()->has('create-failed'))
                    Swal.fire(
                        "Oh noes!!",
                        "Could not create the record!",
                        "error"
                    );
                @endif
                @if(session()->has('edit-success'))
                    Swal.fire(
                        "Poof!",
                        "The record has been updated!",
                        "success"
                    );
                @endif
                @if(session()->has('edit-failed'))
                    Swal.fire(
                        "Oh noes!!",
                        "Could not update the record!",
                        "error"
                    );
                @endif
                @if(session()->has('delete-success'))
                    Swal.fire(
                        "Poof!",
                        "The record has been deleted!",
                        "success"
                    );
                @endif
                @if(session()->has('delete-failed'))
                    Swal.fire(
                        "Oh noes!!",
                        "Could not delete the record!",
                        "error"
                    );
                @endif
            });

            function deleteAlert(id) {
                Swal.fire({
                  title: 'Are you sure?',
                  text: "Once deleted, you will not be able to recover this record!",
                  icon: 'warning',
                  showCancelButton: true,
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                  if (result.isConfirmed) {
                    document.getElementById('delete-row-'+id).submit();
                  }
                  else{
                    Swal.fire('You canceled deleting the record!')
                  }
                });
            }
            
        </script>
        <script src="{{ asset('js/axios.min.js') }}"></script>
        @stack('scripts')
    </body>
</html>