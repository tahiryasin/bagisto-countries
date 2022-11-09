@extends('saas::super.layouts.content')

@section('page_title')
    {{ __('countries::app.countries.edit-title') }}
@stop

@section('content')
    <div class="content">

        <form method="POST" action="{{ route('super.countries.update', $country->id) }}" @submit.prevent="onSubmit" enctype="multipart/form-data">
            <div class="page-header">
                <div class="page-title">
                    <h1>
                        <i class="icon angle-left-icon back-link" onclick="history.length > 1 ? history.go(-1) : window.location = '{{ url('/super/companies') }}';"></i>

                        {{ __('countries::app.countries.edit-title') }}
                    </h1>
                </div>

                <div class="page-action">
                    <button type="submit" class="btn btn-lg btn-primary">
                        {{ __('countries::app.countries.save-btn-title') }}
                    </button>
                </div>
            </div>

            <div class="page-content">
                <div class="form-container">
                    @csrf()

                    <accordian :title="'{{ __('countries::app.countries.general') }}'" :active="true">
                        <div slot="body">

                            <div class="control-group" :class="[errors.has('code') ? 'has-error' : '']">
                                <label for="code" class="required">{{ __('countries::app.countries.code') }}</label>
                                <input type="text" v-validate="'required'" class="control" id="code" name="code" data-vv-as="&quot;{{ __('countries::app.countries.code') }}&quot;" value="{{ old('code') ?: $country->code }}" disabled="disabled"/>
                                <input type="hidden" name="code" value="{{ $country->code }}"/>
                                <span class="control-error" v-if="errors.has('code')">@{{ errors.first('code') }}</span>
                            </div>

                            <div class="control-group" :class="[errors.has('name') ? 'has-error' : '']">
                                <label for="name" class="required">{{ __('countries::app.countries.name') }}</label>
                                <input v-validate="'required'" class="control" id="name" name="name" data-vv-as="&quot;{{ __('countries::app.countries.name') }}&quot;" value="{{ old('name') ?: $country->name }}"/>
                                <span class="control-error" v-if="errors.has('name')">@{{ errors.first('name') }}</span>
                            </div>

                            <div class="control-group">
                                <label for="status">{{ __('countries::app.countries.status') }}</label>
                                <input class="control" id="status" name="status" value="{{ old('status') ?: $country->status }}"/>
                            </div>
                        </div>
                    </accordian>

                </div>
            </div>
        </form>
    </div>
@stop