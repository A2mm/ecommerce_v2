<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <form action="https://sandbox.cashu.com/cgi-bin/payment/pcashu.cgi"method="post">
      <input type="hidden" name="Transaction_Code" value="{{$Transaction_Code}}">
      <input type="submit" name="but" value="Pay with cashU!">
    </form>
  </body>
</html>
