<?php

namespace app\controllers;

use Yii;
use app\models\User;
use app\models\User_usuario_rol;
use app\models\UserSearch;
use SebastianBergmann\CodeCoverage\Test\TestStatus\Success;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\web\Response;
use yii\helpers\Html;
use yii\helpers\Url;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
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
       * Lists all User models.
       * @return mixed
       */
      public function actionIndex()
      {
            $searchModel = new UserSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

            return $this->render('index', [
                  'searchModel' => $searchModel,
                  'dataProvider' => $dataProvider,
            ]);
      }


      /**
       * Displays a single User model.
       * @param integer $id
       * @return mixed
       */
      public function actionView($id)
      {
            $request = Yii::$app->request;
            if ($request->isAjax) {
                  Yii::$app->response->format = Response::FORMAT_JSON;
                  return [
                        'title' => "User #" . $id,
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
       * Creates a new User model.
       * For ajax request will return json object
       * and for non-ajax request if creation is successful, the browser will be redirected to the 'view' page.
       * @return mixed
       */
      public function actionCreate()
      {
            $request = Yii::$app->request;
            $model = new User();

            if ($request->isAjax) {
                  /*
            *   Process for ajax request
            */
                  Yii::$app->response->format = Response::FORMAT_JSON;
                  if ($request->isGet) {
                        return [
                              'title' => "Create new User",
                              'content' => $this->renderAjax('create', [
                                    'model' => $model,
                              ]),
                              'footer' => Html::button('Close', ['class' => 'btn btn-secondary float-left', 'data-dismiss' => "modal"]) .
                                    Html::button('Save', ['class' => 'btn btn-primary', 'type' => "submit"])

                        ];
                  } else if ($model->load($request->post()) && $model->save()) {
                        return [
                              'forceReload' => '#crud-datatable-pjax',
                              'title' => "Create new User",
                              'content' => '<span class="text-success">Create User success</span>',
                              'footer' => Html::button('Close', ['class' => 'btn btn-secondary float-left', 'data-dismiss' => "modal"]) .
                                    Html::a('Create More', ['create'], ['class' => 'btn btn-primary', 'role' => 'modal-remote'])

                        ];
                  } else {
                        return [
                              'title' => "Create new User",
                              'content' => $this->renderAjax('create', [
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
                        return $this->redirect(['view', 'id' => $model->id]);
                  } else {
                        return $this->render('create', [
                              'model' => $model,
                        ]);
                  }
            }
      }

      /**
       * Updates an existing User model.
       * For ajax request will return json object
       * and for non-ajax request if update is successful, the browser will be redirected to the 'view' page.
       * @param integer $id
       * @return mixed
       */
      public function actionUpdate($id, $ismodal = false)
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
                              'title' => "Update User del isget" . $id,
                              'content' => $this->renderAjax('update', [
                                    'model' => $model,
                                    'ismodal' => $ismodal,
                              ]),
                              'footer' => Html::button('Cerrar', ['id' => 'btnClose', 'class' => 'btn btn-secondary float-left', 'data-dismiss' => "modal"]) .
                                    Html::button('Guardar', ['id' => 'btnSave', 'class' => 'btn btn-secondary', 'type' => "submit"])
                        ];
                  } else if ($model->load($request->post()) && $model->save()) {
                        return [
                              'forceReload' => '#crud-datatable-pjax',
                              'title' => "User del else if isget " . $id,
                              'content' => $this->renderAjax('view', [
                                    'model' => $model,
                                    'ismodal' => $ismodal,
                              ]),
                              'footer' => Html::button('Close', ['id' => 'btnClose', 'class' => 'btn btn-secondary float-left', 'data-dismiss' => "modal"]) .
                                    Html::a('Edit', ['update', 'id' => $id], ['id' => 'btnEdit', 'class' => 'btn btn-secondary', 'role' => 'modal-remote'])
                        ];
                  } else {
                        return [
                              'title' => "User del else isget " . $id,
                              'content' => $this->renderAjax('update', [
                                    'model' => $model,
                                    'ismodal' => $ismodal,
                              ]),
                              'footer' => Html::button('Close', ['id' => 'btnClose', 'class' => 'btn btn-secondary float-left', 'data-dismiss' => "modal"]) .
                                    Html::button('Save', ['class' => 'btn btn-secondary', 'type' => "submit"])
                        ];
                  }
            } else {
                  /*
            *   a continuación el código para peticiones no ajax lo que significa que no va a un modal      
            */
                  if ($model->load($request->post()) && $model->save()) {
                        Yii::$app->session->setFlash('success', '¡Cambios guardados correctamente!');
                        return $this->redirect(['update', 'id' => $model->id]);
                  } else {
                        return $this->render('update', [
                              'model' => $model,
                        ]);
                  }
            }
      }

      /**
       * Delete an existing User model.
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
       * Delete multiple existing User model.
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
       * Finds the User model based on its primary key value.
       * If the model is not found, a 404 HTTP exception will be thrown.
       * @param integer $id
       * @return User the loaded model
       * @throws NotFoundHttpException if the model cannot be found
       */
      protected function findModel($id)
      {
            if (($model = User::findOne($id)) !== null) {
                  return $model;
            } else {
                  throw new NotFoundHttpException('The requested page does not exist.');
            }
      }

      public function actionChange_password()
      {
            //return ['success' => true];  
            Yii::$app->response->format = Response::FORMAT_JSON;

            $request = Yii::$app->request;
            $pActual = $request->post('actual');
            $pNueva  = $request->post('nueva');
            $iduser = $request->post('iduser');
            //$iduser = $iduser ?? Yii::$app->user->id;
            $perfil  = $request->post('perfil'); // true si viene del perfil propio

            $user = $this->findModel($iduser);

            // 1. Validar contraseña actual
            if (!$user->validatePassword($pActual)) {
                  return ['success' => false, 'message' => 'La contraseña actual es incorrecta.'];
            }

            // 2. Setear y guardar
            $user->setPassword($pNueva);
            if ($user->save()) {
                  // 1. Cerramos la sesión en el servidor
                  if ($perfil == true) {
                        Yii::$app->user->logout();
                        return [
                              'success' => true,
                              'url' => Url::to(['site/login'])
                        ];
                  } else {

                        // 2. Devolvemos la URL a la que debe redirigir el JS
                        return [
                              'success' => true,
                        ];
                  }
            } else {
                  return ['success' => false, 'message' => 'No se pudo guardar la nueva contraseña.'];
            }
      }

      public function actionRoles($id)
      {
            $request = Yii::$app->request;
            $user = $this->findModel($id);

            // IDs de roles actuales del usuario
            $rolesActuales = User_usuario_rol::find()
                  ->select('idrol')
                  ->where(['idusuario' => $id])
                  ->column();

            if ($request->isAjax) {
                  Yii::$app->response->format = Response::FORMAT_JSON;

                  // =====================
                  // ABRIR MODAL (GET)
                  // =====================
                  if ($request->isGet) {
                        return [
                              'title'   => 'Editar roles de ' . Html::encode($user->username),
                              'content' => $this->renderAjax('_form_roles', [
                                    'user' => $user,
                                    'rolesActuales' => $rolesActuales,
                              ]),
                              'footer'  =>
                              Html::button('Cerrar', [
                                    'class' => 'btn btn-secondary',
                                    'data-dismiss' => 'modal'
                              ]) .
                                    Html::button('Guardar', [
                                          'class' => 'btn btn-primary',
                                          'type' => 'submit'
                                    ])
                        ];
                  }

                  // =====================
                  // GUARDAR (POST)
                  // =====================
                  $rolesPost = $request->post('roles', []);

                  // Borramos roles actuales
                  User_usuario_rol::deleteAll(['idusuario' => $id]);

                  // Insertamos los nuevos
                  foreach ($rolesPost as $idrol) {
                        $ur = new User_usuario_rol();
                        $ur->idusuario = $id;
                        $ur->idrol = $idrol;
                        $ur->save(false);
                  }

                  return [
                        'forceReload' => '#crud-datatable-pjax',
                        'title' => 'Roles actualizados',
                        'content' => '<span class="text-success">Roles guardados correctamente</span>',
                        'footer' =>
                        Html::button('Cerrar', [
                              'class' => 'btn btn-secondary',
                              'data-dismiss' => 'modal'
                        ])
                  ];
            }

            // Seguridad: si entran sin ajax
            throw new \yii\web\BadRequestHttpException('Acceso inválido');
      }
}
