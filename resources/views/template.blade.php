<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TEMPLATE PAGE</title>
  </head>
  <body>
    @foreach($templates as $template)

    <h6> {{$template->description}} </h6>
    <img src="{{$template->photo}}"/>
    @endforeach
  </body>
</html>