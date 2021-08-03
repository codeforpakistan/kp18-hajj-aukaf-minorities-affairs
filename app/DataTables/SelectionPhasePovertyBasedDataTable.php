<?php

namespace App\DataTables;

use App\Helpers\Table;
use App\Models\ApplicantFundDetail;
use App\Models\Fund;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class SelectionPhasePovertyBasedDataTable extends DataTable
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
        if(request()->limit && $totalCount){
            $totalCount = request()->limit <= $totalCount ? request()->limit : $totalCount;
            if(request()->limit < 10){
                $datatable['length'] = request()->limit;
            }
        }

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
            ->setTotalRecords($totalCount)
            ->addColumn('dependent_family_members',function($row){
                return $row->dependent_family_members ?? 0;
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\ApplicantFundDetail $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(ApplicantFundDetail $model)
    {
        $distributed_amount = ApplicantFundDetail::where('fund_id',request()->fund)->sum('amount_recived');

        $select = [];
        $sql = $model
                ->join('applicants','applicants.id','=','applicant_fund_details.applicant_id')
                ->join('religions','religions.id','=','applicants.religion_id')
                ->leftJoin('applicant_addresses','applicant_addresses.applicant_id','=','applicants.id')
                ->leftJoin('cities','cities.id','=','applicant_addresses.city_id')
                ->join('funds','funds.id','=','applicant_fund_details.fund_id')
                ->where([
                    ['funds.total_amount', '>', $distributed_amount],
                    ['applicant_fund_details.amount_recived', '=', null],
                    ['applicant_fund_details.selected', '=', 0],
                    ['applicant_fund_details.fund_id', '=', intval(request()->fund)],
                ]);

        if(request()->percentage){
            $sql->join('qualifications','qualifications.applicant_id','=','applicants.id');
            $sql->join('disciplines','disciplines.id','=','qualifications.discipline_id');
            $sql->where('qualifications.percentage','>',intval(request()->percentage));
            $select[] = 'qualifications.percentage';
        }

        if(request()->salary){
            $sql->join('applicant_incomes','applicant_incomes.applicant_id','=','applicants.id');
            $sql->orderBy('applicant_incomes.monthly_income');
            $sql->where('applicant_incomes.monthly_income',request()->salary_operator,intval(request()->salary));
        }

        if(request()->family_members){
            $sql->join('applicant_household_details','applicant_household_details.applicant_id','=','applicants.id');
            $sql->where('applicant_household_details.dependent_family_members',request()->member_operator,intval(request()->family_members));
            $sql->orderByDesc('applicant_household_details.dependent_family_members');
            $select[] = 'applicant_household_details.dependent_family_members';
        }

        if(request()->religion){
            $sql->where('applicants.religion_id',intval(request()->religion));
        }

        if(request()->city_id){
            $sql->where('applicant_addresses.city_id',intval(request()->city_id));
        }

        $sql->orderBy('applicants.name');
        $sql->select(array_merge(['applicant_fund_details.id as id','applicants.name as name','applicants.father_name','applicants.cnic'],$select));

        dd($sql->dump());
        return $sql;
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
                        Button::make('pageLength'),
                        Button::make('export'),
                        // Button::make('reload')
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
