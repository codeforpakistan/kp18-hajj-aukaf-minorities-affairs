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
        <!--=== Inline Tabs ===-->
        <div class="row" style="margin-top: 60px;">
            @if(session('error'))
                <div class="col-md-12">
                    <div class="alert alert-danger">
                        <strong>Woops!</strong> {{ session('error') }}
                    </div>
                </div>
            @endif
            <!--=== Form Wizard ===-->
            <div class="col-md-1"></div>
            @if (isset($no_available_grants))
                <!--=== Confirmation ===-->
                <!--<div class="tab-pane" id="tab4">-->
                <h3  style="color:#117D2C;font-size: 20px;color: red;"><?= $no_available_grants; ?></h3>
                <!--</div>-->
                <!-- /Confirmation -->
            @else
                <div class="col-md-10">
                    <div class="widget box" id="form_wizard">
                        <div class="widget-header"style="background-color:#117D2C;">
                            <h4 style="color:white">Please Fill the form carefully</h4>
                        </div>
                        <div class="widget-content">
                            <div class="lang"  id="google_translate_element" style="margin-bottom: 15px;padding: 0 5px;min-height: 15px;">
                                @if ( \Auth::check() && ( \Auth::user()->hasRole('Admin') || \Auth::user()->hasRole('Operator') ) )
                                    <a onclick="window.history.go(-1);return false;" style ="font-size: 14px;color: green;text-decoration: underline; cursor: pointer;">Go back</a>
                                @endif
                            </div>
                            <script type="text/javascript">
                                function googleTranslateElementInit() {
                                    new google.translate.TranslateElement({pageLanguage: 'en', layout: google.translate.TranslateElement.InlineLayout.SIMPLE}, 'google_translate_element');
                                }
                            </script>
                            <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

                            <!--<form class="form-horizontal" id="sample_form" action="#">-->
                            {!! Form::open(['route' => 'guest.home.submit', 'method' => 'POST', 'id' => 'sample_form', 'files' => true, 'class' => 'form-horizontal']) !!}
                                <style>
                                    .bg-image{
                                        background-image:url('{{ asset('img/bg1.jpg') }}');   
                                        background-position: bottom;
                                        background-size: cover;
                                        background-repeat:no-repeat;
                                    }
                                    #content{ background: unset; }
                                </style>
                                <div class="" id="initial" style="margin-top: 25px !important;">
                                    <div class="form-group">
                                        <label class="control-label col-md-offset-3 col-md-2">CNIC<span class="required">*</span></label>
                                        <div class="col-md-4">
                                            {!! Form::text('cnic', old('cnic'), ['id' => 'cnic', 'label' => false, 'class' => 'form-control', 'pattern' => "[0-9]{5}-[0-9]{7}-[0-9]{1}", 'data-mask' => '99999-9999999-9', 'required']) !!}
                                            <span id="cnic_error" class="help-block">CNIC format (xxxxx-xxxxxxx-x)</span>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-offset-3 col-md-2">Available Grants <span class="required">*</span></label>
                                        <div class="col-md-4">
                                            {!! Form::select('fund_id', $funds, null, [
                                                'class' => 'form-control',
                                                'id' => 'fund_id',
                                                'label' => false,
                                                'placeholder' => 'Select Grant',
                                                'required',
                                            ]) !!}
                                            <span id="grant_error" class="help-block">Please select Grant.</span>
                                            <br/>
                                            {{-- @if( ! $last_date->isEmpty() && ( \Auth::check() && \Auth::user()->hasRole(['Admin', 'Operator', 'School']) ) ) --}}
                                                {!! Form::submit('Click to Apply', ['class' => 'btn btn-success pull-right', 'style' => 'margin-left:5px;']); !!}
                                            {{-- @endif --}}
                                            {!! Form::submit('Check Your Status', ['name' => 'check_status', 'class' => 'btn btn-info pull-right', 'style' => 'margin-left:5px;']); !!}
                                        </div>
                                        <div class="col-lg-12">
                                            <br/><br/>
                                            <ol style="color: red;padding: 0px 15px;font-size: 14px;list-style: unset;">
                                                @if(isset($last_date))
                                                    @foreach ($last_date as $l_d)
                                                        <li>Last date of {!! ucfirst($l_d->fund_name) . ' is &nbsp;<b>' . date('d-F-Y', strtotime($l_d->last_date)) . '</b>' !!}</li>
                                                    @endforeach
                                                @endif
                                            </ol>
                                        </div>
                                    </div>
                                </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            @endif
            <div class="col-md-1"></div>
        </div> <!-- /.row -->
    </div>
</div>

@endsection