@extends('layouts.admin-app')

@section('content')

{{-- <a href="{{ route('/fileList/{id}')}}">Project File List</a> --}}
<h1>Project File List</h1>

<form action="{{ route('project.file.upload', $id) }}" method="post" enctype="multipart/form-data">

    @csrf

    <input type="file" class="" name="projectFile" id="projectFile">
    @error('projectFile')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
    <button type="submit" class="">Upload</button>
</form>

<br/>

<!-- view upload -->
<div class="container">
    <div class="header">
        <h1>View Upload</h1>

        <div class="table-responsive mt-2">
            <table class="table table-hover">
                <thead class="thead-light">
                    <th scope="col">File ID</th>
                    <th scope="col">File Name</th>
                </thead>

                @foreach ($fileUploads as $fl)
                <tr>
                    <td scope="col">{{$fl->id}}</td>
                    <td scope="col">{{$fl-> filename}}</td>
                    <td scope="col">
                        <a href="{{route('project.file.list',[$fl->id])}}">{{$fl-> file_url}}</a>
                    </td>
                </tr>
                @endforeach

            </table>
        </div>
    </div>

</div>

@endsection
