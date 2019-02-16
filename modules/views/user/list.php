<?php
    $this->title = '会员列表';
    /*$this->params['breadcrumbs'][] = ['label' => '用户管理', 'url' => ['/admin/user/users']];
    $this->params['breadcrumbs'][] = $this->title;*/
    $this->registerCssFile('admin/css/compiled/user-list.css');
?>
<div class="container-fluid">
    <div id="pad-wrapper" class="users-list">
        <div class="row-fluid header">
            <h3>
                会员列表
            </h3>
            <div class="span10 pull-right">
                <a href="<?php echo yii\helpers\Url::to(['user/add']) ?>" class="btn-flat success pull-right">
                    <span>
                        &#43;
                    </span>
                    添加新用户
                </a>
            </div>
        </div>
        <div class="row-fluid table">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th class="span3 sortable">
                            <span class="line"></span>
                            用户名
                        </th>
                        <th class="span3 sortable">
                            <span class="line"></span>
                            姓名
                        </th>
                        <th class="span2 sortable">
                            <span class="line"></span>
                            昵称
                        </th>
                        <th class="span3 sortable">
                            <span class="line"></span>
                            年龄
                        </th>
                        <th class="span3 sortable">
                            <span class="line"></span>
                            性别
                        </th>
                        <th class="span3 sortable">
                            <span class="line"></span>
                            生日
                        </th>
                        <th class="span3 sortable align-right">
                            <span class="line"></span>
                            操作
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        foreach($users as $user): 
                    ?>
                    <tr class="first">
                        <td>
                            <?php 
                                if (empty($user->profile->avatar)): 
                            ?>
                            <img src="<?php echo Yii::$app->params['defaultValue']['avatar']; ?>" class="img-circle avatar hidden-phone" />
                            <?php 
                                else: 
                            ?>
                            <img src="assets/uploads/avatar/<?php echo $user->profile->avatar; ?>" class="img-circle avatar hidden-phone" />
                            <?php 
                                endif; 
                            ?>
                            <a href="#" class="name">
                                <?php 
                                    echo $user->username; 
                                ?>
                            </a>
                            <span class="subtext">
                                <?php 
                                    echo $user->useremail; 
                                ?>
                            </span>
                        </td>
                        <td>
                            <?php 
                                echo isset($user->profile->truename) ? $user->profile->truename : '未填写'; 
                            ?>
                        </td>
                        <td>
                            <?php 
                                echo isset($user->profile->nickname) ? $user->profile->nickname : '未填写'; 
                            ?>
                        </td>
                        <td>
                            <?php 
                                echo isset($user->profile->age) ? $user->profile->age : '未填写'; 
                            ?>
                        </td>
                        <td>
                            <?php 
                                echo isset($user->profile->sex) ? $user->profile->sex : '未填写'; 
                            ?>
                        </td>
                        <td>
                            <?php 
                                echo isset($user->profile->birthday) ? $user->profile->birthday : '未填写'; 
                            ?>
                        </td>
                        <td class="align-right">
                            <a href="<?php echo yii\helpers\Url::to(['user/del', 'id' => $user->id]); ?>">
                                删除
                            </a>
                        </td>
                    </tr>
                    <?php 
                        endforeach; 
                    ?>
                </tbody>
            </table>
        </div>
        <div class="pagination pull-right">
            <?php 
                echo yii\widgets\LinkPager::widget([
                    'pagination' => $pagination,
                    'prevPageLabel' => '&#8249;',
                    'nextPageLabel' => '&#8250;',
                ]); 
            ?>
        </div>
    </div>
</div>