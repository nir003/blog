<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class WelcomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function loadHome()
    {
        $all_post_info = DB::table('blog')
            ->where('publication_status', 1)
            ->orderBy('blog_id','desc')
            ->get();

        $post_page = view('pages.post')
                    ->with('all_post_info', $all_post_info);

        return view('home')
            ->with('post_page', $post_page);

    }

    public function loadPortfolio()
    {

        $portfolio_page = view('pages.portfolio');


        return view('home')
            ->with('post_page', $portfolio_page);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function detailPost($post_id){






        $post_detail = DB::table('blog')
            ->where('blog_id',$post_id)
            ->first();

        /*Read Count */
        $read_count = $post_detail->read_count;
        $read_count++;

        DB::table('blog')
            ->where('blog_id',$post_id)
            ->update(['read_count'=>$read_count]);
        /*Read Count */

        $post_detail = DB::table('blog')
            ->where('blog_id',$post_id)
            ->first();

        $count_comments = DB::table('comments')
            ->where('post_id',$post_id)
            ->count('post_id');

        /*Comments */
        $comments_all = DB::table('comments')
            ->where('post_id',$post_id)
            ->get();
        /*Comments */

        //exit();

        $detail_post = view("pages.detail_post")
            ->with('post_detail',$post_detail)
            ->with('comments_all',$comments_all)
            ->with('count_comments',$count_comments);
        return view('home')
            ->with('detail_post_section', $detail_post);

    }

    public function categoryPostShow($category_id){

        $all_post_info = DB::table('blog')
            ->where('publication_status', 1)
            ->where('category_id',$category_id)
            ->orderBy('blog_id','desc')
            ->get();

        $post_page = view('pages.post')
            ->with('all_post_info', $all_post_info);

        return view('home')
            ->with('post_page', $post_page);
    }
    public function popularPpostSshow(){

        $all_post_info = DB::table('blog')
            ->where('publication_status', 1)
            ->orderBy('read_count','desc')
            ->get();

        $post_page = view('pages.post')
            ->with('all_post_info', $all_post_info);

        return view('home')
            ->with('post_page', $post_page);
    }




    public function addComments(Request $request_comment){

        $data = array();

        $data['name']= $request_comment->name;
        $data['post_id']= $request_comment->post_id;
        $data['email']= $request_comment->email;
        $data['comment']= $request_comment->comment;

        DB::table('comments')
            ->insert($data);

        return Redirect::to('/detail_post/'.$request_comment->post_id);

    }
}
