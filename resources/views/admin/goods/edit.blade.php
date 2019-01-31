@extends('admin.layouts.base')

@section('styles')
    <style>
        body .layui-tree-skin-shihuang .layui-tree-branch{color: #EDCA50;}
        .form-horizontal .banners ul{margin-top: 20px;display: block;}
        .form-horizontal .banners ul li{float: left;text-align: center;margin-right: 20px;}
        .form-horizontal .banners ul li div{width: 140px; height: 140px; line-height: 140px; position: relative;box-sizing: border-box; border: 1px dashed #ddd;}
        .form-horizontal .banners ul li div.cover:before{content: '封面';display: inline-block;width: 60px;height: 24px;line-height: 24px;position: absolute;top: 0;right: 0;background-color: #ff7300;color: #fff;}
        .form-horizontal .banners ul li div img{max-width: 100%; max-height: 100%;object-fit: cover;vertical-align: middle;}
        .form-horizontal .banners ul li p{margin-top: 10px}
        .form-horizontal .banners ul li p a:first-child{margin-right: 5px;}
        .form-horizontal .banners ul li p a{display: inline-block; width: 60px;height: 24px;line-height: 24px;background-color: #aaa;color: #fff;}
    </style>
    <link href="{{asset('common/node_modules/cropperjs/dist/cropper.min.css')}}" rel="stylesheet">
    {{--<script src="{{asset('common/tinymce/jquery.tinymce.min.js')}}"></script>--}}
    <script src="{{asset('common/tinymce/tinymce.min.js')}}"></script>
    <script>
        tinymce.init({
            selector: '#textarea',
            language: 'zh_CN',
            branding: false,
            elementpath: false,
            height: 600,
            menubar: 'edit insert view format table tools',
            plugins: [ 'advlist autolink lists link image charmap print preview hr anchor pagebreak imagetools',
                'searchreplace visualblocks visualchars code fullpage',
                'insertdatetime media nonbreaking save table contextmenu directionality',
                'emoticons paste textcolor colorpicker textpattern imagetools codesample' ],
            toolbar1: ' newnote print preview | undo redo | insert | styleselect | forecolor backcolor bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image emoticons media codesample',
            autosave_interval: '20s',
            image_advtab: true,
            images_upload_url: "{{route('common.upload.image')}}",
            images_upload_base_path: '',
            images_upload_credentials: true,
            /*images_upload_handler: function (blobInfo, success, failure) {
                var xhr, formData;

                xhr = new XMLHttpRequest();
                xhr.withCredentials = false;
                xhr.open('POST', "");

                xhr.onload = function() {
                    var json;

                    if (xhr.status < 200 || xhr.status >= 300) {
                        failure('HTTP Error: ' + xhr.status);
                        return;
                    }

                    json = JSON.parse(xhr.responseText);

                    if (!json || typeof json.location != 'string') {
                        failure('Invalid JSON: ' + xhr.responseText);
                        return;
                    }

                    success(json.location);
                };

                formData = new FormData();
                formData.append('file', blobInfo.blob(), blobInfo.filename());

                xhr.send(formData);
            },*/
            table_default_styles: {
                width: '100%',
                borderCollapse: 'collapse'
            },
            setup: function (editor) {
                editor.on('init', function (e) {
                    //vm.spinShow2 = false;
                    //tinyMCE.get('textarea').setContent("");

                });
                editor.on('change', function () {
                    editor.save();
                });
                /*editor.on('blur', function (e) {
                    //如果当前页面有多个编辑器（下面的“[0]”表示第一个编辑器，以此类推）
                    // 获取内容：tinyMCE.editors[0].getContent()
                    // 设置内容：tinyMCE.editors[0].setContent("需要设置的编辑器内容")
                    //vm.addForm.MessageContent = tinyMCE.get('textarea').getContent();
                    tinyMCE.activeEditor.setContent(tinyMCE.activeEditor.getContent());
                });*/
            }
        });
    </script>
@endsection

@section('content')
    <!-- Main content -->
    <main class="main">

        <!-- Breadcrumb -->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">Home</li>
            <li class="breadcrumb-item"><a href="#">Admin</a>
            </li>
            <li class="breadcrumb-item active">Dashboard</li>

            <!-- Breadcrumb Menu-->
            <li class="breadcrumb-menu hidden-md-down">
                <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                    <a class="btn btn-secondary" href="#"><i class="icon-speech"></i></a>
                    <a class="btn btn-secondary" href="./"><i class="icon-graph"></i> &nbsp;Dashboard</a>
                    <a class="btn btn-secondary" href="#"><i class="icon-settings"></i> &nbsp;Settings</a>
                </div>
            </li>
        </ol>


        <div class="container-fluid">
            <div class="animated fadeIn">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <strong>Basic Form</strong>Elements
                            </div>
                            <form action="{{route('admin.goods.save')}}" method="post" enctype="multipart/form-data" class="form-horizontal ajax-form" onsubmit="return false">
                                <div class="card-block">
                                    {{--<div class="form-group row">
                                        <label class="col-md-2 form-control-label">Static</label>
                                        <div class="col-md-10">
                                            <p class="form-control-static">Username</p>
                                        </div>
                                    </div>--}}
                                    <div class="form-group row">
                                        <label class="col-md-2 form-control-label" for="text-input">商品标题</label>
                                        <div class="col-md-10 input-group">
                                            <input type="text" id="title" name="title" class="form-control" placeholder="请输入商品标题">
                                            <span class="input-group-addon">限3-50个字符</span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-2 form-control-label" for="text-input">商品数量</label>
                                        <div class="col-md-10 input-group">
                                            <input type="text" id="unit" name="unit" class="form-control" placeholder="请输入商品数量">
                                            <span class="input-group-addon">商品库存数量</span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-2 form-control-label" for="text-input">商品市场价</label>
                                        <div class="col-md-10 input-group">
                                            <input type="text" id="market_price" name="market_price" class="form-control" placeholder="商品通常市场价格">
                                            <span class="input-group-addon">通常的价格</span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-2 form-control-label" for="text-input">商品最新价</label>
                                        <div class="col-md-10 input-group">
                                            <input type="text" id="recent_quotation" name="recent_quotation" class="form-control" placeholder="最新价格可以是优惠价、折扣价">
                                            <span class="input-group-addon">根据行情更新的价格</span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-2 form-control-label" for="text-input">促销语</label>
                                        <div class="col-md-10 input-group">
                                            <input type="text" id="promotion" name="promotion" class="form-control" placeholder="请输入促销语，限3-50个字符">
                                            <span class="input-group-addon">emmmmm.....自由发挥</span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-2 form-control-label" for="multiple-select">商品标签</label>
                                        <div class="col-md-10 input-group">
                                            <textarea id="cateid_tree" name="cateid_tree" rows="4" class="form-control" placeholder="标签啊">活好
工龄长
责任心强
长得帅</textarea>
                                            <span class="input-group-addon">一行一个标签，回车分行</span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-2 form-control-label" for="textarea-input">简介</label>
                                        <div class="col-md-10">
                                            <textarea id="remark" name="remark" rows="9" class="form-control" placeholder="当然是商品的简介啊"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group row banners">
                                        <label class="col-md-2 form-control-label" for="file-input">商品轮播图</label>
                                        <div class="col-md-10">
                                            <input type="hidden" name="thumb" value="" class="thumb"/>
                                            <ul class="clearfix">
                                                <li>
                                                    <div class="cover_img cover">
                                                        <input type="hidden" name="album[]" value="https://jiancai-jsjzjz.oss-cn-beijing.aliyuncs.com/15c4c022b3d8d9.jpg">
                                                        <img src="https://jiancai-jsjzjz.oss-cn-beijing.aliyuncs.com/15c4c022b3d8d9.jpg" alt="">
                                                    </div>
                                                    <p><a href="javascript:;" onclick="return setThumb($(this));">设为封面</a><a href="javascript:void(0);" onclick="return delImg($(this));">删除</a></p>
                                                </li>
                                                <li>
                                                <div class="cover_img">
                                                    <input type="hidden" name="album[]" value="http://server.script.me/storage/upload/20190130/15c5152567cf9c.jpg">
                                                    <img src="http://server.script.me/storage/upload/20190130/15c5152567cf9c.jpg" alt="">
                                                </div>
                                                    <p><a href="javascript:;" onclick="return setThumb($(this));">设为封面</a><a href="javascript:void(0);" onclick="return delImg($(this));">删除</a></p>
                                                </li>
                                                <li class="upload_html"><div onclick="return $('#uploader-btn').click();"><img src="{{asset('admin/img/file_icon.png')}}"></div></li>
                                            </ul>
                                        </div>
                                        <div id="uploader-box" style="display: none;">
                                            <input type="button" id="uploader-btn"/>
                                            <input type="hidden" class="tmp_order_sn" value=""/>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-2 form-control-label" for="textarea-input">商品详情</label>
                                        <div class="col-md-10">
                                            <textarea id="textarea" name="content" class="form-control" placeholder=""></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group form-actions">
                                        <button type="submit" class="btn btn-primary"> 确定新增</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!--/.col-->
                </div>
                <!--/.row-->
            </div>
        </div>
        <!-- /.conainer-fluid -->
    </main>
@endsection

@section('scripts')
    <script src="{{asset('common/plupload-2.3.6/js/plupload.full.min.js')}}"></script>
    <script type="text/javascript">
        var loadingIndex = 0;
        var uploader = new plupload.Uploader({
            runtimes : 'html5,flash,silverlight,html4',
            browse_button : "uploader-btn", // you can pass an id...
            container: document.getElementById("uploader-box"), // ... or DOM Element itself
            url : "{{route('common.upload.image')}}",
            flash_swf_url : '{{asset('common/plupload-2.3.6/js/Moxie.swf')}}',
            silverlight_xap_url : '{{asset('common/plupload-2.3.6/js/Moxie.xap')}}',
            multi_selection: true, // 是否允许多张
            filters : {
                max_file_size : '10mb',
                mime_types: [
                    {title : "选择商品图片", extensions : "JPG,PNG,JPEG"}
                ]
            },
            init: {
                PostInit: function() {

                    //document.getElementById('filelist').innerHTML = '';

                    /*document.getElementById('uploadfiles').onclick = function() {
                     uploader.start();
                     return false;
                     };*/
                },

                FilesAdded: function(up, files) {

                    uploader.start();
                    plupload.each(files, function(file) {

                    });

                },

                UploadProgress: function(up, file) {
                    if($('.banners img').length > 10){
                        layer.msg('最多可上传10张'); return;
                    }
                    loadingIndex = layer.load(1, {
                        shade: [0.1,'#fff'] //0.1透明度的白色背景
                    });
                    //document.getElementById(file.id).getElementsByTagName('b')[0].innerHTML = '<span>' + file.percent + "%</span>";
                },

                FileUploaded: function (up,file,response){
                    layer.close(loadingIndex);
                    if($('.banners img').length > 10){
                        return;
                    }
                    var respJson = JSON.parse(response.response);
                    if(respJson.status !== 1){

                        layer.alert(respJson.msg,{
                            title:'发布商品',
                            btn: ['确认'],
                            icon:'2'
                        });
                        return;
                    }else {
                        var htmlString = '<li><div class="cover_img"><input type="hidden" name="album[]" value="'+respJson.data.url+'"/><img src="'+respJson.data.url+'" alt=""></div><p><a href="javascript:;" onclick="return setThumb($(this));">设为封面</a><a href="javascript:void(0);" onclick="return delImg($(this));">删除</a></p></li>';
                        $(htmlString).insertBefore('.upload_html');
                        if ($('.cover').find('input').val() === undefined){
                            $('.cover_img').addClass('cover');
                            var thumb=$('.cover img').attr('src');
                            $('.thumb').val(thumb);
                        }
                    }
                },
                Error: function(up, err) {
                    //document.getElementById('console').appendChild(document.createTextNode("\nError #" + err.code + ": " + err.message));
                }
            }
        });
        uploader.init();
        function delImg(_this)
        {
            _this.parents('li').remove();
        }
        function setThumb(_this){
            $('.cover').removeClass('cover');
            _this.parents('li').find('.cover_img').addClass('cover');
            var thumb=$('.cover img').attr('src');
            $('.thumb').val(thumb);
        }
    </script>
@endsection
