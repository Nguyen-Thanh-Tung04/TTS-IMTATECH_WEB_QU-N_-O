<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Xác Nhận Đơn Hàng</title>
  <link rel="stylesheet" href="styles.css"> </head>
  <style>
    .container {
  max-width: 600px;
  margin: 0 auto;
  padding: 20px;
  background: #f9f9f9;
  border-radius: 5px;
}

.title {
  color: #333;
}

.button-container {
  text-align: center;
  margin-top: 20px;
}

.confirm-button {
  display: inline-block;
  padding: 10px 20px;
  background: #007bff;
  color: #fff;
  text-decoration: none;
  border-radius: 5px;
}

  </style>
<body>
  <div class="container">
    <h2 class="title">Xin chào, {{$username}}!</h2>
    <p>Cảm ơn bạn đã đặt hàng tại cửa hàng chúng tôi.</p>
    <p>Vui lòng xác nhận đơn hàng bằng cách nhấp vào nút bên dưới:</p>
    <div class="button-container">
      <a href="http://asigment.test:8888/auth/verify/{{$token}}" class="confirm-button">Xác Nhận Đơn Hàng</a>
    </div>
    <p>Nếu bạn không thực hiện hành động này, vui lòng bỏ qua email này.</p>
  </div>
</body> 
</html>
