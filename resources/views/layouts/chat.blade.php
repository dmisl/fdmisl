<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('chat.title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-uWxY/CJNBR+1zjPWmfnSnVxwRheevXITnMqoEIeG1LJrdI0GlVs/9cVSyPYXdcSF" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-kQtW33rZJAHjgefvhyyzcGF3C5TFyBQBA13V1RKPf4uH+bwyzQxZ6CmMZHmNBEfJ" crossorigin="anonymous"></script>
    <style>
        .main_container {
            width: 50vh;
        }

        main {
            background-color: rgb(241, 243, 248);
        }

        .navbar-img {
            width: 25px;
        }

        .bg-grey {
            background-color: rgb(241, 243, 248);
        }

        .nav-item:hover {
            background-color: rgb(221, 223, 230);
            transition: 0.3s;
        }

        .nav-item {
            transition: 0.3s;
        }

        .changeAvatar {
            cursor: pointer;

        }

        .chat {
            width: 70%;
            height: 500px;
            background-color: rgb(214, 206, 211);
        }

        .users {
            height: 500px;
            width: 30%;
            overflow: auto;
        }

        .user {
            width: 100%;
            background-color: rgb(241, 243, 248);
            height: 100px;
        }

        .user img {
            margin-top: 12.5px;
            margin-left: 10px;
        }

        .chat-title
        {
            height: 50px;
            width: 100%;
            background-color: rgb(241, 243, 248);
        }
        .chat-messages
        {
            height:400px;
            width:100%;
            overflow: auto;
        }
        .chat-input
        {
            height:50px;
            width:100%;
        }
        .message
        {
            width: 40%;
            word-wrap: break-word;
        }
        .message img
        {
            width: 100%;
        }
    </style>
</head>

<body>
    @include('includes.header')
    <x-container style="width: 60vw;" class="bg-grey mt-3 px-0 border">
        <div class="d-flex">
            @yield('chat.content')
        </div>
    </x-container>
</body>

</html>