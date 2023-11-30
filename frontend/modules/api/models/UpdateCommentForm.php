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
class UpdateCommentForm extends Comments
{
    public function actionUpdateByIdForm(){
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $id = \Yii::$app->request->post()['id'];
        $articles = Comments::find()->where(['id' => $id])->one();
        $token = \Yii::$app->request->post()['accessToken'];

        $user = User::findIdentityByAccessToken($token);
        if (empty($user)) {
            return array('status'=>false);
        }
        $newArticles = new Comments();
        $newArticles->id = $id;
        $newArticles->authorName=$user['username'];
        $newArticles->load(\Yii::$app->request->post(), '');
        if ($newArticles->validate() && $articles->delete() && $newArticles->save()){
            return array('status'=>true, 'data'=>'Succes');
        } else {
            return array('status'=>false, 'data'=>$articles->getErrors());
        }
    }
}
