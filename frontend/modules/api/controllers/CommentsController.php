<?php

namespace frontend\modules\api\controllers;

use Yii;
use yii\filters\AccessControl;
// use yii\filters\auth\HttpBasicAuth;
use yii\filters\auth\HttpBearerAuth;
use frontend\modules\api\models\CreateCommentForm;
use frontend\modules\api\models\DeleteCommentForm;
use frontend\modules\api\models\UpdateCommentForm;
use frontend\modules\api\models\OutputCommentForm;
use yii\web\Controller;

class CommentsController extends Controller
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
        $articles=new CreateCommentForm();
        return($articles->actionCreateForm());
    }
    public function actionDeleteById()
    {
        $articles=new DeleteCommentForm();
        return($articles->actionDeleteByIdForm());
    }
    public function actionUpdateById(){
        $articles=new UpdateCommentForm();
        return($articles->actionUpdateByIdForm());
    }
    public function actionOutput(){
        $articles=new OutputCommentForm();
        return($articles->actionOutputForm());
    }

}
