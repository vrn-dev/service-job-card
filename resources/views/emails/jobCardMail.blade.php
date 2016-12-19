<!doctype html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Report for Ticket # {{ $ticketId }}</title>
    {{--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">--}}
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }
        table, th, td {
            border: 1px solid darkgrey;
        }
        th, td {
            padding: 15px;
            text-align: left;
        }

        .inner-table, .inner-th, .inner-td {
            border: 1px solid darkgray;

        }
        .page-break {
            page-break-after: always;
        }
    </style>
</head>
<body>

    <div>
        <h1 style="text-align: center;">Trade Link Middle East</h1>
        <h2 style="text-align: center;">Service Call Report</h2>
    </div>

<h3>Report for Ticket # {{ $ticketId }}</h3>

<row>
    <table >
        <thead>
        <tr>
            <th>Detail</th>
            <th>Description</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <th>Customer</th>
            <td>{{ $customer }}</td>
        </tr>
        <tr>
            <th>Date</th>
            <td>{{ $date }}</td>
        </tr>
        <tr>
            <th>Location</th>
            <td>{{ $location }}</td>
        </tr>
        <tr>
            <th>Customer Supervisor</th>
            <td>{{ $supervisor }}</td>
        </tr>
        <tr>
            <th>Mobile</th>
            <td>{{ $mobile }}</td>
        </tr>
        <tr>
            <th>Machine Model</th>
            <td>{{ $machineModel }}</td>
        </tr>
        <tr>
            <th>Machine Sn</th>
            <td>{{ $machineSerial }}</td>
        </tr>
        <tr>
            <th>Machine Hours</th>
            <td>{{ $machineHours }}</td>
        </tr>
        </tbody>
    </table>
</row>

<row>
    <h3>Details</h3>
    <div>
        <table class="inner-table">
            <tr>
                <td class="inner-td" style="width: 200px"><strong>Faults and Warnings: </strong></td>
                <td class="inner-td">
                    <ul>
                        @if(empty($fnw))
                            <li>No Faults or Warnings</li>
                        @elseif(count($fnw) == 1)
                            @foreach($fnw as $item)
                                <li>{{ $item }}</li>
                            @endforeach
                        @elseif(count($fnw) > 1)
                            @foreach($fnw as $item)
                                <li>{{ $item }}</li>
                            @endforeach
                        @endif
                    </ul>
                    @if(!empty($otherFault))
                        <p>Other Faults: <span style="text-decoration: underline ">{{ $otherFault }}</span></p>
                    @endif
                </td>
            </tr>
        </table>
    </div>

    <div class="page-break"></div>
    <div>
        <table class="inner-table">
            <tr>
                <td class="inner-td" style="width: 200px"><strong>Actions Taken: </strong></td>
                <td class="inner-td">
                    <ul>
                        @if(empty($actTaken))
                            <li>No Actions Taken</li>
                        @elseif(count($actTaken) == 1)
                            @foreach($actTaken as $item)
                                <li>{{ $item }}</li>
                            @endforeach
                        @elseif(count($actTaken) > 1)
                            @foreach($actTaken as $item)
                                <li>{{ $item }}</li>
                            @endforeach
                        @endif
                    </ul>
                    @if(!empty($otherAction))
                        <p>Other Faults: <span style="text-decoration: underline ">{{ $otherAction }}</span></p>
                    @endif
                </td>
            </tr>
        </table>
    </div>

    @if(!empty($repPart))
        <div>
            <table class="inner-table">
                <tr>
                    <td class="inner-td" style="width: 200px"><strong>Repaired Parts </strong></td>
                    <td class="inner-td">
                        <ul>
                            @if(empty($repPart))
                                <li>No Replaced Parts</li>
                            @elseif(count($repPart) == 1)
                                @foreach($repPart as $item)
                                    <li>{{ $item }}</li>
                                @endforeach
                            @elseif(count($repPart) > 1)
                                @foreach($repPart as $item)
                                    <li>{{ $item }}</li>
                                @endforeach
                            @endif
                        </ul>
                    </td>
                </tr>
            </table>
        </div>
    @endif

    <div>
        <table class="inner-table">
            <tr>
                <td class="inner-td" style="width: 200px"><strong>Nature of Call: </strong></td>
                <td class="inner-td">
                    <ul>
                        <li>{{ $noc }}</li>
                    </ul>
                    @if(!empty($remarks))
                        <p>Remarks: <span style="text-decoration: underline ">{{ $remarks }}</span></p>
                    @endif
                </td>
            </tr>
        </table>
    </div>
</row>

<row>
    <p>Service Engineer Assigned to Ticket: {{ $user }}</p>
</row>

</body>
</html>




