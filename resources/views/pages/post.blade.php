<?php
/**
 * Created by PhpStorm.
 * User: nirjhor
 * Date: 7/8/2018
 * Time: 1:42 PM
 */

function checkMonth($month_id){
    $month_name = 'null';
    if($month_id == 1){
        $month_name = "Jan";
    }elseif($month_id == 2){
        $month_name = "Feb";
    }elseif($month_id == 3){
        $month_name = "Mar";
    }elseif($month_id == 4){
        $month_name = "Apr";
    }elseif($month_id == 5){
        $month_name = "May";
    }elseif($month_id == 6){
        $month_name = "Jun";
    }elseif($month_id == 7){
        $month_name = "July";
    }elseif($month_id == 8){
        $month_name = "Aug";
    }elseif($month_id == 9){
        $month_name = "Sept";
    }elseif($month_id == 10){
        $month_name = "Oct";
    }elseif($month_id == 11){
        $month_name = "Nov";
    }elseif($month_id == 12){
        $month_name = "Dec";
    }
    return $month_name;
}

?>

@extends('home')

@section('post_section')

    <head>
        <style>
            .post_image{
                width: 100%;
                height: 200px;
            }
        </style>
    </head>


    @foreach($all_post_info as $postRow)

        <?php
                $date = $postRow->created_at;
                //echo "<h3>$date</h3>";
                $date2 = explode('-',$date);
                //echo $date;
                //print_r($date2);
                //echo $date[1];
                //echo $date2[1];

                $day = explode(' ',$date2[2]);
                $day = $day[0];

                $month_name = checkMonth($date2[1]);
                //print_r($month);


        ?>
<div class="post_section">
    <div class="post_date">
        {{$day}}<span>{{$month_name}}</span>
    </div>

    <div class="post_content">
        <h3><a href="#">{{$postRow->blog_title}}</a></h3>
        <strong>Author:</strong> {{$postRow->author_name}} <strong>Category:</strong> <a href="#">Game</a>

        <a href="{{$postRow->blog_image}}" target="_parent"><img src="{{asset($postRow->blog_image)}}" alt="image" class="post_image" /></a>



        <p>{{$postRow->blog_short_description}}</p>

        <a href="blog_post.html">58 Comments</a> | <a href="{{URL::to('/detail_post/'.$postRow->blog_id)}}">Continue reading...</a>

    </div>
    <div class="cleaner"></div>
</div>

    @endforeach
    @endsection
