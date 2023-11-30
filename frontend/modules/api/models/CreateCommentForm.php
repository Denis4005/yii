<?php

namespace frontend\modules\api\models;

use Yii;
use common\models\User;
use common\models\Comments;
/**
 * This is the model class for table "posts".
 *
 * @property int $id
 * @property string $namePost
 * @property string $content
 * @property string $data
 */
class CreateCommentForm extends Comments
{
    public function actionCreateForm()
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $articles = new Comments();
        $token = \Yii::$app->request->post()['accessToken'];

        $user = User::findIdentityByAccessToken($token);
        if (empty($user)) {
            return array('status'=>false);
        }
        $articles->authorName=$user['username'];
        $articles->load(\Yii::$app->request->post(),'');
        
        if ($articles->validate() && $articles->save()){
            return array('status'=>true, 'data'=>'Succes');
        } else {
            return array('status'=>false, 'data'=>$articles->getErrors());
        }
    }
}
