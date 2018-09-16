<?php 

require 'db.php';

$data=null;
$mdg=null;

if(isset($_POST['submit'])){

    $searchItem=$_POST['content'];

    $exe=$connect->prepare(" SELECT * FROM `users` WHERE sur_name LIKE '%$searchItem%' OR email LIKE '%$searchItem%' OR mobile LIKE '%$searchItem%';") or die('Have some PROBLEM..');
    $exe->execute();

    $data = $exe->fetchAll(PDO::FETCH_OBJ);

    if(empty($data)){
       $msg= 'Sorry could not FIND data';
    }

}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Search</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Searching by Name, Email, Number</h1>
    <div class='container'>
    <form action="" method="post">
        <input type="text" name="content" id="search" class='text'>
        <input type="submit" name='submit' value="Search" id='btn' class='btn'>
    </form>
    <?php if(!empty($msg)): ?>
    <h3><?php echo $msg; ?></h3>
    <?php endif; ?>
    </div>

    <table>
    <tr>
    <th>Name:</th>
    <th>email:</th>
    <th>number:</th>
    </tr>
    <?php if($data != null): foreach($data as $d):?>
    <tr>
    <td><?php echo $d->sur_name;?></td>
    <td><?php echo $d->email;?></td>
    <td><?php echo $d->mobile; ?></td>
    </tr>
    <?php endforeach; endif; ?>
    </table>
</body>
</html>