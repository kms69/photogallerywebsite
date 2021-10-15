@extends('admin.layout.master')


@section('content')
    <h3 class="p-b-2 text-center">ویرایش مطلب</h3>
    <div class="row">
{{--        <div class="col-md-3">--}}
{{--            <img src="{{  asset('storage/post/images/'.$post->image) }}" width="200" class="img-fluid" >--}}
{{--        </div>--}}

        <div class="col-md-9">
{{--            @include('partials.form-errors')--}}
            {!! Form::model($post, ['method' => 'PUT', 'action'=> ['App\Http\Controllers\PostController@update', $post->id], 'files'=>true]) !!}
            <div class="form-group">
                {!! Form::label('title', 'عنوان:') !!}
                {!! Form::text('title',null , ['class'=>'form-control']) !!}
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
                {!! Form::label('body', 'توضیحات:') !!}
                {!! Form::textarea('body', null, ['class'=>'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('image', 'تصویر :') !!}
                <input type="file" name="image" class="form-control" value="{{$post->image}}" >
                 <img src="{{  asset('storage/post/images/'.$post->image) }}" width="100" >
            </div>
                       <div class="form-group">
                {!! Form::submit('بروزرسانی', ['class'=>'btn btn-success col-md-3']) !!}

            </div>
            {!! Form::close() !!}

            {!! Form::open(['method' => 'DELETE', 'action'=> ['App\Http\Controllers\PostController@destroy', $post->id]]) !!}
            <div class="form-group">
                {!! Form::submit('حذف', ['class'=>'btn btn-danger ']) !!}
            </div>
            {!! Form::close() !!}
            dd{{$post}}
        </div>


    </div>

@endsection
