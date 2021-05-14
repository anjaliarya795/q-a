<?php include "include/config.php";
    if(isset($_SESSION['user'])){
        $datawork->redirect();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
    <?php include "include/header.php";?>

    <div class="container mt-5">
        <div class="row mt-5">
            <div class="col-lg-6 mx-auto card mt-5 shadow-lg">
            <h2 class="mx-auto mb-3">Fill this form to create your account</h2>
                <form action="" method="post">
                    <div class="mb-3">
                        <label for="">Name</label>
                        <input type="text" name="name" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="">Contact</label>
                        <input type="text" name="contact" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="">Email</label>
                        <input type="email" name="email" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="">Password</label>
                        <input type="password" name="password" class="form-control">
                    </div>
                    <div class="mb-3 d-flex justify-content-center">
                        <input type="submit" name="create" class="btn btn-info">
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>

<?php

if(isset($_POST['create'])){

    $data = [
        'name' => $_POST['name'],
        'contact' => $_POST['contact'],
        'email' => $_POST['email'],
        'password' => sha1($_POST['password'])
    ];

    $datawork->insertData("accounts",$data);

}
    
?>

