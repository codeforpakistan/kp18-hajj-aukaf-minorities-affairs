<?php

namespace App\DataTables;

use App\Models\SubCategory;
use App\Models\FundCategory;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class SubCategoryDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *`
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('action', 'admin.sub-categories.actions')
            ->addColumn('fund_category_name', function($row){
                return '<a href="' . route('admin.fund-categories.show', [$row->fund_category_id]) . '">' . $row->fundCategory->type_of_fund . '</a>';
            })
            ->addColumn('status_label', function($row){
                if ($row->status == 1) {
                    return '<span class="label label-success">Active</span>';
                } else {
                    return '<span class="label label-danger">Disabled</span>';
                }
            })
            ->rawColumns(['fund_category_name', 'action', 'status_label']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\SubCategoryDataTable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(SubCategory $model)
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('sub-category-table')
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
            Column::make('id')->title('Sub Category Id'),
            Column::make('fund_category_name')->title('Fund Category Name'),
            Column::make('type')->title('Fund Sub Category Name'),
            Column::make('description')->title('Description'),
            Column::make('status_label')->title('Status'),
            Column::computed('action')->title('Actions')
                ->exportable(false)
                ->printable(false)
                ->width(60)
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
        return 'SubCategory_' . date('YmdHis');
    }
}
