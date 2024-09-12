<?php 
namespace App\DataTables;

use App\Models\Employee;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class EmployeesDataTable extends DataTable
{
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->setRowId('id')
            // Add an action column for Edit and Delete buttons
            ->addColumn('action', function($row){
                return '<a href="'.route('employees.edit', $row->id).'" class="btn btn-sm btn-primary">Edit</a>
                        <a href="'.route('employees.destroy', $row->id).'" class="btn btn-sm btn-danger" 
                        onclick="return confirm(\'Are you sure?\')">Delete</a>';
            });
    }

    public function query(Employee $model): QueryBuilder
    {
        return $model->newQuery();
    }

    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('employees-table')
                    ->columns($this->getColumns())
                    ->orderBy(1)
                    ->selectStyleSingle()
                    ->buttons([
                        Button::make('excel'),
                        Button::make('csv'),
                        Button::make('pdf'),
                        Button::make('print'),
                        Button::make('reset'),
                        Button::make('reload'),
                    ]);
    }

    public function getColumns(): array
    {
        return [
            Column::make('id'),
            Column::make('employee_number'),
            Column::make('last_name'),
            Column::make('first_name'),
            Column::make('employee_status'),
            Column::make('date_of_birth'),
            Column::make('hire_date'),
            Column::make('phone'),
            Column::make('email'),
            Column::make('uniform_pant_size'),
            Column::make('uniform_shirt_size'),
            Column::make('comments'),
            Column::computed('action')  // Add action column
                ->exportable(false)
                ->printable(false)
                ->width(100)
                ->addClass('text-center'),
        ];
    }

    protected function filename(): string
    {
        return 'Employees_' . date('YmdHis');
    }
}
