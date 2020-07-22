<?php

if(isset($_POST['search']))
{
    $valueToSearch = $_POST['valueToSearch'];
    

    $sql = "SELECT * FROM data WHERE 1=1";

if (!empty($valueToSearch)) $sql .= " AND comboclass = '$valueToSearch'";

    $query = "SELECT * FROM `data` WHERE CONCAT(`comboclass`) LIKE '%".$valueToSearch."%'";
    
    $search_result = filterTable($query);
   
    
}
 else {
    
    //exit();
    // $query = "SELECT * FROM `data`";
    // $search_result = filterTable($query);
}



// function to connect and execute the query
function filterTable($query)
{
    $connect = new mysqli("localhost","ray","password","reports")or die(mysqli_error($mysqli));
    $filter_Result = mysqli_query($connect, $query);
    
    return $filter_Result;
}

?>
<p>
</p>

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
            <input type="text" name="valueToSearch" placeholder="Enter classname and time in this format-> 104i am"><br><br>
         

            <input type="submit" name="search" value="Filter Class Button"><br><br>
            <!-- <input type="submit" name="searchtime" value="Filter time Button"><br><br> -->
            
            <table>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Comboclass</th>
                    <!-- <th>time</th> -->
                   
                </tr>

      <!-- populate table from mysql database -->
                <?php while($row = mysqli_fetch_array($search_result)):?>
                <tr>
                    <td><?php echo $row['id'];?></td>
                    <td><?php echo $row['studentname'];?></td>
                    <td><?php echo $row['comboclass'];?></td>
                    
                </tr>
                <?php endwhile;?>
            </table>
        </form>
        
    </body>
</html>

