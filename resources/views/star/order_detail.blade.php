@extends('star.star_layouts')


@section('title', "红了吗（试用版）")

@section('body')
@section('page-main')
    <header class="bar bar-nav">
     <a class="button button-link button-nav pull-left back" href="javascript:history.go(-1)">
            <span class="icon icon-left"></span>
            返回
        </a>
        <h1 class="title">订单详情</h1>
    </header>

        <div class="content" style="margin-bottom: 5rem">
       
         <div class="list-block" style="margin-top:0; margin-bottom:0;">
            <ul>
            <li>
                <div valign="bottom" class="card-header color-white no-border no-padding" style="height:6rem">
                    <img class='card-cover' style="height:100%" src="{{$data['activity']->picture}}" alt="">
                </div>
            </li>
            </ul>
            <ul>
            <li>
                <div class="item-content">
                    <div class="item-inner">
                        <div class="item-title" style="font-size:80%;">{{ $data['activity']->title}}</div>
                        <div id="f_merchant_name" class="item-after"  style="font-size:80%;">￥ {{$data['price']}}</div>
                    </div>
                </div>
            </li>
            <li>
                <div class="item-content">
                    <div class="item-inner">
                        <div class="item-title label" style="font-size:80%;">活动时间</div>
                        <div class="item-input" style="font-size:80%; color:#666666">
                            <p>{{$data['activity']->time_within}}</p>
                        </div>
                    </div>
                </div>
                <div class="item-content">
                    <div class="item-inner">
                        <div class="item-title label" style="font-size:80%;">活动要求</div>
                        <div class="item-input" style="font-size:80%; color:#666666">
                            <p>{{$data['activity']->claim}}</p>
                        </div>
                    </div>
                </div>
                @if($data['order']->status==1)
                    <div class="item-content">
                        <div class="item-inner">
                            <div class="item-title label" style="font-size:80%;">抢单场次</div>
                            <div class="item-input" style="font-size:80%; color:#666666">
                                <p>{{$data['order']->expectation_num}}</p>
                            </div>
                        </div>
                    </div>
                @endif
                @if($data['order']->status==2)
                    <div class="item-content">
                        <div class="item-inner">
                            <div class="item-title label" style="font-size:80%;">分配场次</div>
                            <div class="item-input" style="font-size:80%; color:#666666">
                                <p>{{$data['task']->show_num}}</p>
                            </div>
                        </div>
                    </div>
                @endif
            </li>
            </ul>
        </div>
        <div class="list-block"  style="margin-bottom: 0px;margin-top:1rem">
                <ul>
                    <li>
                        <div class="item-content">
                            <div class="item-inner">
                                <div class="item-title" style="font-size:80%;">商品信息</div>
                            </div>
                        </div>
                    </li>
                </ul>
        </div>
        <div class="list-block" style="margin:0px  ">
                <ul>
                    @foreach ($commodities as $commodity)
                        <li>
                            <a href="<?php echo (strpos($commodity->url,'http') === 0) ? $commodity->url : 'http://'.$commodity->url; ?>" style="">
                                <div class="item-content">
                                    <div class="item-inner">
                                        <div class="item-title" style="font-size:80%;">{{$commodity->name}}</div>
                                    </div>
                                </div>
                            </a>
                        </li>
                    @endforeach
                </ul>
        </div>
            @if($data['order']->status==2)
            <div class="list-block"  style="margin-top: 0px;margin-bottom: 2rem" >
                <ul>
                    <li>
                        <div class="item-content">
                            <div class="item-inner">
                                <div class="item-title" style="font-size:80%;">物流信息</div>
                            </div>
                            <div class="item-after">
                                <div class="item-title" style="font-size:80%;">
                                    @if($data['task']->is_shipping==0) 无需邮寄样品
                                @elseif($data['order']->status==2&&$data['task']->status>=2&&$data['task']->is_shipping>=1)
                                      {{$data['task']->express_company}}
                                      {{$data['task']->express_num}}
                                @endif
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
            @endif
            @if($data['order']->status==2&&$data['task']->status>=4)
            <div class="list-block"  style="margin-top: 0px;margin-bottom: 5rem" >
                <ul>
                    <li>
                        <div class="item-content">
                            <div class="item-inner">
                                <div class="item-title" style="font-size:80%;">商家评论</div>
                            </div>
                            <div class="item-after">
                                <div class="item-title" style="font-size:80%;">
                                    @if($data['order']->status==2&&$data['task']->status==2)
                                        {{$data['task']->evaluation}}
                                    @endif
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
            @endif
    </div>
    <div class="list-block" style="background-color:#cccccc;position:fixed; width:100%; bottom:2.5rem; margin-bottom:0; overflow:visible;">
        <div class="item-content">
            <div class="item-inner">
                @if($data['order']->status==1&&$data['isAvailable']==true)
                    <div class="item-title" style="font-size:80%;">正在审核抢单 </div>
                    <div  class="item-after">
                        <a href="#" onclick="$.cancelOrder({{$data['order']->order_id}})" class="button button-dark" style="border:0; background-color:#ee5555; color:white;">取消申请</a></div>
                @elseif($data['order']->status==2&&$data['task']->status==1)
                    <div class="item-title" style="font-size:80%;">等待商家发货 </div>
                @elseif($data['order']->status==2&&$data['task']->status==2&&$data['task']->is_shipping==1)
                    <div class="item-title" style="font-size:80%;">商家已发货 </div>
                    <div  class="item-after">
                        <a href="javascript:ship_confirm({{$data['task']->task_id}})" class="button button-dark" style="border:0; background-color:#ee5555; color:white;">确认收货</a></div>
                @elseif($data['order']->status==2&&$data['task']->status==2&&$data['task']->is_shipping==2)
                    <div class="item-title" style="font-size:80%;">已收货 </div>
                    <div  class="item-after">
                        <a href="task_result?task_id={{$data['task']->task_id}}" class="button button-dark" style="border:0; background-color:#ee5555; color:white;">提交结果</a>&nbsp;
                        <a href="javascript:finish_task({{$data['task']->task_id}})" class="button button-dark" style="border:0; background-color:#ee5555; color:white;">完成任务</a>
                    </div>
                @elseif($data['order']->status==2&&$data['task']->status==2&&$data['task']->is_shipping==0)
                    <div class="item-title" style="font-size:80%;">无样品，任务进行中 </div>
                    <div  class="item-after">
                        <a href="task_result?task_id={{$data['task']->task_id}}" class="button button-dark" style="border:0; background-color:#ee5555; color:white;">提交结果</a>&nbsp;
                        <a href="javascript:finish_task({{$data['task']->task_id}})" class="button button-dark" style="border:0; background-color:#ee5555; color:white;">完成任务</a>
                    </div>
                @elseif($data['order']->status==2&&$data['task']->status==3)
                    <div class="item-title" style="font-size:80%;">任务已完成，等待商家评论 </div>
                @elseif($data['order']->status==2&&$data['task']->status==4)
                    <div class="item-title" style="font-size:80%;">商家已完成评价，任务结束  </div>
                @elseif($data['order']->status==0)
                    <div class="item-title" style="font-size:80%;">抢单已取消，任务结束 </div>
                @elseif($data['order']->status==1&&$data['isAvailable']==false)
                    <div class="item-title" style="font-size:80%;">该活动已被抢光 </div>
                @endif
            </div> </div> </div>
    @include("star.star_footer")
@overwrite
@include('partial/jquery_mobile_page', ["page_id" => "main"])




