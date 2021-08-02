<?php

namespace App\DataTables;

use App\Models\Discipline;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class DisciplineDataTable extends DataTable
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
            ->addColumn('qualification_level', function($row){
                $qualificationLevel = $row->qualificationLevel;
                if($qualificationLevel)
                {
                    return '<a href="' . route('admin.qualification-levels.show', [$row->qualification_level_id]) . '">' . $qualificationLevel->name . '</a>';
                }
                return '';
            })
            ->addColumn('action', 'admin.disciplines.actions')
            ->rawColumns(['action','qualification_level']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\DisciplineDataTable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Discipline $model)
    {
        return $model->newQuery()->orderBy('discipline');
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('disciplinedatatable-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Bfrtip')
                    ->orderBy(1)
                    ->buttons(
                        Button::make('pageLength'),
                        Button::make('export'),
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
            Column::make('qualification_level'),
            Column::make('discipline'),
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
        return 'Discipline_' . date('YmdHis');
    }
}
