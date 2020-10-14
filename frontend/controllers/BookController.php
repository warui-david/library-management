<?php
namespace frontend\controllers;
use Yii;
use frontend\models\Book;
use frontend\models\BookSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use frontend\models\BookAuthor;
use frontend\models\Borrowedbook;
/**
 * BookController implements the CRUD actions for Book model.
 */
class BookController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }
    /**
     * Lists all Book models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new BookSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    /**
     * Displays a single Book model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }
    /**
     * Creates a new Book model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Book();
        $bookauthor = New Bookauthor();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $authorId = Yii::$app->request->post()['Bookauthor']['authorId'];
            $bookId = $model->bookId;
            if($this->bookauthors($authorId,$bookId)){
                return $this->redirect(['index']);
            }
            return $this->redirect(['create']);
        }
        return $this->render('create', [
            'model' => $model,
            'bookauthor'=>$bookauthor
        ]);
    }
    public function actionAddauthor()
    {
        $model = new \frontend\models\Author();
        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate() && $model->save()) {
                return $this->redirect(['create']);
            }
        }
        return $this->renderAjax('addauthor', [
            'model' => $model,
        ]);
    }
    public function bookauthors($authorId,$bookId){
        $model = New Bookauthor();
        $data= array('Bookauthor'=>['bookId'=>$bookId,'authorId'=>$authorId]);
        if($model->load($data) && $model->save()){
            return true;
        }
        return false;
    }
    

    
    public function actionBorrowbook()
    {
        $model = new Borrowedbook();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $this->afterBorrowbook($model->bookId);
            // form inputs are valid, do something here
            return $this->redirect(['index']);
        }
        return $this->renderAjax('borrowbook', [
            'model' => $model,
        ]);
    }
    public function afterBorrowbook($bookId){
        $command = \Yii::$app->db->createCommand('UPDATE book SET status=2 WHERE bookId='.$bookId);
        $command->execute();
        return true;
    }
    

    
    /**
     * Updates an existing Book model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->bookId]);
        }
        return $this->render('update', [
            'model' => $model,
        ]);
    }
    /**
     * Deletes an existing Book model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        return $this->redirect(['index']);
    }
    /**
     * Finds the Book model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Book the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Book::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }
}