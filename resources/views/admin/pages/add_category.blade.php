<?php
/**
 * Created by PhpStorm.
 * User: nirjhor
 * Date: 7/10/2018
 * Time: 4:01 PM
 */?>

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

        {!! Form::open(['url' => '/add_category_form','method'=>'post','class="form-horizontal"']) !!}

            <div class="control-group">
                <label class="control-label">Category Name</label>
                <div class="controls">
                    <input type="text" placeholder="Enter Category Name" class="input-large" name="category_name"/>
                    <span class="help-inline">Sports</span>
                </div>
            </div>

            <div class="control-group">
                <label class="control-label">Category Description</label>
                <div class="controls">
                    <textarea class="input-xlarge" rows="3" name="category_description"></textarea>
                </div>
            </div>

            <div class="control-group">
                <label class="control-label">Category Status</label>
                <div class="controls">
                    <select class="input-large m-wrap" tabindex="1" name="category_status">
                        <option value="0">Select Status</option>
                        <option value="1">Publish</option>
                        <option value="2">Unpublish </option>
                        <option value="0">Draft</option>
                    </select>
                </div>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn blue btn-primary"><i class="icon-ok"></i> Save</button>
                <button type="button" class="btn btn-success"><i class=" icon-remove"></i> Cancel</button>
            </div>
        {{--</form>--}}

        {!! Form::close() !!}
        <!-- END FORM-->
    </div>
</div>
<!-- END SAMPLE FORM PORTLET-->

@endsection
