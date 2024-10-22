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
            ->addColumn('full_name', function($row) {
                return $row->first_name . ' ' . $row->last_name;
            })
            // Add an action column for Edit and Delete buttons
            ->addColumn('action', function($row){
                $editUrl = route('employees.edit', $row->id);
                $deleteUrl = route('employees.destroy', $row->id);

                return '<a href="'.$editUrl.'" class="btn btn-sm btn-primary">Edit</a>
                        <form action="'.$deleteUrl.'" method="POST" style="display:inline;" onsubmit="return confirm(\'Are you sure you want to delete this Employee?\')">
                            '.csrf_field().'
                            '.method_field('DELETE').'
                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                        </form>';
            })
            ->rawColumns(['action']); // Prevent escaping of the HTML in the action column
    }

    public function query(Employee $model): QueryBuilder
    {
        return $model->newQuery()->select('*');
    }

    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('employees-table')
                    ->columns($this->getColumns())
                    ->orderBy(1)
                    ->selectStyleSingle()
                    ->dom('Bfrtip') // Add 'Bfrtip' to enable buttons
                    ->buttons([
                        Button::make('excel')
                            ->text('Export Excel')
                            ->action("window.location.href='" . route('employees.export.excel') . "';"),
                        
                        Button::make('csv')
                            ->text('Export CSV')
                            ->action("window.location.href='" . route('employees.export.csv') . "';"),
                        
                        Button::make('pdf'),
                        Button::make('print'),
                    ]);
    }

    public function getColumns(): array
    {
        return [
            Column::make('id'),
            Column::make('employee_number'),
            Column::make('full_name')->title('Full Name'),
            Column::make('employee_status')->title('Status'),
            Column::make('date_of_birth')->title('DOB'),
            Column::make('hire_date'),
            Column::make('phone'),
            Column::make('email'),
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
