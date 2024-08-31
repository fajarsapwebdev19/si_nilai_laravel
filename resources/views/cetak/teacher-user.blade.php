<!DOCTYPE html>
<html>
<head>
    <title>{{ $title }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table, th, td {
            border: 1px solid black;
        }

        th, td {
            padding: 8px;
            text-align: left;
            vertical-align: top;
        }

        th {
            background-color: #f2f2f2;
        }

        tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tbody tr:nth-child(odd) {
            background-color: #ffffff;
        }

        tfoot {
            font-weight: bold;
        }

        /* Optional: Adjust column widths */
        .col-name {
            width: 25%;
        }

        .col-email {
            width: 10%;
        }

        .col-personal {
            width: 25%;
        }

        .col-guru {
            width: 25%;
        }
    </style>
</head>
<body>
    <h1>{{ $title }}</h1>
    <table>
        <thead>
            <tr>
                <th class="col-name">Nama</th>
                <th class="col-email">Jenis Kelamin</th>
                <th class="col-personal">Username</th>
                <th class="col-guru">Password</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->personalData->nama }}</td>
                    <td>{{ $user->personalData->jenis_kelamin }}</td>
                    <td>{{ $user->username ?? 'Tidak Ada' }}</td>
                    <td>{{ $user->real_password ?? 'Tidak Ada' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
