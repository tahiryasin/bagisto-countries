<?php

namespace Tahiryasin\Countries\DataGrids;

use Illuminate\Support\Facades\DB;
use Webkul\Ui\DataGrid\DataGrid;

class CountryStateDataGrid extends DataGrid
{
    protected $index = 'id';

    protected $sortOrder = 'asc';

    public function prepareQueryBuilder()
    {
        $queryBuilder = DB::table('country_states')
            ->select('country_states.id', 'country_state_translations.default_name')
            ->leftJoin('country_state_translations', function($leftJoin) {
                $leftJoin->on('country_states.id', '=', 'country_state_translations.country_state_id')
                         ->where('country_state_translations.locale', app()->getLocale());
            });

        $this->addFilter('id', 'country_states.id');

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
            'index'      => 'default_name',
            'label'      => trans('countries::app.datagrid.name'),
            'type'       => 'string',
            'searchable' => true,
            'sortable'   => true,
            'filterable' => true,
            'closure' => true,
            'wrapper' => function($value) {
                return $value->default_name;
            }
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
            'route'  => 'super.states.edit',
            'icon'   => 'icon pencil-lg-icon',
        ], true);

        $this->addAction([
            'title'  => trans('admin::app.datagrid.delete'),
            'method' => 'POST',
            'route'  => 'super.states.delete',
            'icon'   => 'icon trash-icon',
        ], true);
    }

    public function prepareMassActions()
    {
        $this->addMassAction([
            'type'   => 'delete',
            'label'  => trans('admin::app.datagrid.delete'),
            'action' => route('super.states.mass-delete'),
            'method' => 'POST',
        ]);
    }
}