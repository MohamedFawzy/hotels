<!DOCTYPE html>
<html>
<head>
    <title>Application</title>
    <link rel="stylesheet" type="text/css" href="{{asset('css/app.css')}}">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
<div class="container">
    <div id="app">
        <router-view name="hotelsIndex"></router-view>
        <router-view></router-view>
    </div>
</div>
</body>
<script type="text/javascript" src="{{asset('js/app.js')}}"></script>
</html>