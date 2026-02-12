<?php

namespace app\controllers;

use Yii;
use app\models\User_rol;
use app\models\User_rolSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\web\Response;
use yii\helpers\Html;

/**
 * User_rolController implements the CRUD actions for User_rol model.
 */
class User_rolController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                    'bulkdelete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all User_rol models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new User_rolSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * Displays a single User_rol model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $request = Yii::$app->request;
        if ($request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                'title' => "User_rol #" . $id,
                'content' => $this->renderAjax('view', [
                    'model' => $this->findModel($id),
                ]),
                'footer' => Html::button('Close', ['class' => 'btn btn-secondary float-left', 'data-dismiss' => "modal"]) .
                    Html::a('Edit', ['update', 'id' => $id], ['class' => 'btn btn-primary', 'role' => 'modal-remote'])
            ];
        } else {
            return $this->render('view', [
                'model' => $this->findModel($id),
            ]);
        }
    }

    /**
     * Creates a new User_rol model.
     * For ajax request will return json object
     * and for non-ajax request if creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $request = Yii::$app->request;
        $userId = Yii::$app->request->get('userId');
        $model = new User_rol();

        if ($request->isAjax) {

            Yii::$app->response->format = Response::FORMAT_JSON;
            if ($request->isGet) {
                return [
                    'title' => "Nuevo Rol", //aca abro el modal para crear un nuevo rol desde el modal de roles del usuario, por eso el titulo es nuevo rol y no user_rol
                    'content' => $this->renderAjax('create', [
                        'model' => $model,
                        'userId' => $userId,
                    ]),
                    'footer' =>
                    Html::a(
                        'Volver a roles',
                        ['user/roles', 'id' => $userId],
                        [
                            'class' => 'btn btn-secondary',
                            'role' => 'modal-remote',
                            'title' => 'Cerrar',
                            'onclick' => 'volverARoles(' . $userId . ');',
                        ]
                    ) .
                        Html::a(
                            'Guardar',
                            ['user/roles', 'id' => $userId],
                            [
                                'class' => 'btn btn-secondary',
                                'role' => 'modal-remote',
                                'title' => 'Guardar',
                                'onclick' => 'guardarNuevoRolDesdeModal(' . $userId . ');',
                            ]
                        ) 


                ];
            } else if ($model->load($request->post()) && $model->save()) {
                return [
                    'success' => true,
                    'nuevoRolId' => $model->idrol,
                    'userId' => $userId,

                ];
            } else {
                return [
                    'title' => "Nuevo Rol",
                    'content' => $this->renderAjax('create', [
                        'model' => $model,
                    ]),
                    'footer' => Html::button('Cerrar', [
                        'class' => 'btn btn-secondary',
                        'onclick' => "volverARoles(" . $userId . ");"
                    ])
                        .
                        Html::button('Guardar', ['class' => 'btn btn-primary',])
                    //ESTE BOTON VA A DEJAR DE SER SUBMIT PARA SER UN BOTON NORMAL QUE AL HACER CLICK PRIMERO GUARDA EL ROL CREADO Y LUEGO VUELVE AL MODAL DE ROLES DEL USUARIO, POR ESO EL ONCLICK ES VOLVERARROLES Y NO ES DE TIPO SUBMIT

                ];
            }
        }
    }

 public function actionGuardar_rol()
{
    \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

    $model = new User_rol();
    $model->nombre = Yii::$app->request->post('nombre');
    $model->descripcion = Yii::$app->request->post('descripcion');

    if ($model->save()) {
        return [
            'ok' => true,
            'idrol' => $model->idrol
        ];
    }

    return ['ok' => false];
}

    public function actionUpdate($id)
    {
        $request = Yii::$app->request;
        $model = $this->findModel($id);

        if ($request->isAjax) {
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if ($request->isGet) {
                return [
                    'title' => "Update User_rol #" . $id,
                    'content' => $this->renderAjax('update', [
                        'model' => $model,
                    ]),
                    'footer' => Html::button('Close', ['class' => 'btn btn-secondary float-left', 'data-dismiss' => "modal"]) .
                        Html::button('Save', ['class' => 'btn btn-primary', 'type' => "submit"])
                ];
            } else if ($model->load($request->post()) && $model->save()) {
                return [
                    'forceReload' => '#crud-datatable-pjax',
                    'title' => "User_rol #" . $id,
                    'content' => $this->renderAjax('view', [
                        'model' => $model,
                    ]),
                    'footer' => Html::button('Close', ['class' => 'btn btn-secondary float-left', 'data-dismiss' => "modal"]) .
                        Html::a('Edit', ['update', 'id' => $id], ['class' => 'btn btn-primary', 'role' => 'modal-remote'])
                ];
            } else {
                return [
                    'title' => "Update User_rol #" . $id,
                    'content' => $this->renderAjax('update', [
                        'model' => $model,
                    ]),
                    'footer' => Html::button('Close', ['class' => 'btn btn-secondary float-left', 'data-dismiss' => "modal"]) .
                        Html::button('Save', ['class' => 'btn btn-primary', 'type' => "submit"])
                ];
            }
        } else {
            /*
            *   Process for non-ajax request
            */
            if ($model->load($request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->idrol]);
            } else {
                return $this->render('update', [
                    'model' => $model,
                ]);
            }
        }
    }

    /**
     * Delete an existing User_rol model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $request = Yii::$app->request;
        $this->findModel($id)->delete();

        if ($request->isAjax) {
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['forceClose' => true, 'forceReload' => '#crud-datatable-pjax'];
        } else {
            /*
            *   Process for non-ajax request
            */
            return $this->redirect(['index']);
        }
    }

    /**
     * Delete multiple existing User_rol model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionBulkdelete()
    {
        $request = Yii::$app->request;
        $pks = explode(',', $request->post('pks')); // Array or selected records primary keys
        foreach ($pks as $pk) {
            $model = $this->findModel($pk);
            $model->delete();
        }

        if ($request->isAjax) {
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['forceClose' => true, 'forceReload' => '#crud-datatable-pjax'];
        } else {
            /*
            *   Process for non-ajax request
            */
            return $this->redirect(['index']);
        }
    }

    /**
     * Finds the User_rol model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User_rol the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User_rol::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
