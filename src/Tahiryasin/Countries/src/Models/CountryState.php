<?php

namespace Tahiryasin\Countries\Models;

use Webkul\Core\Eloquent\TranslatableModel;
use Tahiryasin\Countries\Contracts\CountryState as StateContract;

class CountryState extends TranslatableModel implements StateContract{
    /**
     * Fillable.
     *
     * @var array
     */
    protected $fillable = [
        'default_name',
        'country_code',
        'code',
        'country_id'
    ];
}