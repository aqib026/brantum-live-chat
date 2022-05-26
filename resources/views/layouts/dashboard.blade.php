<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" />
    <!-- CSS only -->
    <link rel="stylesheet" href="{{ asset('') }}assets/lib/bootstrap/css/bootstrap.min.css">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script>
        window.auth = {!!auth()->user()!!}
    </script>
    <link rel="stylesheet" href="{{ asset('') }}assets/css/style.css">
    <title>Chat Dashboard</title>
</head>

<body class="p-0">
    <div id="app">
        <!-- Dashboard -->
        @yield('content')
        <!-- End Dashboard -->
    </div><!-- Page Wrapper -->
    <!-- js files -->
    <script src="{{ mix('js/app.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('') }}assets/js/jquerry.min.js">
    <!-- JavaScript Bundle with Popper -->
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
       >
    </script>
    <link rel="stylesheet" href="{{ asset('') }}assets/lib/bootstrap/js/bootstrap.bundle.min.js">
    <link rel="stylesheet" href="{{ asset('') }}assets/js/app.js">



</body>

</html>
