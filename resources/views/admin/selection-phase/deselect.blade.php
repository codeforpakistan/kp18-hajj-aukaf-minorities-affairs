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
                                Search for applicant to deselect
                            </h2>
                        </div>
                        <div class="body" id="deselect-app" v-cloak>
                            <div class="search-form">
                                @include('admin.selection-phase.search',['tokenField' => true])
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover no-footer" v-if="list.length">
                                    <thead>
                                        <tr role="row">
                                            <th>Applicant Name</th>
                                            <th>Father Name</th>
                                            <th>CNIC</th>
                                            <th>Gender</th>
                                            <th>District</th>
                                            <th>Religion</th>
                                            <th>Applied On</th>
                                            <th>Amount</th>
                                            <th>Selected</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr role="row" v-for="(detail,index) in list" :key="detail.id">
                                            <td v-text="detail.name"></td>
                                            <td v-text="detail.father_name"></td>
                                            <td v-text="detail.cnic"></td>
                                            <td v-text="detail.gender"></td>
                                            <td v-text="detail.city_name"></td>
                                            <td v-text="detail.religion_name"></td>
                                            <td v-text="detail.appling_date"></td>
                                            <td v-text="detail.amount_recived"></td>
                                            <td>
                                                <input type="checkbox" :checked="detail.selected" @click="deselect(index,detail.id)"/>
                                            </td>
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

        const getApplicantsUrl = '{{ route('admin.selection-phase.de-select.get.applicants') }}';
        const deselectUrl = '{{ route('admin.selection-phase.de-select.applicant') }}';

        let deSelectApp = Vue.createApp({
            data(){
                return {

                    list : [],
                    selectedApplicants : [],
                    allSelected : false,
                    totalApplicants : 0,

                    
                    applicantsUrl : getApplicantsUrl,
                    deselectUrl : deselectUrl,
                    form : {
                        fund : '',
                        city : '',
                        religion : '',
                        token : ''
                    }
                }
            },

            methods: {

                filter(){

                    let submitForm = true;
                    this.list = [];
                    for(let i in this.form){
                        if(( ! this.form[i].length || ! this.form[i]) && i !== 'token'){
                            submitForm = false;
                        }
                    }

                    if(submitForm){
                        axios({
                            params : this.form,
                            url : this.applicantsUrl
                        }).then((response) => {

                            this.list = response.data.list;

                        }).catch((error) => {
                            console.log(error);
                        })
                    }
                },

                deselect(index,id){
                    axios({
                        method : 'GET',
                        params : {
                            id : id
                        },
                        url : this.deselectUrl
                    }).then((response) => {
                        Swal.fire(
                            `Poof!`,
                            response.data.message,
                            "success",
                        );
                        this.list.splice(index,1);
                    }).catch((error) => {
                        try {
                            Swal.fire(
                                "Poof!",
                                error.response.data.message,
                                "error",
                            );
                        } catch(e) {
                            Swal.fire(
                                "Oh noes!!",
                                "Something went wrong",
                                "error",
                            );
                        }
                    })
                }
            }
            
        }).mount("#deselect-app");

    </script>
@endpush