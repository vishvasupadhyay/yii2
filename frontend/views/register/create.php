<?php

use kartik\export\ExportMenu;

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <div class="container">
        <div class="jumbotron" style="
    padding: 0;
    margin: 0;">
            <a href=" import" class="row btn btn-success" style=" padding: 1px; width: 89px;">Import</a>
        </div>

        <?php

        // Renders a export dropdown menu
        echo ExportMenu::widget([
            'dataProvider' => $provider,
            'columns' => $gridColumns
        ]);

        // You can choose to render your own GridView separately
        echo \kartik\grid\GridView::widget([
            'dataProvider' => $provider,
            'columns' => $gridColumns
        ]);

        ?>

    </div>

</body>

</html>