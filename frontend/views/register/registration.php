<?php

use yii\helpers\Html;
use yii\jui\DatePicker;
use yii\widgets\ActiveForm;
use frontend\Widget\Form;


$this->title = 'RegistrationForm';
$this->params['breadcrumbs'][] = $this->title;

?>

<?php $form = ActiveForm::begin(['id' => 'RegistrationForm']); ?>

<?= $form->field($model, 'name') ?>
<?= $form->field($model, 'mobile') ?>
<?= $form->field($model, 'email')->input('email') ?>
<?= $form->field($model, 'dob')->widget(\yii\jui\DatePicker::classname(), [
    //'language' => 'ru',
    'dateFormat' => 'yyyy-MM-dd',
]) ?>
<?= $form->field($model, 'image')->fileInput(['multiple' => 'multiple']); ?>
<?= $form->field($model, 'password')->input('password') ?>

<div class="form-group">
    <?= Html::submitButton('Submit', [
        'class' => 'btn btn-primary',
        'name' => 'registration-button'
    ]) ?>
</div>
<?php ActiveForm::end(); ?>
</div>
</div>