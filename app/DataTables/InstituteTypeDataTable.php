<?php

namespace App\DataTables;

use App\Models\InstituteType;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class InstituteTypeDataTable extends DataTable
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
            ->addColumn('action', 'admin.institute-types.actions');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\InstituteType $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(InstituteType $model)
    {
        return $model->newQuery()->orderBy('type');
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('institutetypedatatable-table')
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
            Column::make('type'),
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  // ->width(60)
                  ->addClass('text-center')
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'InstituteType_' . date('YmdHis');
    }
}
