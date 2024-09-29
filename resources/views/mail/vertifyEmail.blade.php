<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h2>XIN CHÀO {{$username}}</h2>
    <p>Cảm ơn bạn đã đăng ký thành công tài khoản mua hàng của ThanhTungStore
       Mời bạn xác thực tài khoản để tiếp tục sử dụng các tính năng trên hệ thống
    </p>
    <button>
        <a href="http://asigment.test:8888/auth/vertify/{{$token}}"></a>
    </button>
</body>
</html>