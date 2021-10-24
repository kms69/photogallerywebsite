@extends('admin.layout.master')

@section('content')
    <h3 class="p-b-2">لیست مطالب</h3>
    <table class="table table-hover bg-content">
        <thead>
        <tr>
            <th>عنوان</th>
            <th>تصویر</th>
            <th>سال انتشار</th>
            <th>ناشر</th>
            <th>توضیحات</th>

        </tr>
        </thead>
        <tbody>

        @foreach($books as $book)

            <tr>

                    <td>{{$book->title}}</td>

                <td><img src="{{  asset('storage\book\\' .$book->image) }}" width="100"; ></td>
                <td>{{$book->year}}</td>
                <td>{{$book->publisher}}</td>
                <td>{{$book->body}}</td>



                    <td class="text-center">
                        <a class="btn btn-warning" href="{{route('book.edit', $book->id)}}">ویرایش</a>
                        <div class="display-inline-block">

                        </div>
                        {!! Form::open(['method' => 'DELETE', 'action'=> ['App\Http\Controllers\BookController@destroy', $book->id]]) !!}
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
