<?php

namespace frontend\controllers;

use frontend\models\Product;
use Yii;
use frontend\models\Order;
use yii\data\ActiveDataProvider;
use yii\db\Query;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * OrderController implements the CRUD actions for Order model.
 */
class OrderController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Order models.
     * @return mixed
     */
    public function actionIndex()
    {

        $productIdes = [];
        $sum = 0;

        /* @var Order $orders */
        $orders = Order::find()->where(
            [
                'user_id'=> Yii::$app->user->id,
                'status' => Order::STATUS_START
            ]
        )->one();

        if(!empty($orders)){
            $productIdes = unserialize($orders->orders_details);
            $sum = $orders->sum;
        }


        $products = new Query();
        $products->select('id ,name')->from('product');

        $products->where(['id' => $productIdes]);

        $dataProvider = new ActiveDataProvider([
            'query' => $products,
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'sum' => $sum,
        ]);
    }

    /**
     * Displays a single Order model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Order model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Order();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Order model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Order model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionAddToCart(){



        if(Yii::$app->request->isAjax){

            $prods = [];

            /* @var Order $model */

            $model = Order::find()->where(
                [
                    'user_id'=> Yii::$app->user->id,
                    'status'=>Order::STATUS_START
                ]
            )->one();

            if(empty($model)) {
                $model = new Order();
                $model->user_id = Yii::$app->user->id;
                $model->orders_details = serialize($_POST['productId']);

            }
            else{
                $prods = (array)unserialize($model->orders_details);
                $prods[] =   $_POST['productId'];
                $model->orders_details = serialize($prods);
            }


            $model->sum = 50;
            $model->status = Order::STATUS_START;

            if($model->save()){
                return 'save'.Yii::$app->user->id;
            }
            else{
                return 'error';
            }

        }
        else{
            return 'not ajax request';
        }


    }

    public function actionRemoveFromCart(){

        if(Yii::$app->request->isAjax){

            $prods = [];

            /* @var Order $model */

            $model = Order::find()->where(
                [
                    'user_id'=> Yii::$app->user->id,
                    'status'=>Order::STATUS_START
                ]
            )->one();

            if(empty($model)) {
                return 'not match product ;)';
            }
            else{
                $prods = unserialize($model->orders_details);
                foreach($prods as $key => $value){

                    if($value==$_POST['productId']){
                        unset($prods[$key]);
                    }

                }
                $model->orders_details = serialize($prods);
            }


            $model->sum = 50;

            if($model->save()){
                return 'removed'.Yii::$app->user->id;
            }
            else{
                return 'error';
            }

        }
        else{
            return 'not ajax request';
        }



    }


    /**
     * Finds the Order model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Order the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Order::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
