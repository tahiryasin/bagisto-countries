<?php

namespace Tahiryasin\Countries\Repositories;

use Webkul\Core\Repositories\CountryRepository as WebkulCountryRepository;
use Prettus\Repository\Traits\CacheableRepository;

class CountryRepository extends WebkulCountryRepository
{
    use CacheableRepository;

    /**
     * Specify Model class name
     *
     * @return mixed
     */
    function model()
    {
        return 'Webkul\Core\Contracts\Country';
    }
}