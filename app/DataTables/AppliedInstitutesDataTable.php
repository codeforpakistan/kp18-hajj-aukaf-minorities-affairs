<?php

namespace App\DataTables;

use App\Helpers\Table;
use App\Models\Institute;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class AppliedInstitutesDataTable extends DataTable
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

        if(request()->has('action') && request()->action === 'print'){
            
            $limitedData = $query->get();

        }else{
            
            $limitedData = $query->limit($datatable['length'])->offset($datatable['start'])->get();

        }
        
        return datatables()
            ->of($limitedData)
            ->skipPaging(function(){})
            ->setFilteredRecords($totalCount)
            ->setTotalRecords($totalCount)
            ->addColumn('registration_number', function($row){
                return $row->reg_num;
            })->addColumn('affilition', function($row){
                return $row->affiliated_with_board;
            })->addColumn('city', function($row){
                return '';
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Institute $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Institute $model)
    {
        return Table::searchQuery($model,request()->search)
                        ->join('users','users.id','=','institutes.user_id')
                        ->join('cities','cities.id','=','institutes.city_id')
                        ->join('institute_classes','institutes.id','=','institute_classes.institute_id')
                        ->join('applicants','applicants.institute_class_id','=','institute_classes.id')
                        ->join('institute_fund_details','institute_fund_details.applicant_id','=','applicants.id')
                        ->where('institute_fund_details.fund_id',request()->fund_id);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('appliedinstitutesdatatable-table')
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
            Column::make('registration_number'),
            Column::make('affilition'),
            Column::make('contact_number'),
            Column::make('address'),
            Column::make('city')
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'AppliedInstitutes_' . date('YmdHis');
    }
}
