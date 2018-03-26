<?php

//获取话题图片
Route::get('/back/tag/thumb/{id}', ['as' => 'getTopicImg', 'uses' => 'Common\FileController@getTopicImg']);

// 首页
Route::get('/', function () {
    return view('wenda.index');
});

//授权后页面
Route::group(['middleware' => 'authed'], function () {
	Route::group(['namespace' => 'Front'], function()
	{
		//新建问答
		Route::get('/question/create', 'QuestionController@create');
		//新建问答保存
		Route::post('/question/store', 'QuestionController@store');
		//问答删除
		Route::post('/question/del', 'QuestionController@del');
		//编辑问答
		Route::get('/question/edit', 'QuestionController@edit');
		//更新问答
		Route::post('/question/update', 'QuestionController@update');
		//问答收藏
		Route::post('/question/collect', 'QuestionController@collect');
		//问答回答提交
		Route::post('/question/answer', 'QuestionController@answer');
		//取消收藏
		Route::post('/question/collectCancel', 'QuestionController@collectCancel');
		//关注其他
		Route::get('/attention/user', 'AttentionController@user');
		//取消关注其他
		Route::get('/attention/cancelUser', 'AttentionController@cancelUser');
		//个人中心
		Route::get('/person', 'PersonController@index');
		//个人中心信息修改
		Route::get('/person/info', 'PersonController@info');
		//个人中心信息修改保存
		Route::post('/person/info', 'PersonController@info');
		//个人密码修改
		Route::get('/person/pass', 'PersonController@password');
		//个人密码修改保存
		Route::post('/person/storepass', 'PersonController@storePass');
		//个人头像修改
		Route::get('/person/thumb', 'PersonController@thumb');
		//个人头像保存
		Route::post('/person/thumb', 'PersonController@thumbStore');
		//我的收藏
		Route::get('/person/collect', 'PersonController@collect');
		//我的私信
		Route::get('/person/letter', 'PersonController@letter');
		//写私信
		Route::get('/person/sendLetter', 'PersonController@sendLetter');
		//发送私信
		Route::post('/person/storeLetter', 'PersonController@storeLetter');
		//私信展开
		Route::get('/person/letterDetail', 'PersonController@letterDetail');
		//我收藏的文章
		Route::get('/person/postCollect', 'PersonController@postCollect');
		//我收藏的问答
		Route::get('/person/answerCollect', 'PersonController@answerCollect');
		//我的关注
		Route::get('/person/attention', 'PersonController@myAttention');
		//我关注的用户
		Route::get('/person/userAttention', 'PersonController@userAttention');
		//我关注的话题
		Route::get('/person/topicAttention', 'PersonController@topicAttention');
		//新增我关注的话题
		Route::get('/person/topic/create', 'PersonController@topicCreate');
		//取消我关注的话题
		Route::get('/person/topic/cancel', 'PersonController@topicCancel');
		//我已关注的话题
		Route::get('/person/topiced', 'PersonController@topiced');
		//文章新增
		Route::get('/post/create', 'PostController@create');
		//保存文章
		Route::post('/post/store', 'PostController@store');
		//编辑文章
		Route::get('/post/edit', 'PostController@edit');
		//更新文章
		Route::post('/post/update', 'PostController@update');
		//文章删除
		Route::post('/post/del', 'PostController@del');
		//我收藏的文章
		Route::get('/post/myCollect', 'PostController@myCollect');
		//添加评论
		Route::post('/comment/create', 'CommentController@create');
	});
	//文章单张图片上传
	Route::post('/post/image/upload', 'Common\FileController@uploadImg');
	//登出
	Route::get('/logout','UserController@logout');
	
	
	
	//后台首页
	Route::get('/admin', 'Admin\IndexController@index');
	//新后台管理
	Route::group(['prefix' => 'back'], function()
	{
	    //角色列表
	    Route::get('/role/list', 'Admin\RoleController@index');
	    //新增角色
	    Route::get('/role/add', 'Admin\RoleController@add');
	    //存储角色
	    Route::post('/role/store', 'Admin\RoleController@store');
	    //编辑角色
	    Route::get('/role/edit', 'Admin\RoleController@edit');
	    //保存更新角色
	    Route::post('/role/update', 'Admin\RoleController@update');
	    //删除角色
	    Route::post('/role/delete', 'Admin\RoleController@delete');
	    //权限列表
	    Route::get('/permit/list', 'Admin\PermissionController@index');
	    //新增权限
	    Route::get('/permit/add', 'Admin\PermissionController@add');
	    //存储权限
	    Route::post('/permit/store', 'Admin\PermissionController@store');
	    //删除权限
	    Route::post('/permit/delete', 'Admin\PermissionController@delete');
	    //更新权限
	    Route::get('/permit/edit', 'Admin\PermissionController@edit');
	    Route::post('/permit/update', 'Admin\PermissionController@update');
	    //用户列表
	    Route::get('/user/list', 'Admin\UserController@index');
	    //新增用户
	    Route::get('/user/add', 'Admin\UserController@add');
	    //保存用户
	    Route::post('/user/store', 'Admin\UserController@store');
	    //编辑用户
	    Route::get('/user/edit', 'Admin\UserController@edit');
	    //删除用户
	    Route::post('/user/delete', 'Admin\UserController@delete');
	    //话题列表
	    Route::get('/topic/list', 'Admin\TopicController@index');
	    //新增话题
	    Route::get('/topic/add', 'Admin\TopicController@add');
	    //保存话题
	    Route::post('/topic/store', 'Admin\TopicController@store');
	    //编辑话题
	    Route::get('/topic/edit', 'Admin\TopicController@edit');
	    //删除话题
	    Route::post('/topic/delete', 'Admin\TopicController@delete');
	    //更改话题状态
	    Route::post('/topic/status', 'Admin\TopicController@status');
	    //搜索话题
	    Route::post('/topic/search', 'Admin\TopicController@search');
	    //分类列表
	    Route::get('/cate/list', 'Admin\CateController@index');
	    //新增分类
	    Route::get('/cate/add', 'Admin\CateController@add');
	    //保存分类
	    Route::post('/cate/store', 'Admin\CateController@store');
	    //编辑分类
	    Route::get('/cate/edit', 'Admin\CateController@edit');
	    //新增子分类
	    Route::get('/cate/addchild', 'Admin\CateController@addChild');
	    //删除分类
	    Route::post('/cate/delete', 'Admin\CateController@delete');
	    //更改分类状态
	    Route::post('/cate/status', 'Admin\CateController@status');
	    //文章列表
	    Route::get('/post/list', 'Admin\PostController@index');
	    //删除文章
	    Route::post('/post/delete', 'Admin\PostController@delete');
	    //更改文章状态
	    Route::post('/post/status', 'Admin\PostController@status');
	});
	
});
//文章收藏
Route::post('/post/collect', 'Front\PostController@collect');
//取消收藏
Route::post('/post/collectCancel', 'Front\PostController@collectCancel');
	
//首页搜索
Route::get('/sou','Sou\IndexController@index');
//搜索结果
Route::any('/result','Sou\IndexController@result');
//关于
Route::get('/about', function () {return view('wenda.crumbs.about');});
//登录
Route::get('/login', function () {return view('wenda.user.login');});
//全文搜索
Route::post('/search','Front\SearchController@index');
//全文搜索
Route::get('/search/wenda','Front\SearchController@wenda');
//文章全文搜索
Route::get('/search/post','Front\SearchController@post');
//文章全文搜索
Route::get('/search/topic','Front\SearchController@topic');
//用户全文搜索
Route::get('/search/user','Front\SearchController@user');
//验证登录信息
Route::post('/login','UserController@login');
// 注册
// Route::get('/register', function () {return view('wenda.user.register');});


//保存注册用户
Route::post('/register','UserController@register');
// 检测该用户是否已经存在
Route::post('/user/check', 'UserController@isExist');
// 验证码
Route::get('/captcha/{tmp}', 'Common\CaptchaController@captcha');
// 邮件验证码
Route::post('/email/captcha', 'Common\EmailController@sendRegCaptcha');
//文章列表
Route::get('/post', 'Front\PostController@index');
//问答列表
Route::get('/question', 'Front\QuestionController@index');
//问答详情页
Route::get('/question/detail', 'Front\QuestionController@detail');
//最新问答列表
Route::get('/question/latest', 'Front\QuestionController@latest');
//热门问答列表
Route::get('/question/hottest', 'Front\QuestionController@hottest');
//待问答列表
Route::get('/question/unanswered', 'Front\QuestionController@unanswered');
//问答分类筛选
Route::get('/question/cate', 'Front\QuestionController@cate');
//问答标签筛选
Route::get('/question/tag', 'Front\QuestionController@tag');
//个人主页
Route::get('/home', 'Front\HomeController@index');
//个人主页文章
Route::get('/home/post', 'Front\HomeController@post');
//个人主页回答
Route::get('/home/question', 'Front\HomeController@question');
//个人主页回答
Route::get('/home/answer', 'Front\HomeController@answer');
//个人主页粉丝
Route::get('/home/fan', 'Front\HomeController@fans');

//加载省份城市信息
Route::get('/common/loadCity/{province_id}', 'Common\CommonController@loadCity')->where(['province_id'=>'[0-9]+']);
//获取个人头像
Route::get('/person/thumb/{img}', ['as' => 'getThumbImg', 'uses' => 'Common\FileController@getThumbImg']);
//个人发布的文章
Route::get('/person/post', 'Front\PersonController@post');
//个人发布的问答
Route::get('/person/answer', 'Front\PersonController@answer');
//获取文章图片
Route::get('/post/images/{img}', ['as' => 'getPostImgs', 'uses' => 'Common\FileController@getPostImgs']);
//获取文章缩略图
Route::get('/post/thumb/{id}', ['as' => 'getPostImg', 'uses' => 'Common\FileController@getPostImg']);
//文章详情
Route::get('/post/detail', 'Front\PostController@detail');
//文章分类筛选
Route::get('/post/cate', 'Front\PostController@cate');
//文章标签筛选
Route::get('/post/tag', 'Front\PostController@tag');
//分类筛选
Route::get('/cate', 'Front\CategoryController@index');
//文章分类筛选
Route::get('/cate/article', 'Front\CategoryController@article');
//文档分类筛选
Route::get('/cate/answer', 'Front\CategoryController@answer');
//话题
Route::get('/topic', 'Front\TopicController@index');
//热门关注话题
Route::get('/topic/hot', 'Front\TopicController@hot');
//QQ社会化登录
Route::get('/auth/qq','Common\SocializeController@qqAuth');
//QQ社会化登录
Route::get('/auth/qq_redirect','Common\SocializeController@qqCallback');
// 微博社会化登录 引导用户到新浪微博的登录授权页面
Route::get('/auth/weibo', 'Common\SocializeController@weiboAuth');
// 微博社会化登录 用户授权后新浪微博回调的页面
Route::get('/auth/weibo_redirect', 'Common\SocializeController@weiboCallback');
//微信社会化监听
Route::get('/auth/weixin', 'Common\SocializeController@weixinAuth');
//微信社会化监听
Route::get('/auth/weixin_redirect', 'Common\SocializeController@weixinCallback');
//获取分类图片
Route::get('cate/thumb/{id}', ['as' => 'getCateImg', 'uses' => 'Common\FileController@getCateImg']);
