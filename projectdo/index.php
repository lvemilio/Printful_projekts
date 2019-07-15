<?php
    include "db.inc.php";
   $query = "SELECT*FROM todo";
   $result = mysqli_query($connection, $query);

   if($_SERVER['REQUEST_METHOD']== 'POST'){
       $todo = $_POST['todo'];
       $date = date('d. m. Y');
    if (empty($todo)) {
        $error = "Lauciņš ir jāizpilda!"; // Ko programmai jādara, darāmās lietas lauks ir tukšs//
    }
    else{
       $sql = "INSERT INTO todo(t_name,t_date) VALUES('$todo','$date');";
       $results = mysqli_query($connection, $sql); // Vērtības tiek pievienotas datubāzei un programmai, kad tiek izveidota jauna darāmā lieta//

       if (!$results){
           die("Failed");

       }else{
           header("Location:index.php?todo-added");
       }
   }
   }
   if (isset($_GET['delete_todo'])){
           $dtl_todo = $_GET['delete_todo'];
           $sqli = "DELETE FROM todo WHERE t_id = $dtl_todo";//Ko darīt kad tiek nospiests "Dzēst"//
           $res = mysqli_query($connection,$sqli);
           if (!$res){
                die("Failed");
        }else{
            header("Location:index.php?todo-deleted");
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
        .search{
            margin:5px;
        }
    </style><!-- Stilizēšana -->

</head>




<body>
    <div class="container">
    <div class="todo">
        <h1>Mans darāmo lietu saraksts</h1>
        <h3>Pievienot jaunu darāmo lietu</h3>
        <?php 
            if (isset($error)){
                echo "<div class = 'alert alert-danger'>$error</div>";
            }
        ?>
        <form action="<?php echo $_SERVER['PHP_SELF'];?>" method = "POST">
            <div class = "form-group">
                    <input type="text" class="form-control" type = "text" name="todo" placeholder="Darāmā lieta..." > <!-- Vizuālais pamats pogām, meklēšanas kastēm, utt... -->
                </div>
                <div class="form-group">
                    <input class="btn btn-primary" value="Pievienot jaunu darāmo lietu"
                    type = "submit">
                    </div>
            </form>
        </div>
        <div class="col-lg-4 search">
            <form action="search.php" method="POST">
                <input class = "form-control" type = "text" name="search" placeholder="Meklēt...">
            </form>
        </div>
        <div class = "table-responsive col-lg-12">
            <table class="table table-bordered table-striped table-hover">
                <thead>
                    <th>Kārtas nr. </th>
                    <th>Darāmais</th>
                    <th>Pievienošanas datums</th>
                    <th>Rediģēt darāmo</th>
                    <th>Dzēst darāmo</th>
                </thead>
                <tbody>
                    <?php
                        while($row = mysqli_fetch_assoc($result)) {
                            $t_id = $row['t_id'];                       //Paņemt datus no datubāzes//
                            $t_name = $row['t_name'];
                            $t_date = $row["t_date"];
                            ?>


                    <tr>
                        <td><?php echo $t_id;?> <input type="checkbox" name="checkbox" id ="check1"><?php echo $_POST['txtCheck'];?> <?php if(isset($_POST['txtCheck'])) echo "checked='checked'"; ?>  <br /> <br> Pabeigts/Nepabeigts</br>  </td>   <!-- Darāmās lietas ievietotas programmā--> 
                        <td><?php echo $t_name;?></td> 
                        <td><?php echo $t_date;?></td> 
                        <td><a href="edit.php?edit-todo=<?php echo $t_id; ?>" class = "btn btn-primary"> Rediģēt darāmo</a></td> <!-- Ko rādīt kad ar pelīti pārbrauc pāri pogām -->
                        <td><a href="index.php?delete_todo=<?php echo $t_id;?>" class = "btn btn-danger"> Dzēst darāmo</a></td> 
                    </tr>
                            
                       <?php }
                        
                        ?>
                    
                </tbody>

        </div>

    </div>
</body>
</html>