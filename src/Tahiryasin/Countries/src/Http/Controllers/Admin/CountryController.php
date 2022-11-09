<?php

namespace Tahiryasin\Countries\Http\Controllers\Admin;

use Illuminate\Support\Facades\DB;
use Tahiryasin\Countries\DataGrids\CountryDataGrid;
use Tahiryasin\Countries\Http\Controllers\Controller;
use Tahiryasin\Countries\Repositories\CountryRepository;

class CountryController extends Controller
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
     * @param  \Tahiryasin\Countries\Repositories\CountryRepository  $countryRepository
     * @return void
     */
    public function __construct(protected CountryRepository $countryRepository)
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
        return view($this->_config['view']);
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
//            'url_key'      => ['required', 'unique:cms_page_translations,url_key', new \Webkul\Core\Contracts\Validations\Slug],
            'name'   => 'required',
            'code'     => 'required',
            'status' => 'required',
        ]);
dd(request()->all());
        $page = $this->countryRepository->create(request()->all());

        session()->flash('success', trans('admin::app.response.create-success', ['name' => 'page']));

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
        $country = $this->countryRepository->findOrFail($id);

        return view($this->_config['view'], compact('country'));
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
            'name'   => 'required',
            'code'     => 'required',
            'status' => 'required',
        ]);

//        $this->validate(request(), [
//            $locale . '.url_key'      => ['required', new \Webkul\Core\Contracts\Validations\Slug, function ($attribute, $value, $fail) use ($id) {
//                if (! $this->countryRepository->isUrlKeyUnique($id, $value)) {
//                    $fail(trans('admin::app.response.already-taken', ['name' => 'Page']));
//                }
//            }],
//            $locale . '.page_title'   => 'required',
//            $locale . '.html_content' => 'required',
//            'channels'                => 'required',
//        ]);

        $this->countryRepository->update(request()->all(), $id);

        session()->flash('success', trans('admin::app.response.update-success', ['name' => 'Country']));

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
        $page = $this->countryRepository->findOrFail($id);

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
                $page = $this->countryRepository->find($pageId);

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
