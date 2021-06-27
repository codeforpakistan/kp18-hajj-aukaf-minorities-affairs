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
                                Distribute Grants
                            </h2>
                        </div>
                        <div class="body" id="grants-app" v-cloak>
                            <div class="search-form">
                                @include('admin.selection-phase.search',['cnicOrName' => true])
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
                                            <th>District</th>
                                            <th>Religion</th>
                                            <th>Applied On</th>
                                            <th>Amount</th>
                                            <th>Distributed</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr role="row" v-for="(detail,index) in list" :key="index">
                                            <td v-text="detail.name"></td>
                                            <td v-text="detail.father_name"></td>
                                            <td v-text="detail.cnic"></td>
                                            <td v-text="detail.gender"></td>
                                            <td v-text="detail.dependent_family_members"></td>
                                            <td v-text="detail.monthly_income"></td>
                                            <td v-text="detail.city_name"></td>
                                            <td v-text="detail.religion_name"></td>
                                            <td v-text="detail.appling_date"></td>
                                            <td v-text="detail.amount_recived"></td>
                                            <td class="text-center" :data-text="detail.distributed">
                                                <input type="checkbox" v-model="detail.distributed" @click="distribute($event,index,detail.id)"/>
                                            </td>
                                            <td :id="'status-'+index" class="text-success" v-text="detail.distributed ? 'Distributed' : ''"></td>
                                        </tr>
                                    </tbody>
                                </table>
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

        const getApplicantsUrl = "{{ route('admin.selection-phase.distribution.applicants') }}";
        const distributionUrl = "{{ route('admin.selection-phase.distribution.submit') }}";

        let distributionApp = Vue.createApp({
            data(){
                return {
                    list : [],

                    getApplicantsUrl : getApplicantsUrl,
                    distributionUrl : distributionUrl,

                    selectedApplicants : [],

                    form : {
                        fund : '',
                        city : '',
                        religion : '',
                        cnicOrName : ''
                    }
                }
            },

            methods : {

                distribute(event,index,id){
                    axios({
                        method : 'POST',
                        url : this.distributionUrl,
                        data : {
                            id : id,
                            distributed : event.target.checked
                        }
                    }).then((response) => {
                        let status = document.getElementById('status-'+index);
                        if(event.target.checked)
                        {
                            status.innerHTML = 'Distributed';
                        }
                        else
                        {
                            status.innerHTML = '';
                        }
                    }).catch((error) => {
                        console.log(error);
                    })
                },

                filter(){
                    axios({
                        url : this.getApplicantsUrl,
                        params : this.form
                    }).then((response => {
                        this.list = [];
                        this.list = response.data.list;
                    })).catch((error) => {
                        try {
                            Swal.fire(
                                "Poof!",
                                error.response.data.error,
                                "error",
                            );
                        } catch(e) {
                            Swal.fire(
                                "Poof!",
                                "Something went wrong",
                                "error",
                            );
                        }
                    })
                }
            }

        }).mount("#grants-app");

    </script>
@endpush