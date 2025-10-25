<!DOCTYPE html>
<html>

<head>
    <title>Top Authors</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #f8f9fa;
            font-weight: bold;
        }

        .nav-links {
            margin: 20px 0;
        }

        .nav-links a {
            margin-right: 15px;
            text-decoration: none;
            color: #007bff;
        }
    </style>
</head>

<body>
    <h1>Top 10 Most Famous Author</h1>

    <div class="nav-links">
        <a href="/books">Book List</a>
        <a href="/authors/top">Top Authors</a>
        <a href="/ratings/create">Input Rating</a>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Author Name</th>
                <th>Voter</th>
            </tr>
        </thead>
        <tbody>
            @if (count($authors) > 0)
                @foreach ($authors as $author)
                    <tr>
                        <td>{{ $author['rank'] }}</td>
                        <td>{{ $author['name'] }}</td>
                        <td>{{ $author['voter_count'] }}</td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="3" style="text-align: center;">No authors found</td>
                </tr>
            @endif
        </tbody>
    </table>
</body>

</html>
