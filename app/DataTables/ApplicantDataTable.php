<?php

namespace App\DataTables;

use App\Helpers\DataTableHelper;
use App\Helpers\Table;
use App\Models\Applicant;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ApplicantDataTable extends DataTable
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

        // get total data in case of $actions
        $actions = ['print','csv','excel','pdf'];

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
            ->addColumn('action', 'admin.applicants.actions')
            ->addColumn('family_members', function($row){
                $data = $row->applicantHouseholdDetails;
                $familyMembers = $data ? $data->sum('dependent_family_members') : 0;
                return $familyMembers;
            })
            ->addColumn('income', function($row){
                $data = $row->applicantIncomes;
                $income = $data ? $data->sum('monthly_income') : 0;
                return $income;
            })
            ->addColumn('city_name', function($row){
                return $row->applicantAddress ? $row->applicantAddress->city->name: '';
            })
            ->addColumn('religion_name', function($row){
                return $row->religion ? $row->religion->religion_name : '';
            })
            ->addColumn('applied_on', function($row){
                return $row->applicantFundDetail ? $row->applicantFundDetail->appling_date : '';
            })
            ->addColumn('amount', function($row){
                return $row->applicantFundDetail ? $row->applicantFundDetail->amount_recived : '';
            })
            ->rawColumns(['action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\ApplicantDataTable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Applicant $model)
    {
        return Table::searchQuery($model,request()->search,['applicants.name','applicants.father_name','applicants.cnic'])->with([
            'applicantHouseholdDetail',
            'applicantIncome',
            'applicantAddress.city',
            'religion',
            'applicantFundDetail'
        ])->where(function($query){
            if (request()->has('fund') && request()->input('fund') != "") {
                if ( ! (request()->has('token') && request()->token) ) {
                    $query->whereHas('applicantFundDetail', function ($query) {
                        $query->where('fund_id', request()->input('fund'));
                    });
                }
            }
            if (request()->has('city') && request()->input('city') != "") {
                if ( ! (request()->has('token') && request()->token) ) {
                    $query->whereHas('applicantAddress', function ($query) {
                        $query->where('city_id', request()->input('city'));
                    });
                }
            }
            if (request()->has('religion') && request()->input('religion') != "") {
                if ( ! (request()->has('token') && request()->token) ) {
                    $query->where('religion_id', request()->input('religion'));
                }
            }
            if (request()->has('token')  && request()->token) {
                $query->whereHas('applicantFundDetail', function ($query) {
                    $query->where('id', request()->input('token'));
                });
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
            ->setTableId('applicant-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('Bfrtip')
            ->orderBy(1)
            ->buttons(
                Button::make('export'),
                Button::make('print'),
                Button::make('reset')
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
            Column::make('id')->title('Applicant Id'),
            Column::make('name')->title('Name'),
            Column::make('father_name')->title('Father Name'),
            Column::make('cnic')->title('CNIC'),
            Column::make('family_members')->title('Family Members'),
            Column::make('income')->title('Income'),
            Column::make('city_name')->title('City'),
            Column::make('religion_name')->title('Religion'),
            Column::make('applied_on')->title('Applied on'),
            Column::make('amount')->title('Amount'),
            // Column::computed('action')->title('Actions')
            //     ->exportable(false)
            //     ->printable(false)
            //     ->width(60)
            //     ->addClass('text-center'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Applicant_' . date('YmdHis');
    }
}
