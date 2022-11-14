@extends('saas::super.layouts.content')

@section('page_title')
    {{ __('countries::app.states.add-title') }}
@stop

@section('content')
    <div class="content">

        <form method="POST" action="{{ route('super.states.store') }}" @submit.prevent="onSubmit" enctype="multipart/form-data">
            <div class="page-header">
                <div class="page-title">
                    <h1>
                        <i class="icon angle-left-icon back-link" onclick="history.length > 1 ? history.go(-1) : window.location = '{{ url('/super/companies') }}';"></i>

                        {{ __('countries::app.states.add-title') }}
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

                                <select
                                    class="control"
                                    id="country_code"
                                    type="text"
                                    name="country_code"
                                    v-model="country_code"
                                    v-validate="'{{ core()->isCountryRequired() ? 'required' : '' }}'"
                                    data-vv-as="&quot;{{ __('countries::app.states.country_code') }}&quot;">
                                    <option value=""></option>

                                    @foreach (core()->countries() as $country)
                                        <option {{ $country->code === $defaultCountry ? 'selected' : '' }}  value="{{ $country->code }}">{{ $country->name }}</option>
                                    @endforeach
                                </select>


                                <span class="control-error" v-if="errors.has('country_code')">@{{ errors.first('country_code') }}</span>
                            </div>

                            <div class="control-group" :class="[errors.has('code') ? 'has-error' : '']">
                                <label for="code" class="required">{{ __('countries::app.states.code') }}</label>
                                <input v-validate="'required|min:2|max:2'" class="control" id="code" name="code" value="{{ old('code') }}" data-vv-as="&quot;{{ __('countries::app.states.code') }}&quot;" style="text-transform:uppercase" v-code/>
                                <span class="control-error" v-if="errors.has('code')">@{{ errors.first('code') }}</span>
                            </div>

                            <div class="control-group" :class="[errors.has('default_name') ? 'has-error' : '']">
                                <label for="default_name" class="required">{{ __('countries::app.states.default_name') }}</label>
                                <input v-validate="'required'" class="control" id="default_name" name="default_name" data-vv-as="&quot;{{ __('countries::app.states.default_name') }}&quot;" value="{{ old('default_name') }}"/>
                                <span class="control-error" v-if="errors.has('default_name')">@{{ errors.first('default_name') }}</span>
                            </div>

                            <div class="control-group">
                                <label for="status">{{ __('countries::app.states.status') }}</label>
                                <input class="control" id="status" name="status" value="{{ old('status') }}"/>
                            </div>

                            <div class="control-group" :class="[errors.has('status') ? 'has-error' : '']">
                                <label for="status" class="required">{{ __('countries::app.states.status') }}</label>

                                <select class="control" name="status" v-model="status" v-validate="'required'" >
                                    <option value="0">{{ __('saas::app.super-user.tenants.deactivate') }}</option>
                                    <option value="1" >{{ __('saas::app.super-user.tenants.activate') }}</option>
                                </select>

                                <span class="control-error" v-if="errors.has('status')">@{{ errors.first('status') }}</span>

                                <div class="clear">&nbsp;</div>
                                @if (old('status'))
                                    <span class="badge badge-md badge-success">
                                    {{ __('saas::app.super-user.tenants.activated') }}
                                </span>
                                @else
                                    <span class="badge badge-md badge-danger">
                                    {{ __('saas::app.super-user.tenants.deactivated') }}
                                </span>
                                @endif
                            </div>

                            <div class="clear">&nbsp;</div>

                        </div>
                    </accordian>

                </div>
            </div>
        </form>
    </div>
@stop