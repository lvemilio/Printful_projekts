<?php
    include "db.inc.php";
    if (isset($_GET['edit-todo'])){
        $e_id = $_GET['edit-todo'];
    }

    if (isset ($_POST['edit_todo'])){
        $edit_todo = $_POST['todo'];


        $query = "UPDATE todo SET t_name = '$edit_todo' WHERE t_id = $e_id"; // Maina darāmo lietu, nosūta datus uz datubāzi...//
        $run = mysqli_query($connection,$query);
        
        if(!run){
            die("Failed");

        }else{
            header("Location: index.php?updated");
        }


    }
    
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>To do app with php and mysql</title>
    <link rel="stylesheet" type="text/css" href = css/bootstrap.min.css>
    <style>
        .todo{
            display:flex;
            flex-direction:column;
            justify-content:center;
            align-items:center;
            border-radius: 3px;
            border: 1px solid #cccccc;
            margin-top: 5px;
        }
    </style>

</head>




<body>
    <div class="container">
        <div class="todo">
            <h1> Mans darāmo lietu sarkasts</h1>
            <h3>Rediģēt darāmo lietu...</h3>
            <form action="" method = "POST">
                <?php
                    $sql = "SELECT * FROM todo WHERE t_id = $e_id"; // Paņem jaunos mainītos datus un ievieto tos datubāzē
                    $result = mysqli_query($connection,$sql);
                    $data = mysqli_fetch_array($result);
                ?>
                <div class = "form-group">
                    <input type="text" class="form-control" type = "text" name="todo" placeholder="Darāmā lieta" 
                    value="<?php echo $data['t_name']; ?>" >
                </div>
                <div class="form-group">
                    <input class="btn btn-primary" value="Rediģēt"
                    type = "submit" name = "edit_todo">
                    </div>
            </form>
        </div>
</body>
</html>