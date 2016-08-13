<div class="main-content">
    <!-- #section:basics/content.breadcrumbs -->
    <div class="breadcrumbs" id="breadcrumbs">
        <script type="text/javascript">
            try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
        </script>

        <ul class="breadcrumb">
            <li>
                <i class="ace-icon fa fa-home home-icon"></i>
                <a href="#">首页</a>
            </li>

            <li>
                <a href="#">文章</a>
            </li>
            <li class="active">Simple &amp; Dynamic</li>
        </ul><!-- /.breadcrumb -->

        <!-- #section:basics/content.searchbox -->
        <div class="nav-search" id="nav-search">
            <form class="form-search">
                        <span class="input-icon">
                            <input type="text" placeholder="Search ..." class="nav-search-input" id="nav-search-input" autocomplete="off" />
                            <i class="ace-icon fa fa-search nav-search-icon"></i>
                        </span>
            </form>
        </div><!-- /.nav-search -->

        <!-- /section:basics/content.searchbox -->
    </div>

    <!-- /section:basics/content.breadcrumbs -->
    <div class="page-content">
        <!-- #section:settings.box -->
        <div class="ace-settings-container" id="ace-settings-container">
            <div class="btn btn-app btn-xs btn-warning ace-settings-btn" id="ace-settings-btn">
                <i class="ace-icon fa fa-cog bigger-150"></i>
            </div>

            <div class="ace-settings-box clearfix" id="ace-settings-box">
                <div class="pull-left width-50">
                    <!-- #section:settings.skins -->
                    <div class="ace-settings-item">
                        <div class="pull-left">
                            <select id="skin-colorpicker" class="hide">
                                <option data-skin="no-skin" value="#438EB9">#438EB9</option>
                                <option data-skin="skin-1" value="#222A2D">#222A2D</option>
                                <option data-skin="skin-2" value="#C6487E">#C6487E</option>
                                <option data-skin="skin-3" value="#D0D0D0">#D0D0D0</option>
                            </select>
                        </div>
                        <span>&nbsp; Choose Skin</span>
                    </div>

                    <!-- /section:settings.skins -->

                    <!-- #section:settings.navbar -->
                    <div class="ace-settings-item">
                        <input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-navbar" />
                        <label class="lbl" for="ace-settings-navbar"> Fixed Navbar</label>
                    </div>

                    <!-- /section:settings.navbar -->

                    <!-- #section:settings.sidebar -->
                    <div class="ace-settings-item">
                        <input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-sidebar" />
                        <label class="lbl" for="ace-settings-sidebar"> Fixed Sidebar</label>
                    </div>

                    <!-- /section:settings.sidebar -->

                    <!-- #section:settings.breadcrumbs -->
                    <div class="ace-settings-item">
                        <input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-breadcrumbs" />
                        <label class="lbl" for="ace-settings-breadcrumbs"> Fixed Breadcrumbs</label>
                    </div>

                    <!-- /section:settings.breadcrumbs -->

                    <!-- #section:settings.rtl -->
                    <div class="ace-settings-item">
                        <input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-rtl" />
                        <label class="lbl" for="ace-settings-rtl"> Right To Left (rtl)</label>
                    </div>

                    <!-- /section:settings.rtl -->

                    <!-- #section:settings.container -->
                    <div class="ace-settings-item">
                        <input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-add-container" />
                        <label class="lbl" for="ace-settings-add-container">
                            Inside
                            <b>.container</b>
                        </label>
                    </div>

                    <!-- /section:settings.container -->
                </div><!-- /.pull-left -->

                <div class="pull-left width-50">
                    <!-- #section:basics/sidebar.options -->
                    <div class="ace-settings-item">
                        <input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-hover" />
                        <label class="lbl" for="ace-settings-hover"> Submenu on Hover</label>
                    </div>

                    <div class="ace-settings-item">
                        <input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-compact" />
                        <label class="lbl" for="ace-settings-compact"> Compact Sidebar</label>
                    </div>

                    <div class="ace-settings-item">
                        <input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-highlight" />
                        <label class="lbl" for="ace-settings-highlight"> Alt. Active Item</label>
                    </div>

                    <!-- /section:basics/sidebar.options -->
                </div><!-- /.pull-left -->
            </div><!-- /.ace-settings-box -->
        </div><!-- /.ace-settings-container -->

        <!-- /section:settings.box -->
        <div class="page-content-area">
            <div class="page-header">
                <h1>
                    Tables
                    <small>
                        <i class="ace-icon fa fa-angle-double-right"></i>
                        Static &amp; Dynamic Tables
                    </small>
                </h1>
            </div><!-- /.page-header -->

            <div class="row">
                <div class="col-xs-12">
                    <!-- PAGE CONTENT BEGINS -->
                    <div class="row">
                        <div class="col-xs-12">
                            <h3 class="header smaller lighter blue">文章管理</h3>
                            <div class="table-header">
                                文章列表
                            </div>
                            <!-- <div class="table-responsive"> -->
                            <!-- <div class="dataTables_borderWrap"> -->
                            <div>
                                <table id="sample-table-2" class="table table-striped table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th class="center">
                                            <label class="position-relative">
                                                <input type="checkbox" class="ace" />
                                                <span class="lbl"></span>
                                            </label>
                                        </th>
                                        <th>文章id</th>
                                        <th>文章标题</th>
                                        <th>文章简介</th>
                                        <th>文章作者</th>
                                        <th>文章所属分类</th>
                                        <th><i class="ace-icon fa fa-clock-o bigger-110 hidden-480"></i>文章更新时间</th>
                                        <th>操作</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php if(!empty($rows) && is_array($rows)):
                                        foreach($rows as $key => $val):
                                    ?>
                                        <tr>
                                            <td class="center">
                                                <label class="position-relative">
                                                    <input type="checkbox" class="ace" />
                                                    <span class="lbl"></span>
                                                </label>
                                            </td>
                                            <td><a href="#"><?php echo $val['id'];?></a></td>
                                            <td><?php echo $val['title'];?></td>
                                            <td><?php echo $val['brief'];?></td>
                                            <td><?php echo $val['username'];?></td>
                                            <td>
                                                <span class="label label-sm label-warning"><?php echo $val['category_name'];?></span>
                                            </td>
                                            <td><?php echo $val['updatetime'];?></td>
                                            <td>
                                                <div class="hidden-sm hidden-xs action-buttons">
                                                    <a class="blue" href="#">
                                                        <i class="ace-icon fa fa-search-plus bigger-130"></i>
                                                    </a>
                                                    <a class="green" href="#">
                                                        <i class="ace-icon fa fa-pencil bigger-130"></i>
                                                    </a>
                                                    <a class="red" href="#">
                                                        <i class="ace-icon fa fa-trash-o bigger-130"></i>
                                                    </a>
                                                </div>
                                                <div class="hidden-md hidden-lg">
                                                    <div class="inline position-relative">
                                                        <button class="btn btn-minier btn-yellow dropdown-toggle" data-toggle="dropdown" data-position="auto">
                                                            <i class="ace-icon fa fa-caret-down icon-only bigger-120"></i>
                                                        </button>

                                                        <ul class="dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close">
                                                            <li>
                                                                <a href="#" class="tooltip-info" data-rel="tooltip" title="View">
                                                                        <span class="blue">
                                                                            <i class="ace-icon fa fa-search-plus bigger-120"></i>
                                                                        </span>
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="#" class="tooltip-success" data-rel="tooltip" title="Edit">
                                                                        <span class="green">
                                                                            <i class="ace-icon fa fa-pencil-square-o bigger-120"></i>
                                                                        </span>
                                                                </a>
                                                            </li>

                                                            <li>
                                                                <a href="#" class="tooltip-error" data-rel="tooltip" title="Delete">
                                                                        <span class="red">
                                                                            <i class="ace-icon fa fa-trash-o bigger-120"></i>
                                                                        </span>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php  endforeach; endif;?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div id="modal-table" class="modal fade" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header no-padding">
                                    <div class="table-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                            <span class="white">&times;</span>
                                        </button>
                                        Results for "Latest Registered Domains
                                    </div>
                                </div>

                                <div class="modal-body no-padding">
                                    <table class="table table-striped table-bordered table-hover no-margin-bottom no-border-top">
                                        <thead>
                                        <tr>
                                            <th>Domain</th>
                                            <th>Price</th>
                                            <th>Clicks</th>

                                            <th>
                                                <i class="ace-icon fa fa-clock-o bigger-110"></i>
                                                Update
                                            </th>
                                        </tr>
                                        </thead>

                                        <tbody>
                                        <tr>
                                            <td>
                                                <a href="#">ace.com</a>
                                            </td>
                                            <td>$45</td>
                                            <td>3,330</td>
                                            <td>Feb 12</td>
                                        </tr>

                                        <tr>
                                            <td>
                                                <a href="#">base.com</a>
                                            </td>
                                            <td>$35</td>
                                            <td>2,595</td>
                                            <td>Feb 18</td>
                                        </tr>

                                        <tr>
                                            <td>
                                                <a href="#">max.com</a>
                                            </td>
                                            <td>$60</td>
                                            <td>4,400</td>
                                            <td>Mar 11</td>
                                        </tr>

                                        <tr>
                                            <td>
                                                <a href="#">best.com</a>
                                            </td>
                                            <td>$75</td>
                                            <td>6,500</td>
                                            <td>Apr 03</td>
                                        </tr>

                                        <tr>
                                            <td>
                                                <a href="#">pro.com</a>
                                            </td>
                                            <td>$55</td>
                                            <td>4,250</td>
                                            <td>Jan 21</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <div class="modal-footer no-margin-top">
                                    <button class="btn btn-sm btn-danger pull-left" data-dismiss="modal">
                                        <i class="ace-icon fa fa-times"></i>
                                        Close
                                    </button>

                                    <ul class="pagination pull-right no-margin">
                                        <li class="prev disabled">
                                            <a href="#">
                                                <i class="ace-icon fa fa-angle-double-left"></i>
                                            </a>
                                        </li>

                                        <li class="active">
                                            <a href="#">1</a>
                                        </li>

                                        <li>
                                            <a href="#">2</a>
                                        </li>

                                        <li>
                                            <a href="#">3</a>
                                        </li>

                                        <li class="next">
                                            <a href="#">
                                                <i class="ace-icon fa fa-angle-double-right"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div><!-- /.modal-content -->
                        </div><!-- /.modal-dialog -->
                    </div><!-- PAGE CONTENT ENDS -->
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.page-content-area -->
    </div><!-- /.page-content -->
</div><!-- /.main-content -->
<!-- #section:basics/foot.layout -->
</div><!-- /.main-container -->

<!-- basic scripts -->

<!--[if !IE]> -->
<script type="text/javascript">
window.jQuery || document.write("<script src=<?php echo ADMIN_STYLE_PATH.'/assets/js/jquery.min.js'?>>"+"<"+"/script>");
</script>

<!-- <![endif]-->

<!--[if IE]>
<script type="text/javascript">
window.jQuery || document.write("<script src=<?php echo ADMIN_STYLE_PATH.'/assets/js/jquery1x.min.js'?>>"+"<"+"/script>");
</script>
<![endif]-->
<script type="text/javascript">
if('ontouchstart' in document.documentElement) document.write("<script src=<?php echo ADMIN_STYLE_PATH.'/assets/js/jquery.mobile.custom.min.js'?>>"+"<"+"/script>");
</script>
<script src="<?php echo ADMIN_STYLE_PATH.'/assets/js/bootstrap.min.js'?>"></script>

<!-- page specific plugin scripts -->
<script src="<?php echo ADMIN_STYLE_PATH.'/assets/js/jquery.dataTables.min.js'?>"></script>
<script src="<?php echo ADMIN_STYLE_PATH.'/assets/js/jquery.dataTables.bootstrap.js'?>"></script>

<!-- ace scripts -->
<script src="<?php echo ADMIN_STYLE_PATH.'/assets/js/ace-elements.min.js'?>"></script>
<script src="<?php echo ADMIN_STYLE_PATH.'/assets/js/ace.min.js'?>"></script>

<!-- inline scripts related to this page -->
<script type="text/javascript">
jQuery(function($) {
    var oTable1 =
        $('#sample-table-2')
        //.wrap("<div class='dataTables_borderWrap' />")   //if you are applying horizontal scrolling (sScrollX)
            .dataTable( {
                bAutoWidth: false,
                "aoColumns": [
                    { "bSortable": false },
                    null, null,null, null, null,null,//用户设置列时不能任意指定，无需设置的定义为null
                    { "bSortable": false }
                ],
                "aaSorting": [],

                //自定义修改语言 by kele
                "language": {
                    "zeroRecords": "啊哦，木有找到任何信息哦",
                }

                //,
                //"sScrollY": "200px",
                //"bPaginate": false,

                //"sScrollX": "100%",
                //"sScrollXInner": "120%",
                //"bScrollCollapse": true,
                //Note: if you are applying horizontal scrolling (sScrollX) on a ".table-bordered"
                //you may want to wrap the table inside a "div.dataTables_borderWrap" element

                //"iDisplayLength": 50
            } );
    /**
     var tableTools = new $.fn.dataTable.TableTools( oTable1, {
                "sSwfPath": "../../copy_csv_xls_pdf.swf",
                "buttons": [
                    "copy",
                    "csv",
                    "xls",
                    "pdf",
                    "print"
                ]
            } );
     $( tableTools.fnContainer() ).insertBefore('#sample-table-2');
     */


    $(document).on('click', 'th input:checkbox' , function(){
        var that = this;
        $(this).closest('table').find('tr > td:first-child input:checkbox')
            .each(function(){
                this.checked = that.checked;
                $(this).closest('tr').toggleClass('selected');
            });
    });


    $('[data-rel="tooltip"]').tooltip({placement: tooltip_placement});
    function tooltip_placement(context, source) {
        var $source = $(source);
        var $parent = $source.closest('table')
        var off1 = $parent.offset();
        var w1 = $parent.width();

        var off2 = $source.offset();
        //var w2 = $source.width();

        if( parseInt(off2.left) < parseInt(off1.left) + parseInt(w1 / 2) ) return 'right';
        return 'left';
    }

})
</script>

<!-- the following scripts are used in demo only for onpage help and you don't need them -->
<link rel="stylesheet" href="<?php echo ADMIN_STYLE_PATH.'/assets/css/ace.onpage-help.css'?>" />
<link rel="stylesheet" href="<?php echo ADMIN_STYLE_PATH.'/docs/assets/js/themes/sunburst.css'?>" />

<script type="text/javascript"> ace.vars['base'] = '..'; </script>
<script src="<?php echo ADMIN_STYLE_PATH.'/assets/js/ace/elements.onpage-help.js'?>"></script>
<script src="<?php echo ADMIN_STYLE_PATH.'/assets/js/ace/ace.onpage-help.js'?>"></script>
<script src="<?php echo ADMIN_STYLE_PATH.'/docs/assets/js/rainbow.js'?>"></script>
<script src="<?php echo ADMIN_STYLE_PATH.'/docs/assets/js/language/generic.js'?>"></script>
<script src="<?php echo ADMIN_STYLE_PATH.'/docs/assets/js/language/html.js'?>"></script>
<script src="<?php echo ADMIN_STYLE_PATH.'/docs/assets/js/language/css.js'?>"></script>
<script src="<?php echo ADMIN_STYLE_PATH.'/docs/assets/js/language/javascript.js'?>"></script>
</body>
</html>