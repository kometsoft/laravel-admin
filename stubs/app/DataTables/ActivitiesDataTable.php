<?php

namespace App\DataTables;

use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use App\Models\Activity;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;

class ActivitiesDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     * @return \Yajra\DataTables\EloquentDataTable
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function ($model) {
                return view('components.datatable-actions', [
                    'id' => 'activities-table',
                    'route' => [
                        'show' => route('admin.activity.show', $model),
                    ]
                ])->toHtml();
            })
            ->editColumn('created_at', function ($model) {
                return $model->created_at?->format(config('laravel-admin.datetime_format'));
            })
            ->editColumn('log_name', function($model) {
                return <<<TEXT
                <span class="badge bg-primary text-capitalize">{$model->log_name}</span>
                TEXT;
            })
            ->rawColumns(['action', 'log_name'])
            ->setRowId('id');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Activity $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Activity $model): QueryBuilder
    {
        return $model->newQuery()->with('subject', 'causer');
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('activities-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->orderBy(6)
            ->buttons(
                Button::make('excel'),
                Button::make('print'),
            );
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns(): array
    {
        return [
            Column::computed('action')
                ->exportable(false)
                ->printable(false),
            Column::make('log_name')->title('Type'),
            Column::make('event')->title('Event'),
            Column::make('description')->title('Description'),
            Column::make('subject.name')->title('Subject'),
            Column::make('causer.name')->title('User'),
            Column::make('created_at')->title('Logged At'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'Activities_' . date('YmdHis');
    }
}
