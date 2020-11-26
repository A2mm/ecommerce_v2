<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Royalpos</title>
    <link href="https://fonts.googleapis.com/css?family=Cairo" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
    <style>body{font-family: "Cairo", sans-serif;}</style>
  </head>
  <body style="margin: 0;">
    <article class="" style="background-image: url('https://luxgems.co.uk/layouts/images/mail.png'); background-size: cover; background-position: center; text-align: center">
      <div style="background-color: rgba(255, 255, 255, .6); padding: 20px 10px; border-bottom: 5px solid #226f37; box-shadow: 0px 3px 5px #eee; color: #226f37">
        <img src="http://134.209.231.86/royalpos/layouts/images/logo.png" style="width:150px" alt="">
        <h1 style="font-weight: bold">Royalpos Shop Update profile</h1>
      </div>
    </article>
    <section style="background-color: #eee; padding: 30px 0; margin: auto">
      <div style="margin: 10px auto; width: 80%; background-color: #fff; padding: 20px 10px; border-radius: 5px; box-shadow: 3px 3px 5px #bbb; text-align: center">
        <h1>Update your profile code is</h1>
        <mark style="padding: 5px; font-weight: bold">{{$code}}</mark>
        <p>Please Click On This link <a href="{{url('/updateVerify/'.$code)}}" style="color: #226f37">{{url('/updateVerify/'.$code)}}</a>to update your account.';</p>
      </div>
    </section>
    <footer style="background-color: #226f37; color: #eee; text-align: center; padding: 20px 0">
      <a href="https://luxgems.co.uk" style="color: #eee">royalpos.co.uk</a>
      <p>All Rights Reserved To Royalpos Shop  2019</p>
      <a href="https://www.facebook.com/LuxGemsUK/" style="color: #eee"><i class="fab fa-facebook-f" style="margin: 0 5px;"></i></a>
      <a href="https://twitter.com/LuxGemsUK/" style="color: #eee"><i class="fab fa-twitter" style="margin: 0 5px;"></i></a>
      <a href="https://wa.me/+0201066240101" style="color: #eee"><i class="fab fa-whatsapp" style="margin: 0 5px;"></i></a>
    </footer>
  </body>
</html>
