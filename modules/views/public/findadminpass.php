<?php
    use app\assets\AdminLoginAsset;
    use yii\bootstrap\ActiveForm;
    use yii\helpers\Html;
    AdminLoginAsset::register($this);
?>
<?php
    $this->beginPage();
?>
<!DOCTYPE html>
<html class="login-bg">
<head>
	<title>
        找回密码 - 后台管理
    </title>
    <?php 
        $this->registerMetaTag(["http-equiv" => "Content-type", "content" => "text/html;charset=utf-8"]);
        $this->registerMetaTag(["name" => "viewport", "content" => "width=device-width, initial-scale=1.0"]);  
        $this->head();
    ?>
</head>
<body>
    <?php 
        $this->beginBody(); 
    ?>
    <div class="row-fluid login-wrapper">
        <a class="brand" href="<?php echo yii\helpers\Url::to(['/index/index']) ?>"></a>
        <?php 
            $form = ActiveForm::begin([
                'fieldConfig' => [
                    'template' => '{error}{input}',
                ],
            ]); 
        ?>
        <div class="span4 box">
            <div class="content-wrap">
                <h6>
                    商城 - 找回密码
                </h6>
                <?php 
                    if (Yii::$app->session->hasFlash('info')) {
                        echo Yii::$app->session->getFlash('info');
                    } 
                ?>
                <?php 
                    echo $form->field($model, 'adminuser')->textInput(["class" => "span12", "placeholder" => "管理员账号"]); 
                ?>
                <?php 
                    echo $form->field($model, 'adminemail')->textInput(["class" => "span12", "placeholder" => "管理员电子邮箱"]); 
                ?>
                <a href="<?php echo yii\helpers\Url::to(['public/login']); ?>" class="forgot">
                    返回登录
                </a>
                <?php 
                    echo Html::submitButton('找回密码', ["class" => "btn-glow primary login"]); 
                ?>
            </div>
        </div>
        <?php 
            ActiveForm::end(); 
        ?>
    </div>
    <script src="assets/admin/js/jquery-latest.js"></script>
    <script src="assets/admin/js/bootstrap.min.js"></script>
    <script src="assets/admin/js/theme.js"></script>
    <script type="text/javascript">
        $(function () {
            var $btns = $(".bg-switch .bg");
            $btns.click(function (e) {
                e.preventDefault();
                $btns.removeClass("active");
                $(this).addClass("active");
                var bg = $(this).data("img");
                $("html").css("background-image", "url('img/bgs/" + bg + "')");
            });
        });
    </script>
    <?php 
        $this->endBody(); 
    ?>
</body>
</html>
<?php 
    $this->endPage(); 
?>
