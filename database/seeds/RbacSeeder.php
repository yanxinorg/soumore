<?php

use Illuminate\Database\Seeder;

class RbacSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //清除角色表数据
        DB::table('roles')->delete();
        //清除权限表数据
        DB::table('permissions')->delete();
        //清除权限角色关联表数据
        DB::table('permission_role')->delete();
        //清除用户表数据
        DB::table('users')->delete();
        //清除用户角色表数据
        DB::table('role_user')->delete();

        //初始化超管角色
        $admin = new \App\Role();
        $admin->name = 'admins';
        $admin->display_name = 'admins';
        $admin->description = '管理员组';
        $admin->save();

        //初始化普通用户角色
        $normal = new \App\Role();
        $normal->name = 'normals';
        $normal->display_name = 'normals';
        $normal->description = '普通用户组';
        $normal->save();

        //---------------------------------------------------------------------------------前端权限列表-------------------------------------------------------------//
        //创建问答
        $frontquestionCreate = new \App\Permission();
        $frontquestionCreate->name = 'front-question-create';
        $frontquestionCreate->display_name = 'Create Question';
        $frontquestionCreate->description = '创建问答';
        $frontquestionCreate->save();
        //保存问答
        $frontquestionStore = new \App\Permission();
        $frontquestionStore->name = 'front-question-store';
        $frontquestionStore->display_name = 'Store Question';
        $frontquestionStore->description = '保存问答';
        $frontquestionStore->save();
        //删除问答
        $frontquestionDelete = new \App\Permission();
        $frontquestionDelete->name = 'front-question-delete';
        $frontquestionDelete->display_name = 'Delete Question';
        $frontquestionDelete->description = '删除问答';
        $frontquestionDelete->save();
        //编辑问答
        $frontquestionEdit = new \App\Permission();
        $frontquestionEdit->name = 'front-question-edit';
        $frontquestionEdit->display_name = 'Edit Question';
        $frontquestionEdit->description = '编辑问答';
        $frontquestionEdit->save();
        //更新问答
        $frontquestionUpdate = new \App\Permission();
        $frontquestionUpdate->name = 'front-question-update';
        $frontquestionUpdate->display_name = 'Update Question';
        $frontquestionUpdate->description = '更新问答';
        $frontquestionUpdate->save();
        //收藏问答
        $frontquestionCollect = new \App\Permission();
        $frontquestionCollect->name = 'front-question-collect';
        $frontquestionCollect->display_name = 'Collect Question';
        $frontquestionCollect->description = '收藏问答';
        $frontquestionCollect->save();
        //取消收藏问答
        $frontcollectCancel = new \App\Permission();
        $frontcollectCancel->name = 'front-collect-cancel';
        $frontcollectCancel->display_name = 'Cancel Collect';
        $frontcollectCancel->description = '取消收藏问答';
        $frontcollectCancel->save();
        //回答问答
        $frontquestionAnswer = new \App\Permission();
        $frontquestionAnswer->name = 'front-question-answer';
        $frontquestionAnswer->display_name = 'Answer Question';
        $frontquestionAnswer->description = '回答问答';
        $frontquestionAnswer->save();
        //关注用户
        $frontuserAttention = new \App\Permission();
        $frontuserAttention->name = 'front-user-attention';
        $frontuserAttention->display_name = 'User Attention';
        $frontuserAttention->description = '关注用户';
        $frontuserAttention->save();
        //取消关注用户
        $frontuserCancel = new \App\Permission();
        $frontuserCancel->name = 'front-user-cancel';
        $frontuserCancel->display_name = 'User Cancel';
        $frontuserCancel->description = '取消关注用户';
        $frontuserCancel->save();
        //用户个人首页
        $frontpersonIndex = new \App\Permission();
        $frontpersonIndex->name = 'front-person-index';
        $frontpersonIndex->display_name = 'User Index';
        $frontpersonIndex->description = '用户首页';
        $frontpersonIndex->save();
        //用户信息修改
        $frontpersonInfo = new \App\Permission();
        $frontpersonInfo->name = 'front-person-info';
        $frontpersonInfo->display_name = 'person Info';
        $frontpersonInfo->description = '用户个人首页';
        $frontpersonInfo->save();
        //用户密码修改
        $frontpersonPass = new \App\Permission();
        $frontpersonPass->name = 'front-person-pass';
        $frontpersonPass->display_name = 'person Password';
        $frontpersonPass->description = '用户密码修改';
        $frontpersonPass->save();
        //保存密码修改
        $frontPassStore = new \App\Permission();
        $frontPassStore->name = 'front-person-passstore';
        $frontPassStore->display_name = 'person Passstore';
        $frontPassStore->description = '保存密码修改';
        $frontPassStore->save();
        //用户头像修改
        $frontpersonThumb = new \App\Permission();
        $frontpersonThumb->name = 'front-person-thumb';
        $frontpersonThumb->display_name = 'person thumb';
        $frontpersonThumb->description = '用户头像修改';
        $frontpersonThumb->save();
        //保存用户头像修改
        $frontThumbstore = new \App\Permission();
        $frontThumbstore->name = 'front-person-thumbstore';
        $frontThumbstore->display_name = 'person thumbstore';
        $frontThumbstore->description = '保存头像修改';
        $frontThumbstore->save();
        //用户私信
        $frontletter = new \App\Permission();
        $frontletter->name = 'front-person-letter';
        $frontletter->display_name = 'person letter';
        $frontletter->description = '用户私信';
        $frontletter->save();
        //私信发送
        $frontSendletter = new \App\Permission();
        $frontSendletter->name = 'front-person-sendletter';
        $frontSendletter->display_name = 'person sendletter';
        $frontSendletter->description = '私信发送';
        $frontSendletter->save();
        //私信详情
        $frontletterDetail = new \App\Permission();
        $frontletterDetail->name = 'front-letter-detail';
        $frontletterDetail->display_name = 'detail letter';
        $frontletterDetail->description = '私信详情';
        $frontletterDetail->save();
        //用户发布的文章
        $frontpersonPost = new \App\Permission();
        $frontpersonPost->name = 'front-person-post';
        $frontpersonPost->display_name = 'post person';
        $frontpersonPost->description = '用户发布的文章';
        $frontpersonPost->save();
        //用户发布的问答
        $frontpersonAnswer = new \App\Permission();
        $frontpersonAnswer->name = 'front-person-answer';
        $frontpersonAnswer->display_name = 'answer person';
        $frontpersonAnswer->description = '用户发布的问答';
        $frontpersonAnswer->save();
        //用户发布的视频
        $frontpersonVideo = new \App\Permission();
        $frontpersonVideo->name = 'front-person-video';
        $frontpersonVideo->display_name = 'video person';
        $frontpersonVideo->description = '用户发布的视频';
        $frontpersonVideo->save();
        //用户收藏的文章
        $frontpersonpostCollect = new \App\Permission();
        $frontpersonpostCollect->name = 'front-personpost-collect';
        $frontpersonpostCollect->display_name = 'Person Collect Post';
        $frontpersonpostCollect->description = '用户收藏的文章';
        $frontpersonpostCollect->save();
        //用户收藏的问答
        $frontanswerCollect = new \App\Permission();
        $frontanswerCollect->name = 'front-answer-collect';
        $frontanswerCollect->display_name = 'Collect Answer';
        $frontanswerCollect->description = '用户收藏的问答';
        $frontanswerCollect->save();
        //用户收藏的视频
        $frontpersonvideoCollect = new \App\Permission();
        $frontpersonvideoCollect->name = 'front-personvideo-collect';
        $frontpersonvideoCollect->display_name = 'Collect Video';
        $frontpersonvideoCollect->description = '用户收藏的视频';
        $frontpersonvideoCollect->save();
        //我的关注
        $frontpersonAtten = new \App\Permission();
        $frontpersonAtten->name = 'front-person-atten';
        $frontpersonAtten->display_name = 'Atten Person';
        $frontpersonAtten->description = '我的关注';
        $frontpersonAtten->save();
        //我关注的用户
        $frontpersonUseratten = new \App\Permission();
        $frontpersonUseratten->name = 'front-person-useratten';
        $frontpersonUseratten->display_name = 'userAtten Person';
        $frontpersonUseratten->description = '我关注的用户';
        $frontpersonUseratten->save();
        //我关注的话题
        $fronttopicAtten = new \App\Permission();
        $fronttopicAtten->name = 'front-topic-atten';
        $fronttopicAtten->display_name = 'Atten Topic';
        $fronttopicAtten->description = '我关注的话题';
        $fronttopicAtten->save();
        //新增话题关注
        $fronttopicCreate = new \App\Permission();
        $fronttopicCreate->name = 'front-topic-create';
        $fronttopicCreate->display_name = 'Create Topic';
        $fronttopicCreate->description = '新增话题关注';
        $fronttopicCreate->save();
        //取消话题关注
        $fronttopicCancel = new \App\Permission();
        $fronttopicCancel->name = 'front-topic-cancel';
        $fronttopicCancel->display_name = 'Cancel Topic';
        $fronttopicCancel->description = '取消话题关注';
        $fronttopicCancel->save();
        //我关注的话题
        $frontpersonTopiced = new \App\Permission();
        $frontpersonTopiced->name = 'front-person-topiced';
        $frontpersonTopiced->display_name = 'Person Topiced';
        $frontpersonTopiced->description = '我关注的话题';
        $frontpersonTopiced->save();
        //收藏文章
        $frontpostCollect = new \App\Permission();
        $frontpostCollect->name = 'front-post-collect';
        $frontpostCollect->display_name = 'Collect Post';
        $frontpostCollect->description = '收藏文章';
        $frontpostCollect->save();
        //取消收藏文章
        $frontpostCollectcancel = new \App\Permission();
        $frontpostCollectcancel->name = 'front-postcollect-cancel';
        $frontpostCollectcancel->display_name = 'Cancel Collect Post';
        $frontpostCollectcancel->description = '取消收藏文章';
        $frontpostCollectcancel->save();
        //新增文章
        $frontpostCreate = new \App\Permission();
        $frontpostCreate->name = 'front-post-create';
        $frontpostCreate->display_name = 'Create Post';
        $frontpostCreate->description = '新增文章';
        $frontpostCreate->save();
        //保存文章
        $frontpostStore = new \App\Permission();
        $frontpostStore->name = 'front-post-store';
        $frontpostStore->display_name = 'Store Post';
        $frontpostStore->description = '保存文章';
        $frontpostStore->save();
        //编辑文章
        $frontpostEdit = new \App\Permission();
        $frontpostEdit->name = 'front-post-edit';
        $frontpostEdit->display_name = 'Edit Post';
        $frontpostEdit->description = '编辑文章';
        $frontpostEdit->save();
        //保存更新文章
        $frontpostUpdate = new \App\Permission();
        $frontpostUpdate->name = 'front-post-update';
        $frontpostUpdate->display_name = 'Update Post';
        $frontpostUpdate->description = '保存更新文章';
        $frontpostUpdate->save();
        //删除文章
        $frontpostDelete = new \App\Permission();
        $frontpostDelete->name = 'front-post-delete';
        $frontpostDelete->display_name = 'Delete Post';
        $frontpostDelete->description = '删除文章';
        $frontpostDelete->save();
        //新增评论
        $frontcommentCreate = new \App\Permission();
        $frontcommentCreate->name = 'front-comment-create';
        $frontcommentCreate->display_name = 'Create Comment';
        $frontcommentCreate->description = '新增评论';
        $frontcommentCreate->save();
        //我收藏的文章
        $frontpostMycollect = new \App\Permission();
        $frontpostMycollect->name = 'front-post-mycollect';
        $frontpostMycollect->display_name = 'Mycollect Post';
        $frontpostMycollect->description = '我收藏的文章';
        $frontpostMycollect->save();
        //创建视频
        $frontvideoCreate = new \App\Permission();
        $frontvideoCreate->name = 'front-video-create';
        $frontvideoCreate->display_name = 'Create Videos';
        $frontvideoCreate->description = '创建视频';
        $frontvideoCreate->save();
        //保存视频
        $frontvideoStore = new \App\Permission();
        $frontvideoStore->name = 'front-video-store';
        $frontvideoStore->display_name = 'Store Videos';
        $frontvideoStore->description = '保存视频';
        $frontvideoStore->save();
        //删除视频
        $frontvideoDelete = new \App\Permission();
        $frontvideoDelete->name = 'front-video-delete';
        $frontvideoDelete->display_name = 'Delete Videos';
        $frontvideoDelete->description = '删除视频';
        $frontvideoDelete->save();
        //更新视频
        $frontvideoEdit = new \App\Permission();
        $frontvideoEdit->name = 'front-video-edit';
        $frontvideoEdit->display_name = 'Edit Videos';
        $frontvideoEdit->description = '编辑视频';
        $frontvideoEdit->save();
        //更新视频
        $frontvideoUpdate = new \App\Permission();
        $frontvideoUpdate->name = 'front-video-update';
        $frontvideoUpdate->display_name = 'Update Videos';
        $frontvideoUpdate->description = '更新视频';
        $frontvideoUpdate->save();
        //收藏视频
        $frontvideoCollect = new \App\Permission();
        $frontvideoCollect->name = 'front-video-collect';
        $frontvideoCollect->display_name = 'Collect Videos';
        $frontvideoCollect->description = '收藏视频';
        $frontvideoCollect->save();
        //取消收藏视频
        $frontvideoCancelcollect = new \App\Permission();
        $frontvideoCancelcollect->name = 'front-video-cancelcollect';
        $frontvideoCancelcollect->display_name = 'Cancel Collect Videos';
        $frontvideoCancelcollect->description = '取消收藏视频';
        $frontvideoCancelcollect->save();
        //视频评论
        $frontvideoComment = new \App\Permission();
        $frontvideoComment->name = 'front-video-comment';
        $frontvideoComment->display_name = 'Comment Videos';
        $frontvideoComment->description = '评论视频';
        $frontvideoComment->save();
        //用户动态
        $frontdynamicIndex = new \App\Permission();
        $frontdynamicIndex->name = 'front-dynamic-index';
        $frontdynamicIndex->display_name = 'Index Dynamic';
        $frontdynamicIndex->description = '用户动态';
        $frontdynamicIndex->save();
        //文章点赞
        $frontsupportPost = new \App\Permission();
        $frontsupportPost->name = 'front-support-post';
        $frontsupportPost->display_name = 'Post Support';
        $frontsupportPost->description = '文章点赞';
        $frontsupportPost->save();
        //问答点赞
        $frontsupportQuestion = new \App\Permission();
        $frontsupportQuestion->name = 'front-support-question';
        $frontsupportQuestion->display_name = 'Question Support';
        $frontsupportQuestion->description = '问答点赞';
        $frontsupportQuestion->save();
        //视频点赞
        $frontsupportVideo = new \App\Permission();
        $frontsupportVideo->name = 'front-support-video';
        $frontsupportVideo->display_name = 'Video Support';
        $frontsupportVideo->description = '视频点赞';
        $frontsupportVideo->save();


//------------------------------------------------------------------后台权限列表----------------------------------------------------//
        //角色列表
        $roleList = new \App\Permission();
        $roleList->name = 'role-list';
        $roleList->display_name = 'List Role';
        $roleList->description = '更新视频';
        $roleList->save();
        //新增角色
        $roleAdd = new \App\Permission();
        $roleAdd->name = 'role-add';
        $roleAdd->display_name = 'Add Role';
        $roleAdd->description = '新增角色';
        $roleAdd->save();
        //保存角色
        $roleStore = new \App\Permission();
        $roleStore->name = 'role-store';
        $roleStore->display_name = 'Store Role';
        $roleStore->description = '保存角色';
        $roleStore->save();
        //编辑角色
        $roleEdit = new \App\Permission();
        $roleEdit->name = 'role-edit';
        $roleEdit->display_name = 'Edit Role';
        $roleEdit->description = '编辑角色';
        $roleEdit->save();
        //更新角色
        $roleUpdate = new \App\Permission();
        $roleUpdate->name = 'role-update';
        $roleUpdate->display_name = 'Update Role';
        $roleUpdate->description = '更新角色';
        $roleUpdate->save();
        //删除角色
        $roleDelete = new \App\Permission();
        $roleDelete->name = 'role-delete';
        $roleDelete->display_name = 'Delete Role';
        $roleDelete->description = '删除角色';
        $roleDelete->save();
        //权限列表
        $permitList = new \App\Permission();
        $permitList->name = 'permit-list';
        $permitList->display_name = 'List Permit';
        $permitList->description = '权限列表';
        $permitList->save();
        //新增权限
        $permitAdd = new \App\Permission();
        $permitAdd->name = 'permit-add';
        $permitAdd->display_name = 'Add Permit';
        $permitAdd->description = '新增权限';
        $permitAdd->save();
        //保存权限
        $permitStore = new \App\Permission();
        $permitStore->name = 'permit-store';
        $permitStore->display_name = 'Store Permit';
        $permitStore->description = '保存权限';
        $permitStore->save();
        //删除权限
        $permitDelete = new \App\Permission();
        $permitDelete->name = 'permit-delete';
        $permitDelete->display_name = 'Delete Permit';
        $permitDelete->description = '删除权限';
        $permitDelete->save();
        //编辑权限
        $permitEdit = new \App\Permission();
        $permitEdit->name = 'permit-edit';
        $permitEdit->display_name = 'Edit Permit';
        $permitEdit->description = '编辑权限';
        $permitEdit->save();
        //更新权限
        $permitUpdate = new \App\Permission();
        $permitUpdate->name = 'permit-update';
        $permitUpdate->display_name = 'Update Permit';
        $permitUpdate->description = '更新权限';
        $permitUpdate->save();
        //用户列表
        $userList = new \App\Permission();
        $userList->name = 'user-list';
        $userList->display_name = 'List User';
        $userList->description = '用户列表';
        $userList->save();
        //新增用户
        $userAdd = new \App\Permission();
        $userAdd->name = 'user-add';
        $userAdd->display_name = 'Add User';
        $userAdd->description = '新增用户';
        $userAdd->save();
        //保存用户
        $userStore = new \App\Permission();
        $userStore->name = 'user-store';
        $userStore->display_name = 'Store User';
        $userStore->description = '保存用户';
        $userStore->save();
        //更新用户
        $userUpdate = new \App\Permission();
        $userUpdate->name = 'user-update';
        $userUpdate->display_name = 'Update User';
        $userUpdate->description = '更新用户';
        $userUpdate->save();
        //编辑用户
        $userEdit = new \App\Permission();
        $userEdit->name = 'user-edit';
        $userEdit->display_name = 'Edit User';
        $userEdit->description = '编辑用户';
        $userEdit->save();
        //删除用户
        $userDelete = new \App\Permission();
        $userDelete->name = 'user-delete';
        $userDelete->display_name = 'Delete User';
        $userDelete->description = '删除用户';
        $userDelete->save();
        //用户状态
        $userStatus = new \App\Permission();
        $userStatus->name = 'user-status';
        $userStatus->display_name = 'Status User';
        $userStatus->description = '更改用户状态';
        $userStatus->save();
        //话题列表
        $topicList = new \App\Permission();
        $topicList->name = 'topic-list';
        $topicList->display_name = 'List Topic';
        $topicList->description = '话题列表';
        $topicList->save();
        //新增话题
        $topicAdd = new \App\Permission();
        $topicAdd->name = 'topic-add';
        $topicAdd->display_name = 'Add Topic';
        $topicAdd->description = '新增话题';
        $topicAdd->save();
        //保存话题
        $topicStore = new \App\Permission();
        $topicStore->name = 'topic-store';
        $topicStore->display_name = 'Store Topic';
        $topicStore->description = '保存话题';
        $topicStore->save();
        //编辑话题
        $topicEdit = new \App\Permission();
        $topicEdit->name = 'topic-edit';
        $topicEdit->display_name = 'Edit Topic';
        $topicEdit->description = '编辑话题';
        $topicEdit->save();
        //删除话题
        $topicDelete = new \App\Permission();
        $topicDelete->name = 'topic-delete';
        $topicDelete->display_name = 'Delete Topic';
        $topicDelete->description = '删除话题';
        $topicDelete->save();
        //更改话题状态
        $topicStatus = new \App\Permission();
        $topicStatus->name = 'topic-status';
        $topicStatus->display_name = 'Status Topic';
        $topicStatus->description = '更改话题状态';
        $topicStatus->save();
        //分类列表
        $cateList = new \App\Permission();
        $cateList->name = 'cate-list';
        $cateList->display_name = 'List Cate';
        $cateList->description = '分类列表';
        $cateList->save();
        //新增分类
        $cateAdd = new \App\Permission();
        $cateAdd->name = 'cate-add';
        $cateAdd->display_name = 'Add Cate';
        $cateAdd->description = '新增分类';
        $cateAdd->save();
        //保存分类
        $cateStore = new \App\Permission();
        $cateStore->name = 'cate-store';
        $cateStore->display_name = 'Store Cate';
        $cateStore->description = '保存分类';
        $cateStore->save();
        //编辑分类
        $cateEdit = new \App\Permission();
        $cateEdit->name = 'cate-edit';
        $cateEdit->display_name = 'Edit Cate';
        $cateEdit->description = '编辑分类';
        $cateEdit->save();
        //新增子分类
        $cateChild = new \App\Permission();
        $cateChild->name = 'cate-addchild';
        $cateChild->display_name = 'ChildAdd Cate';
        $cateChild->description = '新增子分类';
        $cateChild->save();
        //新增子分类
        $cateDelete = new \App\Permission();
        $cateDelete->name = 'cate-delete';
        $cateDelete->display_name = 'Delete Cate';
        $cateDelete->description = '删除分类';
        $cateDelete->save();
        //更改分类状态
        $cateStatus = new \App\Permission();
        $cateStatus->name = 'cate-status';
        $cateStatus->display_name = 'Status Cate';
        $cateStatus->description = '更改分类状态';
        $cateStatus->save();
        //链接列表
        $linkList = new \App\Permission();
        $linkList->name = 'link-list';
        $linkList->display_name = 'List Link';
        $linkList->description = '链接列表';
        $linkList->save();
        //链接列表
        $linkAdd = new \App\Permission();
        $linkAdd->name = 'link-add';
        $linkAdd->display_name = 'Add Link';
        $linkAdd->description = '新增链接';
        $linkAdd->save();
        //保存链接
        $linkStore = new \App\Permission();
        $linkStore->name = 'link-store';
        $linkStore->display_name = 'Store Link';
        $linkStore->description = '保存链接';
        $linkStore->save();
        //编辑链接
        $linkEdit = new \App\Permission();
        $linkEdit->name = 'link-edit';
        $linkEdit->display_name = 'Edit Link';
        $linkEdit->description = '编辑链接';
        $linkEdit->save();
        //删除链接
        $linkDelete = new \App\Permission();
        $linkDelete->name = 'link-delete';
        $linkDelete->display_name = 'Delete Link';
        $linkDelete->description = '删除链接';
        $linkDelete->save();
        //更改链接状态
        $linkStatus = new \App\Permission();
        $linkStatus->name = 'link-status';
        $linkStatus->display_name = 'Status Link';
        $linkStatus->description = '更改链接状态';
        $linkStatus->save();
        //文章列表
        $postList = new \App\Permission();
        $postList->name = 'post-list';
        $postList->display_name = 'List Post';
        $postList->description = '文章列表';
        $postList->save();
        //删除文章
        $postDelete = new \App\Permission();
        $postDelete->name = 'post-delete';
        $postDelete->display_name = 'Delete Post';
        $postDelete->description = '删除文章';
        $postDelete->save();
        //文章状态
        $postStatus = new \App\Permission();
        $postStatus->name = 'post-status';
        $postStatus->display_name = 'Status Post';
        $postStatus->description = '更改文章状态';
        $postStatus->save();
        //问答列表
        $questionList = new \App\Permission();
        $questionList->name = 'question-list';
        $questionList->display_name = 'List Question';
        $questionList->description = '问答列表';
        $questionList->save();
        //删除问答
        $questionDelete = new \App\Permission();
        $questionDelete->name = 'question-delete';
        $questionDelete->display_name = 'Delete Question';
        $questionDelete->description = '删除问答';
        $questionDelete->save();
        //新增公告
        $noticeAdd = new \App\Permission();
        $noticeAdd->name = 'notice-add';
        $noticeAdd->display_name = 'Add Notice';
        $noticeAdd->description = '新增公告';
        $noticeAdd->save();
        //保存公告
        $noticeStore = new \App\Permission();
        $noticeStore->name = 'notice-store';
        $noticeStore->display_name = 'Store Notice';
        $noticeStore->description = '保存公告';
        $noticeStore->save();
        //编辑公告
        $noticeEdit = new \App\Permission();
        $noticeEdit->name = 'notice-edit';
        $noticeEdit->display_name = 'Edit Notice';
        $noticeEdit->description = '编辑公告';
        $noticeEdit->save();
        //公告列表
        $noticeList = new \App\Permission();
        $noticeList->name = 'notice-list';
        $noticeList->display_name = 'List Notice';
        $noticeList->description = '公告列表';
        $noticeList->save();
        //删除公告
        $noticeDelete = new \App\Permission();
        $noticeDelete->name = 'notice-delete';
        $noticeDelete->display_name = 'Delete Notice';
        $noticeDelete->description = '删除公告';
        $noticeDelete->save();

        //超管组权限列表
        $admin->attachPermissions([
            $roleList,$roleAdd,$roleStore, $roleEdit,$roleUpdate, $roleDelete, $permitList, $permitAdd, $permitStore,$permitDelete,
            $permitEdit,$permitUpdate, $userList, $userAdd,$userStore, $userUpdate, $userEdit,$userDelete, $userStatus, $topicList,
            $topicAdd,$topicStore, $topicEdit, $topicDelete,$topicStatus, $cateList,$cateAdd, $cateStore,$cateEdit, $cateChild,
            $cateDelete,$cateStatus,$linkList, $linkAdd, $linkStore, $linkEdit, $linkDelete,$linkStatus,$postList, $postDelete,
            $postStatus,$questionList, $questionDelete, $noticeAdd, $noticeStore,$noticeEdit,$noticeList,$noticeDelete
        ]);
        //普通用户组权限列表
        $normal->attachPermissions([
            $frontquestionCreate,$frontquestionStore,$frontquestionDelete,$frontquestionEdit, $frontquestionUpdate, $frontquestionCollect,
            $frontcollectCancel,$frontquestionAnswer, $frontuserAttention,$frontuserCancel,$frontpersonIndex, $frontpersonInfo,$frontpersonPass,
            $frontPassStore, $frontpersonThumb, $frontThumbstore,$frontletter,$frontSendletter,$frontletterDetail, $frontpersonPost,$frontpersonAnswer,
            $frontpersonVideo, $frontpersonpostCollect,$frontanswerCollect,$frontpersonvideoCollect,$frontpersonAtten,$frontpersonUseratten,$fronttopicAtten,
            $fronttopicCreate,$fronttopicCancel, $frontpersonTopiced,$frontpostCollect,$frontpostCollectcancel,$frontpostCreate,$frontpostStore,
            $frontpostEdit, $frontpostUpdate,$frontpostDelete, $frontcommentCreate,$frontpostMycollect, $frontvideoCreate, $frontvideoStore,
            $frontvideoDelete, $frontvideoEdit, $frontvideoUpdate,$frontvideoCollect, $frontvideoCancelcollect, $frontvideoComment,$frontdynamicIndex,
            $frontsupportPost, $frontsupportQuestion, $frontsupportVideo
        ]);

        //初始化超管用户
        $user = \App\User::updateOrCreate(array('name' => 'chen','admin' => '1'),array('id'=>'1','name' => 'chen','email'=>'001@chenframe.com','password'=>bcrypt('123456'),'admin'=>'1'));
        $user->attachRole($admin);
        $user->attachRole($normal);

        //初始化普通用户
        $test = \App\User::updateOrCreate(array('name' => 'test'),array('id'=>'2','name' => 'test','email'=>'002@chenframe.com','password'=>bcrypt('test')));
        $test->attachRole($normal);
    }
}
