<?php

namespace app\models;

use yii\db\ActiveRecord;
use yii\web\IdentityInterface;
use Yii;

/**
 * Modelo User usado para autenticación y gestión de usuarios.
 *
 * Campos reales en la BD:
 * @property integer $id
 * @property string $username
 * @property string $email
 * @property string $password_hash
 * @property string $auth_key
 * @property string $access_token
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 *
 * Atributos virtuales:
 * @property string $password (solo para formulario)
 */
class User extends ActiveRecord implements IdentityInterface
{
      public $password;

      const STATUS_DELETED = 0;
      const STATUS_ACTIVE  = 10;

      public static function tableName()
      {
            return 'user';
      }

      public function rules()
      {
            return [
                  [['username', 'email'], 'required'],
                  // Password solo es obligatorio al crear (no al actualizar)
                  ['password', 'required', 'on' => 'create'],
                  [['username', 'email'], 'string', 'max' => 100],
                  ['email', 'email'],
                  // Password debe tener mínimo 6 caracteres
                  ['password', 'string', 'min' => 6],

                  [['password'], 'string', 'max' => 255],
                  [['authKey', 'accessToken'], 'string', 'max' => 255],
                  ['status', 'in', 'range' => [
                        self::STATUS_ACTIVE,
                        self::STATUS_DELETED,
                  ]],
                  ['status', 'default', 'value' => self::STATUS_ACTIVE],
                  ['status', 'default', 'value' => 1],
                  ['status', 'in', 'range' => [0, 1]],
            ];
      }




      public function attributeLabels()
      {
            return [
                  'id' => 'ID',
                  'username' => 'Usuario',
                  'email'     => 'Correo electrónico',
                  'password'  => 'Contraseña',
                  'status'    => 'Estado',
                  'authKey' => 'Clave de Autenticación',
                  'accessToken' => 'Token de Acceso',
            ];
      }

      //Busca un usuario por ID (solo si está activo).
      public static function findIdentity($id)
      {
            return static::findOne([
                  'id' => $id,
                  'status' => self::STATUS_ACTIVE,
            ]);
      }

      //Autenticación vía token (por ejemplo API).
      public static function findIdentityByAccessToken($token, $type = null)
      {
            return static::findOne([
                  'access_token' => $token,
                  'status' => self::STATUS_ACTIVE,
            ]);
      }

      //Búsqueda por username (para login).
      public static function findByUsername($username)
      {
            return static::findOne([
                  'username' => $username,
                  'status' => self::STATUS_ACTIVE,
            ]);
      }

      //Devuelve el ID del usuario autenticado.
      public function getId()
      {
            return $this->id;
      }

      //Devuelve auth_key (cookie de sesión segura).
      public function getAuthKey()
      {
            return $this->authKey;
      }

      //Valida auth_key.
      public function validateAuthKey($authKey)
      {
            return $this->authKey === $authKey;
      }

      // ---------------------------------------------------------
      //  MÉTODOS DE PASSWORD
      // ---------------------------------------------------------

      //Valida la contraseña ingresada con la almacenada en la BD.
      public function validatePassword($password)
      {
            return Yii::$app->security->validatePassword($password, $this->password_hash);
      }

      //Genera un hash de la contraseña que ingresa por parametro
      public function setPassword($password)
      {
            $this->password = Yii::$app->security->generatePasswordHash($password);
      }

      //Genera una nueva auth_key (recordarme, sesiones).
      public function generateAuthKey()
      {
            $this->authKey = Yii::$app->security->generateRandomString();
      }

      //Genera un nuevo access_token (API).
      public function generateAccessToken()
      {
            $this->accessToken = Yii::$app->security->generateRandomString();
      }

      // ---------------------------------------------------------
      //  BEFORE SAVE — Manejo automático de seguridad
      // ---------------------------------------------------------
      public function beforeSave($insert)
      {
            if (parent::beforeSave($insert)) {

                  // Si el usuario cargó o cambió el password (en un form)
                  if ($this->password) {
                        $this->setPassword($this->password);
                  }

                  // Si es un registro nuevo, generar claves
                  if ($insert) {
                        $this->generateAuthKey();
                        $this->generateAccessToken();
                  }

                  return true;
            }

            return false;
      }
}
