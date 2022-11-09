<?php

namespace Tahiryasin\Countries\Models;

use Webkul\Core\Eloquent\TranslatableModel;
use Tahiryasin\Countries\Contracts\Country as CountryContract;

class Country extends TranslatableModel implements CountryContract{
    /**
     * Fillable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'code',
        'status',
        '_token'
    ];
}