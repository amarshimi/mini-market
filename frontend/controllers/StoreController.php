<?php

namespace frontend\controllers;

use frontend\models\Product;
use frontend\models\StoreProduct;
use Yii;
use frontend\models\Store;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * StoreController implements the CRUD actions for Store model.
 */
class StoreController extends Controller
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

    public function actionPairingProducts()
    {

        if (Yii::$app->request->isAjax) {
            /* @var StoreProduct $storeProduct */

            $storeProduct = new StoreProduct();
            $storeProduct->store_id = $_POST['storeId'];
            $storeProduct->product_id = $_POST['productId'];
            $storeProduct->price = $_POST['price'];


            if ($storeProduct->save()) {

                return 'save :)';
            } else {
                return 'not save :(';
            }


        } else {

            $dataProvider = new ActiveDataProvider([
                'query' => Product::find(),
            ]);

            return $this->render('pairing-products', [
                'dataProvider' => $dataProvider,
            ]);

        }

    }

    /**
     * Lists all Store models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Store::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Store model.
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
     * Creates a new Store model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Store();
        $model->user_id = Yii::$app->user->id;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Store model.
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
     * Deletes an existing Store model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionByLocation()
    {
        $lat = 32.09091;
        $lng = 34.81288;

        $sql = 'SELECT id, name, (
                6371 * acos( cos( radians('.$lat.') ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians( '.$lng.' ) ) + sin( radians('.$lat.' ) ) * sin( radians( latitude ) ) )
                ) AS distance
                FROM store
                HAVING distance <150
                ORDER BY distance
                LIMIT 0 , 20';
        $dataProvider = new SqlDataProvider([
            'sql' => $sql,

            'pagination' => [
                'pageSize' => 20,
            ],
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);

    }

    /**
     * Finds the Store model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Store the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Store::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
