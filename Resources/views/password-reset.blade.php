@extends('layouts.app')

@section('content')
<div class="col-md-9">
    <div class="card">
        <div class="card-header">Change password</div>

        <div class="card-body">
        	@include('core::includes.contextualLinks')
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            {{ $form->render() }}
        </div>
    </div>
</div>
@endsection