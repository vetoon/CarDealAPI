<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>
<body>
    <script> swal("Car is updated successfully!", "", "success");
    </script>
    <?php
    header('Refresh: 2; URL=http://localhost:3000/updateCar');
    ?>
</body>
</html>