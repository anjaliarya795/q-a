<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a href="" class="navbar-brand">Feel Free</a>

            <ul class="navbar-nav ml-auto">
                <li class="nav-item"><a href="index.php" class="nav-link">Home</a></li>

                <?php
                    if(isset($_SESSION['user'])):?>
                <li class="nav-item"><a href="#insert" data-bs-toggle="modal" class="nav-link">Ask Question</a></li>
                <li class="nav-item"><a href="logout.php" class="nav-link">Logout</a></li>
                <?php else:?>

                <li class="nav-item"><a href="login.php" class="nav-link">Login</a></li>
                <li class="nav-item"><a href="signup.php" class="nav-link">Register</a></li>

                <?php endif;?>
            </ul>
        </div>
    </nav> 

    <div class="modal fade" id="insert">
        <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-body">
                            <form action="" method="post">
                                <div class="mb-3">
                                    <label for="">Title</label>
                                    <input type="text" class="form-control" name="title">
                                </div>
                                <div class="mb-3">
                                    <label for="">Content</label>
                                    <textarea rows="10" class="form-control" name="content"></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="">Category</label>
                                    <select name="category" id="" class="form-control">
                                        <option value="">Select Category</option>
                                        <?php
                                            $callingCat = $datawork->getData("select * from category");
                                            foreach($callingCat as $cat):
                                        ?>
                                        <option value="<?=$cat['cat_id'];?>"><?=$cat['title'];?></option>
                                        <?php endforeach;?>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <input type="submit" class="btn tbn-success w-100" name="insert">
                                </div>
                            </form>
                        </div>
                    </div>
        </div>
    </div>

    <?php
        if(isset($_POST['insert'])){

            $data = [
                'q_title' => $_POST['title'],
                'q_content' => $_POST['content'],
                'q_by' => $datawork->getUserId(),
                'q_status' => 1,
                'cat_id' => $_POST['category']

            ];
        
            $datawork->insertData("questions",$data);
        
        }
    ?>

    