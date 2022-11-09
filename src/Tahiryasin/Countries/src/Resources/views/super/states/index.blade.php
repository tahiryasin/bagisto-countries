@extends('saas::super.layouts.content')

@section('page_title')
    {{ __('countries::app.states.title') }}
@stop

@section('content')
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h1>{{ __('countries::app.states.title') }}</h1>
            </div>
            <div class="page-action">
                <a href="{{ route('super.states.create') }}" class="btn btn-lg btn-primary">
                    {{ __('countries::app.states.add-title') }}
                </a>
            </div>
        </div>

        <div class="page-content">

            @inject('states','Tahiryasin\Countries\DataGrids\CountryStateDataGrid')
            {!! $states->render() !!}
        </div>
    </div>
@stop