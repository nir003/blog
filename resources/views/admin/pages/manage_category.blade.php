<?php
/**
 * Created by PhpStorm.
 * User: nirjhor
 * Date: 7/10/2018
 * Time: 8:36 PM
 */
?>


@extends('admin.master')
@section('dashboard_content')
        <!-- BEGIN EXAMPLE TABLE widget-->

<?php
echo "<pre>";
//print_r($all_category);
echo "$category_id_edit";
//print_r($category_info_for_edit);
echo "</pre>";

?>

<div class="widget purple">
    <div class="widget-title">
        <h4><i class="icon-reorder"></i> Editable Table</h4>
                            <span class="tools">
                                <a href="javascript:;" class="icon-chevron-down"></a>
                                <a href="javascript:;" class="icon-remove"></a>
                            </span>
    </div>
    <div class="widget-body">
        <div>
            <div class="clearfix">
                <div class="btn-group">
                    <a href="{{'/Wild_horse/add_category'}}" id="editable-sample_new" class="btn green">
                        Add New <i class="icon-plus"></i>
                    </a>
                </div>
                <div class="btn-group pull-right">
                    <button class="btn dropdown-toggle" data-toggle="dropdown">Tools <i class="icon-angle-down"></i>
                    </button>
                    <ul class="dropdown-menu pull-right">
                        <li><a href="#">Print</a></li>
                        <li><a href="#">Save as PDF</a></li>
                        <li><a href="#">Export to Excel</a></li>
                    </ul>
                </div>
            </div>
            <div class="space15"></div>


            <table class="table table-striped table-hover table-bordered" id="editable-sample">
                <thead>
                <tr>
                    <th>Category ID</th>
                    <th>Category Name</th>
                    <th>Category Description</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>


                @foreach($all_category as $category_row)

                    <?php
                    if($category_row->id == $category_id_edit){
                    ?>
                    {!! Form::open(['url' => '/update_category_form','method'=>'post','class="form-horizontal"']) !!}
                    <tr class="">
                        <td><input type="hidden" value="{{$category_row->id}}" name="category_id">{{$category_row->id}}</td>

                        <td><input type="text" name="category_name" value="{{$category_row->category_name}}"></td>
                        <td><textarea name="category_description">{{$category_row->category_description}}</textarea>
                        </td>
                        <td>
                            <?php
                            if($category_row->category_status == 0){

                            ?><span class="label label-danger label-mini">Draft     </span><?php

                            }elseif($category_row->category_status == 1){
                            ?><span class="label label-success label-mini"
                                    style="color: rgba(0, 0, 0, 0.77)">Publish</span><?php
                            }else{
                            ?><span class="label label-important label-mini">Unpublish</span><?php
                            }
                            ?>
                        </td>
                        <td>
                            <button type="submit" class="btn blue btn-primary"><i class="icon-ok"></i> Update</button>
                        </td>
                    </tr>
                    {!! Form::close() !!}
                    <?php
                    }else {
                    ?>
                    <tr class="">
                        <td>{{$category_row->id}}</td>
                        <td>{{$category_row->category_name}}</td>
                        <td>{{$category_row->category_description}}</td>
                        <td>
                            <?php
                            if($category_row->category_status == 0){

                            ?><span class="label label-danger label-mini">Draft     </span><?php

                            }elseif($category_row->category_status == 1){
                            ?><span class="label label-success label-mini"
                                    style="color: rgba(0, 0, 0, 0.77)">Publish</span><?php
                            }else{
                            ?><span class="label label-important label-mini">Unpublish</span><?php
                            }
                            ?>
                        </td>
                        <td>
                            {{--<a  href="javascript:;">--}}
                            @if($category_row->category_status == 2)
                                <a class="btn btn-success" href="{{URL::to('/unpublish-category/'.$category_row->id)}}">
                                    <i class="material-icons" style="font-size:15px;color: #0000F0">thumb_up</i>
                                </a>
                            @elseif($category_row->category_status == 0)
                                <a class="btn btn-success" href="{{URL::to('/unpublish-category/'.$category_row->id)}}">
                                    <i class="material-icons" style="font-size:15px">thumb_up</i>
                                </a>
                            @else
                                <a class="btn btn-success" href="{{URL::to('/unpublish-category/'.$category_row->id)}}">
                                    <i class="material-icons" style="font-size:15px;color: darkred">thumb_down</i>
                                </a>
                            @endif
                            {{--</a>--}}

                            <a class="edit btn btn-primary" href="{{URL::to('/edit-category/'.$category_row->id)}}">
                                <i class="material-icons" style="font-size:15px;color: black">edit</i>
                            </a>
                            <a class="edit btn btn-primary" href="{{URL::to('/edit-category2/'.$category_row->id)}}">
                                <i class="material-icons" style="font-size:15px;color: yellow">edit</i>
                            </a>

                            <a class="delete btn btn-danger" href="{{URL::to('/delete-category/'.$category_row->id)}}"
                               onclick="return checkDelete()">
                                <i class="material-icons" style="font-size:15px">delete</i>
                            </a>
                        </td>
                    </tr>
                    <?php
                    }
                    ?>



                @endforeach

                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- END EXAMPLE TABLE widget-->

@endsection
