<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <title>Leaderboard</title>
</head>

<body>
    <div class="container">
        <h3 class="text-muted">Leaderboard</h3>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Position</th>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Total Comissions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($topFive as $i => $affiliate)
                    <tr>
                        <td>{{$i}}</td>
                        <td>{{$affiliate['id']}}</td>
                        <td>{{$affiliate['first_name']}} {{$affiliate['last_name']}}</td>
                        <td>{{$affiliate['totals']['order_total']}}</td>
                    </tr>
                        
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
