@extends('admin.layout.master')

@section('content')
    <h3 class="p-b-2">لیست مطالب</h3>
    <table class="table table-hover bg-content">
        <thead>
        <tr>
            <th>عنوان</th>
            <th>تصویر</th>
            <th>پوستر نمایشگاه</th>
            <th>تاریخ برگزاری</th>
            <th>محل نمایشگاه</th>

        </tr>
        </thead>
        <tbody>

        @foreach($exibitions as $exibition)

            <tr>

                    <td>{{$exibition->title}}</td>

                <td><img src="{{  asset('storage\exibition\\' .$exibition->image) }}" width="100"; ></td>
                <td>{{$exibition->date}}</td>
                <td>{{$exibition->location}}</td>




                    <td class="text-center">
                        <a class="btn btn-warning" href="{{route('exibition.edit', $exibition->id)}}">ویرایش</a>
                        <div class="display-inline-block">

                        </div>
                        {!! Form::open(['method' => 'DELETE', 'action'=> ['App\Http\Controllers\ExibitionController@destroy', $exibition->id]]) !!}
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
