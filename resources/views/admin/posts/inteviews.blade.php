@extends('admin.layout.master')

@section('content')
    <h3 class="p-b-2">لیست مطالب</h3>
    <table class="table table-hover bg-content">
        <thead>
        <tr>
            <th>دسته بندی</th>
            <th>عنوان</th>
            <th>تصویر</th>
            <th>تاریخ انتشار</th>
            <th>توضیحات</th>
            <th>عملیات</th>
        </tr>
        </thead>
        <tbody>

        @foreach($posts as $post)
            @php
                $sub_info=DB::table('categories')->select('name')->where('id',$post->category_id)->where('name', 'interviews')->get();
            @endphp
            <tr>
                @foreach($sub_info as $data)
                    <td>{{$data->name}}</td>
                <td>{{$post->title}}</td>
                <td><img src="{{  asset('storage\post\images\\' .$post->image) }}" width="100"; ></td>
                <td>{{$post->publish_date}}</td>
                <td>{{$post->body}}</td>

                    <td class="text-center">
                        <a class="btn btn-warning" href="{{route('posts.edit', $post->id)}}">ویرایش</a>
                        <div class="display-inline-block">

                        </div>
                        {!! Form::open(['method' => 'DELETE', 'action'=> ['App\Http\Controllers\PostController@destroy', $post->id]]) !!}
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
