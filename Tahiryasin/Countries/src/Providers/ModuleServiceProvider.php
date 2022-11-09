<?php

namespace Tahiryasin\Countries\Providers;

use Webkul\Core\Providers\CoreModuleServiceProvider;

class ModuleServiceProvider extends CoreModuleServiceProvider
{
    protected $models = [
        \Tahiryasin\Countries\Models\Country::class,
        \Tahiryasin\Countries\Models\CountryTranslation::class
    ];
}