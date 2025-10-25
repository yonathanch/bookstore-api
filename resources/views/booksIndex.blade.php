<!DOCTYPE html>
<html>

<head>
    <title>Book List</title>
</head>

<body>
    <h1>Book Management System</h1>

    <div>
        <a href="/books">Book List</a> |
        <a href="/authors/top">Top Authors</a> |
        <a href="/ratings/create">Input Rating</a>
    </div>

    <br>

    <form method="GET" action="">
        <label>List shown:</label>
        <select name="per_page">
            @foreach ([10, 20, 30, 40, 50, 60, 70, 80, 90, 100] as $limit)
                <option value="{{ $limit }}" {{ request('per_page', 10) == $limit ? 'selected' : '' }}>
                    {{ $limit }}
                </option>
            @endforeach
        </select>

        <label>Search:</label>
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search...">

        <button type="submit">SUBMIT</button>
    </form>

    <br>

    <table border="1" width="100%">
        <tr>
            <th>No</th>
            <th>Book Name</th>
            <th>Category Name</th>
            <th>Author Name</th>
            <th>Average Rating</th>
            <th>Voter</th>
        </tr>
        @if ($books->count() > 0)
            @foreach ($books as $book)
                <tr>
                    <td>{{ ($books->currentPage() - 1) * $books->perPage() + $loop->iteration }}</td>
                    <td>{{ $book->name }}</td>
                    <td>
                        @foreach ($book->categories as $category)
                            {{ $category->name }}@if (!$loop->last)
                                ,
                            @endif
                        @endforeach
                    </td>
                    <td>{{ $book->author->name }}</td>
                    <td>{{ number_format($book->average_rating, 2) }}</td>
                    <td>{{ $book->voter_count }}</td>
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="6" align="center">No books found</td>
            </tr>
        @endif
    </table>

    <br>

    @if ($books->count() > 0)
        <div>
            Page {{ $books->currentPage() }} of {{ $books->lastPage() }}
            <br>
            @if ($books->currentPage() > 1)
                <a href="{{ $books->previousPageUrl() }}">Previous</a> |
            @endif

            @if ($books->currentPage() < $books->lastPage())
                <a href="{{ $books->nextPageUrl() }}">Next</a>
            @endif
        </div>
    @endif
</body>

</html>
