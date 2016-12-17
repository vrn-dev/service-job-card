<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Job Card Email</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
</head>
<body>
<nav class="navbar" style="background-color: #65b8d9">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <img alt="Trade Link ME" src="http://www.tradelinkmeltd.com/images/index_02.jpg">
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <h1 style="text-align: center;">Service Call Report</h1>
    </div><!-- /.container-fluid -->
</nav>
<h3>New Job Card Generated</h3>
<h3>Ticket # {{ $ticketId }}</h3>

<row>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Faults & Warnings</h3>
        </div>
        <div class="panel-body">
            <ul>
                @foreach($fnw as $item)
                    <li class="list-group-item">{{ $item }}</li>
                @endforeach
            </ul>
            <p class="list-group-item">Other Faults or Warinings: {{ $otherFault }}</p>        </div>
    </div>
    <pre>
        <h4>Faults & Warnings</h4>
        <ul>
            @foreach($fnw as $item)
                <li class="list-group-item">{{ $item }}</li>
            @endforeach
        </ul>
        <p>Other Faults or Warinings: {{ $otherFault }}</p>
    </pre>
    <pre>
        <h4>Actions Taken</h4>
        <ul>
            @foreach($actTaken as $item)
                <li>{{ $item }}</li>
            @endforeach
        </ul>
        <p>Other Faults or Warinings: {{ $otherAction }}</p>
    </pre>
    <pre>
        <h4>Parts Replaced</h4>
        <ul>
            @foreach($repPart as $item)
                <li>{{ $item }}</li>
            @endforeach
        </ul>
    </pre>
    <pre>
        <h4>Nature of Call</h4>
        <ul>
            @foreach($noc as $item)
                <li>{{ $item }}</li>
            @endforeach
        </ul>
        <p>Remarks: {{ $remarks }}</p>
    </pre>
</row>
</body>
</html>




