<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <title>index</title>

    <!-- style -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <!-- script -->
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <main id="management">
        <div class="container">
            <div class="card p-4 m-4">
                <h1 class="text-center"><a href="company/management.php">企業側</a></h1>
                <h1 class="text-center"><a href="public/top.php">サイト</a></h1>
                <?= $_SERVER['HTTP_HOST'] ?>
            </div>
        </div>
    </main>
</body>

</html>