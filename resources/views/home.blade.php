@extends('layouts.app')

@section('title', 'BIENVENIDO')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilos.css">
    <!--Icon-Font-->
    <script src="https://kit.fontawesome.com/eb496ab1a0.js" crossorigin="anonymous"></script>
    <!-- <title>Document</title> -->
</head>
<body>
    <style>
        *{
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}
#btn-mas{
    display: none;
}
.container{
    
    bottom: 20px;
    right: 20px;
}
.redes a, .btn-mas label{
    display: block;
    text-decoration: none;
    background: #736D6C;
    color: #fff;
    width: 55px;
    height: 55px;
    line-height: 55px;
    text-align: center;
    border-radius: 50%;
    box-shadow: 0px 1px 10px rgba(0,0,0,0.4);
    transition: all 500ms ease;
}
.redes a:hover{
    background: #fff;
    color: #736D6C;
}
.redes a{
    margin-bottom: -10px;
    opacity: 0;
    visibility: hidden;
}
#btn-mas:checked~ .redes a{
    margin-bottom: 10px;
    opacity: 1;
    visibility: visible;
}
.btn-mas label{
    cursor: pointer;
    background: #0099FF;
    font-size: 10px;
}
#btn-mas:checked ~ .btn-mas label{
    transform: rotate(135deg);
    font-size: 25px;
}
    </style>
    <div class="container">
        <input type="checkbox" id="btn-mas">
        <div class="redes">
            <!-- <a href="#" class="fa fa-facebook"></a> -->
            <!-- <a href="#" class="fa fa-youtube"></a> -->
            <!-- <a href="#" class="fa fa-twitter"></a> -->
            <!-- <a href="#" class="fa fa-pinterest"></a> -->
            <a href="https://api.whatsapp.com/send?phone=9983887612" class="fa fa-whatsapp"></a>
        </div>
        <div class="btn-mas">
            <label for="btn-mas" class="fa fa-plus"></label>
        </div>
    </div>
</body>
</html>
@endsection