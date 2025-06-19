<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Support Form</title>
  <style>
    @import url(https://fonts.googleapis.com/css?family=Open+Sans:400italic,400,300,600);

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-weight: 300;
      font-size: 12px;
      line-height: 30px;
      color: #272727;
      background: #fdc5d2;
    }

    .container {
      max-width: 400px;
      width: 100%;
      margin: 0 auto;
      position: relative;
    }

    #contact input, textarea {
      font: 400 12px/16px;
      width: 100%;
      border: 1px solid #CCC;
      background: #FFF;
      margin: 10 5px;
      padding: 10px;
      border-radius: 10px;
    }

    h1 {
      margin-bottom: 30px;
      font-size: 30px;
    }

    #contact {
      background: #F9F9F9;
      padding: 25px;
      margin: 50px 0;
      border-radius: 15px;
    }

    fieldset {
      border: medium none !important;
      margin: 0 0 10px;
      min-width: 100%;
      padding: 0;
      width: 100%;
    }

    textarea {
      height: 100px;
      max-width: 100%;
      resize: none;
      width: 100%;
    }

    button {
      cursor: pointer;
      width: 100%;
      border: none;
      background: #fdc5d2;
      color: black;
      margin: 0 0 5px;
      padding: 10px;
      font-size: 20px;
      border-radius: 10px;
    }

    button:hover {
      background-color: #fdc7f4;
    }

    .message-container {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 50px;
    }

    .message {
        text-align: center;
        background-color: lightgreen; 
        padding: 20px;
        border-radius: 5px;
        font-size: 18px; 
        font-weight: bold; 
    }

    .back-button {
      font-size: 16px;
      padding: 8px;
      text-decoration: none; 
      color: black; 
      display: inline-block;
    }
    
    .back-button:hover {
      color: gray;
      text-decoration: none; 
      background: #fdc5d2;
    }
  </style>
</head>

<body>
  <div class="container">
    @if(session('success'))
    <div class="message-container">
        <div class="message">
            {{ session('success') }}
        </div>
    </div>
    @endif
    @if(session('error'))
    <div class="message-container">
        <div class="message">
            {{ session('error') }}
        </div>
    </div>
    @endif
    <form id="contact" action="{{ route('support.send') }}" method="post">
      @csrf
      <h1>Liên hệ hỗ trợ</h1>

      <fieldset>
        <input placeholder="Họ tên" name="name" type="text" tabindex="1" autofocus>
      </fieldset>
      <fieldset>
        <input placeholder="Email" name="email" type="email" tabindex="2">
      </fieldset>
      <fieldset>
        <input placeholder="Tiêu đề" type="text" name="subject" tabindex="4">
      </fieldset>
      <fieldset>
        <textarea name="message" placeholder="Vấn đề bạn cần hỗ trợ" tabindex="5"></textarea>
      </fieldset>

      <fieldset>
        <button type="submit" name="send" id="contact-submit">Xác nhận</button>
      </fieldset>
    </form>

    <button class="back-button"><a href="{{ route('products.index') }}" class="back-button">Quay lại trang chủ</a></button>
    
  </div>
</body>

</html>
