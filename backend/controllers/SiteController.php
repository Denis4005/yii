<?php

namespace backend\controllers;

use common\models\LoginForm;
use common\models\Posts;
use Yii;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use common\models\User;
use frontend\models\SignupForm;
use frontend\modules\api\models\CreatePostForm;
/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public $enableCsrfValidation = false;
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'actions' => ['login','error'],
                        'allow' => true,
                    ],

                    [
                        'actions' => ['logout','index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['login', 'signup', 'error','logout','index','users','posts','post'],
                        'allow' => true,
                        'roles' => ['canAdmin'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => \yii\web\ErrorAction::class,
            ],            
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
  
    public function actionIndex()
    {
        return $this->render('index');
    }
    public function actionUsers()
    {
        return $this->render('users');
    }
    public function actionPost()
    {
        $model = new CreatePostForm();
        // var_dump(Yii::$app->request->post()["CreatePostForm"]);die;
        // var_dump($model->load(Yii::$app->request->post()["CreatePostForm"]);)
        
        // var_dump(CreatePostForm->actionCreateForm(Yii::$app->request->post()["Posts"]));die;
        //var_dump(Yii::$app->request->post()["CreatePostForm"]);die;
        //$model->namePost = $this->Yii::$app->request->post()['namePost'];
        // if ($model->load(Yii::$app->request->post()) && $model->actionCreateForm()) {
        //     return $model->actionCreateForm();
        //     // return $this->goHome();
        // }
        return $this->render('posts', [
            'model' => $model,
        ]);
    }
    public function actionPosts()
    {
        $model = new CreatePostForm();
        // var_dump(Yii::$app->request->post()["CreatePostForm"]);die;
        // var_dump($model->load(Yii::$app->request->post()["CreatePostForm"]);)
        
        // var_dump(CreatePostForm->actionCreateForm(Yii::$app->request->post()["Posts"]));die;
        //var_dump(Yii::$app->request->post()["CreatePostForm"]);die;
        //$model->namePost = $this->Yii::$app->request->post()['namePost'];
        if ($model->load(Yii::$app->request->post()) && $model->actionCreateForm()) {
            return $model->actionCreateForm();
            // return $this->goHome();
        }
        return $this->render('posts', [
            'model' => $model,
        ]);
    }

    /**
     * Login action.
     *
     * @return string|Response
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $this->layout = 'blank';

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';

        return $this->render('login', [
            'model' => $model,
        ]);
    }
    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post()) && $model->signup()) {
            Yii::$app->session->setFlash('success', 'Thank you for registration. Please check your inbox for verification email.');
            return $this->goHome();
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    // public function actionRole(){
    //     // $admin = Yii::$app->authManager->createRole('admin');
    //     // $admin->description = 'Администратор';
    //     // Yii::$app->authManager->add($admin);

    //     // $content = Yii::$app->authManager->createRole('content');
    //     // $content->description = 'Контент';
    //     // Yii::$app->authManager->add($content);

    //     // $user = Yii::$app->authManager->createRole('user');
    //     // $user->description = 'Пользователь';
    //     // Yii::$app->authManager->add($user);

    //     // $ban = Yii::$app->authManager->createRole('banned');
    //     // $ban->description = 'Забаненый Пользователь';
    //     // Yii::$app->authManager->add($ban);

    //     // $permit = Yii::$app->authManager->createPermission('canAdmin');
    //     // $permit->description = 'Право входа в админку';
    //     // Yii::$app->authManager->add($permit);

    //     // $role_a = Yii::$app->authManager->getRole('admin');
    //     // $role_c = Yii::$app->authManager->getRole('content');
    //     // $permit = Yii::$app->authManager->getPermission('canAdmin');
    //     // Yii::$app->authManager->addChild($role_a, $permit);
    //     // Yii::$app->authManager->addChild($role_c, $permit);

    //     // $userRole = Yii::$app->authManager->getRole('admin');
    //     // Yii::$app->authManager->assign($userRole, Yii::$app->user->id);

    //     return 123;
    // }

    // public function actionAdminPanel(){
    //     return $this->render('admin');
    // }
}
