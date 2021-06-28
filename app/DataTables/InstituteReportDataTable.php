<?php

namespace App\DataTables;

use App\Models\Institute;
use App\Models\InstituteFundDetail;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class InstituteReportDataTable extends DataTable
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
            'order',
        ]);
        
        // $index = request()->order[0]['column'];
        // $dir = request()->order[0]['dir'];
        // $orderBy = [$this->orderBy[$index], $dir];
        $totalCount = $query->count();

        // get total data in case of $actions
        $actions = ['print','csv','excel','pdf'];

        if(request()->has('action') && in_array(request()->action, $actions)){
            $limitedData = $query->get(); //->orderBy($orderBy[0],$orderBy[1])
        }
        else{
            $limitedData = $query->limit($datatable['length'])->offset($datatable['start'])->get();
        }

        return datatables()
            ->of($limitedData)
            ->skipPaging(function(){})
            ->setTotalRecords($totalCount);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\InstituteType $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Institute $model)
    {

        // $students_count = 
        // InstituteFundDetail::join('applicants','institute_fund_details.applicant_id','=','applicants.id')
        //                     ->join('institute_classes','applicants.institute_class_id','=','institute_classes.id')
        //                     ->where('institute_classes.institute_id',1)->where('institute_fund_details.fund_id',request()->fund);

        $select = [
            'institutes.id','institutes.name as institute','institutes.reg_num as registration_number','institutes.contact_number','institutes.address','users.email','cities.name as city'
        ];
        return $model
            ->join('users','institutes.user_id','=','users.id')
            ->join('cities','institutes.city_id','=','cities.id')
            ->join('institute_classes','institutes.id','=','institute_classes.institute_id')
            ->join('applicants','institute_classes.id','=','applicants.institute_class_id')
            ->join('institute_fund_details','applicants.id','=','institute_fund_details.applicant_id')
            ->where('institute_fund_details.fund_id',request()->fund)
            ->select($select);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('institutereportdatatable-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Bfrtip')
                    ->buttons(
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
            Column::make('institute'),
            Column::make('registration_number'),
            Column::make('contact_number'),
            Column::make('address'),
            Column::make('city'),
            Column::make('email'),
            // Column::make('applied_students'),
            // Column::make('remark'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'InstituteReport_' . date('YmdHis');
    }
}
