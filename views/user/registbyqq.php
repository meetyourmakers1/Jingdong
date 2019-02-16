<?php
    $this->title = "绑定QQ";
    use yii\bootstrap\ActiveForm;
    use yii\helpers\Html;
?>
<main id="authentication" class="inner-bottom-md">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <section class="section sign-in inner-right-xs">
                    <h2 class="bordered">
                        <img src="<?php /*echo Yii::$app->session['userinfo']['figureurl_1']*/ ?>">
                        绑定QQ
                    </h2>
                    <p>
                        请填写一个用户名和密码
                    </p>
                    <div class="social-auth-buttons">
                    </div>
                    <?php 
                        $form = ActiveForm::begin([
                            'fieldConfig' => [
                                'template' => '<div class="field-row">{label}{input}</div>{error}'
                            ],
                            'options' => [
                                'class' => 'login-form cf-style-1',
                                'role' => 'form',
                            ],
                            'action' => ['user/registbyqq'],
                        ]);
                    ?>
                    <input type="text" value="<?php /*echo Yii::$app->session['userinfo']['nickname']*/ ?>" class="le-input"><br>
                    <?php 
                        echo $form->field($model, 'username')->textInput(['class' => 'le-input']); 
                    ?>
                    <?php 
                        echo $form->field($model, 'userpass')->passwordInput(['class' => 'le-input']); 
                    ?>
                    <?php 
                        echo $form->field($model, 'repassword')->passwordInput(['class' => 'le-input']); 
                    ?>
                    <div class="field-row clearfix">
                    </div>
                    <div class="buttons-holder">
                        <?php 
                            echo Html::submitButton('绑定QQ', ['class' => 'le-button huge']); 
                        ?>
                    </div>
                    <?php 
                        ActiveForm::end(); 
                    ?>
                </section>
            </div>
        </div>
    </div>
</main>
<script>
    var qqbtn = document.getElementById("login_qq");
    qqbtn.onclick = function(){
        window.location.href="<?php echo yii\helpers\Url::to(['user/loginbyqq']) ?>";
    }
</script>





