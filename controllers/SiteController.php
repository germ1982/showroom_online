<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\UserSignupForm;

class SiteController extends Controller
{
      /**
       * {@inheritdoc}
       */
      public function behaviors()
      {
            return [
                  'access' => [
                        'class' => AccessControl::class,
                        'only' => ['logout'],
                        'rules' => [
                              [
                                    'actions' => ['logout'],
                                    'allow' => true,
                                    'roles' => ['@'],
                              ],
                        ],
                  ],
                  'verbs' => [
                        'class' => VerbFilter::class,
                        'actions' => [
                              'logout' => ['post'],
                        ],
                  ],
            ];
      }

      /**
       * {@inheritdoc}
       */
      public function actions()
      {
            return [
                  'error' => [
                        'class' => 'yii\web\ErrorAction',
                  ],
                  'captcha' => [
                        'class' => 'yii\captcha\CaptchaAction',
                        'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
                  ],
            ];
      }

      /**
       * Displays homepage.
       *
       * @return string
       */
      public function actionIndex()
      {
            Yii::$app->session->setFlash('success', 'Bienvenido <br> al sitio web');
            return $this->render('index');
      }

      /**
       * Login action.
       *
       * @return Response|string
       */
      public function actionLogin()
      {

            //es raro que ocurra esto primer if, pero bueno, si el usuario ya esta logueado no tiene sentido que vuelva a loguearse  
            if (!Yii::$app->user->isGuest) { //isGuest (es invitado )pregunta si el usuario no es invitado, osea si es un usuario y esta logueado
                  return $this->goHome(); //si era usaurio y  estaba logueado por default se va a actionIndex de este mismo controlador el cual va a la vista index
            }

            //este es el pazo principal del login, aca se procesa el formulario y se loguea al usuario, o no, dependiendo de si los datos son correctos o no
            $model = new LoginForm(); //ccrea una instancia del modelo LoginForm, es ahi donde estan las reglas de validacion del login
            if ($model->load(Yii::$app->request->post()) && $model->login()) { //load carga los datos del formulario en el modelo y login() valida y loguea al usuario
                  return $this->goBack(); //si el login es exitoso vuelve a la pagina anterior, esto es porque no todas las secciones son privadas y puede que haya llegado a login desde otra pagina
            }

            //esto sigueinte ocurre si no se ha enviado el formulario o si la validacion fallo
            $model->password = ''; //limpia el campo password por seguridad
            return $this->render('login', [ //renderiza la vista login y le pasa el modelo
                  'model' => $model,
            ]);
      }

      /**
       * Logout action.
       *
       * @return Response
       */
      public function actionLogout()
      {
            Yii::$app->user->logout();

            return $this->goHome();
      }

      /**
       * Displays contact page.
       *
       * @return Response|string
       */
      public function actionContact()
      {
            $model = new ContactForm();
            if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
                  Yii::$app->session->setFlash('contactFormSubmitted');

                  return $this->refresh();
            }
            return $this->render('contact', [
                  'model' => $model,
            ]);
      }

      /**
       * Displays about page.
       *
       * @return string
       */
      public function actionAbout()
      {
            return $this->render('about');
      }

      public function actionRegistro()
      {
            $model = new UserSignupForm();

            if ($model->load(Yii::$app->request->post()) && $user = $model->signup()) {
                  if (Yii::$app->getUser()->login($user)) {
                        Yii::$app->session->setFlash('success', 'Tu cuenta se creó correctamente.');
                  } else {
                        Yii::$app->session->setFlash('error', 'Hubo un error al iniciar sesión con tu nueva cuenta.');
                  }

                  return $this->goHome();
            }

            return $this->render('registro', [
                  'model' => $model,
            ]);
      }
}
