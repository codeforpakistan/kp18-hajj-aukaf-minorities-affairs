@extends('admin.layouts.app')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <!-- Exportable Table -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Poverty based selection
                            </h2>
                        </div>
                        <div class="body">
                            <div class="search-form">
                                @include('admin.selection-phase.poverty-based-search')
                            </div>
                            @if($fund && $totalCount)
                                <div class="table-responsive">{!! $dataTable->table() !!}</div>
                                <div id="selection-app" v-cloak>
                                    <div class="row">
                                        <div class="col-12">
                                            <p style="padding: 0px 10px; color:red;"> Note! The selected applicants can not be appear here.</p>
                                            <div class="col-lg-6" style="background-color: #eee9;padding: 15px 15px !important;">
                                                <label class="form-label">Amount per person</label>
                                                <?php
                                                    $remaining_amount = $fund->total_amount - $distributedAmount;
                                                ?>
                                                <input type="number" name="perhead_amount" id='perhead_amount' min="0" class="form-control" :max="maxAmountPerPerson" @input="amountChange">
                                                <!--<label class="form-label">Fund to distribute</label>-->
                                                <?php
        //                                        echo $this->Form->number('fund_amount', ['id' => 'total_amount', 'class' => 'form-control', 'value' => $remaining_amount, 'max' => $remaining_amount]);
                                                ?>
                                                <p style="color: green;margin: 10px 0;">Number of applicants: <span v-text="totalApplicants"></span></p>
                                                <p style="color: green;" v-text="'Total: ' + totalDistributableAmount"></p>
                                            </div> 
                                            <div class="col-lg-6">
                                                <label class="form-label">Fund Summary</label>
                                                <p>Total Amount For Fund: <span style="font-weight: bold;">{{$fund->total_amount}}</span></p>
                                                <p>All selected Applicants: <span style="font-weight: bold;">{{$selectedApplicants}}</span></p>  
                                                <p>Amount Distributed: <span style="font-weight: bold;">{{ $distributedAmount }}</span></p>  
                                                <p id="amountinaccount">Amount Remaining: <span style="font-weight: bold;">{{ $remaining_amount }}</span></p>  
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12" style="padding-left: 25px;">
                                            <button class="btn btn-primary waves-effect" @click="submit" :disabled="!amountPerHead">SUBMIT</button>
                                        </div>
                                        <br/>
                                    </div>
                                </div>
                        @endif
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Exportable Table -->
        </div>
    </section>
@endsection
@push('css')
    {{-- Datatables bootstrap --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.bootstrap.min.css">
@endpush
@push('scripts')
    <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.23/js/dataTables.bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.bootstrap.min.js"></script>
     
    <script src="{{ asset('vendor/datatables/buttons.server-side.js') }}"></script>
    @if($fund && $totalCount)
        {!! $dataTable->scripts() !!}
    @endif
    <script>

        const totalAmount = {{$fund->total_amount ?? 0}};
        const distributedAmount = {{$distributedAmount}};

        const remainingAmount = totalAmount - distributedAmount;
        
        const submitDistributionurl = '{{ route('admin.selection-phase.poverty.submit') }}';
        const filterUrl = '{{ route('admin.selection-phase.poverty-based') }}';

        const totalCount = {{$totalCount}};
        const ids = @json($ids);

        let form = @json(request()->query());

        let filterApp = Vue.createApp({
            data(){
                return {
                    url : filterUrl,

                    grantOrSholarship : 0,

                    fund : '',

                    form : {
                        fund : this.fund,
                        city_id : '',
                        religion : '',
                        member_operator : '',
                        family_members : '',
                        salary_operator : '',
                        salary : '',
                        limit : '',
                        percentage : '',
                    }

                }
            },

            methods: {

                fundChange(){
                    let selectFund = document.getElementById('selectFund');
                    if(selectFund.selectedIndex >= 0){
                        this.grantOrSholarship = Number(selectFund.options[selectFund.selectedIndex].dataset.gs);
                        this.fund = Number(selectFund.options[selectFund.selectedIndex].value);
                        this.form.fund = this.fund;
                        // console.log(this.form);
                    }
                    console.log(this.fund,this.form);
                    if(this.grantOrSholarship){
                        this.form.member_operator = '';
                        this.form.family_members = '';
                        this.form.salary_operator = '';
                        this.form.salary = '';
                    }
                    else
                    {
                        this.form.percentage = '';
                    }
                },

                filter() {
                    const query = this.encodeQueryData(this.form);
                    // console.log(query);
                    window.location = this.url + '?' + query;
                },

                encodeQueryData(data) {
                   const ret = [];
                   for (let d in data)
                    {
                        if(data[d].length || data[d])
                            ret.push(encodeURIComponent(d) + '=' + encodeURIComponent(data[d]));
                    }
                   return ret.join('&');
                }
            },

            mounted(){
                if(Object.keys(form).length){
                    Object.assign(this.form, form);
                    this.fund = this.form.fund;
                }
            },

            updated(){
                let selectFund = document.getElementById('selectFund');
                if(selectFund.selectedIndex >= 0){
                    this.grantOrSholarship = Number(selectFund.options[selectFund.selectedIndex].dataset.gs);
                    this.fund = Number(selectFund.options[selectFund.selectedIndex].value);
                    this.form.fund = this.fund;
                }
            }

        }).mount("#filter-app");

        @if($fund)
            let app = Vue.createApp({
                data(){

                    return {

                        remainingAmount : remainingAmount,
                        totalAmount : totalAmount,
                        distributedAmount : distributedAmount,
                        totalApplicants : totalCount,

                        amountPerHead : 0,
                        totalDistributableAmount : 0,
                        
                        ids : ids,

                        refreshUrl : filterUrl,
                        url : submitDistributionurl
                    }

                },

                computed:{
                    maxAmountPerPerson(){
                        return Math.floor(this.remainingAmount / this.totalApplicants);
                    }
                },

                methods : {

                    amountChange(){
                        this.amountPerHead = Number(event.target.value);
                        if(this.amountPerHead > this.maxAmountPerPerson){
                            this.amountPerHead = event.target.value = this.maxAmountPerPerson;
                        }
                        this.totalDistributableAmount = this.totalApplicants * this.amountPerHead;
                    },

                    submit(){

                        axios({
                            method : "POST",
                            url : this.url,
                            data : {
                                ids : this.ids, //
                                amount_per_head : this.amountPerHead,
                            },
                        })
                        .then((response) => {
                            Swal.fire(
                                "Poof!",
                                response.data.message,
                                "success"
                            );
                            // setTimeout(() => {
                            //     window.location = this.refreshUrl;
                            // }, 2000);
                        })
                        .catch((error) => {
                            try {
                                Swal.fire(
                                    "Poof!",
                                    error.response.data.message,
                                    "error"
                                );
                            } catch(e) {

                                Swal.fire(
                                    "Poof!",
                                    somethingWentWrongText(),
                                    "error"
                                );
                            }
                        });
                    }
                }
            }).mount('#selection-app');
        @endif
    </script>
@endpush