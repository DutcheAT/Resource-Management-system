
<?php
   ob_start();?>
<!--<?php include 'db.php';?>-->
<div class="col-md-4">

      <!-- loging for form -->
<div class="well">
        
        <h4>login</h4>
        <form method="post" action="" method="post">
        <form id="login" method="post" action="sidebar.php">  
    <?php if (isset($_GET['error'])) { ?>

<p class="error"><?php echo $_GET['error']; ?></p>

<?php } ?> 
        <div class="form-group">
            <input type="text" class="form-control" name='firstname' placeholder="Name" required>
        </div>
            <div class="input-group">
                        <input type="password" class="form-control" name='password' placeholder="enter password" required>

            <span class="input-group-btn">
            <button class="btn btn-primary" type="submit" name='submit'>
                   login
                   </button>
            </span>
        </div>
    </form>
  
<?php 


if (isset($_POST['firstname'])){
echo "is seeted ";
//include 'verification.php';


echo "already in verifing page";
session_start(); 

$connection=mysqli_connect('localhost','root','','project');

if (isset($_POST['firstname']) && isset($_POST['password'])) {
   
    function validate($data){

       $data = trim($data);

       $data = stripslashes($data);

       $data = htmlspecialchars($data);

       return $data;

    }

    $name = validate($_POST['firstname']);

    $pass = validate($_POST['password']);

    if (empty($name)) {

        header("Location: index.php?error=User Name is required");

        exit();

    }else if(empty($pass)){

        header("Location: index.php?error=Password is required");

        exit();

    }else{

        $sql = "SELECT * FROM users WHERE name='$name' AND password='$pass'";

        $result = mysqli_query($connection, $sql);

        if (mysqli_num_rows($result) === 1) {

            $row = mysqli_fetch_assoc($result);
            print_r($result);
            if ($row['name'] === $name && $row['password'] === $pass) {

                echo "Logged in!";

                $_SESSION['user_name'] = $row['user_name'];

                $_SESSION['name'] = $row['name'];

                $_SESSION['id'] = $row['id'];

                //header("Location: includes/secondpage.php");

                exit();

            }else{

                header("Location: index.php?error=Incorect User name or password");

                exit();

            }

        }else{

            header("Location: index.php?error=Incorect User name or password");

            exit();

        }

    }

}else{

    header("Location: index.php");

    exit();
}
}
?>



        <!-- searching for form -->
    </div>
    <!-- Blog Search Well -->
    
    <div class="well">
        
        <h4>services blog</h4>
        <form method="post" action="search.php">
        <div class="input-group">
            <input type="text" class="form-control" name='search'>
            <span class="input-group-btn">
                <button class="btn btn-default" type="submit" name='submit'>
                    <span class="glyphicon glyphicon-search"></span>
            </button>
            </span>
        </div>
    </form>
        <!-- searching for form -->
    </div>

    <!-- Blog Categories Well -->
    <div class="well">
        <h4>Blog Categories</h4>
        <div class="row">
            <div class="col-lg-6">
                <ul class="list-unstyled">
                    <?php
                    $query="SELECT * FROM catagories";
                    $selecting_catagories=mysqli_query($connection,$query);
                    while($row=mysqli_fetch_assoc($selecting_catagories)){
                        $cat_title=$row['cat_title'];
                        echo "<li><a href='#'>{$cat_title}</a></li>";
                    }
                    ?>
                    
                </ul>
            </div>

            <!-- /.col-lg-6 -->
         
            <!-- /.col-lg-6 -->
        </div>
        <!-- /.row -->
    </div>

    <!-- Side Widget Well -->
    <div class="well">
        <h4>Side Widget Well</h4>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Inventore, perspiciatis adipisci accusamus laudantium odit aliquam repellat tempore quos aspernatur vero.</p>
    </div>

</div>