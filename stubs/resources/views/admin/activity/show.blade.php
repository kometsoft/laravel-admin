@extends(config('laravel-auth.layout'))

@section('header')
<x-tab::page-header :title='"$activity->description"' :links="array_merge([
    ['route' => route('admin.activity.index'), 'name' => __('Activity Logs')],
])"></x-tab::page-header>
@endsection

@section('content')

<div class="row row-cards">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="form-group mb-3 row">
                    <x-tab::label class="col-md-3 col-form-label" label="Log Name"></x-tab::label>
                    <div class="col-md-9">
                        <p class="form-control-plaintext">{{ $activity->log_name }}</p>
                    </div>
                </div>
                <div class="form-group mb-3 row">
                    <x-tab::label class="col-md-3 col-form-label" label="Event"></x-tab::label>
                    <div class="col-md-9">
                        <p class="form-control-plaintext">{{ $activity->event }}</p>
                    </div>
                </div>
                <div class="form-group mb-3 row">
                    <x-tab::label class="col-md-3 col-form-label" label="Description"></x-tab::label>
                    <div class="col-md-9">
                        <p class="form-control-plaintext">{{ $activity->description }}</p>
                    </div>
                </div>
                <div class="form-group mb-3 row">
                    <x-tab::label class="col-md-3 col-form-label" label="Subject Type"></x-tab::label>
                    <div class="col-md-9">
                        <p class="form-control-plaintext">{{ $activity->subject->name }}</p>
                    </div>
                </div>
                <div class="form-group mb-3 row">
                    <x-tab::label class="col-md-3 col-form-label" label="Subject ID"></x-tab::label>
                    <div class="col-md-9">
                        <p class="form-control-plaintext">{{ $activity->subject->name }}</p>
                    </div>
                </div>
                <div class="form-group mb-3 row">
                    <x-tab::label class="col-md-3 col-form-label" label="By"></x-tab::label>
                    <div class="col-md-9">
                        <a class="form-control-plaintext" href="{{ $activity->causer ? route('admin.user.show', $activity->causer) : '#' }}">
                            {{ $activity->causer->name }}
                        </a>
                    </div>
                </div>
                @if(isset($activity->properties['old']))
                <div class="form-group mb-3 row">
                    <x-tab::label class="col-md-3 col-form-label" label="Old"></x-tab::label>
                    <div class="col-md-9">
                        <ul class="list-group">
                            @foreach($activity->properties['old'] as $key => $value)
                            @if(!is_array($value))
                            <li class="list-group-item py-1"><span style="font-weight: 500;">{{ $key }}</span>:
                                {{ $value }}</li>
                            @endif
                            @if(is_array($value))
                            <li class="list-group-item py-1"><span style="font-weight: 500;">{{ $key }}</span>:
                                {{ json_encode($value) }}</li>
                            @endif
                            @endforeach
                        </ul>
                    </div>
                </div>
                @endif
                @if(isset($activity->properties['attributes']))
                <div class="form-group mb-3 row">
                    <x-tab::label class="col-md-3 col-form-label" label="New"></x-tab::label>
                    <div class="col-md-9">
                        <ul class="list-group">
                            @if(isset($activity->properties['attributes']))
                            @foreach($activity->properties['attributes'] as $key => $value)
                            @if(!is_array($value))
                            <li class="list-group-item py-1"><span style="font-weight: 500;">{{ $key }}</span>:
                                {{ $value }}</li>
                            @endif
                            @if(is_array($value))
                            <li class="list-group-item py-1"><span style="font-weight: 500;">{{ $key }}</span>:
                                {{ json_encode($value) }}</li>
                            @endif
                            @endforeach
                            @endif
                        </ul>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>


@endsection