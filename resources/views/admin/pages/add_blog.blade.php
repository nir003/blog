<?php
/**
 * Created by PhpStorm.
 * User: nirjhor
 * Date: 7/13/2018
 * Time: 11:52 AM
 */
?>

@extends('admin.master')
@section('dashboard_content')

        <!-- BEGIN SAMPLE FORMPORTLET-->
<div class="widget green">
    <div class="widget-title">
        <h4><i class="icon-reorder"></i> Form Layouts</h4>
                            <span class="tools">
                            <a href="javascript:;" class="icon-chevron-down"></a>
                            <a href="javascript:;" class="icon-remove"></a>
                            </span>
    </div>
    <div class="widget-body">
        <!-- BEGIN FORM-->

        <h3 align="center" style="color: green">
            <?php
            use Illuminate\Support\Facades\DB;$message = Session::get('message_for_blog_post');
            if ($message) {
                echo $message;
                \Illuminate\Support\Facades\Session::put('message_for_blog_post', '');
            }
            ?>
        </h3>
        {{--  <form action="#" class="form-horizontal">--}}

        {!! Form::open(['url' => '/add_post_form','method'=>'post','enctype'=>'multipart/form-data','class="form-horizontal"']) !!}

        <div class="control-group">
            <label class="control-label">Post Title</label>

            <div class="controls">
                <input type="text" placeholder="Enter Post Title" class="input-xxlarge" name="post_Title"/>
            </div>
        </div>


        <div class="control-group">
            <label class="control-label">Category Name</label>

            <div class="controls">
                <select class="input-large m-wrap" tabindex="1" name="category_name">
                    <option value="null">Select Category</option>

                    <?php
                    $all_category_only = DB::table('category')
                            ->get();

                    //print_r($all_category_only);
                    foreach($all_category_only as $category){
                    ?>
                    <option value="{{$category->id}}">
                        {{$category->category_name}}
                    </option>
                    <?php
                    }
                    ?>


                </select>
            </div>
        </div>

        <div class="control-group">
            <label class="control-label">Post Image</label>

            <div class="controls">
                <input type="file" class="input-xlarge" name="post_image"/>
            </div>
        </div>

        <div class="control-group">
            <label class="control-label">Short Description</label>

            <div class="controls">
                <textarea class="input-xlarge" rows="4" name="post_short_description"></textarea>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label">Long Description</label>

            <div class="controls">
                <textarea class="input-xxlarge" rows="6" name="post_long_description"></textarea>
            </div>
        </div>

        <div class="control-group">
            <label class="control-label">Author Name</label>

            <div class="controls">
                <select class="input-large m-wrap" tabindex="1" name="author_name">
                    <option value="{{Session::get('name')}}">{{Session::get('name')}} </option>
                    <?php
                    $user_id = Session::get('id') + 100
                    ?>
                    <option value="guest<?php echo $user_id ?>">As Guest</option>
                </select>
            </div>
        </div>


        <div class="control-group">
            <label class="control-label">publication Status</label>

            <div class="controls">
                <select class="input-large m-wrap" tabindex="1" name="publication_status">
                    <option value="0">Select Status</option>
                    <option value="1">Publish</option>
                    <option value="2">Unpublish</option>
                    <option value="0">Draft</option>
                </select>
            </div>
        </div>


        <div class="form-actions">
            <button type="submit" class="btn blue btn-primary"><i class="icon-ok"></i> Post</button>
            <button type="button" class="btn btn-success"><i class=" icon-remove"></i> Cancel</button>
        </div>
        {{--</form>--}}

        {!! Form::close() !!}
                <!-- END FORM-->
    </div>
</div>
<!-- END SAMPLE FORM PORTLET-->

@endsection

