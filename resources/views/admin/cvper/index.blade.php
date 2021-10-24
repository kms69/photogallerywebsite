@extends('admin.layout.master')

@section('content')
    <h3 class="p-b-2">لیست مطالب</h3>
    <table class="table table-hover bg-content">
        <thead>
        <tr>

            <th>تصویر</th>
            <th>توضیحات</th>

        </tr>
        </thead>
        <tbody>

        @foreach($cvs as $cv)

            <tr>



                <td><img src="{{  asset('storage\cv\\' .$cv->image) }}" width="100"; ></td>
                <td>{{$cv->body}}</td>


                    <td class="text-center">
                        <a class="btn btn-warning" href="{{route('cvper.edit', $cv->id)}}">ویرایش</a>
                        <div class="display-inline-block">

                        </div>
                        {!! Form::open(['method' => 'DELETE', 'action'=> ['App\Http\Controllers\CvperController@destroy', $cv->id]]) !!}
                        <div class="form-group">
                            {!! Form::submit('حذف', ['class'=>'btn btn-danger ']) !!}
                        </div>
                        {!! Form::close() !!}
                        </div>

                    </td>
                @endforeach


            </tr>
        </tbody>
    </table>

@endsection
