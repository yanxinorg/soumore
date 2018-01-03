@extends('layouts.back')
@section('content')
<section class="wrapper ">
    <div class="row">
            <div class="col-md-12 col-sm-6 ">
                <section class="panel">
                        <header class="panel-heading">用户列表
                            <span class="tools pull-right"><a href="">新增角色</a></span>
                        </header>
                        <div class="panel-body">
                             <!--body wrapper start-->
						        <div class="wrapper">
						            <div class="panel">
						                <table class="table table-bordered table-invoice">
						                    <thead>
						                    <tr>
						                        <th class="text-center">#</th>
						                        <th class="text-center">标识</th>
						                        <th class="text-center">角色名</th>
						                        <th class="text-center">备注</th>
						                        <th class="text-center">创建时间</th>
						                        <th class="text-center">操作</th>
						                    </tr>
						                    </thead>
						                    <tbody>
						                    <tr>
						                        <td class="text-center"></td>
						                        <td class="text-center"></td>
						                        <td class="text-center"></td>
						                        <td class="text-center"></td>
						                        <td class="text-center"></td>
						                        <td class="text-center">操作</td>
						                    </tr>
						                    </tbody>
						                </table>
						                <div class="paginate" style="text-align:right;"></div>
						            </div>
						        </div>
						        <!--body wrapper end-->
                        </div>
                    </section>
            </div>
    </div>
</section>
@endsection
