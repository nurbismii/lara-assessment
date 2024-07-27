<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Evaluation Report</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <style>
        body {
            font-size: 10px;
        }

        .table {
            width: 100%;
        }

        .table th,
        .table td {
            vertical-align: middle;
            text-align: center;
            padding: 5px;
        }

        .table th {
            white-space: nowrap;
        }

        .table td {
            white-space: pre-line;
            /* Allows line breaks within cells */
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <h3 class="text-center my-4">Evaluation Report</h3>
        <table class="table table-bordered">
            <thead class="thead-light">
                <tr>
                    <th>ID</th>
                    <th>NIK</th>
                    <th>Name</th>
                    <th>Departement</th>
                    <th>Divisi</th>
                    <th>Evaluation Date</th>
                    <th>Content</th>
                    <th>Grades</th>
                    <th>Created At</th>
                    <th>Updated At</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data as $row)
                <tr>
                    <td rowspan="{{ max(count($row['Content']), count($row['Grades'])) }}">{{ $row['ID'] }}</td>
                    <td rowspan="{{ max(count($row['Content']), count($row['Grades'])) }}">{{ $row['NIK'] }}</td>
                    <td rowspan="{{ max(count($row['Content']), count($row['Grades'])) }}">{{ $row['Name'] }}</td>
                    <td rowspan="{{ max(count($row['Content']), count($row['Grades'])) }}">{{ $row['Departement'] }}</td>
                    <td rowspan="{{ max(count($row['Content']), count($row['Grades'])) }}">{{ $row['Divisi'] }}</td>
                    <td rowspan="{{ max(count($row['Content']), count($row['Grades'])) }}">{{ $row['EvaluationDate'] }}</td>
                    <td>
                        @if(isset($row['Content'][0]))
                        {{ $row['Content'][0] }}
                        @endif
                    </td>
                    <td>
                        @if(isset($row['Grades'][0]))
                        {{ $row['Grades'][0] }}
                        @endif
                    </td>
                    <td rowspan="{{ max(count($row['Content']), count($row['Grades'])) }}">{{ $row['CreatedAt'] }}</td>
                    <td rowspan="{{ max(count($row['Content']), count($row['Grades'])) }}">{{ $row['UpdatedAt'] }}</td>
                    <td rowspan="{{ max(count($row['Content']), count($row['Grades'])) }}">{{ $row['Total'] }}</td>
                </tr>
                @for($i = 1; $i < max(count($row['Content']), count($row['Grades'])); $i++) <tr>
                    <td>
                        @if(isset($row['Content'][$i]))
                        {{ $row['Content'][$i] }}
                        @endif
                    </td>
                    <td>
                        @if(isset($row['Grades'][$i]))
                        {{ $row['Grades'][$i] }}
                        @endif
                    </td>
                    </tr>
                    @endfor
                    @endforeach
            </tbody>
        </table>
    </div>
</body>

</html>