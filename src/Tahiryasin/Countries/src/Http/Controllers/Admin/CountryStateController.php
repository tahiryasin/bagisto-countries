<?php

namespace Tahiryasin\Countries\Http\Controllers\Admin;

use Tahiryasin\Countries\DataGrids\CountryDataGrid;
use Tahiryasin\Countries\Http\Controllers\Controller;
use Tahiryasin\Countries\Repositories\CountryStateRepository;

class CountryStateController extends Controller
{
    /**
     * To hold the request variables from route file.
     *
     * @var array
     */
    protected $_config;

    /**
     * Create a new controller instance.
     *
     * @param  \Tahiryasin\Countries\Repositories\CountryStateRepository  $countryStateRepository
     * @return void
     */
    public function __construct(protected CountryStateRepository $countryStateRepository)
    {
        $this->_config = request('_config');
    }

    /**
     * Loads the index page showing the static pages resources.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        if (request()->ajax()) {
            return app(CountryDataGrid::class)->toJson();
        }

        return view($this->_config['view']);
    }

    /**
     * To create a new CMS page.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view($this->_config['view'], ['defaultCountry' => config('app.default_country')]);
    }

    /**
     * To store a new CMS page in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $data = request()->all();

        $this->validate(request(), [
            'default_name'   => 'required',
            'country_code'     => 'required',
            'code'     => 'required',
            'status' => 'required',
        ]);

        $page = $this->countryStateRepository->create($data);

        session()->flash('success', trans('admin::app.response.create-success', ['name' => 'State']));

        return redirect()->route($this->_config['redirect']);
    }

    /**
     * To edit a previously created CMS page.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $countryState = $this->countryStateRepository->findOrFail($id);

        $defaultCountry = config('app.default_country');

        return view($this->_config['view'], compact('countryState', 'defaultCountry'));
    }

    /**
     * To update the previously created CMS page in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        $locale = core()->getRequestedLocaleCode();

        $this->validate(request(), [
            'default_name'   => 'required',
            'code'     => 'required',
            'country_code'     => 'required',
            'status' => 'required',
        ]);

//        $this->validate(request(), [
//            $locale . '.url_key'      => ['required', new \Webkul\Core\Contracts\Validations\Slug, function ($attribute, $value, $fail) use ($id) {
//                if (! $this->countryStateRepository->isUrlKeyUnique($id, $value)) {
//                    $fail(trans('admin::app.response.already-taken', ['default_name' => 'Page']));
//                }
//            }],
//            $locale . '.page_title'   => 'required',
//            $locale . '.html_content' => 'required',
//            'channels'                => 'required',
//        ]);

        $this->countryStateRepository->update(request()->all(), $id);

        session()->flash('success', trans('admin::app.response.update-success', ['name' => 'State']));

        return redirect()->route($this->_config['redirect']);
    }

    /**
     * To delete the previously create CMS page.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $page = $this->countryStateRepository->findOrFail($id);

        if ($page->delete()) {
            return response()->json(['message' => trans('admin::app.cms.pages.delete-success')]);
        }

        return response()->json(['message' => trans('admin::app.cms.pages.delete-failure')], 500);
    }

    /**
     * To mass delete the CMS resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function massDelete()
    {
        $data = request()->all();

        if ($data['indexes']) {
            $pageIDs = explode(',', $data['indexes']);

            $count = 0;

            foreach ($pageIDs as $pageId) {
                $page = $this->countryStateRepository->find($pageId);

                if ($page) {
                    $page->delete();

                    $count++;
                }
            }

            if (count($pageIDs) == $count) {
                session()->flash('success', trans('admin::app.datagrid.mass-ops.delete-success', [
                    'resource' => 'CMS Pages',
                ]));
            } else {
                session()->flash('success', trans('admin::app.datagrid.mass-ops.partial-action', [
                    'resource' => 'CMS Pages',
                ]));
            }
        } else {
            session()->flash('warning', trans('admin::app.datagrid.mass-ops.no-resource'));
        }

        return redirect()->route('admin.cms.index');
    }
}
