@extends('admin.layout.master')


@section('content')
    <h3 class="p-b-2 text-center">ایجاد آلبوم جدید</h3>

    <div class="row">
        <div class="col-md-10 offset-md-1">
{{--            @include('partials.form-errors')--}}
            {!! Form::model($exibition, ['method' => 'PUT',  'action'=> ['App\Http\Controllers\ExibitionController@update', $exibition->id], 'files'=>true]) !!}
            <div class="form-group">
                {!! Form::label('title', 'عنوان:') !!}
                {!! Form::text('title', null, ['class'=>'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('image', 'پوستر نمایشگاه:') !!}
                <input type="file" name="image" class="form-control"  >
                <img src="{{  asset('storage/exibition/'.$exibition->image) }}" width="100" >
            </div>

            <div class="form-group">
                {!! Form::label('date', 'تاریخ برگزاری:') !!}
                {!! Form::text('date', null, ['class'=>'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('location', 'محل نمایشگاه') !!}
                {!! Form::text('location', null, ['class'=>'form-control']) !!}
            </div>



            <div class="form-group">
                {!! Form::submit('ذخیره', ['class'=>'btn btn-success']) !!}
            </div>
            {!! Form::close() !!}




    </div>

@endsection
