@extends('admin.layout.master')


@section('content')
    <h3 class="p-b-2 text-center">ایجاد مطلب جدید</h3>

    <div class="row">
        <div class="col-md-10 offset-md-1">
{{--            @include('partials.form-errors')--}}
            {!! Form::open(['method' => 'POST', 'action'=> 'App\Http\Controllers\PostController@store', 'files'=>true]) !!}
            <div class="form-group">
                {!! Form::label('title', 'عنوان:') !!}
                {!! Form::text('title', null, ['class'=>'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::Label('category_id', 'دسته بندی:') !!}
                <select class="form-control" name="category_id">

                    @foreach($categories as $category)
                        <option value='{{ $category->id}}'> {{ $category->name}}</option>
                    @endforeach

                </select>
            </div>
            <div class="form-group">
                {!! Form::label('publish_date', 'تاریخ انتشار:') !!}
                {!! Form::text('publish_date', null, ['class'=>'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('image', 'تصویر پست:') !!}
                {!! Form::file('image', null, ['class'=>'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('body', 'توضیحات:') !!}
                {!! Form::textarea('body', null, ['class'=>'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::submit('ذخیره', ['class'=>'btn btn-success']) !!}
            </div>
            {!! Form::close() !!}
        </div>

    </div>

@endsection
