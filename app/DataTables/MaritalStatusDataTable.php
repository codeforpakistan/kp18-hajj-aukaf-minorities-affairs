<?php

namespace App\DataTables;

use App\Models\MaritalStatus;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class MaritalStatusDataTable extends DataTable
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
        $limitedData = $query->limit($datatable['length'])->offset($datatable['start'])->get();
        return datatables()
            ->of($limitedData)
            ->skipPaging(function(){})
            ->setFilteredRecords($totalCount)
            ->setTotalRecords($totalCount)
            ->addColumn('action', 'admin.marital-statuses.actions');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\MaritalStatusDataTable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(MaritalStatus $model)
    {
        return $model->newQuery()->orderBy('status');
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('maritalstatusdatatable-table')
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
            Column::make('status'),
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  // ->width(60)
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
        return 'MaritalStatus_' . date('YmdHis');
    }
}
