<?php

namespace App\DataTables;

use App\Helpers\Table;
use App\Models\ApplicantFundDetail;
use App\Models\City;
use App\Models\Fund;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class GeneralReportDataTable extends DataTable
{
    public $options = [
        'created_by',
        'updated_by',
        'income',
        'family_members',
        'current_address',
        'permanent_address',
        'postal_address',
        'amount_recieved',
        'cheque_no',
        'applying_date',
        'payment_date',
        // 'signature',
        // 'remarks'
    ];

    public $nonOrderable = [
        'updated_by',
        'created_by'
    ];

    public $orderBy = [
        'applicant_fund_details.id',
        'applicants.name',
        'applicants.father_name',
        'applicants.cnic',
        'cities.name',
        'religions.religion_name',
    ];
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
        
        $this->setOrderingColumns();

        $index = request()->order[0]['column'];
        $dir = request()->order[0]['dir'];
        $orderBy = [$this->orderBy[$index], $dir];
        $totalCount = $query->count();

        // get total data in case of $actions
        $actions = ['print','csv','excel','pdf'];

        if(request()->has('action') && in_array(request()->action, $actions)){
            $limitedData = $query->orderBy($orderBy[0],$orderBy[1])->get();
        }
        else{
            $limitedData = $query->orderBy($orderBy[0],$orderBy[1])->limit($datatable['length'])->offset($datatable['start'])->get();
        }

        return datatables()
            ->of($limitedData)
            ->skipPaging(function(){})
            ->setTotalRecords($totalCount)
            ->addColumn('token_no',function($row){
                return $row->id;
            })
            ->addColumn('created_by',function($row){
                return $row->username;
            })
            ->addColumn('updated_by',function($row){
                return $row->username;
            });
    }

    public function addColumns()
    {
        $columns = [];
        foreach($this->options as $option)
        {
            if(request()->get($option) === 'on')
            {
                $column = Column::make($option);
                if(in_array($option,$this->nonOrderable))
                {
                    $column->orderable(false);
                }
                $columns[] = $column;
            }
        }
        return $columns;
    }

    public function setOrderingColumns()
    {
        foreach($this->options as $option)
        {
            if(request()->get($option) === 'on')
            {
                $this->orderBy[] = $option;
            }
        }
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\GeneralReportDataTable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(ApplicantFundDetail $model)
    {
        $select = [
            'funds.sub_category_id','applicant_fund_details.id','applicant_fund_details.created_by','applicant_fund_details.updated_by','applicant_fund_details.amount_recived as amount_recieved','applicant_fund_details.check_number as cheque_no','applicant_fund_details.payment_date','applicant_fund_details.appling_date as applying_date','applicants.name','applicants.father_name','applicants.cnic','applicants.gender','applicants.disease','applicants.dname','applicants.dcontact','applicants.clinic_address','applicants.gname','applicants.gfather_name','applicants.gcnic','applicants.gcontact','applicant_addresses.permenent_address as permanent_address','applicant_addresses.current_address','applicant_addresses.postal_address','applicant_household_details.dependent_family_members as family_members','applicant_incomes.monthly_income as income','cities.name as city_name','religions.religion_name',
                'users.name as username',
        ];

        $searchableFields = [
            'applicants.name',
            'applicants.father_name',
            'applicants.cnic',
            'cities.name',
            'religions.religion_name',
            'applicant_addresses.current_address',
            'applicant_addresses.permenent_address',
            'applicant_addresses.postal_address',
        ];

        $sql = Table::searchQuery(new ApplicantFundDetail,request()->search,$searchableFields)
                    ->join('applicants','applicants.id','=','applicant_fund_details.applicant_id')
                    ->join('funds','applicant_fund_details.fund_id','=','funds.id')
                    ->join('applicant_household_details','applicant_household_details.applicant_id','=','applicants.id')
                    ->join('religions', 'religions.id','=','applicants.religion_id')
                    ->leftJoin('applicant_incomes','applicant_incomes.applicant_id','=','applicants.id')
                    ->leftJoin('applicant_addresses','applicant_addresses.applicant_id','=','applicants.id')
                    ->leftJoin('users',function($join){
                        $join->on('users.id','=','applicant_fund_details.created_by')
                             ->on('users.id','=','applicant_fund_details.updated_by');
                    })
                    ->leftJoin('cities','cities.id','=','applicant_addresses.city_id');
                    // ->groupBy('applicant_fund_details.id');
        if (request()->fund) {
            $fund = Fund::find(request()->fund);
            $sql->where('applicant_fund_details.fund_id',request()->fund);
            if($fund && $fund->sub_category_id == 3)
            {
                $select = ['qualifications.percentage','qualifications.passing_date','qualifications.recent_class','qualifications.current_class','disciplines.discipline','qualification_levels.name as qualification_name'];
                $sql->join('qualifications','qualifications.applicant_id','=','applicants.id')
                    ->join('qualification_levels','qualification_levels.id','=','qualifications.qualification_level_id')
                    ->join('disciplines','disciplines.id','=','qualifications.discipline_id');
            }
            else if(request()->token)
            {
                $qualificationQuery = $model
                    ->join('applicants','applicants.id','=','applicant_fund_details.applicant_id')
                    ->join('qualifications','applicants.id','=','qualifications.applicant_id')
                    ->where('applicant_fund_details.id',request()->token);
                if(
                    !$qualificationQuery->count()
                )
                {
                    $select = ['qualifications.percentage','qualifications.passing_date','qualifications.recent_class','qualifications.current_class','disciplines.discipline','qualification_levels.name as qualification_name'];
                    $sql->join('qualifications','qualifications.applicant_id','=','applicants.id')
                        ->join('qualification_levels','qualification_levels.id','=','qualifications.qualification_level_id')
                        ->join('disciplines','disciplines.id','=','qualifications.discipline_id');
                }
                // $sql->where('applicant_fund_details.id',request()->token);
            }
        }

        if (request()->religion) {
            $sql->where('applicants.religion_id',request()->religion);
        }
        if (request()->city) {
            $sql->where('applicant_addresses.city_id',request()->city);
        }
        if (request()->cnic) {
            $cnic = request()->cnic;
            $sql->where('applicants.cnic','LIKE', "%$cnic%")
            ->orWhere('applicants.name','LIKE', "%$cnic%");
        }
        if (request()->gender && request()->gender != 'both') {
            $sql->where('applicants.gender',request()->gender);
        }
        if (request()->from_date && request()->to_date) {
            $sql->whereBetween('applicant_fund_details.appling_date',[date(request()->from_date),date(request()->to_date)]);
        }

        if ($status = request()->applicant_status) {
            if ($status == 'selected') {
                $sql->where('applicant_fund_details.selected',1)
                ->whereNotNull('applicant_fund_details.amount_recived')
                ->where('applicant_fund_details.distributed',0);
            }
            if ($status == 'notselected') {
                $sql->where('applicant_fund_details.selected',0)
                ->whereNull('applicant_fund_details.amount_recived')
                ->where('applicant_fund_details.distributed',0);
            }
            if ($status == 'distributed') {
                $sql->where('applicant_fund_details.distributed',1);
            }
        }

        if (request()->user) {
            $sql->where('applicant_fund_details.created_by',request()->user)
            ->orWhere('applicant_fund_details.updated_by',request()->user);
        }

        // $sql->orderBy('applicant_fund_details.id');
        
        if(count($select))
        {
            $sql->select($select);
        }
        
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
                    ->setTableId('generalreportdatatable-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Bfrtip')
                    ->buttons(
                        Button::make('pageLength'),
                        Button::make('export'),
                        // Button::make('print'),
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
        return array_merge([
            Column::make('token_no'),
            Column::make('name'),
            Column::make('father_name'),
            Column::make('cnic'),
            Column::make('city_name'),
            Column::make('religion_name')
        ],$this->addColumns());
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'GeneralReport_' . date('YmdHis');
    }
}
