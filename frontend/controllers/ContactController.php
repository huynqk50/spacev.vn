<?php

namespace frontend\controllers;

use common\utils\Json;
use frontend\models\Contact;
use Yii;
use yii\helpers\Url;
use yii\web\BadRequestHttpException;

class ContactController extends BaseController
{

    public function actionIndex()
    {
        $this->link_canonical = Url::current([], true);
        $this->breadcrumbs[] = ['label' => 'Liên hệ', 'url' => $this->link_canonical];
        
        return $this->render('index');
    }

    public function actionAjaxCreate()
    {
        $response = 0;
        
        if (Yii::$app->request->isPost) {
            $model = new Contact();
            $model->scenario = 'full';
            $data = Json::decode(Yii::$app->request->post('Contact'), true);
            if ($model->load(['Contact' => $data]) && $model->save()) {
                $response = 1;
            } else {
                $response = json_encode($model->errors);
            }
        }
        
        return $response;
    }
    
    public function actionCreateWithEmail()
    {
        if (!Yii::$app->request->isPost) {
            throw new BadRequestHttpException;
        }
        $model = new Contact;
        $model->scenario = 'only-email';
        $model->email = Yii::$app->request->post('email', '');
        $model->message = '';
        
        if ($model->save()) {
            return 1;
        }
        
        return 0;
    }
    
}
