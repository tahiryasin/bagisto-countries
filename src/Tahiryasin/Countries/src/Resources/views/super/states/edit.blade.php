@extends('saas::super.layouts.content')

@section('page_title')
    {{ __('countries::app.states.edit-title') }}
@stop

@section('content')
    <div class="content">

        <form method="POST" action="{{ route('super.states.update', $countryState->id) }}" @submit.prevent="onSubmit" enctype="multipart/form-data">
            <div class="page-header">
                <div class="page-title">
                    <h1>
                        <i class="icon angle-left-icon back-link" onclick="history.length > 1 ? history.go(-1) : window.location = '{{ url('/super/companies') }}';"></i>

                        {{ __('countries::app.states.edit-title') }}
                    </h1>
                </div>

                <div class="page-action">
                    <button type="submit" class="btn btn-lg btn-primary">
                        {{ __('countries::app.states.save-btn-title') }}
                    </button>
                </div>
            </div>

            <div class="page-content">
                <div class="form-container">
                    @csrf()

                    <accordian :title="'{{ __('countries::app.states.general') }}'" :active="true">
                        <div slot="body">

                            <div class="control-group" :class="[errors.has('country_code') ? 'has-error' : '']">
                                <label for="country_code" class="required">{{ __('countries::app.states.country_code') }}</label>
                                <input type="text" v-validate="'required'" class="control" id="country_code" name="country_code" data-vv-as="&quot;{{ __('countries::app.states.country_code') }}&quot;" value="{{ old('country_code') ?: $countryState->country_code }}" disabled="disabled"/>
                                <input type="hidden" name="country_code" value="{{ $countryState->country_code }}"/>
                                <span class="control-error" v-if="errors.has('country_code')">@{{ errors.first('country_code') }}</span>
                            </div>

                            <div class="control-group" :class="[errors.has('code') ? 'has-error' : '']">
                                <label for="code" class="required">{{ __('countries::app.states.code') }}</label>
                                <input type="text" v-validate="'required'" class="control" id="code" name="code" data-vv-as="&quot;{{ __('countries::app.states.code') }}&quot;" value="{{ old('code') ?: $countryState->code }}" disabled="disabled"/>
                                <input type="hidden" name="code" value="{{ $countryState->code }}"/>
                                <span class="control-error" v-if="errors.has('code')">@{{ errors.first('code') }}</span>
                            </div>

                            <div class="control-group" :class="[errors.has('default_name') ? 'has-error' : '']">
                                <label for="default_name" class="required">{{ __('countries::app.states.name') }}</label>
                                <input v-validate="'required'" class="control" id="default_name" name="default_name" data-vv-as="&quot;{{ __('countries::app.states.name') }}&quot;" value="{{ old('default_name') ?: $countryState->default_name }}"/>
                                <span class="control-error" v-if="errors.has('default_name')">@{{ errors.first('default_name') }}</span>
                            </div>

                            <div class="control-group">
                                <label for="status">{{ __('countries::app.states.status') }}</label>
                                <input class="control" id="status" name="status" value="{{ old('status') ?: $countryState->status }}"/>
                            </div>
                        </div>
                    </accordian>

                </div>
            </div>
        </form>
    </div>
@stop