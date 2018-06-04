@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <form method="POST" action="{{ route('users.store') }}" class="needs-validation" novalidate>
                    {{ csrf_field() }}
                    @include('administration.users._form', [
                        'title' => 'Add New User',
                        'button_label' => 'Add'
                    ])
                </form>
            </div>
        </div>
    </div>
@endsection
