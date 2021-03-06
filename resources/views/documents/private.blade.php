@extends('documents.layout')

@section('content')
    <head>
        <style>
            .tables{
                margin-left: 100px;
            }
        </style>
    </head>
    <body>
    <div class="row">
        <table class="tables">
            @if (Route::has('login'))
                <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                    @auth
                        <a href="{{ url('/profile') }}" class="text-sm text-gray-700 underline">Profile</a>
                    @else
                        <a href="{{ route('login') }}" class="text-sm text-gray-700 underline">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 underline">Register</a>
                        @endif
                    @endif
                </div>
            @endif
        </table>
    </div>

    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Title</th>
            <th>Content</th>
            <th>Privacy</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($private_docs as $document)
            <tr>
                <td>{{ ++$i }}</td>
                <td>{{ $document->title }}</td>
                <td>{{ $document->content }}</td>
                <td>{{ $document->privacy }}</td>
                <td>
                    <form action="{{ route('documents.destroy',$document->id) }}" method="POST">

                        <a class="btn btn-info" href="{{ route('documents.show',$document->id) }}">Show</a>

                        <a class="btn btn-primary" href="{{ route('documents.edit',$document->id) }}">Edit</a>

                        @csrf
                        @method('DELETE')

                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
    {!! $documents->links() !!}
    @endsection
    </body>
