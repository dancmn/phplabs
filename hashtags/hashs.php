<?php

?>

<div class="container">
<form action="index.php" method="GET">
    <input type="hidden" name="filter-field">
    <h4>Выберите области знаний</h4>
    <div class="container">
        <select name="field_id" id="field_id" class="form-control">
            <?php
                $sql = "SELECT `id`, `field_name` FROM `field`";
                $res = mysqli_query($connect, $sql);
                while ($row = $res->fetch_assoc()) {
                    echo '<option value="' . $row['id'] . '">' . $row['field_name'] . '</option>';
                }
            ?>
        </select>
    </div>
    <br>
    <button type="submit" class="btn btn-primary mb-3">Отфильтровать посты</button>
</form>
</div>

<div class="container">
    <?php
        $field_id = 1;
                
        $descriptionsAndChannels = [];
        if(isset($_GET['field_id'])) {
            $field_id = $_GET['field_id'];
        }

        $sql = "SELECT `hash_id` FROM `hash_connect` WHERE `field_id` = '$field_id'";
        $res = mysqli_query($connect, $sql);

        $hash_ids = [];
        while ($row = mysqli_fetch_assoc($res)) {
            $hash_ids[] = $row['hash_id'];
        }

        if (!empty($hash_ids)) {
            $hash_ids_string = implode(',', $hash_ids);
            $sql = "SELECT p.description, c.name AS channel_name FROM posts p JOIN channels c ON p.channel_id = c.id WHERE p.hash_id IN ($hash_ids_string)";
            $res = mysqli_query($connect, $sql);

            while ($row = mysqli_fetch_assoc($res)) {
                $descriptionsAndChannels[] = [
                    'description' => $row['description'],
                    'channel_name' => $row['channel_name']
                ];
            }
        }

        foreach ($descriptionsAndChannels as $item) {
            echo "<hr>";
            echo "<p>{$item['description']}</p>";
            echo "<h5>{$item['channel_name']}</h5>";
        }

    ?>

</div>