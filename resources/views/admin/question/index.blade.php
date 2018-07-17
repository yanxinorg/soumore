@extends('layouts.admin')
@section('content')
 <div class="wrapper wrapper-content animated fadeInRight ecommerce">
    <div class="row">
        <div class="col-lg-12">
            <div class="tabs-container">
                    <div class="ibox-content">
                	<div class="row">
                        <div class="col-md-6 m-b-md">
                            <div class="input-group">
                            	<input type="text" placeholder="问答标题，作者" class="input-md form-control">
                            	<span class="input-group-btn">
                                	<button type="button" class="btn btn-md btn-primary">Search</button>
                                </span>
                            </div>
                        </div>
                        <div class="col-md-6 m-b-md">
                            <div class="pull-right">
                                <a type="button" class="btn btn-md btn-white" href="{{ url('/question/create') }}"><i class="fa fa-plus">新增</i></a>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered table-stripped">
                            <thead>
                            <tr>
                                <th>问答标题</th>
                                <th>问答作者</th>
                                <th>创建时间</th>
                                <th>删除时间</th>
                                <th>操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($questions as $question)
                                <tr>
                                    <td>
                                        <a href="{{ URL::action('Front\QuestionController@detail', ['id'=>$question->question_id]) }}"><span> {{ str_limit($question->title,316) }}</span></a>
                                    </td>
                                    <td>
                                       <a href="{{ URL::action('Front\HomeController@index', ['uid'=>$question->user_id]) }}">{{ $question->author }}</a>
                                    </td>
                                    <td>{{ $question->created_at }}</td>
                                    <td style="color: red;">{{ $question->deleted_at }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <a class="btn btn-white" href="{{ URL::action('Front\QuestionController@edit', ['id'=>$question->question_id]) }}"><i class="fa fa-edit"></i></a>
                                            <a class="btn btn-white " href="javascript:void(0);" onclick="del({{ $question->question_id }});"><i class="fa fa-trash"></i></a>
                                        </div>
                                    </td>
                                </tr>
                              @endforeach()
                            </tbody>
                        </table>
                        <div class="pull-right" >{{ $questions->links() }}</div>
                    </div>
            </div>
        </div>
    </div>
</div>
@section('js')
@parent
<script>
    //删除话题
    function del(id){
    	 swal({
             title: "确认删除该问答?",
             type: "warning",
             showCancelButton: true,
             confirmButtonColor: "#DD6B55",
             confirmButtonText: "Yes, delete it!",
             closeOnConfirm: false
         }, function () {
         	 $.post("{{ url('/back/question/delete') }}",
                      {
                      "_token":'{{ csrf_token() }}',
                      "id": id,
                      },function(data){
                    	  swal({
                    	         title: data.msg,
                    	         confirmButtonColor: "#DD6B55",
                    	         animation: false,
                    	         showConfirmButton: true
                    	     }, function () {
                    	    	 $.pjax.reload('table');
                        	     });
                      });
         });
    	
    }
    
</script>
@stop
@endsection