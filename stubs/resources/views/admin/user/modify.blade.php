@extends(config('laravel-auth.layout.app'))

@section('header')
<x-tab::page-header :title='$user->exists ? "Edit User" : "Create User"' :links="array_merge([
    ['route' => route('admin.user.index'), 'name' => __('Users')],
    ($user->exists ? ['route' => route('admin.user.show', $user), 'name' => $user->name] : []),
])">
    <div class="btn-list">
        <x-tab::button type="submit" form="form-user-edit" class="btn btn-primary" icon="check" label="Save">
        </x-tab::button>
    </div>
</x-tab::page-header>
@endsection

@section('content')

<div class="row row-cards">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <form id="form-user-edit"
                    action="{{ $user->exists ? route('admin.user.update', $user) : route('admin.user.store') }}"
                    method="POST">
                    @csrf

                    <div class="form-group mb-3 row">
                        <x-tab::label class="col-md-3 col-form-label" label="Name"></x-tab::label>
                        <div class="col-md-6">
                            <x-tab::input name="name" :value="old('name', $user->name)" required></x-tab::input>
                        </div>
                    </div>

                    <div class="form-group mb-3 row">
                        <x-tab::label class="col-md-3 col-form-label" label="Email"></x-tab::label>
                        <div class="col-md-9">
                            <x-tab::input type="email" name="email" :value="old('email', $user->email)" required>
                            </x-tab::input>
                        </div>
                    </div>

                    <div class="form-group mb-3 row">
                        <x-tab::label class="col-md-3 col-form-label" label="Roles"></x-tab::label>
                        <div class="col-md-9">
                            <div class="form-selectgroup">
                                @foreach($roles as $role)
                                <label class="form-selectgroup-item">
                                    <input type="radio" id="role-{{ $role->id }}" name="roles[]" value="{{ $role->id }}"
                                        class="form-selectgroup-input" @checked($user->hasAnyRole($role->name))>
                                    <span class="form-selectgroup-label">{{ $role->name }}</span>
                                </label>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


@endsection