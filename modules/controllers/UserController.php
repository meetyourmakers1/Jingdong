<?php

namespace app\modules\controllers;

use app\modules\controllers\CommonController;
use app\models\User;
use Yii;
use yii\data\Pagination;
use app\models\Profile;

class UserController extends CommonController{

    //会员列表页
    public function actionList(){
        $this->layout = "layout1";
        $model = User::find()->joinWith('profile');
        $count = $model->count();
        $pageSize = Yii::$app->params['pageSize']['user'];
        $pagination = new Pagination(['totalCount' => $count, 'pageSize' => $pageSize]);
        $users = $model->offset($pagination->offset)->limit($pagination->limit)->all();
        return $this->render('list', ['users' => $users, 'pagination' => $pagination]);
    }

    //添加会员
    public function actionAdd(){
        $this->layout = "layout1";
        $model = new User;
        if (Yii::$app->request->isPost) {
            $post = Yii::$app->request->post();
            if ($model->addUser($post)) {
                Yii::$app->session->setFlash('info', '添加成功!');
            }
        }
        $model->userpass = '';
        $model->repassword = '';
        return $this->render("add", ['model' => $model]);
    }

    //删除会员
    public function actionDel(){
        $id = Yii::$app->request->get('id');
        if ($id) {
            $transaction = Yii::$app->db->beginTransaction();
            $profile = Profile::find()->where('userid = :userid', [':userid' => $id])->one();
            try {
                if ($profile) {
                    if (!Profile::deleteAll('userid = :userid', [':userid' => $id])) {
                        throw new \Exception();
                    }
                }
                if (!User::deleteAll('id = :id', [':id' => $id])) {
                    throw new \Exception();
                }
                $transaction->commit();
            } catch(\Exception $e) {
                if (Yii::$app->db->getTransaction()) {
                    $transaction->rollback();
                }
            }
        }
        $this->redirect(['user/list']);
    }

}