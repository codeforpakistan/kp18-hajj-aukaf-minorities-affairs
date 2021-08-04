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
                                Balloting system
                            </h2>
                        </div>
                        <div class="body" id="balloting-app" v-cloak>
                            <div class="search-form">
                                @include('admin.selection-phase.search',['limitField' => true,'tokenField' => true,'cnicOrName' => true])
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover no-footer" v-if="list.length">
                                    <thead>
                                        <tr role="row">
                                            <th>Applicant Name</th>
                                            <th>Father Name</th>
                                            <th>CNIC</th>
                                            <th>Gender</th>
                                            <th>Family Memebers</th>
                                            <th>Income</th>
                                            <th>City</th>
                                            <th>Religion</th>
                                            <th>Applied On</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr role="row" v-for="(detail,index) in list">
                                            <td v-text="detail.name"></td>
                                            <td v-text="detail.father_name"></td>
                                            <td v-text="detail.cnic"></td>
                                            <td v-text="detail.gender"></td>
                                            <td v-text="detail.dependent_family_members"></td>
                                            <td v-text="detail.monthly_income"></td>
                                            <td v-text="detail.city_name"></td>
                                            <td v-text="detail.religion_name"></td>
                                            <td v-text="detail.appling_date"></td>
                                            <td>
                                                <input type="checkbox" v-model="selectedApplicants" :value="detail.id"/>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="9"></td>
                                            <td>
                                                <input type="checkbox" :checked="allSelected" @change="selectAll"/> Check All
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div v-if="list.length">
                                <div class="row">
                                    <div class="col-12">
                                        <p style="padding: 0px 10px; color:red;"> Note! The selected applicants can not be appear here.</p>
                                        <div class="col-lg-6" style="background-color: #eee9;padding: 15px 15px !important;">
                                            <label class="form-label">Fund to distribute</label>
                                            <input type="number" :min="0" class="form-control" v-model="fundToDistribute" :max="remainingAmount" @input="fundAmountChange">
                                            <p style="color: green;margin: 10px 0;">Number of applicants: <span v-text="selectedApplicants.length"></span></p>
                                            <p style="color: green;" v-text="'Amoun Per Person: ' + amountPerHead"></p>
                                        </div> 
                                        <div class="col-lg-6">
                                            <label class="form-label">Fund Summary</label>
                                            <p>Number of selected Applicants: <span style="font-weight: bold;" v-text="totalSelectedApplicants"></span></p>  
                                            <p>Total Fund Amount: <span style="font-weight: bold;" v-text="selectedFund.total_amount"></span></p>
                                            <p>Amount Distributed: <span style="font-weight: bold;" v-text="distributedAmount"></span></p>  
                                            <p id="amountinaccount">Amount Remaining: <span style="font-weight: bold;" v-text="remainingAmount"></span></p>  
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
    <script>

        const getApplicantsUrl = "{{ route('admin.selection-phase.balloting.applicants') }}";
        const distributionUrl = "{{ route('admin.selection-phase.balloting.submit') }}";

        let ballotingApp = Vue.createApp({
            components : {
                'select2' : select2Component
            },
            data(){
                return {
                    fundToDistribute : 0,
                    remainingAmount : 0,
                    selectedFund : {},
                    distributedAmount : 0,
                    amountPerHead : 0,
                    totalApplicants : 0,
                    totalSelectedApplicants : 0,
                    
                    list : [],

                    selectedApplicants : [],

                    allSelected : false,

                    applicantsUrl : getApplicantsUrl,
                    distributionUrl : distributionUrl,

                    form : {
                        fund : '',
                        city : '',
                        religion : '',
                        limit : ''
                    }
                }
            },

            watch : {
                fundToDistribute(newVal, oldVal){
                    if(this.selectedApplicants.length){
                        this.amountPerHead = newVal / this.selectedApplicants.length;
                    }
                    else
                    {
                        this.amountPerHead = 0;
                    }
                },

                selectedApplicants(newVal, oldVal){
                    if(newVal.length !== this.list.length){
                        this.allSelected = false;
                    }
                    else if(newVal.length && this.list.length){
                        this.allSelected = true;
                    }

                    if(newVal.length){
                        this.amountPerHead = this.fundToDistribute / newVal.length;
                    }
                    else{
                        this.amountPerHead = 0;
                    }
                }
            },

            methods: {

                fundCityReligionChange(){
                    let selectFund = document.getElementById('fund');
                    let selectCity = document.getElementById('city');
                    let selectReligion = document.getElementById('religion');
                    

                    if(selectFund.selectedIndex > 0){
                        this.fund = selectFund.options[selectFund.selectedIndex].value;
                        this.form.fund = this.fund;
                    }
                    else
                    {
                        this.form.fund = '';
                    }

                    if(selectCity.selectedIndex > 0){
                        this.form.city_id = selectCity.options[selectCity.selectedIndex].value;
                    }
                    else{
                        this.form.city_id = '';
                    }

                    if(selectReligion.selectedIndex > 0){
                        this.form.religion = selectReligion.options[selectReligion.selectedIndex].value;
                    }
                    else{
                        this.form.religion = '';
                    }
                    
                },

                fundAmountChange(){
                    this.fundToDistribute = event.target.value = Number(event.target.value);
                    if(Number(event.target.value) > this.remainingAmount){
                        this.fundToDistribute = this.remainingAmount;
                    }

                    else if(typeof this.fundToDistribute === 'string' && this.fundToDistribute.length === 0){
                        this.fundToDistribute = 0;
                    }
                },

                submit(){
                    axios({
                        method : 'POST',
                        url : this.distributionUrl,
                        data : {
                            ids : this.selectedApplicants,
                            amount_per_head : this.amountPerHead
                        }
                    })
                    .then((response) => {

                        Swal.fire(
                            "Poof!",
                            response.data.message,
                            "success",
                        );

                        setTimeout(() => {
                            window.location.reload();
                        }, 2000);
                    }).catch((error) => {
                        try {
                            Swal.fire(
                                "Poof!",
                                error.response.data.message,
                                "error",
                            );
                        } catch(e) {
                            Swal.fire(
                                "Poof!",
                                "Something went wrong",
                                "error",
                            );
                        }
                    });
                },


                fundCheckBox(index){
                    if(this.list.length !== this.selectedApplicants){
                        this.allSelected = false;
                    }
                    else
                    {
                        this.allSelected = true;
                    }
                },

                selectAll(){
                    if(event.target.checked){
                        this.selectedApplicants = this.list.map((fund) => {return fund.id});
                    }
                    else{
                        this.selectedApplicants = [];
                    }

                    this.allSelected = event.target.checked;
                },

                filter(){

                    this.list = [];
                    let submitForm = true;
                    for(let i in this.form){
                        if( ! this.form['fund'].length || ! this.form['fund']){
                            submitForm = false;
                        }
                    }

                    if(submitForm){
                        this.selectedApplicants = [];
                        this.allSelected = false;
                        axios({
                            method : 'GET',
                            params : this.form,
                            url : this.applicantsUrl
                        }).then((response) => {

                            this.list = response.data.list;
                            this.totalApplicants = this.list.length;
                            this.selectedFund = response.data.fund;
                            this.totalSelectedApplicants = response.data.selectedApplicants;
                            this.distributedAmount = response.data.distributedAmount;
                            this.fundToDistribute = this.selectedFund.total_amount - this.distributedAmount;
                            this.remainingAmount = this.fundToDistribute;

                        }).catch((error) => {
                            console.log(error);
                        })
                    }
                }
            }
            
        }).mount("#balloting-app");

    </script>
@endpush