<?php
namespace App\Models\Common;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Laravel\Scout\Searchable;

class PostModel extends Model
{
    use Searchable;
	protected $table = 'posts';
	public $timestamps = TRUE;
	protected $fillable = ['user_id','cate_id','title','excerpt','content','thumb','thumb_small','status','mime'];

    //返回特定内容
    public function toSearchableArray()
    {
        #_ Read Data & Filter Field
        $Arr_Posts = array_only($this -> toArray(), ['title']);
        #_ Back to Scout
        return $Arr_Posts;
    }

	// 	关联多个标签
	public function belongsTags()
	{
		return $this->belongsToMany('App\Models\Common\TagModel', 'post_tag', 'posts_id', 'tags_id');
	}
	
	public function getCreatedAtAttribute($date)
	{
		if (Carbon::now() < Carbon::parse($date)->addDays(10))
		{
			return Carbon::parse($date);
		}
		return Carbon::parse($date)->diffForHumans();
	}
	
	
	protected static function select()
	{
		$datas = DB::table('posts')
		->leftjoin('users', 'posts.user_id', '=', 'users.id')
        ->leftjoin('category', 'posts.cate_id', '=', 'category.id')
		->select(
                'users.name as author',
                'users.avator as avator',
                'users.id as user_id',
                'category.id as cate_id',
                'category.name as cate_name',
                'posts.id as post_id',
				'posts.title as title',
				'posts.excerpt as excerpt',
				'posts.content as content',
				'posts.thumb as thumb',
				'posts.created_at as created_at',
				'posts.comments as countcomment',
		        'posts.hits as hits',
				'posts.status as status'
				);
		return $datas;
				
	}
	//文章列表
	public static function lists($user_id = "",$status = "-1",$cateid = "",$condition="created_at")
	{
		if(!empty($user_id))
		{
			if(!empty($cateid))
			{
				$datas = self::select();
				return $datas->where([
						'posts.user_id'=>$user_id,
						'posts.status'=>$status,
						'posts.cate_id'=>$cateid
				])->orderBy("posts.$condition",'desc')->paginate('15');
			}
			if($status >= 0 )
			{
				$datas = self::select();
				return $datas->where([
					'posts.user_id'=>$user_id,
					'posts.status'=>$status
				])->orderBy("posts.$condition",'desc')->paginate('15');
			}
			$datas = self::select();
			return $datas->where('posts.user_id','=',$user_id)->orderBy("posts.$condition",'desc')->paginate('15');
		}else{
			$datas = self::select();
			return $datas->where('posts.status','=','1')->orderBy("posts.$condition",'desc')->paginate('15');
		}
		
	}
	
	//分类文章刷选
	public static function cateArticle($status = "1",$cateid)
	{
		
		$datas = self::select();
		return $datas->where([
				'posts.status'=>$status,
				'posts.cate_id'=>$cateid
		])->orderBy('posts.created_at','desc')->paginate('15');
			
	}
	
	
}
