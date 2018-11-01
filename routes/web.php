<?php

// 首页
Route::get('/',  'Front\IndexController@index');
//首页
Route::get('/index',  'Front\IndexController@index');
//登录
Route::get('/login', function () {return view('ask.user.login');});
//验证登录信息
Route::post('/login','UserController@login');
//密码重置
Route::get('/reset', function () {return view('ask.user.reset');});
Route::post('/reset','UserController@reset');
//QQ登录信息
Route::get('/qqlogin','UserController@qqLogin');

Route::get('/qqurl','UserController@qqUrl');
//登出
Route::get('/logout','UserController@logout');
// 注册
Route::get('/register', function () {return view('ask.user.register');});
//保存注册用户
Route::post('/register','UserController@register');
// 检测该用户是否已经存在
Route::post('/user/check', 'UserController@isExist');
// 验证码
Route::get('/captcha/{tmp}', 'Common\CaptchaController@captcha');
// 邮件验证码
Route::post('/email/captcha', 'Common\EmailController@sendRegCaptcha');
//重置密码验证码
Route::post('/email/resetCaptcha', 'Common\EmailController@sendReSetCaptcha');
//全文搜索
Route::match(['get', 'post'], '/search/index', 'Front\SearchController@index');
//全文搜索
Route::get('/search/wenda','Front\SearchController@wenda');
//文章全文搜索
Route::get('/search/post','Front\SearchController@post');
//视频全文搜索
Route::get('/search/video','Front\SearchController@video');
//文章全文搜索
Route::get('/search/topic','Front\SearchController@topic');
//用户全文搜索
Route::get('/search/user','Front\SearchController@user');

//文章列表
Route::get('/post', 'Front\PostController@index');
//推荐文章
Route::get('/post/recom', 'Front\PostController@recom');
//热门文章
Route::get('/post/hot', 'Front\PostController@hot');
//文章详情
Route::get('/post/detail', 'Front\PostController@detail');
//文章分类筛选
Route::get('/post/cate', 'Front\PostController@cate');
//文章分类筛选
Route::get('/post/hotCate', 'Front\PostController@hotCate');
//文章分类筛选
Route::get('/post/recomCate', 'Front\PostController@recomCate');
//文章标签筛选
Route::get('/post/tag', 'Front\PostController@tag');
//问答列表
Route::get('/question', 'Front\QuestionController@index');
//问答详情页
Route::get('/question/detail', 'Front\QuestionController@detail');
//问答分类
Route::get('/question/cate', 'Front\QuestionController@cate');
//热门分类
Route::get('/question/hotCate', 'Front\QuestionController@hotCate');
//待回答分类
Route::get('/question/remainCate', 'Front\QuestionController@remainCate');
//问答标签筛选
Route::get('/question/tag', 'Front\QuestionController@tag');
//视频列表
Route::get('/video', 'Front\VideoController@index');
//视频详情
Route::get('/video/detail', 'Front\VideoController@detail');
//视频分类筛选
Route::get('/video/cate', 'Front\VideoController@cate');
//个人主页
Route::get('/home', 'Front\HomeController@index');
//个人主页文章
Route::get('/home/post', 'Front\HomeController@post');
//个人主页问答
Route::get('/home/question', 'Front\HomeController@question');
//个人主页视频
Route::get('/home/video', 'Front\HomeController@video');
//个人主页关注
Route::get('/home/topicUser', 'Front\HomeController@topicUser');
//个人主页粉丝
Route::get('/home/topicedUser', 'Front\HomeController@topicedUser');
//个人主页关注的话题
Route::get('/home/topics', 'Front\HomeController@topics');
//个人主页回答
Route::get('/home/answer', 'Front\HomeController@answer');
//个人主页详细信息
Route::get('/home/info', 'Front\HomeController@info');
//加载省份城市信息
Route::get('/common/loadCity/{province_id}', 'Common\CommonController@loadCity')->where(['province_id'=>'[0-9]+']);

//分类筛选
Route::get('/cate', 'Front\CategoryController@index');
//文章分类筛选
Route::get('/cate/article', 'Front\CategoryController@article');
//文档分类筛选
Route::get('/cate/answer', 'Front\CategoryController@answer');
//话题
Route::get('/topic', 'Front\TopicController@index');
//话题详情
Route::get('/topic/detail', 'Front\TopicController@detail');
//热门用户列表
Route::get('/user/hot', 'UserController@index');
//热门关注话题
Route::get('/topic/hot', 'Front\TopicController@hot');
//关注分类
Route::get('/topic/cate', 'Front\TopicController@cate');
//该话题文章
Route::get('/topic/post', 'Front\TopicController@post');
//该话题问答
Route::get('/topic/question', 'Front\TopicController@question');
//该话题视频
Route::get('/topic/video', 'Front\TopicController@video');
//前端授权后页面
Route::group(['middleware' => 'authed'], function () {
	Route::group(['namespace' => 'Front'], function()
	{
		//新建问答
		Route::get('/question/create',[ 'middleware' => ['permission:front-question-create'], 'uses' => 'QuestionController@create'] );
		//新建问答保存
		Route::post('/question/store',[ 'middleware' => ['permission:front-question-store'], 'uses' => 'QuestionController@store']  );
		//问答删除
		Route::post('/question/del', [ 'middleware' => ['permission:front-question-delete'], 'uses' => 'QuestionController@del']);
		//编辑问答
		Route::get('/question/edit',[ 'middleware' => ['permission:front-question-edit'], 'uses' =>  'QuestionController@edit']);
		//更新问答
		Route::post('/question/update',[ 'middleware' => ['permission:front-question-update'], 'uses' =>  'QuestionController@update'] );
		//问答收藏
		Route::post('/question/collect', [ 'middleware' => ['permission:front-question-collect'], 'uses' =>  'QuestionController@collect']);
        //取消收藏
        Route::post('/question/collectCancel', [ 'middleware' => ['permission:front-collect-cancel'], 'uses' =>  'QuestionController@collectCancel']);
		//问答回答提交
		Route::post('/question/answer', [ 'middleware' => ['permission:front-question-answer'], 'uses' =>  'QuestionController@answer']);
		//关注用户
		Route::get('/attention/user', [ 'middleware' => ['permission:front-user-attention'], 'uses' =>   'AttentionController@user']);
		//取消关注用户
		Route::get('/attention/cancelUser', [ 'middleware' => ['permission:front-user-cancel'], 'uses' => 'AttentionController@cancelUser'] );
		//个人中心
		Route::get('/person', [ 'middleware' => ['permission:front-person-index'], 'uses' => 'PersonController@index'] );
		//个人中心信息修改
        Route::match(['get', 'post'],'/person/info',[ 'middleware' => ['permission:front-person-info'], 'uses' =>  'PersonController@info']);
		//个人密码修改
		Route::get('/person/pass',[ 'middleware' => ['permission:front-person-pass'], 'uses' =>  'PersonController@password'] );
		//个人密码修改保存
		Route::post('/person/storepass',[ 'middleware' => ['permission:front-person-passstore'], 'uses' =>  'PersonController@storePass'] );
		//个人头像修改
		Route::get('/person/thumb',[ 'middleware' => ['permission:front-person-thumb'], 'uses' =>  'PersonController@thumb'] );
		//个人头像保存
		Route::post('/person/thumb',[ 'middleware' => ['permission:front-person-thumbstore'], 'uses' =>  'PersonController@thumbStore'] );
		//我的私信
		Route::get('/person/letter',[ 'middleware' => ['permission:front-person-letter'], 'uses' =>   'PersonController@letter']);
		//写私信
		Route::get('/person/sendLetter',[ 'middleware' => ['permission:front-person-sendletter'], 'uses' =>  'PersonController@sendLetter']);
		//发送私信
		Route::post('/person/storeLetter',[ 'middleware' => ['permission:front-person-storeletter'], 'uses' => 'PersonController@storeLetter'] );
		//私信展开
		Route::get('/person/letterDetail',[ 'middleware' => ['permission:front-letter-detail'], 'uses' => 'PersonController@letterDetail']);
        //我发布的文章
        Route::get('/person/post', [ 'middleware' => ['permission:front-person-post'], 'uses' =>'PersonController@post']);
        //我发布的问答
        Route::get('/person/answer', [ 'middleware' => ['permission:front-person-answer'], 'uses' => 'PersonController@answer']);
        //我发布的视频
        Route::get('/person/video', [ 'middleware' => ['permission:front-person-video'], 'uses' => 'PersonController@video']);
		//我收藏的文章
		Route::get('/person/postCollect', [ 'middleware' => ['permission:front-personpost-collect'], 'uses' =>  'PersonController@postCollect']);
		//我收藏的问答
		Route::get('/person/answerCollect', [ 'middleware' => ['permission:front-answer-collect'], 'uses' => 'PersonController@answerCollect']);
        //我收藏的视频
        Route::get('/person/videoCollect',  [ 'middleware' => ['permission:front-personvideo-collect'], 'uses' =>'PersonController@videoCollect']);
		//我的关注
		Route::get('/person/attention', [ 'middleware' => ['permission:front-person-atten'], 'uses' =>'PersonController@myAttention'] );
		//我关注的用户
		Route::get('/person/userAttention', [ 'middleware' => ['permission:front-person-useratten'], 'uses' => 'PersonController@userAttention'] );
		//我关注的话题
		Route::get('/person/topicAttention',  [ 'middleware' => ['permission:front-topic-atten'], 'uses' => 'PersonController@topicAttention'] );
		//新增我关注的话题
		Route::get('/person/topic/create',  [ 'middleware' => ['permission:front-topic-create'], 'uses' =>'PersonController@topicCreate'] );
		//取消我关注的话题
		Route::get('/person/topic/cancel', [ 'middleware' => ['permission:front-topic-cancel'], 'uses' => 'PersonController@topicCancel'] );
		//我已关注的话题
		Route::get('/person/topiced', [ 'middleware' => ['permission:front-person-topiced'], 'uses' => 'PersonController@topiced']);
        //文章收藏
        Route::post('/post/collect', [ 'middleware' => ['permission:front-post-collect'], 'uses' => 'PostController@collect']);
        //取消收藏
        Route::post('/post/collectCancel',[ 'middleware' => ['permission:front-postcollect-cancel'], 'uses' =>'PostController@collectCancel']);
		//文章新增
		Route::get('/post/create',[ 'middleware' => ['permission:front-post-create'], 'uses' =>'PostController@create']);
		//保存文章
		Route::post('/post/store',[ 'middleware' => ['permission:front-post-store'], 'uses' =>'PostController@store']);
		//编辑文章
		Route::get('/post/edit',[ 'middleware' => ['permission:front-post-edit'], 'uses' =>'PostController@edit']);
		//更新文章
		Route::post('/post/update',[ 'middleware' => ['permission:front-post-update'], 'uses' => 'PostController@update']);
		//文章删除
		Route::post('/post/del',[ 'middleware' => ['permission:front-post-delete'], 'uses' =>'PostController@del']);
        //文章添加评论
        Route::post('/post/comment',[ 'middleware' => ['permission:front-comment-create'], 'uses' => 'PostController@commentCreate']);
		//我收藏的文章
		Route::get('/post/myCollect',[ 'middleware' => ['permission:front-post-mycollect'], 'uses' =>  'PostController@myCollect']);
        //新增视频
        Route::get('/video/create',[ 'middleware' => ['permission:front-video-create'], 'uses' =>'VideoController@create'] );
        //保存视频
        Route::post('/video/store',[ 'middleware' => ['permission:front-video-store'], 'uses' =>'VideoController@store']);
        //视频删除
        Route::post('/video/del',[ 'middleware' => ['permission:front-video-delete'], 'uses' =>'VideoController@del'] );
        //编辑文章
        Route::get('/video/edit',[ 'middleware' => ['permission:front-video-edit'], 'uses' => 'VideoController@edit'] );
        //更新文章
        Route::post('/video/update',[ 'middleware' => ['permission:front-video-update'], 'uses' => 'VideoController@update']);
        //视频收藏
        Route::post('/video/collect',[ 'middleware' => ['permission:front-video-collect'], 'uses' => 'VideoController@collect']);
        //取消收藏
        Route::post('/video/collectCancel',[ 'middleware' => ['permission:front-video-cancelcollect'], 'uses' => 'VideoController@collectCancel'] );
        //视频添加评论
        Route::post('/video/comment',[ 'middleware' => ['permission:front-video-comment'], 'uses' => 'VideoController@commentCreate'] );
        //动态
        Route::get('/dynamic', [ 'middleware' => ['permission:front-dynamic-index'], 'uses' => 'DynamicController@index']);
        //文章点赞
        Route::get('/support/post',[ 'middleware' => ['permission:front-support-post'], 'uses' =>'SupportController@post'] );
        //问答点赞
        Route::get('/support/question',[ 'middleware' => ['permission:front-support-question'], 'uses' => 'SupportController@question'] );
        //视频点赞
        Route::get('/support/video', [ 'middleware' => ['permission:front-support-video'], 'uses' =>'SupportController@video'] );
	});



	//新后台管理
	Route::group(['prefix' => 'back','middleware' => ['role:admins']], function()
	{
        //后台首页
        Route::get('/panel', 'Admin\IndexController@index');
        //测试！！！
//        Route::get('/panel/decompose','\Lubusin\Decomposer\Controllers\DecomposerController@index');
	    //角色列表
	    Route::get('/role/list', [ 'middleware' => ['permission:role-list'], 'uses' => 'Admin\RoleController@index']);
	    //新增角色
	    Route::get('/role/add', [ 'middleware' => ['permission:role-add'], 'uses' => 'Admin\RoleController@add']);
	    //存储角色
	    Route::post('/role/store', [ 'middleware' => ['permission:role-store'], 'uses' => 'Admin\RoleController@store'] );
	    //编辑角色
	    Route::get('/role/edit', [ 'middleware' => ['permission:role-edit'], 'uses' => 'Admin\RoleController@edit'] );
	    //保存更新角色
	    Route::post('/role/update', [ 'middleware' => ['permission:role-update'], 'uses' =>  'Admin\RoleController@update']);
	    //删除角色
	    Route::post('/role/delete',  [ 'middleware' => ['permission:role-delete'], 'uses' =>'Admin\RoleController@delete']);
	    //权限列表
	    Route::get('/permit/list', [ 'middleware' => ['permission:permit-list'], 'uses' => 'Admin\PermissionController@index']);
	    //新增权限
	    Route::get('/permit/add', [ 'middleware' => ['permission:permit-add'], 'uses' =>  'Admin\PermissionController@add']);
	    //存储权限
	    Route::post('/permit/store', [ 'middleware' => ['permission:permit-store'], 'uses' => 'Admin\PermissionController@store']);
	    //删除权限
	    Route::post('/permit/delete', [ 'middleware' => ['permission:permit-delete'], 'uses' => 'Admin\PermissionController@delete'] );
	    //编辑权限
	    Route::get('/permit/edit', [ 'middleware' => ['permission:permit-edit'], 'uses' => 'Admin\PermissionController@edit'] );
        //更新权限
	    Route::post('/permit/update', [ 'middleware' => ['permission:permit-update'], 'uses' => 'Admin\PermissionController@update'] );
	    //用户列表
	    Route::get('/user/list',  [ 'middleware' => ['permission:user-list'], 'uses' => 'Admin\UserController@index']);
	    //新增用户
	    Route::get('/user/add', [ 'middleware' => ['permission:user-add'], 'uses' => 'Admin\UserController@add'] );
	    //保存用户
	    Route::post('/user/store', [ 'middleware' => ['permission:user-store'], 'uses' =>'Admin\UserController@store'] );
        //更新用户
        Route::post('/user/update', [ 'middleware' => ['permission:user-update'], 'uses' => 'Admin\UserController@update'] );
	    //编辑用户
	    Route::get('/user/edit',  [ 'middleware' => ['permission:user-edit'], 'uses' => 'Admin\UserController@edit']);
	    //删除用户
	    Route::post('/user/delete', [ 'middleware' => ['permission:user-delete'], 'uses' =>'Admin\UserController@delete'] );
        //更改用户状态
        Route::post('/user/status', [ 'middleware' => ['permission:user-status'], 'uses' =>  'Admin\UserController@status']);
	    //话题列表
	    Route::get('/topic/list', [ 'middleware' => ['permission:topic-list'], 'uses' =>  'Admin\TopicController@index']);
	    //新增话题
	    Route::get('/topic/add',  [ 'middleware' => ['permission:topic-add'], 'uses' => 'Admin\TopicController@add']);
	    //保存话题
	    Route::post('/topic/store', [ 'middleware' => ['permission:topic-store'], 'uses' =>  'Admin\TopicController@store']);
	    //编辑话题
	    Route::get('/topic/edit', [ 'middleware' => ['permission:topic-edit'], 'uses' => 'Admin\TopicController@edit'] );
	    //删除话题
	    Route::post('/topic/delete', [ 'middleware' => ['permission:topic-delete'], 'uses' =>'Admin\TopicController@delete'] );
	    //更改话题状态
	    Route::post('/topic/status', [ 'middleware' => ['permission:topic-status'], 'uses' =>  'Admin\TopicController@status']);
	    //分类列表
	    Route::get('/cate/list', [ 'middleware' => ['permission:cate-list'], 'uses' =>  'Admin\CateController@index']);
	    //新增分类
	    Route::get('/cate/add', [ 'middleware' => ['permission:cate-add'], 'uses' =>'Admin\CateController@add'] );
	    //保存分类
	    Route::post('/cate/store', [ 'middleware' => ['permission:cate-store'], 'uses' => 'Admin\CateController@store']);
	    //编辑分类
	    Route::get('/cate/edit',  [ 'middleware' => ['permission:cate-edit'], 'uses' => 'Admin\CateController@edit']);
	    //新增子分类
	    Route::get('/cate/addchild', [ 'middleware' => ['permission:cate-addchild'], 'uses' => 'Admin\CateController@addChild'] );
	    //删除分类
	    Route::post('/cate/delete', [ 'middleware' => ['permission:cate-delete'], 'uses' => 'Admin\CateController@delete'] );
	    //更改分类状态
	    Route::post('/cate/status', [ 'middleware' => ['permission:cate-status'], 'uses' =>  'Admin\CateController@status']);
	    //链接列表
	    Route::get('/link/list', [ 'middleware' => ['permission:link-list'], 'uses' =>  'Admin\LinkController@index']);
	    //新增链接
	    Route::get('/link/add', [ 'middleware' => ['permission:link-add'], 'uses' => 'Admin\LinkController@add']);
 	    //保存链接
	    Route::post('/link/store', [ 'middleware' => ['permission:link-store'], 'uses' =>  'Admin\LinkController@store']);
 	    //编辑链接
	    Route::get('/link/edit', [ 'middleware' => ['permission:link-edit'], 'uses' => 'Admin\LinkController@edit'] );
 	    //删除链接
	    Route::post('/link/delete', [ 'middleware' => ['permission:link-delete'], 'uses' => 'Admin\LinkController@delete'] );
 	    //更改链接状态
	    Route::post('/link/status', [ 'middleware' => ['permission:link-status'], 'uses' => 'Admin\LinkController@status'] );

        //新增公告
        Route::get('/notice/add', [ 'middleware' => ['permission:notice-add'],'uses' =>  'Admin\NoticeController@add']);
        //保存公告
        Route::post('/notice/store', ['middleware' => ['permission:notice-store'], 'uses' =>  'Admin\NoticeController@store']);
        //编辑公告
        Route::get('/notice/edit', [ 'middleware' => ['permission:notice-edit'], 'uses' => 'Admin\NoticeController@edit'] );
       //公告列表
        Route::get('/notice/list', [ 'middleware' => ['permission:notice-list'],'uses' => 'Admin\NoticeController@index'] );
       //删除公告
        Route::post('/notice/delete', [ 'middleware' => ['permission:notice-delete'],'uses' => 'Admin\NoticeController@delete'] );

        //文章列表
        Route::get('/post/list', [ 'middleware' => ['permission:post-list'], 'uses' =>'Admin\PostController@index'] );
        //创建文章
        Route::get('/post/create', ['uses' =>'Admin\PostController@create'] );
        //保存文章
        Route::post('/post/store', ['uses' =>'Admin\PostController@store'] );
        //更新文章
        Route::get('/post/edit', ['uses' =>'Admin\PostController@edit'] );
        //保存文章
        Route::post('/post/update', ['uses' =>'Admin\PostController@update'] );
        //删除文章
        Route::post('/post/delete', ['uses' => 'Admin\PostController@delete'] );
        //更改文章状态
        Route::post('/post/status', [ 'uses' =>'Admin\PostController@status'] );

        //问答列表
        Route::get('/question/list', ['middleware' => ['permission:question-list'],'uses' =>'Admin\QuestionController@index'] );
        //删除问答
        Route::post('/question/delete', ['middleware' => ['permission:question-delete'],'uses' => 'Admin\QuestionController@delete'] );
        //用户搜索
        Route::match(['get', 'post'],'/search/user', [ 'middleware' => ['permission:search-user'], 'uses' => 'Admin\SearchController@userSearch'] );
        //分类搜索
        Route::match(['get', 'post'],'/search/cate', [ 'uses' => 'Admin\SearchController@cateSearch'] );
        //文章搜索
        Route::match(['get', 'post'],'/search/post/title', ['uses' => 'Admin\SearchController@postTitleSearch'] );
        //话题搜索
        Route::match(['get', 'post'],'/search/topic/title', ['uses' => 'Admin\SearchController@topicTitleSearch'] );
    });
});



