@extends('layouts.guest')

@section('content')
    <style>
        .control-label{ text-align: left; }
        #content{ margin-left: unset; }
        li.active{ background-color: #eee6; }
        .nav-justified > li{ border: 1px solid #eee; }
        .control-label{ /*text-align: unset !important;*/ }
        .form-actions{ background-color: #eee6; }
        .custom_head{ color: green; border-bottom: 1px solid #ccc; padding-bottom: 10px; margin-bottom: 15px; }
        .skiptranslate{ float:right; }
    </style>

    <div id="content">
        <div class="container">
            <div class="row" style="margin-top: 60px;">
                @if(session('error'))
                    <div class="col-md-12">
                        <div class="alert alert-danger">
                            <strong>Woops!</strong> {{ session('error') }}
                        </div>
                    </div>
                @endif
                @if(session('success'))
                    <div class="col-md-12">
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    </div>
                @endif
                @if ($errors->any())
                    <div class="col-md-12">
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif
                <div class="col-md-1"></div>
                @if (isset($no_available_grants))
                    <h3  style="color:#117D2C;font-size: 20px;color: red;"><?= $no_available_grants; ?></h3>
                @else
                    <div class="col-md-10">
                        <div class="widget box" id="form_wizard">
                            <div class="widget-header"style="background-color:#117D2C;">
                                <h4 style="color:white">Please Fill the form carefully</h4>
                            </div>
                            <div class="widget-content">
                                <div class="lang"  id="google_translate_element" style="margin-bottom: 15px;padding: 0 5px;min-height: 15px;">
                                    @if ( \Auth::check() && \Auth::user()->hasRole( ['Admin', 'Operator'] ) )
                                        <a onclick="window.history.go(-1);return false;" style ="font-size: 14px;color: green;text-decoration: underline; cursor: pointer;">Go back</a>
                                    @endif
                                </div>
                                <script type="text/javascript">
                                    function googleTranslateElementInit() {
                                        new google.translate.TranslateElement({pageLanguage: 'en', layout: google.translate.TranslateElement.InlineLayout.SIMPLE}, 'google_translate_element');
                                    }
                                </script>
                                <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
                                {!! Form::open(['route' => 'guest.home.submit-application', 'method' => 'POST', 'id' => 'sample_form', 'files' => true, 'class' => 'form-horizontal']) !!}
                                    @if ( request()->has('cnic') )
                                        {!! Form::hidden('Applicant[cnic]', request()->input('cnic')) !!}
                                        {!! Form::hidden('ApplicantFundDetail[fund_id]', request()->input('fund_id')) !!}
                                        <style>
                                            .bg-image{ background-color: #eee; }
                                            #content{ background: #eee; }
                                        </style>
                                        <div class="form-wizard">
                                            <div class="form-body">
                                                <!--=== Steps ===-->
                                                @include('applicants.tabs.navigation')
                                                <div class="tab-content" style="margin-top:60px">
                                                    <!--=== Available On All Tabs ===-->
                                                    <div class="alert alert-danger hide-default">
                                                        <button class="close" data-dismiss="alert"></button>
                                                        Please Fill up the highlighted Fields.
                                                    </div>
                                                    <!-- /Available On All Tabs -->
                                                    @include('applicants.tabs.profile-setup')
                                                    @include('applicants.tabs.billing-setup')
                                                    @if ($selectedFund->sub_category_id == 3)
                                                        @include('applicants.tabs.qualification-setup')
                                                    @endif
                                                    @include('applicants.tabs.confirmation-tab')
                                                </div>
                                                <!-- /Tab Content -->
                                            </div>
                                            <!--=== Form Actions ===-->
                                            <div class="form-actions fluid">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="col-md-offset-3 col-md-9"  style="text-align:right">
                                                            <a href="#" class="btn button-previous">
                                                                <i class="icon-angle-left"></i> Back
                                                            </a>
                                                            <a href="#" id="continue" class="btn btn-primary button-next">
                                                                Continue <i class="icon-angle-right"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- /Form Actions -->
                                        </div>
                                    @endif
                                {!! Form::close() !!}
                            </div>
                        </div>
                        <!-- /Form Wizard -->
                    </div>
                @endif
                <!-- /Page Content -->
            </div> <!-- /.row -->
            <!-- /Page Content -->
        </div>
        <!-- /.container -->
    </div>
@endsection
@section('scripts')
    <script type="text/javascript">
        let subCategoryId = {{ $selectedFund->sub_category_id ?? null}};
        $(".button-previous, .button-next").on('click',function(){
            // alert("OK");
        });
    </script>
@endsection
