<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Client */
/* @var $form yii\widgets\ActiveForm */

    if (!isset($model->sex)) $model->sex = 1;
?>

<div class="client-form">

    <?php $form = ActiveForm::begin(); ?>
    
    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'last_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'second_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'date_birth')->widget(\yii\jui\DatePicker::classname(), [
    //'language' => 'ru',
        'dateFormat' => 'yyyy-MM-dd',
    ]); ?>

    <?= $form->field($model, 'sex')->radioList([
        '1' => 'Мужской',
        '0' => 'Женский',
    ]); ?>
    <div id="phones">
        <div class="form-group field-client-phone">
            <label class="control-label" for="client-name">Телефон</label>
            <input id="client-name" class="form-control" name="Client[phone][]" value="<?=$model->phone[0]->phone?>" maxlength="30" type="text">
            <div><a href="#" class="remove">Убрать</a></div>
        </div>
    <?php for ($i = 1; $i < count($model->phone); $i++) { ?>
        <div class="form-group field-client-phone">
            <label class="control-label" for="client-name">Телефон</label>
            <input id="client-name" class="form-control" name="Client[phone][]" value="<?=$model->phone[$i]->phone?>" maxlength="30" type="text">
            <div><a href="#" class="remove">Убрать</a></div>
        </div>
    <?php } ?>
    </div>
    <div><a href="#" id="addphone">Добавить телефон</a></div>
    <br><br>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
