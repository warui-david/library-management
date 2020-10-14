<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use dosamigos\datepicker\DatePicker;
use frontend\models\Student;
use frontend\models\Book;
/* @var $this yii\web\View */
/* @var $model frontend\models\BorrowedBook */
/* @var $form yii\widgets\ActiveForm */
$students = ArrayHelper::map(Student::find()->all(), 'student', 'fullName');
$books = ArrayHelper::map(Book::find()->where(['status'=>0])->all(), 'bookId', 'bookName');?>
<div class="borrowed-book-form">
    <?php $form = ActiveForm::begin(['id' => 'bb-create']); ?>
    
        <?= $form->field($model, 'borrowDate')->hiddenInput(['value'=>date('yy/m/d')])->label(false) ?>
        <?= $form->field($model, 'status')->hiddenInput(['value'=>1])->label(false) ?>
    
    <?= $form->field($model, 'studentId')->dropDownList($students) ?>
    <?= $form->field($model, 'bookId')->dropDownList($books) ?>
         <?= $form->field($model, 'expectedreturndate')->widget(
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
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>