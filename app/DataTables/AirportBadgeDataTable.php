<?php

namespace App\DataTables;

use App\Models\AirportBadge;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class AirportBadgeDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->setRowId('id')
            ->addColumn('employee_name', function ($row) {
                return $row->employee->first_name . ' ' . $row->employee->last_name;
            })
            ->addColumn('front_image', function ($row) {
                return '<img src="' . asset($row->front_image) . '" alt="Front Image" width="50" height="50">';
            })
            ->addColumn('back_image', function ($row) {
                return '<img src="' . asset($row->back_image) . '" alt="Back Image" width="50" height="50">';
            })
            ->addColumn('action', function ($row) {
                $editUrl = route('airport-badge.edit', $row->id);
                $deleteUrl = route('airport-badge.destroy', $row->id);
                return '<a href="' . $editUrl . '" class="btn btn-primary btn-sm">Edit</a>
                        <form action="' . $deleteUrl . '" method="POST" style="display:inline;">
                            ' . csrf_field() . '
                            ' . method_field('DELETE') . '
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>';
            })
            ->rawColumns(['front_image', 'back_image', 'action']); // Make sure to render the image and action columns as HTML
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(AirportBadge $model): QueryBuilder
    {
        return $model->newQuery()->with('employee'); // Eager load the employee relationship
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('airportbadge-table')
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

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('id'),
            Column::computed('employee_name')
                  ->title('Employee Name'),
            Column::make('security_front_id'),
            Column::make('security_back_id'),
            Column::make('privilege'),
            Column::make('expire_date'),
            Column::make('renew_date'),
            Column::computed('front_image')
                  ->exportable(false)
                  ->printable(false)
                  ->width(60)
                  ->addClass('text-center')
                  ->title('Front Image'),
            Column::computed('back_image')
                  ->exportable(false)
                  ->printable(false)
                  ->width(60)
                  ->addClass('text-center')
                  ->title('Back Image'),
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->width(100)
                  ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'AirportBadge_' . date('YmdHis');
    }
}
