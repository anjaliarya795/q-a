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

<div class="container-fluid py-5 bg-info">
    <div class="container mx-auto">
        <div class="row">
            <div class="col-lg-6 mx-auto text-center">
            <h1 class="display-2">Search Any question</h1>
                <form action="search.php">
                    <input type="text" size="30" name="search" class="form-control form-control-lg" placeholder="Search here">
                    <input type="submit" value="Search" class="btn btn-dark btn-lg mt-2">
                </form>
            </div>
        </div>
    </div>
</div>


    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3">
                <div class="list-group">
                <?php
                    $callingCat = $datawork->getData("select * from category");
                    foreach($callingCat as $cat): ?>
                
                    <a href="search.php?cat_id=<?= $cat['cat_id'];?>" class="list-group-item list-group-item-action"><?= $cat['title'];?></a>
                    <?php
                        endforeach;
                    ?>
                </div>
            </div>
            <div class="col-lg-9">
                <h2>All questions here</h2>

                <div class="row">
                    <div class="col-6">
                        <div class="card border shadow border-primary small">
                            <div class="card-header bg-primary text-white">Latest Questions</div>
                            <div class="card-body">
                                <?php
                                    $calling_latest = $datawork->getData("select * from questions JOIN accounts ON questions.q_by = accounts.id");
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
                    <div class="col-6">
                        <div class="card shadow border border-success small">
                            <div class="card-header bg-success text-white">Unanswered Questions</div>
                            <div class="card-body">
                                <?php
                                    $calling_latest = $datawork->getData("select * from questions JOIN accounts ON questions.q_by = accounts.id");
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
            </div>
        </div>
    </div>
    <?php include "include/footer.php"?>

</body>
</html>