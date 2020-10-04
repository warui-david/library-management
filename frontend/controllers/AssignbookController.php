<?php

namespace frontend\controllers;

use Yii;

class AssignbookController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }
    public function actionAssignbook()//this function is given when generating a form//
    {
        $model = new \frontend\models\Borrowedbook();
        
        if ($model->load(\Yii::$app->request->post())) {
            if ($model->validate() && $model->save())
            {
                // form inputs are valid, do something here
                return;
            }
        }
        
        return $this->renderAjax('assignbook', [
            'model' => $model,
        ]);
    }
}
