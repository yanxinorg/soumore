<?php

use Illuminate\Database\Seeder;

class Rbac extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //清除用户表数据
        DB::table('users')->delete();
        //清除角色表数据
        DB::table('roles')->delete();
        //清除用户角色表数据
        DB::table('role_user')->delete();
        //清除权限表数据
        DB::table('permissions')->delete();
        //清除权限角色表数据
        DB::table('permission_role')->delete();

        //初始化超管角色
        $admin = new \App\Role();
        $admin->name = 'admins';
        $admin->display_name = 'admins';
        $admin->description = '管理员组';
        $admin->save();

        //初始化权限
        //创建视频
        $videoCreate = new \App\Permission();
        $videoCreate->name = 'video-create';
        $videoCreate->display_name = 'Create Videos';
        $videoCreate->description = '创建视频';
        $videoCreate->save();
        //保存视频
        $videoStore = new \App\Permission();
        $videoStore->name = 'video-store';
        $videoStore->display_name = 'Store Videos';
        $videoStore->description = '保存视频';
        $videoStore->save();
        //删除视频
        $videoDelete = new \App\Permission();
        $videoDelete->name = 'video-delete';
        $videoDelete->display_name = 'Delete Videos';
        $videoDelete->description = '删除视频';
        $videoDelete->save();
        //更新视频
        $videoEdit = new \App\Permission();
        $videoEdit->name = 'video-edit';
        $videoEdit->display_name = 'Edit Videos';
        $videoEdit->description = '编辑视频';
        $videoEdit->save();
        //更新视频
        $videoUpdate = new \App\Permission();
        $videoUpdate->name = 'video-update';
        $videoUpdate->display_name = 'Update Videos';
        $videoUpdate->description = '更新视频';
        $videoUpdate->save();
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

        //超管组赋权
        $admin->attachPermissions([
            $videoCreate,
            $videoStore,
            $videoDelete,
            $videoEdit,
            $videoUpdate,
            $roleList,
            $roleAdd,
            $roleStore,
            $roleEdit,
            $roleUpdate,
            $roleDelete,
            $permitList,
            $permitAdd,
            $permitStore,
            $permitDelete,
            $permitEdit,
            $permitUpdate,
            $userList,
            $userAdd,
            $userStore,
            $userUpdate,
            $userEdit,
            $userDelete,
            $userStatus,
            $topicList,
            $topicAdd,
            $topicStore,
            $topicEdit,
            $topicDelete,
            $topicStatus,
            $cateList,
            $cateAdd,
            $cateStore,
            $cateEdit,
            $cateChild,
            $cateDelete,
            $cateStatus,
            $linkList,
            $linkAdd,
            $linkStore,
            $linkEdit,
            $linkDelete,
            $linkStatus,
            $postList,
            $postDelete,
            $postStatus,
            $questionList,
            $questionDelete,
            $noticeAdd,
            $noticeStore,
            $noticeEdit,
            $noticeList,
            $noticeDelete
        ]);

        //初始化超管用户
        \App\User::updateOrCreate(array('name' => 'chen','admin' => '1'), array('name' => 'chen','email'=>'001@chenframe.com','password'=>bcrypt('123456'),'admin'=>'1'));
        $user = \App\User::where('name', '=', 'chen')->first();
        //调用EntrustUserTrait提供的attachRole方法
        $user->attachRole($admin);

        //初始化普通管理用户
        \App\User::updateOrCreate(array('name' => 'test'), array('name' => 'test','email'=>'002@chenframe.com','password'=>bcrypt('test')));
        $test = \App\User::where('name', '=', 'test')->first();
        //调用EntrustUserTrait提供的attachRole方法
        $test->attachRole($admin);
    }
}
