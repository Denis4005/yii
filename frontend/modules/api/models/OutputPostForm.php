<?php

namespace frontend\modules\api\models;

use Yii;
use common\models\Posts;

/**
 * This is the model class for table "posts".
 *
 * @property int $id
 * @property string $namePost
 * @property string $content
 * @property string $data
 */
class OutputPostForm extends Posts
{
    public function actionOutputForm(){
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $articles= Posts::find()->all();
        if (count($articles)> 0) {
            return array('status'=>true,'data'=> $articles);
        } else {
            return array('status'=>false,'data'=> 'No');
        }
    }
}
