<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge;chrome=1">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>big city</title>
    <?php echo _get_html_cssjs('admin_js', 'jquery.js,jquery.validation.min.js,admincp.js,jquery.cookie.js,common.js', 'js'); ?>
    <link href="<?php echo _get_cfg_path('admin') . TPL_ADMIN_NAME; ?>css/skin_0.css" type="text/css" rel="stylesheet"
          id="cssfile"/>
    <?php echo _get_html_cssjs('admin_css', 'perfect-scrollbar.min.css', 'css'); ?>

    <?php echo _get_html_cssjs('admin', TPL_ADMIN_NAME . 'css/font-awesome.min.css', 'css'); ?>

    <!--[if IE 7]>
    <?php echo _get_html_cssjs('admin',TPL_ADMIN_NAME.'css/font-awesome-ie7.min.css','css');?>
    <![endif]-->
    <?php echo _get_html_cssjs('admin_js', 'perfect-scrollbar.min.js', 'js'); ?>

</head>
<body>

<div class="page">
    <div class="fixed-bar">
        <div class="item-title">
            <h3>文章管理</h3>
            <ul class="tab-base">
                <li><a href="JavaScript:void(0);" class="current"><span>文章管理</span></a></li>
            </ul>
        </div>
    </div>
    <div class="fixed-empty"></div>
    <form method="get" name="formSearch" id="formSearch" action="<?php echo ADMIN_SITE_URL.'/article/index';?>">
        <table class="tb-type1 noborder search">
            <tbody>
            <tr>
                <td>
                    <select name="search_field_name" >
                        <option  value="titile" <?php if (!empty($type)&&$type=='titile'){?>selected<?php }?>>文章标题</option>
                        <option  value="real_name" <?php if (!empty($type)&&$type=='real_name'){?>selected<?php   }?>>医生名称</option>
                    </select>
                </td>
                <td>
                    <input type="text" value="<?php if (!empty($cKey)){echo $cKey;}?>" name="search_field_value" class="txt">
                </td>
                <td>
                    <a href="javascript:void(0);" id="ncsubmit" class="btn-search " title="<?php echo lang('nc_query');?>">&nbsp;</a>
                </td>
            </tr>
            </tbody>
        </table>
    </form>
    <table class="table tb-type2" id="prompt">
        <tbody>
        <tr class="space odd">
            <th colspan="12"><div class="title">
                    <h5>操作提示</h5>
                    <span class="arrow"></span></div></th>
        </tr>
        <tr>
            <td><ul>
                    <li></li>
                    <li></li>
                </ul></td>
        </tr>
        </tbody>
    </table>
    <!--<br/>
    <table cellpadding="0" cellspacing="0" bordercolor="#eee" border="0" style="margin-top:2px" width="100%">
        <tr>
            <td height="32">

            </td>
        </tr>
    </table>-->
    <table class="table tb-type2">
        <!-- 字段名称，数组格式输出 -->
        <tr class="thead">
            <?php if (!empty($data_key) && is_array($data_key)) { ?>
                <?php foreach ($data_key as $value) { ?>
                    <th class="align-center"><?php echo $value; ?></th>
                <?php }
            } ?>
            <th class="align-center">操作</th>
        </tr>
        </thead>
        <tbody>
        <!-- 数据模块 -->
        <?php if (!empty($article_list) && is_array($article_list)) { ?>
            <?php foreach ($article_list as $value) { ?>
                <tr class="hover">
                    <?php if (!empty($data_key) && is_array($data_key)) { ?>
                        <?php foreach ($data_key as $key => $val) { ?>

                            <?php if($key == 'status'){?>
                                <td class="align-center"><?php echo isset($status[$value[$key]]) ? $status[$value[$key]] : ''; ?></td>
                            <?php }else if($key == 'createtime'){?>
                                <td class="align-center"><?php echo $value[$key] ? date("Y-m-d H:i", $value[$key]) : ''; ?></td>
                            <?php }else{?>
                                <td class="align-center"><?php echo $value[$key]; ?></td>
                            <?php }}} ?>
                    <td class="align-center">
                        <?php if ($value['status'] == 0){ ?>
                            <a class="check" data-url="<?php echo ADMIN_SITE_URL . '/article/check' ?>" data-article_id="<?php echo $value['id'];?>">审核</a>
                        <?php } else { echo '审核'; } ?> |
                        <a href="<?php echo ADMIN_SITE_URL . '/article/detail/' . $value['id']; ?>">详情</a> |
                        <a class="delete" data-url="<?php echo ADMIN_SITE_URL . '/article/delete' ?>" data-article_id="<?php echo $value['id'];?>">删除</a>
                    </td>
                </tr>
            <?php }} ?>
        </tbody>
    </table>
    <div class="pagination"> <?php echo $pages;?> </div>
</div>
<!-- JS 交互 -->
<script type="application/javascript">
    $(document).ready(function () {
        $(".delete").on("click", function () {
            post_data($(this), '是否删除数据', '删除失败');
        });
        $(".check").on("click", function () {
            post_data($(this), '是否审核通过', '审核失败');
        });
        function post_data($this, $message, $message_fail) {
            if (confirm($message)) {
                $.post($this.data('url'), {
                    article_id: $this.data('article_id')
                }, function (data, status) {
                    if (status) {
                        switch (data) {
                            case '1':
                                alert('操作成功');
                                location.reload();
                                break;
                            default:
                                alert($message_fail);
                                break;
                        }
                    }
                })
            }
        }

        $('#ncsubmit').click(function(){
            $('#formSearch').submit();
        });

    })
</script>
</body>
</html>
