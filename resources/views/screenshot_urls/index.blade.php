<!DOCTYPE html>
<html>
<head>
    <title>PowerBi screenshot URLs</title>
    <style>
        /* Reset and basic styles */
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f4f6f8;
            color: #333;
        }

        a {
            text-decoration: none;
            color: inherit;
        }

        /* Container */
        .container {
            margin: 40px auto;
            padding: 0 20px;
        }

        /* Header */
        header {
            text-align: center;
            margin-bottom: 40px;
        }

        header h1 {
            font-size: 2.5em;
            font-weight: bold;
            color: #2c3e50;
        }

        /* Alerts */
        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 5px;
            color: #fff;
        }

        .alert-success {
            background-color: #27ae60;
        }

        /* Form */
        .form-card {
            background-color: #fff;
            padding: 25px;
            border-radius: 8px;
            margin-bottom: 40px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .form-card h2 {
            font-size: 1.5em;
            margin-bottom: 20px;
            color: #34495e;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            font-weight: bold;
            margin-bottom: 8px;
            color: #555;
        }

        .form-group input {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccd1d9;
            border-radius: 4px;
            font-size: 1em;
            color: #555;
        }

        .form-group input:focus {
            border-color: #1abc9c;
            outline: none;
        }

        .form-group .error {
            color: #e74c3c;
            font-size: 0.9em;
            margin-top: 5px;
        }

        .btn {
            display: inline-block;
            background-color: #1abc9c;
            color: #fff;
            padding: 12px 20px;
            border-radius: 4px;
            font-size: 1em;
            font-weight: bold;
            cursor: pointer;
            border: none;
        }

        .btn:hover {
            background-color: #16a085;
        }

        /* Table */
        .table-card {
            background-color: #fff;
            padding: 25px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .table-card h2 {
            font-size: 1.5em;
            margin-bottom: 20px;
            color: #34495e;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table thead {
            background-color: #ecf0f1;
        }

        table th, table td {
            text-align: left;
            padding: 12px;
            border-bottom: 1px solid #e0e0e0;
            font-size: 1em;
        }

        table th {
            color: #555;
            font-weight: bold;
        }

        table tbody tr:hover {
            background-color: #f9f9f9;
        }

        .action-btn {
            background-color: transparent;
            color: #e74c3c;
            border: none;
            font-size: 1em;
            cursor: pointer;
        }

        .action-btn:hover {
            text-decoration: underline;
        }

        /* Responsive */
        @media (max-width: 600px) {
            .form-card, .table-card {
                padding: 15px;
            }

            header h1 {
                font-size: 2em;
            }

            .btn, .action-btn {
                width: 100%;
                text-align: center;
            }

            table th, table td {
                padding: 10px;
            }
        }
    </style>
</head>
<body>

    <div class="container">
        <header>
            <h1>PowerBi Screenshot URLs</h1>
        </header>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Add New URL Form -->
        <div class="form-card">
            <h2>Add New URL</h2>
            <form action="{{ route('screenshot_urls.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" name="name" id="name" required>
                    @error('name')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="url">URL:</label>
                    <input type="url" name="url" id="url" required>
                    @error('url')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn">Add URL</button>
            </form>
        </div>

        <!-- Existing URLs Table -->
        <div class="table-card">
            <h2>Existing URLs</h2>
            @if($urls->count())
                <table>
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>URL</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($urls as $url)
                            <tr>
                                <td>{{ $url->name }}</td>
                                <td>
                                    <a href="{{ $url->url }}" target="_blank">
                                        {{ Str::limit($url->url, 50) }}
                                    </a>
                                </td>
                                <td>
                                    <form action="{{ route('screenshot_urls.destroy', $url->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this URL?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="action-btn">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p>No URLs found.</p>
            @endif
        </div>
    </div>

</body>
</html>
