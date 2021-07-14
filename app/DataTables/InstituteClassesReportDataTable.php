<?php

namespace App\DataTables;

use App\Helpers\Table;
use App\Models\Institute;
use App\Models\InstituteFundDetail;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class InstituteClassesReportDataTable extends DataTable
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
    public function query(InstituteClass $model)
    {

        $select = ['school_classes.class_number','institute_classes.id' ,'institute_classes.total_students,','institute_classes.minority_students','institute_classes.needy_students','institute_classes.textbook_cost','institute_classes.boys_uniform','institute_classes.girls_uniform'];

        return Table::searchQuery($model,request()->search,$select)
                        ->join('school_classes','school_classes.id','=','institute_classes.school_class_id')
                        ->join('applicants','applicants.institute_class_id','institute_classes.id')
                        ->join('institute_fund_details','institute_fund_details.applicant_id','applicants.id')
                        ->where('institute_classes.institute_id',request()->institute_id)
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
                    ->setTableId('instituteClassesreportdatatable-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Bfrtip')
                    ->buttons(
                        Button::make('export'),
                        Button::make('print'),
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
            Column::make('class_number')->title('Class'),
            Column::make('total_students'),
            Column::make('minority_students'),
            Column::make('needy_students'),
            Column::make('textbook_cost'),
            Column::make('boys_uniform'),
            Column::make('girls_uniform'),
            Column::make('remark'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'InstituteClassesReport_' . date('YmdHis');
    }
}
