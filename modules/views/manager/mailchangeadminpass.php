<?php
    use yii\bootstrap\ActiveForm;
    use yii\helpers\Html;
?>
<!DOCTYPE html>
<html class="login-bg">
<head>
	<title>
        商城 - 后台管理
    </title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="assets/admin/css/bootstrap/bootstrap.css" rel="stylesheet" />
    <link href="assets/admin/css/bootstrap/bootstrap-responsive.css" rel="stylesheet" />
    <link href="assets/admin/css/bootstrap/bootstrap-overrides.css" type="text/css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="assets/admin/css/layout.css" />
    <link rel="stylesheet" type="text/css" href="assets/admin/css/elements.css" />
    <link rel="stylesheet" type="text/css" href="assets/admin/css/icons.css" />
    <link rel="stylesheet" type="text/css" href="assets/admin/css/lib/font-awesome.css" />
    <link rel="stylesheet" href="assets/admin/css/compiled/signin.css" type="text/css" media="screen" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>
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
                    echo $form->field($model, 'adminuser')->hiddenInput(); 
                ?>
                <?php 
                    echo $form->field($model, 'adminpass')->passwordInput(["class" => "span12", "placeholder" => "新密码"]); 
                ?>
                <?php 
                    echo $form->field($model, 'repassword')->passwordInput(["class" => "span12", "placeholder" => "确认密码"]); 
                ?>
                <a href="<?php echo yii\helpers\Url::to(['public/login']); ?>" class="forgot">
                    返回登录
                </a>
                <?php 
                    echo Html::submitButton('修改', ["class" => "btn-glow primary login"]); 
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
</body>
</html>
