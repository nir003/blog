<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

session_start();


class SuperAdminController extends Controller
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


    public function loadAdmin()
    {

        if (Session::get('id')) {
            return Redirect::to('/dashboard')->send();
        } else {
            $admin_page = view('admin.login');
            return $admin_page;
        }

    }

    public function loadDashboard()
    {

        if (Session::get('id')) {
            $dashboard_page = view('admin.pages.dashboard');

            return view('admin.master')
                ->with('dashboard_page', $dashboard_page);
        } else {
            return Redirect::to('/admin');
        }

    }

    public function logout()
    {

        Session::put('id', '');
        return Redirect::to(\URL::previous());


    }


    public function adminLogin(Request $request)
    {


        $email = $request->admin_email;
        $password = $request->password;


        $result = DB::table('admin')
            ->where('email', $email)
            ->where('password', md5($password))
            ->first();


        /*  echo $result->email.'   '.$result->password;

          echo "<br>";
          echo $email.'   '.$password;
          exit();*/


        if ($result) {
            Session::put('name', $result->name);
            Session::put('id', $result->id);

            /*$dashboard_page = view('admin.pages.dashboard');

            return view('admin.master')
                ->with('dashboard_page',$dashboard_page);*/
            return Redirect::to('/dashboard')->send();


        } else {
            Session::put('exception', 'Email or Password Invalid');

            return Redirect::to('/admin');
        }
    }


    public function add_category()
    {
        $dashboard_page = view('admin.pages.add_category');
        return view('admin.master')
            ->with('dashboard_page', $dashboard_page);
    }


    public function add_category_form(Request $request)
    {
        $category_name = $request->category_name;
        $category_description = $request->category_description;
        $category_status = $request->category_status;

        //echo $category_name.'<br>'.$category_description.'<br>'.$category_status;


        $data = array();
        $data['category_name'] = $category_name;
        $data['category_description'] = $category_description;
        $data['category_status'] = $category_status;

        $check_err = DB::table('category')->insert($data);

        if ($check_err) {
            Session::put('message', 'Save Category Successfully');
        } else {
            Session::put('message', 'Category Successfully not save');

        }
        return Redirect::to('/add_category');

    }

    public function manageCategory()
    {


        $all_category = DB::table('category')
            ->get();

        // print_r($result);

        // exit();

        //$test = "it is a test";
        //echo $test;

        $category_id_edit = null;
        $manage_category = view('admin.pages.manage_category')->with('all_category', $all_category)->with('category_id_edit', $category_id_edit);

        return view('admin.master')
            ->with('dashboard_page', $manage_category);


        /*return view('admin.pages.manage_category')
            ->with('all_category',$all_category);*/
    }


    public function unpublishCategory($category_id)
    {

        //echo $category_id;


        $result = DB::table('category')
            ->where('id', $category_id)
            ->first();

        //echo "<br>";
        //print_r($result);
        //exit();

        $category_status = $result->category_status;

        if ($category_status == 1) {
            DB::table('category')
                ->where('id', $category_id)
                ->update(['category_status' => 2]);
        } else {
            DB::table('category')
                ->where('id', $category_id)
                ->update(['category_status' => 1]);
        }

        return Redirect::to('/manage_category');

    }

    public function unpublishBlog($blog_id)
    {

        //echo $category_id;


        $result = DB::table('blog')
            ->where('blog_id', $blog_id)
            ->first();

        //echo "<br>";
        //print_r($result);
        //exit();

        $publication_status = $result->publication_status;

        if ($publication_status == 1) {
            DB::table('blog')
                ->where('blog_id', $blog_id)
                ->update(['publication_status' => 2]);
        } else {
            DB::table('blog')
                ->where('blog_id', $blog_id)
                ->update(['publication_status' => 1]);
        }

        return Redirect::to('/manage-blog');

    }


    public function deleteCategory($category_id)
    {

        DB::table('category')
            ->where('id', $category_id)
            ->delete();
        return Redirect::to('/manage_category');
    }

    public function editCategory($category_id)
    {

        $category_info = DB::table('category')
            ->where('id', $category_id)
            ->first();

        $edit_category_page = view('admin.pages.edit_category')->with('category_info', $category_info);

        return view('admin.master')->with('dashboard_content', $edit_category_page);


    }


    public function deleteBlog($blog_id)
    {

        DB::table('blog')
            ->where('blog_id', $blog_id)
            ->delete();
        return Redirect::to('/manage-blog');
    }

    public function editBlog($blog_id)
    {

        $blog_info = DB::table('blog')
            ->where('blog_id', $blog_id)
            ->first();

        $all_category_only = DB::table('category')
            ->get();

        $edit_blog_page = view('admin.pages.edit_blog')
            ->with('blog_info', $blog_info)
            ->with('all_category_only', $all_category_only);

        return view('admin.master')->with('dashboard_content', $edit_blog_page);


    }


    public function editCategory2($category_id_edit)
    {

        $category_info_for_edit = DB::table('category')
            ->where('id', $category_id_edit)
            ->first();

        /*$manage_category_page = view('admin.pages.manage_category')->with('category_info_for_edit',$category_info_for_edit);

        return view('admin.master')->with('dashboard_content',$manage_category_page);*/

        /*return Redirect::to('/manage_category')
            ->with('category_info_for_edit',$category_info_for_edit);*/

        $all_category = DB::table('category')
            ->get();


        $manage_category = view('admin.pages.manage_category')
            ->with('all_category', $all_category)
            ->with('category_id_edit', $category_id_edit);

        return view('admin.master')
            ->with('dashboard_page', $manage_category);


    }


    public function updateCategory_form(Request $request)
    {

        $data = array();

        $data['category_name'] = $request->category_name;
        $data['category_description'] = $request->category_description;

        $category_id = $request->category_id;

        //echo $data['category_description'].'<br>'.$data['category_name'].'<br> category id: '.$category_id;
        //exit();


        DB::table('category')
            ->where('id', $category_id)
            ->update($data);


        return Redirect::to('/manage_category');

    }


    public function updateBlog_form(Request $request)
    {


        /*
       * Image Uploade
       * */

        if($_FILES['post_image']['name']==""){
            $image_url = $request->default_post_image;
            //echo "image url :".$image_url;
            //exit();
        }else{
            $file = $request->file('post_image');
            print_r($file);
            $file_name = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            $picture = date('dmy') . "_" . date('His') . "_" . $file_name;
            $directory = 'public/images/post_image/';
            $image_url = $directory . $picture;
            $file->move($directory, $picture);
        }


        $data = array();

        $data['blog_title'] = $request->post_Title;
        $data['category_id'] = $request->category_name;
        $data['author_name'] = $request->author_name;
        $data['blog_short_description'] = $request->post_short_description;
        $data['blog_long_description'] = $request->post_long_description;
        $data['blog_image'] = $image_url;

        $blog_id = $request->post_id;


        //echo $data['category_description'].'<br>'.$data['category_name'].'<br> category id: '.$category_id;
        //exit();

        DB::table('blog')
            ->where('blog_id', $blog_id)
            ->update($data);

        return Redirect::to('/manage-blog');
    }


    public function addBlog()
    {
        $addBlog_page = view('admin.pages.add_blog');

        return view('admin.master')
            ->with('dashboard_content', $addBlog_page);
    }


    public function addPost_form(Request $request)
    {
        echo "<pre>";
        //print_r($request);
        //var_dump($request);

        //print_r($_POST);
        //print_r($_FILES);
        //exit();


        $post_Title = $request->post_Title;
        $category_name = $request->category_name;
        $post_image = $request->post_image;
        $post_short_description = $request->post_short_description;
        $post_long_description = $request->post_long_description;
        $author_name = $request->author_name;
        $publication_status = $request->publication_status;


        /*
         * Image Uploade
         * */

        $file = $request->file('post_image');

        print_r($file);

        $file_name = $file->getClientOriginalName();
        //$extension = $file->getClientOriginalExtension();
        $picture = date('dmy') . "_" . date('His') . "_" . $file_name;

        $directory = 'public/images/post_image/';

        $image_url = $directory . $picture;

        $file->move($directory, $picture);

        //echo $file_name."<br>";
        //echo $image_url;
        //exit();


        $data = array();
        $data['blog_title'] = $post_Title;
        $data['category_id'] = $category_name;
        $data['blog_image'] = $image_url;
        $data['blog_short_description'] = $post_short_description;
        $data['blog_long_description'] = $post_long_description;
        $data['author_name'] = $author_name;
        $data['publication_status'] = $publication_status;

        $data['read_count'] = 1;

        $check_err = DB::table('blog')
            ->insert($data);

        if ($check_err) {
            Session::put('message_for_blog_post', 'Post New Blog Successfully');
        } else {
            Session::put('message_for_blog_post', 'not Post !!');

        }
        return Redirect::to('/add-blog');

    }


    public function manageBlog()
    {

        //return view('admin.pages.manage_blog');

        $all_blog = DB::table('blog')
            ->get();

        // print_r($result);

        // exit();

        //$test = "it is a test";
        //echo $test;

        //$category_id_edit = null;
        $manage_blog = view('admin.pages.manage_blog')
            ->with('all_blog', $all_blog);

        return view('admin.master')
            ->with('dashboard_page', $manage_blog);

    }




}
