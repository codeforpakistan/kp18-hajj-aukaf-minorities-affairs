<?php

namespace App\DataTables;

use App\Models\FundCategory;
use App\Models\SubCategory;
use App\Models\Fund;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class FundDataTable extends DataTable
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
            ->addColumn('action', 'admin.funds.actions')
            ->addColumn('fund_category_name', function($row){
                return '<a href="' . route('admin.fund-categories.show', [$row->fund_category_id]) . '">' . $row->fundCategory->type_of_fund . '</a>';
            })
            ->addColumn('fund_sub_category_name', function($row){
                return '<a href="' . route('admin.sub-categories.show', [$row->sub_category_id]) . '">' . $row->subCategory->type . '</a>';
            })
            ->addColumn('status_label', function($row){
                if ($row->active == 1) {
                    return '<span class="label label-success">Active</span>';
                } else {
                    return '<span class="label label-danger">Disabled</span>';
                }
            })
            ->addColumn('institute_students_p', function($row){
                return ($row->institute_students != '' && ! is_null( $row->institute_students )) ? $row->institute_students : '0' . '%';
            })
            ->rawColumns(['fund_category_name', 'fund_sub_category_name', 'status_label', 'action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\FundDataTable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Fund $model)
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
            ->setTableId('fund-table')
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
            Column::make('id')->title('Fund Id'),
            Column::make('fund_category_name')->title('Fund Category'),
            Column::make('fund_sub_category_name')->title('Fund Sub Category'),
            Column::make('fund_name')->title('Name'),
            Column::make('total_amount')->title('Total Amount'),
            Column::make('amount_remaining')->title('Remaining Amount'),
            Column::make('receiving_date')->title('Receiving Date'),
            Column::make('last_date')->title('Last Date'),
            Column::make('fund_for_year')->title('Fund for Year'),
            Column::make('institute_students_p')->title('Students / Institute'),
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
        return 'Fund_' . date('YmdHis');
    }
}
