@extends('admin.layout.master')


@section('content')
    <h3 class="p-b-2 text-center">Create the bio</h3>

    <div class="row">
        <div class="col-md-10 offset-md-1">
{{--            @include('partials.form-errors')--}}
            {!! Form::open(['method' => 'POST', 'action'=> 'App\Http\Controllers\BioController@store', 'files'=>true]) !!}
            <div class="form-group">
                {!! Form::label('image', 'Bio image') !!}
                {!! Form::file('image', null, ['class'=>'form-control']) !!}
            </div>


            <div class="form-group">
                {!! Form::label('body', 'Description') !!}
                {!! Form::textarea('body', null, ['class'=>'form-control']) !!}
            </div>



            <div class="form-group">
                {!! Form::submit('submit', ['class'=>'btn btn-success']) !!}
            </div>
            {!! Form::close() !!}
        </div>

    </div>

@endsection
