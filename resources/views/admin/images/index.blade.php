@extends('admin.layout.master')

@section('content')
    <h3 class="p-b-2">لیست مطالب</h3>
    <table class="table table-hover bg-content">
        <thead>
        <tr>

            <th>تصویر</th>
            <th>دسته بندی</th>


        </tr>
        </thead>
        <tbody>

        @foreach($images as $image)
            @php
                $sub_info=DB::table('albums')->select('title')->where('id',$image->album_id)->get();
            @endphp
            <tr>



                <td><img src="{{  asset('storage\images\\' .$image->photo) }}" width="100"; ></td>
                @foreach($sub_info as $data)
                    <td>{{$data->title}}</td>


                    <td class="text-center">
{{--                        <a class="btn btn-warning" href="{{route('album.edit', $image->id)}}">ویرایش</a>--}}
                        <div class="display-inline-block">

                        </div>
                        {!! Form::open(['method' => 'DELETE', 'action'=> ['App\Http\Controllers\ImageController@destroy', $image->id]]) !!}
                        <div class="form-group">
                            {!! Form::submit('حذف', ['class'=>'btn btn-danger ']) !!}
                        </div>
                        {!! Form::close() !!}
                        </div>

                    </td>
                @endforeach
                @endforeach


            </tr>
        </tbody>
    </table>

@endsection
