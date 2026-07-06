<!DOCTYPE html>
<html>
<head>
    <title>FoundIt Database</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f6f8;
            margin: 0;
            padding: 30px;
        }

        .header {
            background: #2563eb;
            color: white;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 25px;
        }

        .card {
            background: white;
            padding: 20px;
            margin-bottom: 30px;
            border-radius: 10px;
            box-shadow: 0 0 8px rgba(0,0,0,0.1);
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
            font-size: 14px;
        }

        th {
            background: #111827;
            color: white;
            padding: 10px;
            border: 1px solid #ddd;
        }

        td {
            padding: 10px;
            border: 1px solid #ddd;
        }

        tr:nth-child(even) {
            background: #f3f4f6;
        }

        .badge {
            background: #e0ecff;
            color: #2563eb;
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 13px;
        }

        .empty {
            color: #777;
            font-style: italic;
        }
    </style>
</head>
<body>

    <div class="header">
        <h1>Database FoundIt</h1>
        <p>Laravel berhasil terhubung ke database: <b>{{ $dbName }}</b></p>
    </div>

    @foreach ($database as $table)
        <div class="card">
            <h2>
                Tabel: {{ $table['tableName'] }}
                <span class="badge">Total Data: {{ count($table['rows']) }}</span>
            </h2>

            @if (count($table['rows']) > 0)
                <table>
                    <tr>
                        @foreach ($table['columns'] as $column)
                            <th>{{ $column }}</th>
                        @endforeach
                    </tr>

                    @foreach ($table['rows'] as $row)
                        <tr>
                            @foreach ($table['columns'] as $column)
                                <td>{{ $row->{$column} ?? '-' }}</td>
                            @endforeach
                        </tr>
                    @endforeach
                </table>
            @else
                <p class="empty">Tabel ini belum memiliki data.</p>
            @endif
        </div>
    @endforeach

</body>
</html>