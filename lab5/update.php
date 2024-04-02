<?php
    $sql = 'SELECT `id`, `firstname`, 
            LEFT(`name`, 1) N, LEFT(`lastname`, 1) L 
            FROM `friends`';
    $res = mysqli_query($connect, $sql);
    if (mysqli_errno($connect)) print_r(mysqli_error($connect));
?>
<div class="container">
    <?php while($row = mysqli_fetch_assoc($res)):?>
        <a href="?p=update&id=<?=$row['id'];?>"><?=$row['firstname'].' '.$row['N'].'.'.$row['L'].'.<br>'?></a>
    <?php endwhile;?>

    <?php if (isset($_GET['id'])) include('form.php');?>
</div>