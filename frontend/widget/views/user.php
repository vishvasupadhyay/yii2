<?php

//use frontend\assets\AppAsset1;
?>
<div class="container">
    <table id="myTable" class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>NAME</th>
                <th>MOBILE</th>
                <th>EMAIL</th>
                <th>DATE OF BIRTH</th>


            </tr>
        </thead>

        <tbody>
        <?php foreach ($model1 as $key=>$model) ?>
            <tr>
                <td><?php echo $model->id; ?></td>
                <td><?php echo $model->name; ?></td>
                <td><?php echo $model->mobile; ?></td>
                <td><?php echo $model->email; ?></td>
                <td><?php echo $model->dob; ?></td>



            </tr>
        </tbody>




    </table>
</div>
</table>
</div>