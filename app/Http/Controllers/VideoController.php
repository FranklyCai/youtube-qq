<?php

namespace App\Http\Controllers;

include app_path().'/includes/ChromePhp.php';

use App\Comment;
use App\Video;
use Illuminate\Http\Request;
use ChromePhp;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use JavaScript;

class VideoController extends Controller
{
    public function __construct(){
        $this->middleware('auth',['only' => ['comment']]);
    }
    public function showVideo($id){
        if(Auth::check()){
            JavaScript::put([
                'id'=>Auth::user()->id,
                'name'=>Auth::user()->name,
                'avatar'=>Auth::user()->avatar
            ]);
        }
        $video = Video::where('url',$id)->first();
        if($video){
            if(Schema::hasTable($id)){
                $comments =(new Comment)->setTable($id)->leftJoin('users',"$id.name",'=','users.name')->select(['users.id','users.avatar','users.name','comment','up','down','upBy','downBy'])->get();
                return view('video')->with('video',$video)->with('comments',$comments);
            } else {
                $a=1;
                return view('video')->with('video',$video);
            }
        }else{
            return view('404',['message'=>'找不到这个视频哟']);
        }
    }
    public function comment(Request $request,$id){
        if(!Schema::hasTable($id)){
            Schema::create($id, function($table)
            {
                $table->increments('id');
                $table->string('name');
                $table->text('comment');
                $table->integer('up')->default(0);
                $table->integer('down')->default(0);
                $table->unsignedInteger('upBy')->nullable();
                $table->unsignedInteger('downBy')->nullable();
                $table->timestamp('created_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
                $table->foreign('upBy')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
                $table->foreign('downBy')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
//                $table->timestamp('updated_at')->default(\DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
            });
        }
//        $pdo = DB::connection()->getPdo();
        DB::insert("insert into $id (name,comment) values (?, ?)", [Auth::user()->name, $request->comment]);
//        return response()->json(['status'=>200]);
    }
}
