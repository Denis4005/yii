<?php

namespace frontend\modules\api\models;

use Yii;
use common\models\Posts;
use common\models\User;
/**
 * This is the model class for table "posts".
 *
 * @property int $id
 * @property string $namePost
 * @property string $content
 * @property string $data
 */
class CreatePostForm extends Posts
{
    public function actionCreateForm()
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        
        $articles = new Posts();
        // $articles->namePost = \Yii::$app->request->post();
        // $articles->content = \Yii::$app->request->post();
        $articles->data=date("Y-m-d");
        $articles->load(\Yii::$app->request->post(),'');
        $token = \Yii::$app->request->post()['accessToken'];

        $user = User::findIdentityByAccessToken($token);
        if (empty($user)) {
            return array('status'=>false);
        }
        if ($articles->validate() && $articles->save()){
            return array('status'=>true, 'data'=>'Succes');
        } else {
            return array('status'=>false, 'data'=>$articles->getErrors());
        }
    }
}
