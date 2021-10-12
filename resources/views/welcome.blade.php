<!doctype html>
<html>
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <!-- ... -->
</head>
<body>
<div class="shadow-sm bg-white rounded-lg h-18">
    @if (session()->has('error_string'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert" id="errorStringMessage">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h4><i class="icon fa fa-ban"></i> Whoops!</h4>
            <hr>
            Please fix following problem(s)
            <ul style="margin-top: 10px">
                <li>{{ session()->get('error_string') }}</li>
            </ul>
        </div>
    @endif

    <a href="{{route('auth.fb_redirect')}}" class="w-1/2 flex items-center justify-center rounded-full bg-blue-500 text-white" type="submit">Sign In With Facebook</a>
</div>
</body>
</html>
