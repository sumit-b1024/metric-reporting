<?php

namespace App\DataTables;

use App\Models\DrivingLicense;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Services\DataTable;

class DrivingLicenseDataTable extends DataTable
{
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->setRowId('id')
            ->addColumn('employee_name', function ($row) {
                return $row->employee->first_name . ' ' . $row->employee->last_name;
            })
            ->addColumn('image', function ($row) {
                return '<img src="' . asset('storage/' . $row->image) . '" alt="License Image" width="50" height="50">';
            })
            ->addColumn('action', function ($row) {
                $editUrl = route('driving-licenses.edit', $row->id);
                $deleteUrl = route('driving-licenses.destroy', $row->id);
                return '<a href="' . $editUrl . '" class="btn btn-primary btn-sm">Edit</a>
                        <form action="' . $deleteUrl . '" method="POST" style="display:inline;">
                            ' . csrf_field() . '
                            ' . method_field('DELETE') . '
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>';
            })
            ->rawColumns(['image', 'action']);
    }

    public function query(DrivingLicense $model): QueryBuilder
    {
        return $model->newQuery()->with('employee');
    }

    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('drivinglicense-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Bfrtip')
                    ->orderBy(1)
                    ->buttons([
                        Button::make('excel'),
                        Button::make('csv'),
                        Button::make('pdf'),
                        Button::make('print')
                    ]);
    }

    public function getColumns(): array
    {
        return [
            Column::make('id'),
            Column::computed('employee_name')->title('Employee Name'),
            Column::make('driving_id'),
            Column::make('expire_date'),
            Column::make('renew_date'),
            Column::computed('image')->title('License Image')->exportable(false)->printable(false)->width(60)->addClass('text-center'),
            Column::computed('action')->exportable(false)->printable(false)->width(100)->addClass('text-center'),
        ];
    }

    protected function filename(): string
    {
        return 'DrivingLicense_' . date('YmdHis');
    }
}
