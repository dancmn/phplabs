<?php

    $sql = 'SELECT * FROM `hashtags`';
    $res = mysqli_query($connect, $sql);

?>

<div class="container">
<form action="index.php" method="POST">
    <input type="hidden" name="add-field">
    <h3>Создание области знаний</h3>
    <div class="form-group">
        <label for="field-name">Название области знаний</label>
        <input required type="text" class="form-control" id="field-name" name="field-name">
    </div>          

    <div class="form-group">
        <label for="description">Описание области знаний</label>
        <textarea required class="form-control" id="description" rows="3" name="description"></textarea>
    </div>  

    <?php
        while ($row = $res->fetch_assoc()) {
            echo '<input type="checkbox" id="hashtag_' . $row['id'] . '" name="hashtags[]" value="' . $row['hash_name'] . '">';
            echo '<label for="hashtag_' . $row['id'] . '">' . $row['hash_name'] . '</label><br>';
        }
    ?>

    <button type="submit" class="btn btn-primary mb-3">Создать область знаний</button>
</form>
</div>

<div class="container">
<form action="index.php" method="POST">
    <input type="hidden" name="update-field">
    
    <h3>Редактирование области знаний</h3>
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

    <div class="container" id='hashtags'>
        <?php
            $sql = "SELECT `id`, `hash_name` FROM `hashtags`";
            $res = mysqli_query($connect, $sql);
            while ($row = $res->fetch_assoc()) {
                echo
                    '<div class="form-check">
                        <input class="form-check-input update-checkbox" name="hashtags[]" type="checkbox" id="inlineCheckbox' . $row['id'] . '" value="' . $row['hash_name'] . '">
                        <label class="form-check-label" for="inlineCheckbox' . $row['id'] . '">' . $row['hash_name'] . '</label>
                    </div>';
            }
        ?>
    </div>

    
    <script>
        document.getElementById('field_id').addEventListener('change', function() {
            let fieldId = this.value;

            fetch('get_hashtags.php', {
                method: 'POST',
                body: JSON.stringify({ fieldId: fieldId }),
                headers: {
                    'Content-Type': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                let selectedHashtags = [];

                data.forEach(hashtag => {
                    selectedHashtags.push(hashtag);
                });

                // Проходим по всем чекбоксам и устанавливаем состояние checked в соответствии с выбранными хэштегами
                document.querySelectorAll('#hashtags .form-check-input').forEach(checkbox => {
                    if (selectedHashtags.some(hashtag => hashtag.hash_name === checkbox.value)) {
                        checkbox.checked = true;
                    } else {
                        checkbox.checked = false;
                    }

                    checkbox.addEventListener('change', function() {
                        if (this.checked) {
                            selectedHashtags.push(this.value);
                        } else {
                            selectedHashtags = selectedHashtags.filter(id => id !== this.value);
                        }
                        // Здесь можно отправить запрос на сохранение выбранных хэштегов
                    });
                });
            })
            .catch(error => {
                console.error('Ошибка при загрузке хэштегов');
            });
        });
    </script>


    <button type="submit" class="btn btn-primary mb-3">Изменить область знаний</button>
</form>
</div>