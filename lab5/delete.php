<?php 
    if (isset($_GET['id'])){
        $sql = 'DELETE FROM `friends` WHERE `id`='.$_GET['id'];
        mysqli_query($connect, $sql);
        if (mysqli_errno($connect)) print_r(mysqli_error($connect));
            else $s = 'Запись удалена';
    }
?>

<?php
    $sql = 'SELECT `id`, `firstname`, 
            LEFT(`name`, 1) N, LEFT(`lastname`, 1) L 
            FROM `friends`';
    $res = mysqli_query($connect, $sql);
    if (mysqli_errno($connect)) print_r(mysqli_error($connect));
?>
<div class="container">
    <?php if(isset($s)):?>
      <div class="alert alert-success" role="alert">
        <h4 class="alert-heading"></h4>
        <p><?=$s;?></p>
        <p class="mb-0"></p>
      </div>
    <?php endif;?>
    
    <?php while($row = mysqli_fetch_assoc($res)):?>
        <a href="?p=delete&id=<?=$row['id'];?>"><?=$row['firstname'].' '.$row['N'].'.'.$row['L'].'.<br>'?></a>
    <?php endwhile;?>