@extends('admin.layout.master')


@section('content')
    <h3 class="p-b-2 text-center">edit bio</h3>

    <div class="row">
        <div class="col-md-10 offset-md-1">
{{--            @include('partials.form-errors')--}}
            {!! Form::model($bio, ['method' => 'PUT',  'action'=> ['App\Http\Controllers\BioController@update', $bio->id], 'files'=>true]) !!}

            <div class="form-group">
                {!! Form::label('image', 'bio image:') !!}
                <input type="file" name="image" class="form-control"  >
                <img src="{{  asset('storage/bio/'.$bio->image) }}" width="100" >
            </div>

            <div class="form-group">
                {!! Form::label('body', 'bio description:') !!}
                {!! Form::textarea('body', null, ['class'=>'form-control']) !!}
            </div>



            <div class="form-group">
                {!! Form::submit('save', ['class'=>'btn btn-success']) !!}
            </div>
            {!! Form::close() !!}




    </div>

@endsection
