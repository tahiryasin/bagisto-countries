<?php

namespace Tahiryasin\Countries\Repositories;

use Webkul\Core\Repositories\CountryStateRepository as WebkulCountryStateRepository;
use Prettus\Repository\Traits\CacheableRepository;

class CountryStateRepository extends WebkulCountryStateRepository
{
    use CacheableRepository;

    /**
     * Specify Model class name
     *
     * @return mixed
     */
    function model()
    {
        return 'Webkul\Core\Contracts\CountryState';
    }
}