@extends('admin.layout.master')


@section('content')
    <h3 class="p-b-2 text-center">ایجاد آلبوم جدید</h3>

    <div class="row">
        <div class="col-md-10 offset-md-1">
            {{--            @include('partials.form-errors')--}}
            {!! Form::open(['method' => 'POST', 'action'=> 'App\Http\Controllers\ImageController@store', 'files'=>true]) !!}



            <div class="form-group">
                {!! Form::Label('album_id', 'دسته بندی آلبوم:') !!}
                <select class="form-control" name="album_id">

                    @foreach($albums as $album)
                        <option value='{{ $album->id}}'> {{ $album->title}}</option>
                    @endforeach

                </select>
            </div>

            <div class="form-group">
                {!! Form::label('photo', 'تصویر :') !!}
                {!! Form::file('photo', null, ['class'=>'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::submit('ذخیره', ['class'=>'btn btn-success']) !!}
            </div>
            {!! Form::close() !!}
        </div>

    </div>

@endsection
