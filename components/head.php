<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>RoboCupJunior registratiesysteem</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">    <link rel="stylesheet" href="css/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
<div class="container mt-5">

<?php if(isset($_SESSION["admin"]) && $_SESSION["admin"]){ ?>
    <div class="alert alert-primary" role="alert">
        u bevind zich in de administratie omgeving
    </div>
<?php } ?>


<a href="/">home</a>