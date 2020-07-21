<?php

if(isset($_POST['search']))
{
    $valueToSearch = $_POST['valueToSearch'];
    $sql = "SELECT * FROM student WHERE 1=1";

if (!empty($valueToSearch)) $sql .= " AND classroom = '$valueToSearch'";

    $query = "SELECT * FROM `data` WHERE (`classroom`) LIKE '%".$valueToSearch."%'";
    
    $search_result = filterTable($query);
   // printf("Error: %s\n", ($search_result));
    //exit();
    
}
 else {
    
    //exit();
    $query = "SELECT * FROM `data`";
    $search_result = filterTable($query);
}

// function to connect and execute the query
function filterTable($query)
{
    $connect = new mysqli("localhost","ray","password","reports")or die(mysqli_error($mysqli));
    $filter_Result = mysqli_query($connect, $query);
    printf("Error: %s\n", (filter_Result));
    return $filter_Result;
}

?>

<!DOCTYPE html>
<html>
    <head>
        <title>PHP Search</title>
        <style>
            table,tr,th,td
            {
                border: 1px solid black;
            }
        </style>
    </head>
    <body>
        
        <form action="filtered.php" method="post">
            <input type="text" name="valueToSearch" placeholder="Value To Search"><br><br>
            <input type="submit" name="search" value="Filter Button"><br><br>
            
            <table>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>class</th>
                    <th>time</th>
                   
                </tr>

      <!-- populate table from mysql database -->
                <?php while($row = mysqli_fetch_array($search_result)):?>
                <tr>
                    <td><?php echo $row['id'];?></td>
                    <td><?php echo $row['name'];?></td>
                    <td><?php echo $row['classroom'];?></td>
                    <td><?php echo $row['classtime'];?></td>
                </tr>
                <?php endwhile;?>
            </table>
        </form>
        
    </body>
</html>

