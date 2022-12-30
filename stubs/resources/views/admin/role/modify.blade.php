@extends(config('laravel-auth.layout.app'))

@section('header')
<x-tab::page-header :title='$role->exists ? "Edit Role" : "Create Role"' :links="array_merge([
    ['route' => route('admin.role.index'), 'name' => __('Roles')],
    ($role->exists ? ['route' => route('admin.role.show', $role), 'name' => $role->name] : []),
])">
    <div class="btn-list">
        <x-tab::button type="submit" form="form-role-edit" class="btn btn-primary" icon="check" label="Save">
        </x-tab::button>
    </div>
</x-tab::page-header>
@endsection

@section('content')

<div class="row row-cards">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <form id="form-role-edit"
                    action="{{ $role->exists ? route('admin.role.update', $role) : route('admin.role.store') }}"
                    method="POST">
                    @csrf

                    <div class="form-group mb-3 row">
                        <x-tab::label class="col-md-3 col-form-label" label="Name"></x-tab::label>
                        <div class="col-md-6">
                            <x-tab::input name="name" :value="old('name', $role->name)" required></x-tab::input>
                        </div>
                    </div>

                    <div class="form-group mb-3 row">
                        <x-tab::label class="col-md-3 col-form-label" label="Roles"></x-tab::label>
                        <div class="col-md-6">
                            @foreach($permissions as $permission)
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="permissions[]"
                                    value="{{ $permission->id }}" id="permission-{{ $permission->id }}"
                                    @checked($role->hasAnyPermission($permission->name))>
                                <label class="form-check-label" for="permission-{{ $permission->id }}">{{
                                    $permission->name }}</label>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection