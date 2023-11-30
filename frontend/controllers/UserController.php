<?php

namespace frontend\models\controllers;
use yii\filters\auth\HttpBasicAuth;
use yii\web\Controller;
use yii\rest\ActiveController;
use common\models\User;
class UserController extends ActiveController
{
    public $modelClass = User::class;
    // public function actionIndex()
    // {
    //     return $this->render('index');
    // }
}