@extends('admin.layout.master')

@section('content')
    <h3 class="p-b-2">لیست مطالب</h3>
    <table class="table table-hover bg-content">
        <thead>
        <tr>
            <th>عنوان</th>
            <th>تصویر</th>
            <th>توضیحات</th>

        </tr>
        </thead>
        <tbody>

        @foreach($albums as $album)

            <tr>

                    <td>{{$album->name}}</td>

                <td><img src="{{  asset('storage\album\\' .$album->image) }}" width="100"; ></td>
                <td>{{$album->description}}</td>


                    <td class="text-center">
                        <a class="btn btn-warning" href="{{route('album.edit', $album->id)}}">ویرایش</a>
                        <div class="display-inline-block">

                        </div>
                        {!! Form::open(['method' => 'DELETE', 'action'=> ['App\Http\Controllers\AlbumController@destroy', $album->id]]) !!}
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
