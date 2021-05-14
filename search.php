<?php include "include/config.php"; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
</head>
<body>
    
<?php include "include/header.php";?>

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">

                <div class="row">
                    <div class="col-8 mx-auto">
                        
                                <?php
                                if(isset($_GET['search'])){
                                $search = $_GET['search'];
                                    $calling_latest = $datawork->getData("select * from questions JOIN accounts ON questions.q_by = accounts.id where questions.q_title LIKE '%$search%'");
                                
                                }

                                elseif(isset($_GET['cat_id'])){
                                $cat_id = $_GET['cat_id'];
                                $calling_latest = $datawork->getData("select * from questions JOIN accounts ON questions.q_by = accounts.id where questions.cat_id='$cat_id'");
                                }
                                    
                                
                                foreach($calling_latest as $data):
            
                                ?>

                                <div class="row">
                                        <div class="col-2"><?= $data['name'];?></div>
                                        <div class="col-7"><a href="view.php?id=<?= $data['q_id'];?>" class="text-dark nav-link m-0 p-0"><?=$data['q_title'];?></a></div>
                                        <div class="col-3"><?=date("d M Y",strtotime($data['q_doc']));?></div>
                                </div>

                                <?php endforeach;?>
                            

                </div>
            </div>
        </div>
    </div>
    <?php include "include/footer.php"?>

</body>
</html>