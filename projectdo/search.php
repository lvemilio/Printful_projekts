<?php
    include "db.inc.php"; //Pievienots fails, kas savieno ar datubāzi
    if (isset($_POST['search'])){
        $search = $_POST['search'];
        $query = "SELECT * FROM todo WHERE t_name LIKE '%$search%'";// Meklēšana datubāzē
        $result = mysqli_query($connection,$query);
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
    </style> <!-- Stilizēšanas parametri -->
    

</head>




<body>
    <div class="container">
    <div class="todo">
        <h1><a href = "index.php">Mans darāmo lietu saraksts</a></h1>
        <h3>Meklēšana</h3>
        </div>
        <div class="col-lg-4 search">
            <form action="search.php" method="POST">
                <input class = "form-control" type = "text" name="search" placeholder="Meklēt...">
            </form>
        </div>
        <div class = "table-responsive col-lg-12">
            <table class="table table-bordered table-striped table-hover">
                <thead>
                    <th>Kārtas nr.</th>
                    <th>Darāmais</th>
                    <th>Pievienotais datums</th> <!-- Tabula, tās veidošana... -->
                    <th>Rediģēt darāmo</th>
                    <th>Dzēst darāmo</th>
                </thead>
                <tbody>
                    <?php
                        if(mysqli_num_rows($result)=== 0){
                            echo "<tr>";
                            echo "<tr></td>";
                            echo "<tr></td>";
                            echo "<tr><h1 style = 'text-centered'>Nav atrastas šādas darāmās lietas</h1></td>";
                            echo "<tr></td>";
                            echo "<tr></td>";  //Šeit tiek norādīts ko darīt, ja programma nevar atrast noteiktu darāmo lietu//
                            echo "<tr>";
                    }else{
                        while($row = mysqli_fetch_assoc($result)) {
                            $t_id = $row['t_id'];
                            $t_name = $row['t_name'];
                            $t_date = $row["t_date"];
                            ?>
                            
                           
                    <tr>
                        <td><?php echo $t_id;?><input type= "checkbox"> <br> Pabeigts/Nepabeigts</br> </td>   
                        <td><?php echo $t_name;?></td> <!-- Ko norādīt ja pele pārbrauc pāri pogām -->
                        <td><?php echo $t_date;?></td> 
                        <td><a href="edit.php?edit-todo=<?php echo $t_id; ?>" class = "btn btn-primary"> Edit Todo</a></td> 
                        <td><a href="index.php?delete_todo=<?php echo $t_id;?>" class = "btn btn-danger"> Delete Todo</a></td> 
                    </tr>
                            
                       <?php }}
                        
                        ?>
                    
                </tbody>

        </div>

    </div>
</body>
</html>