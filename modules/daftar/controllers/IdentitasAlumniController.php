<?php

namespace app\modules\daftar\controllers;

use Yii;
use app\modules\daftar\models\IdentitasAlumni;
use app\modules\daftar\models\IdentitasAlumniSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * IdentitasAlumniController implements the CRUD actions for IdentitasAlumni model.
 */
class IdentitasAlumniController extends Controller {

    /**
     * {@inheritdoc}
     */
    public function behaviors() {
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
     * Lists all IdentitasAlumni models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new IdentitasAlumniSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);


        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single IdentitasAlumni model.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView() {$id = Yii::$app->user->identity->id;
       
   
        $model = $this->findModel($id);
       
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new IdentitasAlumni model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new IdentitasAlumni();


        if ($model->load(Yii::$app->request->post())) {
            $model->password = md5($model->password);
             if($model->save()){Yii::$app->getSession()->setFlash(
                    'success','Data saved!');
            
            }
        }
        

        return $this->render('create', [

                    'model' => $model,
        ]);
    }

    /**
     * Updates an existing IdentitasAlumni model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate() {
        $id = Yii::$app->user->identity->id;
        $model = $this->findModel($id);
        $oldPass = $model->password;
        if ($model->load(Yii::$app->request->post())) {
         
            $model->foto = UploadedFile::getInstance($model, 'foto');
               $fileFoto = 'foto-' . $model->idalumni. '.'. $model->foto->extension;
            if ($model->foto != null) {
                $model->foto->saveAs(Yii::getAlias('@webroot/../berkas/berkas-foto/') . $fileFoto );
            }
            $model->foto = $fileFoto;
            if ($oldPass != md5($model->password)) {
                $model->password = md5($model->password);
            } else {
                $model->password = $oldPass;
            }
            $model->save();
            return $this->redirect(['view', 'id' => $model->idalumni]);
        }

        return $this->render('update', [
                    'model' => $model,
        ]);
    }

    /**
     * Deletes an existing IdentitasAlumni model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the IdentitasAlumni model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return IdentitasAlumni the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = IdentitasAlumni::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

}
