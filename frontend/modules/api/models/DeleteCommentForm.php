<?php

namespace frontend\modules\api\models;

use common\models\Comments;
use Yii;
use common\models\User;

/**
 * This is the model class for table "posts".
 *
 * @property int $id
 * @property string $namePost
 * @property string $content
 * @property string $data
 */
class DeleteCommentForm extends Comments
{
   
    public function actionDeleteByIdForm(){
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $id = \Yii::$app->request->post()['id'] ;
        $articles = Comments::find()->where(['id' => $id])->one();
        $token = \Yii::$app->request->post()['accessToken'];

        $user = User::findIdentityByAccessToken($token);
        if (empty($user)) {
            return array('status'=>false);
        }
        if ($articles!=NULL && $articles->delete()){
            return array('status'=>true, 'data'=>'Succes');
        } else 
            return array('status'=>false, 'data'=>$articles->getErrors());
    }

   
}
