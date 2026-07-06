<!DOCTYPE html>
<html>
<head>
    <title>Database FoundIt</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 30px;
            background: #f4f4f4;
        }

        h1, h2 {
            color: #333;
        }

        .card {
            background: white;
            padding: 20px;
            margin-bottom: 25px;
            border-radius: 8px;
            box-shadow: 0 0 8px rgba(0,0,0,0.1);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
        }

        th, td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: left;
        }

        th {
            background: #222;
            color: white;
        }

        tr:nth-child(even) {
            background: #f2f2f2;
        }

        .status {
            font-weight: bold;
        }
    </style>
</head>
<body>

    <div class="card">
        <h1>Laravel Berhasil Connect ke Database</h1>
        <p>Nama Database: <b>{{ $dbName }}</b></p>
    </div>

    <div class="card">
        <h2>Data Items</h2>

        <table>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Description</th>
                <th>Category</th>
                <th>Location</th>
                <th>Status</th>
                <th>Posted By</th>
                <th>Created At</th>
            </tr>

            @foreach ($items as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->title }}</td>
                    <td>{{ $item->description }}</td>
                    <td>{{ $item->category }}</td>
                    <td>{{ $item->location }}</td>
                    <td class="status">{{ $item->status }}</td>
                    <td>{{ $item->posted_by }}</td>
                    <td>{{ $item->created_at }}</td>
                </tr>
            @endforeach
        </table>
    </div>

    <div class="card">
        <h2>Data Users</h2>

        <table>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
            </tr>

            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name ?? '-' }}</td>
                    <td>{{ $user->email ?? '-' }}</td>
                </tr>
            @endforeach
        </table>
    </div>

</body>
</html>