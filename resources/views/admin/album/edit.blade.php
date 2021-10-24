@extends('admin.layout.master')


@section('content')
    <h3 class="p-b-2 text-center">ایجاد آلبوم جدید</h3>

    <div class="row">
        <div class="col-md-10 offset-md-1">
{{--            @include('partials.form-errors')--}}
            {!! Form::model($album, ['method' => 'PUT',  'action'=> ['App\Http\Controllers\AlbumController@update', $album->id], 'files'=>true]) !!}
            <div class="form-group">
                {!! Form::label('title', 'عنوان:') !!}
                {!! Form::text('title', null, ['class'=>'form-control']) !!}
            </div>


            <div class="form-group">
                {!! Form::label('body', 'توضیحات:') !!}
                {!! Form::textarea('body', null, ['class'=>'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('image', 'تصویر آلبوم:') !!}
                <input type="file" name="image" class="form-control"  >
                <img src="{{  asset('storage/album/'.$album->image) }}" width="100" >
            </div>

            <div class="form-group">
                {!! Form::submit('ذخیره', ['class'=>'btn btn-success']) !!}
            </div>
            {!! Form::close() !!}




    </div>

@endsection
