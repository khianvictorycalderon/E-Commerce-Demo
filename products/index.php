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
    
        session_start();

        if (!isset($_SESSION["user_id"])) {
            header("Location: /login.php");
            exit();
        }

        $signed_user = $_SESSION["user_id"];

    ?>

  </body>
</html>