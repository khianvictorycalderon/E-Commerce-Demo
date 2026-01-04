<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" href="/images/e-commerce-demo.png">

    <script src="/assets/tailwind-3.4.17.js"></script>
    <script type="module" src="/assets/main.js"></script>
    
    <title>Browse Products</title>
  </head>
  <body>

    <?php

        // Mocking data if user is signed in
        $is_user_signed_in = false;

        // Redirect user to login page if no one is signed in
        if (!$is_user_signed_in) {
            header("Location: /login");
            exit;
        }

    ?>

  </body>
</html>