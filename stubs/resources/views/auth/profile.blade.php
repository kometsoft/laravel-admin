@extends(config('laravel-auth.layout'))

@section('header')
<x-tab::page-header title="Profile"></x-tab::page-header>
@endsection

@section('content')
<div class="row row-cards">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">@lang('Account Information')</h3>
                <div class="card-actions">
                    <x-tab::button type="submit" form="form-profile-account" class="btn btn-primary" icon="check"
                        label="Save"></x-tab::button>
                </div>
            </div>
            <div class="card-body">
                <form id="form-profile-account" action="{{ route('profile.update', $user) }}" method="POST">
                    @csrf
                    <div class="form-group mb-3 row">
                        <x-tab::label class="col-md-3 col-form-label" label="Avatar"></x-tab::label>
                        <div class="col-md-6">
                            <span class="avatar avatar-xl"
                                style="background-image: url('{{ $user->photo_url }}')"></span>
                        </div>
                    </div>
                    <div class="form-group mb-3 row">
                        <x-tab::label class="col-md-3 col-form-label" label="Name"></x-tab::label>
                        <div class="col-md-6">
                            <x-tab::input name="name" id="name" :value="$user->name" required></x-tab::input>
                        </div>
                    </div>
                    <div class="form-group mb-3 row">
                        <x-tab::label class="col-md-3 col-form-label" label="Email"></x-tab::label>
                        <div class="col-md-6">
                            <x-tab::input type="email" name="email" id="email" :value="$user->email" required>
                            </x-tab::input>
                        </div>
                    </div>
                    <div class="form-group mb-3 row">
                        <x-tab::label class="col-md-3 col-form-label" label="Roles"></x-tab::label>
                        <div class="col-md-6">
                            {{ implode(', ', $user->getRoleNames()->toArray()) }}
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">@lang('Account Security')</h3>
                <div class="card-actions">
                    <x-tab::button type="submit" form="form-profile-password" class="btn btn-primary" icon="check"
                        label="Save"></x-tab::button>
                </div>
            </div>
            <div class="card-body">
                <form id="form-profile-password" action="{{ route('profile.update-password', $user) }}"
                    method="POST">
                    @csrf @method('PUT')
                    <div class="form-group mb-3 row">
                        <x-tab::label class="col-md-3 col-form-label" label="Current password"></x-tab::label>
                        <div class="col-md-6">
                            <x-tab::input type="password" name="current_password" id="current_password" required>
                            </x-tab::input>
                        </div>
                    </div>
                    <div class="form-group mb-3 row">
                        <x-tab::label class="col-md-3 col-form-label" label="New Password"></x-tab::label>
                        <div class="col-md-6">
                            <x-tab::input type="password" name="new_password" id="new_password" required>
                            </x-tab::input>
                        </div>
                    </div>
                    <div class="form-group mb-3 row">
                        <x-tab::label class="col-md-3 col-form-label" label="Retype New Password"></x-tab::label>
                        <div class="col-md-6">
                            <x-tab::input type="password" name="new_password_confirmation"
                                id="new_password_confirmation" required></x-tab::input>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection