<?php
use frontend\models\Student;
use yii\helpers\Html;
use yii\grid\GridView;
/* @var $this yii\web\View */
/* @var $searchModel frontend\models\StudentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->title = 'Students list';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="students-index">
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
</div>
<div class="box box-info">
            <div class="box-header with-border">
              <div>
              <?= Html::a('Create Students', ['create'], ['class' => 'btn btn-success']) ?>
            </div>
            <div>
              <h1  class=""><?= Html::encode($this->title) ?></h1>
            </div>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    [
                        'attribute' => 'studentId',
                        'value' => function ($dataProvider) {
                        $studentName = Student::find()->where(['student'=>$dataProvider->student])->One();
                        return $studentName->student;
                        },
                        ],
                        [
                            'attribute' => 'studentId',
                            'value' => function ($dataProvider) {
                            $studentName = Student::find()->where(['student'=>$dataProvider->student])->One();
                            return $studentName->fullName;
                            },
                            ],
                        [
                            'attribute' => 'idNumber',
                            'value' => function ($dataProvider) {
                            $studentName = Student::find()->where(['student'=>$dataProvider->student])->One();
                            return $studentName->idNumber;
                            },
                            ],
                            
                                [
                                    'attribute' => 'Reg Number',
                                    'value' => function ($dataProvider) {
                                    $studentName = Student::find()->where(['student'=>$dataProvider->student])->One();
                                    return $studentName->regNo;
                                    },
                                    ],['class' => 'yii\grid\ActionColumn'],
                ],
            ]); ?>
            </div>
            <!-- /.box-body -->
                  <!-- /.box-footer -->
         