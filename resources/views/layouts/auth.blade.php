<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{ $title ?? ''}}</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="{{mix("css/app.css")}}" />
  <style>
    div.error{
        color: #f55;
    }
  </style>
</head>
<body class="hold-transition login-page">
@yield("container")
<script src="{{ mix('js/app.js') }}"></script>
</body>
</html>