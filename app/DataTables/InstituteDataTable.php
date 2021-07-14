<?php

namespace App\DataTables;

use App\Models\Institute;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class InstituteDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('action', 'admin.institutes.actions')
            ->addColumn('institute_type', function($row){
                $instituteType = $row->instituteType;
                if($instituteType)
                {
                    return '<a href="' . route('admin.institute-types.show', [$instituteType->id]) . '">' . $instituteType->type . '</a>';
                }
                return '';
            })
            ->addColumn('city', function($row){
                $city = $row->city;
                if($city)
                {
                    return '<a href="' . route('admin.districts.show', [$city->id]) . '">' . $city->name . '</a>';
                }
                return '';
            })
            ->rawColumns(['institute_type', 'action','city']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\InstituteDataTable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Institute $model)
    {
        return $model->newQuery()->orderBy('name');
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('institutedatatable-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Bfrtip')
                    ->orderBy(1)
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
            Column::make('id'),
            Column::make('institute_type'),
            Column::make('name'),
            Column::make('city'),
            Column::make('institute_sector'),
            Column::make('address'),
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->addClass('text-center'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Institutes_' . date('YmdHis');
    }
}
