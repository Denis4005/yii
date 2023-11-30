<?php

namespace frontend\modules\api\controllers;

use Yii;
use yii\filters\AccessControl;
// use yii\filters\auth\HttpBasicAuth;
use yii\filters\auth\HttpBearerAuth;
use frontend\modules\api\models\CreatePostForm;
use frontend\modules\api\models\DeletePostForm;
use frontend\modules\api\models\UpdatePostForm;
use frontend\modules\api\models\OutputPostForm;
use yii\web\Controller;

class PostsController extends Controller
{
    public $token;
    public $enableCsrfValidation = false;
    public function init()
    {
        parent::init();
        \Yii::$app->user->enableSession = false;
    }

    public function actionCreate()
    {
        $articles=new CreatePostForm();
        return($articles->actionCreateForm());
    }
    public function actionDeleteById()
    {
        $articles=new DeletePostForm();
        return($articles->actionDeleteByIdForm());
    }
    public function actionUpdateById(){
        $articles=new UpdatePostForm();
        return($articles->actionUpdateByIdForm());
    }
    public function actionOutput(){
        $articles=new OutputPostForm();
        return($articles->actionOutputForm());
    }

}
