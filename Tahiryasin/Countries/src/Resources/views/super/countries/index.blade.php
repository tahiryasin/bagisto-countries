@extends('saas::super.layouts.content')

@section('page_title')
    {{ __('countries::app.countries.title') }}
@stop

@section('content')
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h1>{{ __('countries::app.countries.title') }}</h1>
            </div>
            <div class="page-action">
                <a href="{{ route('super.countries.create') }}" class="btn btn-lg btn-primary">
                    {{ __('countries::app.countries.add-title') }}
                </a>
            </div>
        </div>

        <div class="page-content">

            @inject('currencies','Tahiryasin\Countries\DataGrids\CountryDataGrid')
            {!! $currencies->render() !!}
        </div>
    </div>
@stop