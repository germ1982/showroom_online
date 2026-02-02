<?php

namespace app\models;

use yii\base\Model;
use app\models\User;
use PHPUnit\Framework\Constraint\Count;
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
           

            $roles = User_rol::find()->all();
            if (count($roles) == 0) {
                  $idrol_admin = 1; // Asumimos que el ID del rol administrador es 1
                  // Si no hay roles, crear rol por defecto
                  $rol = new User_rol();
                  $rol->nombre = 'Administrador';
                  $rol->descripcion = 'Rol de administrador del sistema';
                  $rol->activo = 1;
                  $rol->save();
                  $idroladmin = $rol->idrol;

                  $rol = new User_rol();
                  $rol->nombre = 'Vendedor Vip';
                  $rol->descripcion = 'Vendedores que no pagan comision';
                  $rol->activo = 1;
                  $rol->save();

                  $rol = new User_rol();
                  $rol->nombre = 'Vendedor';
                  $rol->descripcion = 'Vendedores comunes';
                  $rol->activo = 1;
                  $rol->save();
                  $idrolvendedor = $rol->idrol;
            }
            else {
                  $rol = User_rol::find()->where(['nombre' => 'Vendedor'])->one();
                  $idrolvendedor = $rol->idrol;
            }

            $usuarios = User::find()->all();
            $idrol = count($usuarios) == 0 ? $idroladmin : $idrolvendedor;


            $user = new User();
            $user->username = $this->username;
            $user->email = $this->email;
            $user->telefono = $this->telefono;
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

            // Asignar rol al usuario
            $userRol = new User_usuario_rol();  
            $userRol->idusuario = $user->id;
            $userRol->idrol = $idrol;
            $userRol->save();
            return $user;
      }
}
