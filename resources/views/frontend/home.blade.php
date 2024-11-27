<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Home</title>


</head>
<body class="font-sans antialiased dark:bg-black dark:text-white/50">


<h1>Wellcome Home</h1>

<form action="{{route('staff.store')}}" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="file" name="image">
    <input type="submit">

</form>


</body>
</html>
