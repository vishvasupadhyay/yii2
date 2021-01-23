<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;


$this->title = 'Table';
$this->params['breadcrumbs'][] = $this->title;
?>
<a href="deletecache" class="row btn btn-danger">Cache</a>
<?php $form = ActiveForm::begin(['id' => 'Register']); ?>

<div class="container">
    <table id="myTable" class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>NAME</th>
                <th>MOBILE</th>
                <th>EMAIL</th>
                <th>DATE OF BIRTH</th>
                <th>IMAGE</th>
                <th>ACTION</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data as $key => $value) {
            ?>


                <tr>
                    <td><?php echo $value['id']; ?></td>
                    <td><?php echo $value['name']; ?></td>
                    <td><?php echo $value['mobile']; ?></td>
                    <td><?php echo $value['email']; ?></td>
                    <td><?php echo $value['dob']; ?></td>
                    <td><img src="../<?php echo $value['image'] ?>"></td>
                    <td><a href="edit?edit=<?php echo $value['id']; ?>" class="btn btn-success">Edit</a>
                        <a href=" delete?delete=<?php echo $value['id']; ?>" class="btn btn-danger">Delete</a>
                        <a href="view?view=<?php echo $value['id']; ?>" class="btn btn-primary">view</a>
                    </td>

                </tr>


            <?php
            }
            ?>
        </tbody>
    </table>
</div>
</table>
</div>
<?php ActiveForm::end(); ?>