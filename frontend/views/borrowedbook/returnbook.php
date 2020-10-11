<?php
use dosamigos\datepicker\DatePicker;
use frontend\models\Book;
use frontend\models\Student;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */
/* @var $model frontend\models\BorrowedBook */
/* @var $form yii\widgets\ActiveForm */
$students = ArrayHelper::map(Student::find()->all(), 'student', 'fullName');
$books = ArrayHelper::map(Book::find()->where(['status'=>0])->all(), 'bookId', 'bookName');
?>
<div class="borrowed-book-form">
    <?php $form = ActiveForm::begin(['id' => 'bb-create']); ?>
    <?= $form->field($model, 'studentId')->dropDownList($students,['disabled' => true]) ?>
    <?= $form->field($model, 'bookId')->dropDownList($books,['disabled' => true]) ?>
    <?= $form->field($model, 'borrowDate')->textInput(['disabled' => true]) ?>
    <?= $form->field($model, 'expectedreturndate')->textInput(['disabled' => true]) ?>
        <?= $form->field($model, 'actualreturnDate')->widget(
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
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>