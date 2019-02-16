<?php

namespace app\modules\models;

use yii\db\ActiveRecord;
use Yii;

class Admin extends ActiveRecord{

    public $rememberMe = true;
    public $repassword;

    //模型表名
    public static function tableName(){
        return "{{%admin}}";
    }

    //模型属性
    public function attributeLabels(){
        return [
            'adminuser' => '管理员账号',
            'adminemail' => '管理员邮箱',
            'adminpass' => '管理员密码',
            'repassword' => '确认密码',
        ];
    }

    //验证规则
    public function rules(){
        return [
            ['adminuser', 'required', 'message' => '管理员账号不能为空!','on' => ['login', 'findadminpass','changeadminpass','addadmin','modAdminemail','modadminpass']],
            ['adminpass', 'required', 'message' => '管理员密码不能为空!', 'on' => ['login','changeadminpass','addadmin','modAdminemail','modadminpass']],
            ['adminuser', 'unique', 'message' => '管理员账号已被注册!', 'on' => 'addadmin'],
            ['rememberMe', 'boolean','on' => 'login'],
            ['adminpass', 'validateAdminpass','on' => ['login','modAdminemail']],
            ['adminemail', 'required', 'message' => '电子邮箱不能为空!','on' => ['findadminpass','addadmin','modAdminemail']],
            ['adminemail', 'email', 'message' => '电子邮箱格式不正确!','on' => ['findadminpass','addadmin','modAdminemail']],
            //['adminemail', 'unique', 'message' => '电子邮箱已被注册!', 'on' => ['addadmin','modAdminemail']],
            ['adminemail', 'validateAdminemail','on' => 'findadminpass'],
            ['repassword', 'required', 'message' => '确认密码不能为空!', 'on' => ['changeadminpass','addadmin','modadminpass']],
            ['repassword', 'compare', 'compareAttribute' => 'adminpass', 'message' => '两次密码输入不一致!', 'on' => ['changeadminpass','addadmin','modadminpass']],
        ];

    }

    //验证规则:用户名密码
    public function validateAdminpass(){
        if (!$this->hasErrors()) {
            $data = self::find()->where('adminuser = :adminuser and adminpass = :adminpass', [":adminuser" => $this->adminuser,":adminpass" => md5($this->adminpass)])->one();
            if (is_null($data)) {
                $this->addError("adminpass", "用户名或者密码不正确!");
            }
        }
    }

    //登录
    public function login($data){
        $this->scenario = "login";
        if ($this->load($data) && $this->validate()) {
            $lifetime = $this->rememberMe ? 24*3600 : 0;
            $session = Yii::$app->session;
            /*session_set_cookie_params($lifetime);*/
            $session['admin'] = [
                'adminuser' => $this->adminuser
            ];
            $this->updateAll(['logintime' => time(), 'loginip' => ip2long(Yii::$app->request->userIP)], 'adminuser = :adminuser', [':adminuser' => $this->adminuser]);
            return true;
        }
        return false;
    }

    //验证规则:电子邮箱
    public function validateAdminemail(){
        if (!$this->hasErrors()) {
            $data = self::find()->where('adminuser = :adminuser and adminemail = :adminemail', [':adminuser' => $this->adminuser, ':adminemail' => $this->adminemail])->one();
            if (is_null($data)) {
                $this->addError("adminemail", "管理员电子邮箱不正确!");        
            }
        }
    }

    //发送邮件找回管理员密码
    public function findAdminpass($data){
        $this->scenario = "findadminpass";
        if ($this->load($data) && $this->validate()) {
            $time = time();
            $token = md5(md5($data['Admin']['adminuser']).base64_encode(Yii::$app->request->userIP).md5($time));
            $mailer = Yii::$app->mailer->compose('findadminpass', ['adminuser' => $data['Admin']['adminuser'], 'time' => $time, 'token' => $token]);
            $mailer->setFrom("3458194688@qq.com");
            $mailer->setTo($data['Admin']['adminemail']);
            $mailer->setSubject("商城-找回密码");
            if ($mailer->send()) {
                return true;
            }
        }
        return false;   
    }

    //发送邮件修改管理员密码
    public function changeAdminPass($data) {
        $this->scenario = "changeadminpass";
        if ($this->load($data) && $this->validate()) {
            return (bool)$this->updateAll(['adminpass' => md5($this->adminpass)], 'adminuser = :user', [':user' => $this->adminuser]);
        }
        return false;
    }

    //添加管理员
    public function addAdmin($data){
        $this->scenario = 'addadmin';
        if ($this->load($data) && $this->validate()) {
            $this->adminpass = md5($this->adminpass);
            $this->logintime = time();
            $this->loginip = '127.0.0.1';
            $this->createtime = time();
            if ($this->save(false)) {
                return true;
            }
            return false;
        }
        return false;
    }

    //修改管理员邮箱
    public function modAdminemail($data){
        $this->scenario = "modAdminemail";
        if ($this->load($data) && $this->validate()) {
            return (bool)$this->updateAll(['adminemail' => $this->adminemail], 'adminuser = :adminuser', [':adminuser' => $this->adminuser]);
        }
        return false;
    }

    //修改管理员密码
    public function modAdminpass($data){
        $this->scenario = "modadminpass";
        if ($this->load($data) && $this->validate()) {
            return (bool)$this->updateAll(['adminpass' => md5($this->adminpass)], 'adminuser = :adminuser', [':adminuser' => $this->adminuser]);
        }
        return false;
    }

}