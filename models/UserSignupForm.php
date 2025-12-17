<?php

namespace app\models;

use yii\base\Model;
use app\models\User;
use Yii;

class UserSignupForm extends Model
{
      public $username;
      public $email;
      public $telefono;
      public $password;
      public $password_repeat;
      public $status;

      public function rules()
      {
            return [
                  [['username', 'email', 'password', 'password_repeat','telefono'], 'required'],

                  ['status', 'default', 'value' => 10],
                  ['email', 'email'],
                  ['email', 'unique', 'targetClass' => User::class, 'message' => 'Este email ya está registrado.'],

                  ['username', 'unique', 'targetClass' => User::class, 'message' => 'Este usuario ya existe.'],

                  ['password_repeat', 'compare', 'compareAttribute' => 'password', 'message' => 'Las contraseñas no coinciden.'],

                  ['password', 'string', 'min' => 6],
            ];
      }

      public function attributeLabels()
      {
            return [
                  'username' => 'Usuario',
                  'email'     => 'Correo electrónico',
                  'password'  => 'Contraseña',
                  'password_repeat'    => 'Confirmar Contraseña',
            ];
      }

      public function signup()
      {
            if (!$this->validate()) {
                  return false;
            }

            $user = new User();
            $user->username = $this->username;
            $user->email = $this->email;
            $user->status = User::STATUS_ACTIVE;
            $user->password_hash = Yii::$app->security->generatePasswordHash($this->password); // genera hash
            $user->auth_key = Yii::$app->security->generateRandomString();
            $user->access_token = Yii::$app->security->generateRandomString();

            // Aseguramos claves (si beforeSave no las generó por alguna razón)
            if (empty($user->auth_key)) {
                  $user->generateAuthKey();
            }
            if (empty($user->access_token)) {
                  $user->generateAccessToken();
            }

            if (!$user->save()) {
                  // útil en desarrollo: ver errores
                  // Yii::error($user->errors);
                  return false;
            }

            return $user;
      }
}
