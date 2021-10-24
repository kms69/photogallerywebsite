@extends('admin.layout.master')

@section('content')
    <h3 class="p-b-2">Bio</h3>
    <table class="table table-hover bg-content">
        <thead>
        <tr>

            <th>image</th>
            <th>description</th>

        </tr>
        </thead>
        <tbody>



            <tr>

                @foreach($bios as $bio)

                <td><img src="{{  asset('storage\bio\\' .$bio->image) }}" width="100"; ></td>
                <td>{{ \Illuminate\Support\Str::limit($bio->body, 100, '...') }}</td>


                    <td class="text-center">
                        <a class="btn btn-warning" href="{{route('bio.edit', $bio->id)}}">edit</a>
                        <div class="display-inline-block">

                        </div>
                        @endforeach
                        {!! Form::open(['method' => 'DELETE', 'action'=> ['App\Http\Controllers\BioController@destroy', $bio->id]]) !!}
                        <div class="form-group">
                            {!! Form::submit('delete', ['class'=>'btn btn-danger ']) !!}
                        </div>
                        {!! Form::close() !!}
                        </div>

                    </td>



            </tr>
        </tbody>
    </table>

@endsection
