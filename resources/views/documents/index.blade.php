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
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>There all of Your  Posts</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('documents.create') }}"> Create New document</a>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Title</th>
            <th>Content</th>
            <th>Privacy</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($private_docs  as $document)
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


    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>The Public Posts</h2>
            </div>
        </div>
    </div>



    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Title</th>
            <th>Content</th>
            <th>Privacy</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($public as $document)
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




    <!--PieChart part-->
    <h1 style="margin-top:100px ;">Privacy catalog of your Documents</h1>

    <div id="piechart"></div>

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

    <script type="text/javascript">
        // Load google charts
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);

        // Draw the chart and set the chart values
        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ['Documents', 'Privacy'],
                ['Private', {{$private_count}}],
                ['Public',{{$public_count}}],
            ]);

            // Optional; add a title and set the width and height of the chart
            var options = {'title':'Privacy of User Documents', 'width':550, 'height':400};

            // Display the chart inside the <div> element with id="piechart"
            var chart = new google.visualization.PieChart(document.getElementById('piechart'));
            chart.draw(data, options);
        }
    </script>



    <a href="{{ url('/private') }}" class="text-sm text-gray-700 underline">Private</a>

    @endsection
    </body>
