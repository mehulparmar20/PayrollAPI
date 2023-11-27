<html>
  <head>
    <title>Checkout</title>
  </head>
  <body>
    <form action="{{route('create_concted_account.index')}}" method="POST">
        @csrf
      <button type="submit">Checkout</button>
    </form>
  </body>
</html>