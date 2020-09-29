<?php
    $errors ="";
    //Conectar a base de datos
    $db = mysqli_connect('localhost','root','','todo');

    if(isset($_POST['submit'])){
        $task = $_POST['task'];
        if(empty($task)) {
            $errors ;
        }else{
            mysqli_query($db, "INSERT INTO tasks (task) VALUES ('$task')");
            header('location: index.php');

        }
        
        
    }

    //Delete task
    if(isset($_GET['del_task'])){
        $id = $_GET['del_task'];
        mysqli_query($db,"DELETE FROM tasks WHERE id=$id");
        header('location: index.php');
    }

    $tasks = mysqli_query($db, "SELECT * FROM tasks");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Todo list</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css" integrity="sha512-1PKOgIY59xJ8Co8+NE6FZ+LOAZKjy+KY8iq0G4B3CyeY6wYHN3yt9PW0XpSriVlkMXe40PTKnXrLnZ9+fkDaog==" crossorigin="anonymous" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/js/all.js" integrity="sha512-th3I8avnzF4BCwrfylow7+VRKCXRtC5gsZA8G4ZqaGyhFzNz7BtmPcZs/qjBv0qVRhPAlqzGwkZAliB0AAQbWQ==" crossorigin="anonymous"></script>
</head>
<body>
   <!-- <div class="heading">
        <h2>Todo list</h2>
    </div> -->
    
    


    <form method="POST" action="index.php">
    <?php if (isset($errors)){ ?>
        <p><?php echo $errors; ?></p>
    <?php } ?>
        <input type="text" name="task" class="task_input">
        <button type="submit" class="add_btn" name="submit"><i class="fas fa-plus"></i></button>
    </form>

    <table>
        <thead>
            <tr>
                <th><i class="fas fa-sort-amount-down"></i></th>
                <th><i class="fas fa-sticky-note"></i></th>
                <th><i class="fas fa-trash"></i></th>
            </tr>
        </thead>
        <tbody>
        <?php $i = 1; while ($row = mysqli_fetch_array($tasks)) { ?>
            <tr>
                <td><?php echo $i; ?></td>
                <td class="task"><?php echo $row['task'];?></td>
                <td class="delete"> 
                    <a href="index.php?del_task=<?php echo $row['id']; ?>"><i class="fas fa-times"></i></a>
                </td>
            </tr>     

        <?php $i++; } ?>
        </tbody>

    </table>

</body>
</html>