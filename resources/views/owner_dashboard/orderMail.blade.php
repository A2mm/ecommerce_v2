<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>LuxGems</title>
    <link href="https://fonts.googleapis.com/css?family=Cairo" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <style>body{font-family: "Cairo", sans-serif;}</style>
  </head>
  <body style="margin: 0;">
    <article class="" style="background-image: url('https://luxgems.co.uk/layouts/images/mail.png'); background-size: cover; background-position: center; text-align: center">
      <div style="background-color: rgba(255, 255, 255, .6); padding: 20px 10px; border-bottom: 5px solid #226f37; box-shadow: 0px 3px 5px #eee; color: #226f37">
        <img src="https://luxgems.co.uk/layouts/images/lux-new-logo.png" style="width:150px" alt="">
        <h1 style="font-weight: bold">LuxGems Shop Order Mail</h1>
      </div>
    </article>
    <section style="background-color: #eee; padding: 30px 0; margin: auto">
      <div style="margin: 10px auto; width: 80%; background-color: #fff; padding: 20px 10px; border-radius: 5px; box-shadow: 3px 3px 5px #bbb; text-align: center">
        <h1>Luxgems reminds you if you still interested in this products </h1>
        <table class="table table-bordered table-striped dataTable no-footer">
          <thead>
            <tr>
              <th scope="col">Product Name</th>
              <th scope="col">Product Price</th>
            </tr>
          </thead>
          <tbody>
            @foreach($products as $product)
            <tr>
              <td><a href="{{route('manage.products.view',['id' => $product->id])}}" class="btn btn-xs btn-primary">{{$product->name}}</a></td>
              <td>{{$product->price}}</td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </section>
    <footer style="background-color: #226f37; color: #eee; text-align: center; padding: 20px 0">
      <a href="https://luxgems.co.uk" style="color: #eee">luxgems.co.uk</a>
      <p>All Rights Reserved To LuxGems Shop  2019</p>
      <a href="https://www.facebook.com/LuxGemsUK/" style="color: #eee"><i class="fab fa-facebook-f" style="margin: 0 5px;"></i></a>
      <a href="https://twitter.com/LuxGemsUK/" style="color: #eee"><i class="fab fa-twitter" style="margin: 0 5px;"></i></a>
      <a href="https://wa.me/+0201066240101" style="color: #eee"><i class="fab fa-whatsapp" style="margin: 0 5px;"></i></a>
    </footer>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>
