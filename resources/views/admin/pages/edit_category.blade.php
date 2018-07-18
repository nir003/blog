<?php
/**
 * Created by PhpStorm.
 * User: nirjhor
 * Date: 7/13/2018
 * Time: 1:29 AM
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
            $message = Session::get('message');
            if($message){
                echo $message;
                \Illuminate\Support\Facades\Session::put('message','');
            }
            ?>
        </h3>
        {{--  <form action="#" class="form-horizontal">--}}

        {!! Form::open(['url' => '/update_category_form','method'=>'post','class="form-horizontal"']) !!}

        <div class="control-group">
            <label class="control-label">Category ID</label>
            <div class="controls">
                <input type="hidden"  class="input-large" name="category_id" value="{{$category_info->id}}"/>
                <span class="help-inline">Non Editable</span>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label">Category Name</label>
            <div class="controls">
                <input type="text" placeholder="Enter Category Name" class="input-large" name="category_name" value="{{$category_info->category_name}}"/>
                <span class="help-inline">Sports</span>
            </div>
        </div>

        <div class="control-group">
            <label class="control-label">Category Description</label>
            <div class="controls">
                <textarea class="input-xlarge" rows="3" name="category_description">{{$category_info->category_description}}</textarea>
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

@endsection
