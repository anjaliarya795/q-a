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


<?php
if(!isset($_GET['id'])){
    $datawork->redirect();
}
    $id = $_GET['id'];
    $value = $datawork->getData("select * from questions where q_id='$id'");
?>
<div class="container mt-5">
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <h2><?= $value[0]['q_title'];?></h2>
                    <p class="">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quidem inventore modi exercitationem cupiditate sint itaque soluta, eum in repellendus sequi similique perferendis est molestiae. Nulla unde fuga quam cum quidem?</p>
                </div>
                <div class="card-footer">
                    <div class="card">
                    <div class="card-header"><h5>All answers</h5></div>
                    <?php
                        $callingAns = $datawork->getData("select * from answers JOIN accounts ON accounts.id = answers.answer_by where answers.q_id='$id'");
                        foreach($callingAns as $ans):
                    ?>
                    <div class="list-group">
                    
                        <a href="#" class="list-group-item list-group-item-action action" aria-current="true">
                            <div class="d-flex w-100 justify-content-between">

                            <h5 class="mb-1"><?=$ans['name'];?></h5>
                            <small><?=$ans['answer_doc'];?></small>
                            </div>
                            <p class="mb-1"><?=$ans['a_content'];?></p>
                        </a>
                        <?php
                            endforeach;
                        ?>                      
                    </div>
                    <?php
                        if(isset($_SESSION['user'])):
                        ?>
                    <form action="" method="post">
                        <div class="mb-3">
                            <input type="text" name="a_content" placeholder="write your answer" class="form-control">
                        </div>
                        <div class="mb-3">
                            <input type="submit" value="submit answer" name="send_answer" class="btn btn-success float-end">
                        </div>
                    </form>

                    <?php
                        if(isset($_POST['send_answer'])){
                        $data = [
                            'answer_by' => $datawork->getUserId(),
                            'q_id' => $_GET['id'],
                            'a_content' => $_POST['a_content'],
                        ];
                        $datawork->insertData('answers',$data,'view.php?id='.$_GET['id']);
                    }
                    ?>
                    <?php
                        else:
                    ?>

                    <div class="card">
                            <div class="card-body">
                                <h2 class="text-muted p-3">Login to answer this question</h2>
                            </div>
                    </div>
                    <?php
                        endif;
                    ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
        <?php
                $calling_latest = $datawork->getData("select * from questions JOIN accounts ON questions.q_by = accounts.id where questions.q_id != '$id'");
                foreach($calling_latest as $data):
            ?>


            <div class="d-flex card p-2 mb-2">
                    <div class="col-7"><a href ="view.php?id=<?= $data['q_id'];?>" class="text-dark nav-link m-0 p-0"><?=$data['q_title'];?></a></div>
            </div>

            <?php endforeach;?>
        </div>
    </div>
</div>

<?php include "include/footer.php"?>

</body>
</html>