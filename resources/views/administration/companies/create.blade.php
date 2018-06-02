@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <nav aria-label="breadcrumb" role="navigation">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Administration</a></li>
                        <li class="breadcrumb-item"><a href="#">Company Management</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Create Company</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <form method="POST" action="{{ route('companies.store') }}" class="needs-validation" enctype="multipart/form-data" novalidate>
                    {{ csrf_field() }}
                    <table class="table">
                        <thead>
                            <tr>
                                <th colspan="2" class="text-left">Add Company</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="w-25"><label for="Name" class="col-form-label">Name *</label></td>
                                <td>
                                    <input type="text" name="name" class="col-6 form-control{{ ($errors->has('name')) ? ' is-invalid':'' }}" id="Name" placeholder="Name" value="{{ old('name') }}" required>
                                    <div class="invalid-feedback">
                                        @if($errors->has('name'))
                                            {{ $errors->first('name') }}
                                        @else
                                            Name is required.
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            <tr class="border-bottom">
                                <th></th>
                                <th><button type="submit" class="btn btn-primary">Add</button></th>
                            </tr>
                        </tbody>
                    </table>
                </form>
            </div>
        </div>
    </div>
@endsection
