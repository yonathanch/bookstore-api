<!DOCTYPE html>
<html>

<head>
    <title>Input Rating</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        .form-container {
            max-width: 500px;
            margin: 0 auto;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        button {
            width: 100%;
            padding: 12px;
            background: #28a745;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
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
    <h1>Insert Rating</h1>

    <div class="nav-links">
        <a href="/books">Book List</a>
        <a href="/authors/top">Top Authors</a>
        <a href="/ratings/create">Input Rating</a>
    </div>

    <div class="form-container">

        <form method="GET" action="{{ route('ratingsCreate') }}">
            <div class="form-group">
                <label>Book Author:</label>
                <select name="author_id" required onchange="this.form.submit()">
                    <option value="">Select Author</option>
                    @foreach ($authors as $author)
                        <option value="{{ $author->id }}" {{ request('author_id') == $author->id ? 'selected' : '' }}>
                            {{ $author->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </form>


        @if (request('author_id'))
            <form method="POST" action="{{ route('ratingsStore') }}">
                @csrf
                <input type="hidden" name="author_id" value="{{ request('author_id') }}">

                <div class="form-group">
                    <label>Book Name:</label>
                    <select name="book_id" required>
                        <option value="">Select Book</option>
                        @php
                            $authorBooks = \App\Models\Book::where('author_id', request('author_id'))->get();
                        @endphp
                        @foreach ($authorBooks as $book)
                            <option value="{{ $book->id }}">
                                {{ $book->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>Rating:</label>
                    <select name="rating" required>
                        <option value="">Select Rating</option>
                        @for ($i = 1; $i <= 10; $i++)
                            <option value="{{ $i }}">{{ $i }}</option>
                        @endfor
                    </select>
                </div>

                <button type="submit">SUBMIT RATING</button>
            </form>
        @else
            <div style="text-align: center; color: #666; margin-top: 20px;">
                Please select an author first to see their books
            </div>
        @endif
    </div>
</body>

</html>
