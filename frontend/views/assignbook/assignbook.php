<?php

use dosamigos\datepicker\DatePicker;
use frontend\models\Book;
use frontend\models\Student;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Borrowedbook */
/* @var $form ActiveForm */
$students = ArrayHelper::map(Student::find()->all(), 'studentId', 'fullName');
$books = ArrayHelper::map(Book::find()->all(), 'bookId', 'bookName');
?>
<div class="assignbook">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'studentId') ->dropDownList($students) ?>
        <?= $form->field($model, 'bookId') ->dropDownList($books) ?>
        <?= $form->field($model, 'borrowDate')->widget(
    DatePicker::className(), [
        // inline too, not bad
         'inline' => false, 
         // modify template for custom rendering
       // 'template' => '<div class="well well-sm" style="background-color: #fff; width:250px">{input}</div>',
        'clientOptions' => [
            'autoclose' => true,
            'format' => 'yyyy-mm-dd'
        ]
]);?>
        <?= $form->field($model, 'returnDate')->widget(
    DatePicker::className(), [
        // inline too, not bad
         'inline' => false, 
         // modify template for custom rendering
       // 'template' => '<div class="well well-sm" style="background-color: #fff; width:250px">{input}</div>',
        'clientOptions' => [
            'autoclose' => true,
            'format' => 'yyyy-mm-dd'
        ]
]);?>
    
        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- assignbook -->
