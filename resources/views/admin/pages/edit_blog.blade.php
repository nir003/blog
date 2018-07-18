<?php
/**
 * Created by PhpStorm.
 * User: nirjhor
 * Date: 7/14/2018
 * Time: 2:37 PM
 */
?>

@extends('admin.master')
@section('dashboard_content')

        <head>
            <script>
                var loadFile = function(event) {
                    var output = document.getElementById('output');
                    output.src = URL.createObjectURL(event.target.files[0]);
                };
            </script>
        </head>
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
            $message = Session::get('message');
            if($message){
                echo $message;
                \Illuminate\Support\Facades\Session::put('message','');
            }
            ?>
        </h3>
        {{--  <form action="#" class="form-horizontal">--}}

        {!! Form::open(['url' => '/update_blog_form','method'=>'post','name'=>'edit_form','enctype'=>'multipart/form-data','class="form-horizontal"']) !!}

        <div class="control-group">
            <label class="control-label">Post ID</label>
            <div class="controls">
                <input type="hidden"  class="input-large" name="post_id" value="{{$blog_info->blog_id}}"/>
                <input type="hidden"  class="input-large" name="default_post_image" value="{{asset($blog_info->blog_image)}}"/>
                <span class="help-inline">Non Editable</span>
            </div>
        </div>


        <div class="control-group">
            <label class="control-label">Post Title</label>
            <div class="controls">
                <input type="text" placeholder="Enter Post Title" class="input-xxlarge" name="post_Title" value="{{$blog_info->blog_title}}"/>
            </div>
        </div>



        <div class="control-group">
            <label class="control-label">Category Name</label>
            <div class="controls">
                <select class="input-large m-wrap" tabindex="1" name="category_name">





                    @foreach($all_category_only as $category){
                    <option value="{{$category->id}}">{{$category->category_name}}</option>
                    @endforeach

                    {{--<option value="{{$category->id}}" selected>{{$category->category_name}}</option>--}}



                </select>
            </div>
        </div>

        <div class="control-group">
            <label class="control-label">Post Image</label>
            <div class="controls">
                <input type="file" class="input-xlarge"  name="post_image" onchange="loadFile(event)" id="file_image"/><br>
                <span>
                    <img src="{{asset($blog_info->blog_image)}}" style="height: 100px;width: 200px" id="output" >
                </span>
            </div>
        </div>

        <div class="control-group">
            <label class="control-label">Short Description</label>
            <div class="controls">
                <textarea class="input-xlarge" rows="2" name="post_short_description">{{$blog_info->blog_short_description}}</textarea>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label">Long Description</label>
            <div class="controls">
                <textarea class="input-xlarge" rows="6"  name="post_long_description">{{$blog_info->blog_long_description}}</textarea>
            </div>
        </div>

        <div class="control-group">
            <label class="control-label">Author Name</label>
            <div class="controls">
                <select class="input-large m-wrap" tabindex="1" name="author_name">

                    <option value="{{Session::get('name')}}">{{Session::get('name')}} </option>
                    <?php
                    $user_id = Session::get('id')+100
                    ?>
                    <option value="guest<?php echo $user_id ?>">As Guest</option>
                </select>
            </div>
        </div>



        <div class="form-actions">
            <button type="submit" class="btn blue btn-primary"><i class="icon-ok"></i> Update</button>
            <button type="button" class="btn btn-success"><i class=" icon-remove"></i> Cancel</button>
        </div>
        {{--</form>--}}

        {!! Form::close() !!}
                <!-- END FORM-->
    </div>


</div>
<!-- END SAMPLE FORM PORTLET-->

<script type="text/javascript">

    document.forms['edit_form'].elements['category_name'].value = '<?php echo $blog_info->category_id  ?>'




    document.forms['edit_form'].elements['author_name'].value = '<?php echo $blog_info->author_name  ?>'
</script>


@endsection

