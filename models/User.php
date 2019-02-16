<?php

namespace app\models;

use yii\db\ActiveRecord;
use Yii;

class User extends ActiveRecord implements \yii\web\IdentityInterface{
    public $repassword;
    public $loginname;
    public $rememberMe = true;

    //模型表名
    public static function tableName(){
        return "{{%user}}";
    }

    //模型属性
    public function attributeLabels(){
        return [
            'username' => '会员账号',
            'userpass' => '会员密码',
            'useremail' => '电子邮箱',
            'repassword' => '确认密码',
            'loginname' => '用户名/电子邮箱',
        ];
    }

    //验证规则
    public function rules(){
        return [
            ['username', 'required', 'message' => '用户名不能为空!', 'on' => ['adduser','registbyemail','registbyqq']],
            ['username', 'unique', 'message' => '用户名已被注册!', 'on' => ['adduser','registbyemail','registbyqq']],
            ['useremail', 'required', 'message' => '电子邮件不能为空!', 'on' => ['adduser','registbyemail']],
            ['useremail', 'email', 'message' => '电子邮件格式不正确!', 'on' => ['adduser','registbyemail']],
            /*['useremail', 'unique', 'message' => '电子邮件已被注册!', 'on' => ['adduser','registbyemail']],*/
            ['userpass', 'required', 'message' => '用户密码不能为空!', 'on' => ['adduser','registbyemail','registbyqq']],
            ['repassword', 'required', 'message' => '确认密码不能为空!', 'on' => ['adduser','registbyqq']],
            ['repassword', 'compare', 'compareAttribute' => 'userpass', 'message' => '两次密码输入不一致!', 'on' => ['adduser','registbyqq']],
            ['loginname', 'required', 'message' => '登录用户名不能为空!', 'on' => ['login']],
            ['userpass', 'validatePass', 'on' => ['login']],
            ['openid', 'required', 'message' => 'openid不能为空!', 'on' => ['registbyqq']],
            ['openid', 'unique', 'message' => 'openid已被注册!', 'on' => ['registbyqq']],
        ];
    }

    // 添加或注册会员
    public function addUser($data, $scenario = 'adduser'){
        $this->scenario = $scenario;
        if ($this->load($data) && $this->validate()) {
            $this->userpass = md5($this->userpass);
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

    //关联profile表
    public function getProfile(){
        return $this->hasOne(Profile::className(), ['userid' => 'id']);
    }

    //发送邮件注册会员
    public function registByEmail($data){
        $data['User']['username'] = 'jingdong_'.uniqid();
        $data['User']['userpass'] = uniqid();
        $data['User']['logintime'] = time();
        $data['User']['loginip'] = '127.0.0.1';
        $data['User']['createtime'] = time();
        $this->scenario = 'registbyemail';
        if ($this->load($data) && $this->validate()) {
            $mailer = Yii::$app->mailer->compose('adduser', ['username' => $data['User']['username'],'userpass' => $data['User']['userpass']]);
            $mailer->setFrom('3458194688@qq.com');
            $mailer->setTo($data['User']['useremail']);
            $mailer->setSubject('商城-注册用户');
            if ($mailer->send() && $this->addUser($data, 'registbyemail')) {
                return true;
            }
        }
        return false;
    }

    //验证规则:用户名密码
    public function validatePass(){
        if (!$this->hasErrors()) {
            $loginname = "username";
            if (preg_match('/@/', $this->loginname)) {
                $loginname = "useremail";
            }
            $user = self::find()->where($loginname.' = :loginname', [':loginname' => $this->loginname])->one();
            if (is_null($user)) {
                $this->addError("userpass", "用户名或者密码错误!");
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
            $session['loginname'] = $this->loginname;
            return $session['loginname'];
        }
        return false;
    }

    public static function findIdentity($id){
        return isset(self::$users[$id]) ? new static(self::$users[$id]) : null;
    }

    public static function findIdentityByAccessToken($token, $type = null){
        foreach (self::$users as $user) {
            if ($user['accessToken'] === $token) {
                return new static($user);
            }
        }
        return null;
    }

    public static function findByUsername($username){
        foreach (self::$users as $user) {
            if (strcasecmp($user['username'], $username) === 0) {
                return new static($user);
            }
        }
        return null;
    }

    public function getId(){
        return $this->id;
    }

    public function getAuthKey(){
        return $this->authKey;
    }

    public function validateAuthKey($authKey){
        return $this->authKey === $authKey;
    }

    public function validatePassword($password){
        return $this->password === $password;
    }
    
}