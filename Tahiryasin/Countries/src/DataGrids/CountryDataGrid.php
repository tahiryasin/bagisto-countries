<?php

namespace Tahiryasin\Countries\DataGrids;

use Illuminate\Support\Facades\DB;
use Webkul\Ui\DataGrid\DataGrid;

class CountryDataGrid extends DataGrid
{
    protected $index = 'id';

    protected $sortOrder = 'asc';

    public function prepareQueryBuilder()
    {
        $queryBuilder = DB::table('countries')
            ->select('countries.id', 'country_translations.name')
            ->leftJoin('country_translations', function($leftJoin) {
                $leftJoin->on('countries.id', '=', 'country_translations.country_id')
                         ->where('country_translations.locale', app()->getLocale());
            });

        $this->addFilter('id', 'countries.id');

        $this->setQueryBuilder($queryBuilder);
    }

    public function addColumns()
    {
        $this->addColumn([
            'index'      => 'id',
            'label'      => trans('countries::app.datagrid.id'),
            'type'       => 'number',
            'searchable' => false,
            'sortable'   => true,
            'filterable' => true,
        ]);

        $this->addColumn([
            'index'      => 'name',
            'label'      => trans('countries::app.datagrid.name'),
            'type'       => 'string',
            'searchable' => true,
            'sortable'   => true,
            'filterable' => true,
        ]);

//        $this->addColumn([
//            'index' => 'status',
//            'label' => trans('countries::app.datagrid.status'),
//            'type' => 'boolean',
//            'searchable' => true,
//            'sortable' => true,
//            'filterable' => true,
//            'closure' => true,
//            'wrapper' => function($value) {
//                if ($value->status == 1) {
//                    return '<span class="badge badge-md badge-success">Active</span>';
//                } else {
//                    return '<span class="badge badge-md badge-danger">Inactive</span>';
//                }
//            }
//        ]);

    }

    public function prepareActions()
    {
        $this->addAction([
            'title'  => trans('admin::app.datagrid.edit'),
            'method' => 'GET',
            'route'  => 'super.countries.edit',
            'icon'   => 'icon pencil-lg-icon',
        ], true);

        $this->addAction([
            'title'  => trans('admin::app.datagrid.delete'),
            'method' => 'POST',
            'route'  => 'super.countries.delete',
            'icon'   => 'icon trash-icon',
        ], true);
    }

    public function prepareMassActions()
    {
        $this->addMassAction([
            'type'   => 'delete',
            'label'  => trans('admin::app.datagrid.delete'),
            'action' => route('super.countries.mass-delete'),
            'method' => 'POST',
        ]);
    }
}