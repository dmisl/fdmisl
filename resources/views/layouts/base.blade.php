<!DOCTYPE html>
<html lang="en">
    
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-uWxY/CJNBR+1zjPWmfnSnVxwRheevXITnMqoEIeG1LJrdI0GlVs/9cVSyPYXdcSF" crossorigin="anonymous">
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-kQtW33rZJAHjgefvhyyzcGF3C5TFyBQBA13V1RKPf4uH+bwyzQxZ6CmMZHmNBEfJ" crossorigin="anonymous"></script>
    <style>
        .main_container
        {
            width: 50vh;
        }
        main
        {
            background-color: rgb(241, 243, 248);
        }
        .navbar-img
        {
            width: 25px;
        }
        .bg-grey
        {
            background-color: rgb(241, 243, 248);
        }
        .nav-item:hover
        {
            background-color: rgb(221, 223, 230);
            transition: 0.3s;
        }
        .nav-item
        {
            transition: 0.3s;
        }
        .changeAvatar
        {
            cursor: pointer;

        }
    </style>
</head>

<body>
    <div class="d-flex flex-column justify-content-between min-vh-100">
        @include('includes.header')
        <main class="flex-grow-1">
            @yield('content')
        </main>
    </div>
</body>

</html>
</head>
<body> 
<script type="text/javascript">
    var path = "{{ route('autocomplete') }}";
    $('input.search').typeahead({
        source:  function (str, process) 
        {
          return $.get(path, { str: str }, function (data) {
                return process(data);
            });
        }
    });
</script>   