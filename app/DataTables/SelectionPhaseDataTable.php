<?php

namespace App\DataTables;

use App\Helpers\Table;
use App\Models\ApplicantFundDetail;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class SelectionPhaseDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        $datatable = request()->only([
            'start',
            'length',
        ]);
        
        $totalCount = $query->count();

        $actions = ['print','csv','excel','pdf'];

        // get total data in case of export / printing the data
        if(request()->has('action') && in_array(request()->action, $actions)){
            
            $limitedData = $query->get();

        }else{
            
            $limitedData = $query->limit($datatable['length'])->offset($datatable['start'])->get();

        }

        return datatables()
            ->of($limitedData)
            ->skipPaging(function(){})
            ->setFilteredRecords($totalCount)
            ->setTotalRecords($totalCount)
            ->addColumn('dependent_family_members',function($row) {
                return $row->ApplicantHouseholdDetail->dependent_family_members;
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\SelectionPhaseDataTable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(ApplicantFundDetail $model)
    {
        $distributed_amount = ApplicantFundDetail::where('fund_id',request()->fund)->sum('amount_recived');
        return Table::searchQuery($model,request()->search)
                    ->join('applicants','applicants.id','=','applicant_fund_details.applicant_id')
                    ->join('religions','religions.id','=','applicants.religion_id')
                    ->leftJoin('applicant_addresses','applicant_addresses.applicant_id','=','applicants.id')
                    ->leftJoin('cities','cities.id','=','applicant_addresses.city_id')
                    ->join('funds','funds.id','=','applicant_fund_details.fund_id')
                    ->where([
                        ['funds.total_amount', '>', $distributed_amount],
                        ['applicant_fund_details.amount_recived', '=', null],
                        ['applicant_fund_details.selected', '=', 0],
                        ['applicant_fund_details.fund_id', '=', request()->fund],
                    ])
                    ->join('qualification_levels',function(){
                        if(request()->percentage){
                            $q->on('qualification_levels.id','qualifications.qualification_level_id')->orderByDesc('qualifications.percentage');
                        }
                    })
                    
                    ->join('qualifications',function(){

                        if(request()->percentage){
                            $q->on('qualifications.applicant_id','applicants.id');
                            $q->join('disciplines','disciplines.id','qualifications.discipline_id');
                        }

                    })

                    ->join('applicant_incomes',function(){

                        if(request()->salary){
                            $q->on('applicant_incomes.applicant_id','applicants.id')
                                ->where('applicant_incomes.monthly_income',request()->salary_operator,request()->salary)
                                ->orderBy('applicant_incomes.monthly_income');
                        }
                    
                    })

                    ->join('applicant_household_details',function(){
                        if(request()->family_members){
                            $q->on('applicant_household_details.applicant_id','applicants.id')
                                ->where('applicant_household_details.dependent_family_members',request()->member_operator,request()->family_members)
                                ->orderByDesc('applicant_household_details.dependent_family_members');
                        }
                    });
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('selectionphasedatatable-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Bfrtip')
                    ->orderBy(1)
                    ->buttons(
                        Button::make('create'),
                        Button::make('export'),
                        Button::make('print'),
                        Button::make('reset'),
                        Button::make('reload')
                    );
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::make('id'),
            Column::make('name'),
            Column::make('father_name'),
            Column::make('cnic'),
            Column::make('dependent_family_members'),
            // Column::computed('action')
            //       ->exportable(false)
            //       ->printable(false)
            //       ->width(60)
            //       ->addClass('text-center'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'SelectionPhase_' . date('YmdHis');
    }
}
