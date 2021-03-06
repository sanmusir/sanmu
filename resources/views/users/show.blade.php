@extends('layouts.app')

@section('title', $user->name . ' 的个人中心')

@section('content')

    <div class="row">

        <div class="col-lg-3 col-md-3 hidden-sm hidden-xs user-info">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="media">
                        <div align="center">
                            <img class="thumbnail img-responsive" src="{{ $user->avatar }}" width="300px" height="300px">
                        </div>
                        <div class="media-body">
                            <hr>
                            <h4><strong>个人简介</strong></h4>
                            <p>{{ $user->introduction }} </p>
                            <hr>
                            <h4><strong>注册于</strong></h4>
                            <p>{{ $user->created_at->diffForHumans() }}</p>
                            <hr>
                            <h4><strong>最后活跃</strong></h4>
                            <p title="{{  $user->last_actived_at }}">{{ $user->last_actived_at->diffForHumans() }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
            <div class="panel panel-default">
                <div class="panel-body">
                <span>
                    <h1 class="panel-title pull-left" style="font-size:30px;">{{ $user->name }} <small>{{ $user->email }}</small></h1>
                </span>
                </div>
            </div>
            <hr>

            {{-- 用户发布的内容 --}}
            <div class="panel panel-default">
                <div class="panel-body">
                    <ul class="nav nav-tabs">
                        <li class="{{ active_class(if_query('tab', null)) }}">
                            <a href="{{ route('users.show', $user->id) }}">话题</a>
                        </li>
                        <li class="{{ active_class(if_query('tab', 'replies')) }}">
                            <a href="{{ route('users.show', [$user->id, 'tab' => 'replies']) }}">回复</a>
                        </li>
                        <li class="{{ active_class(if_query('tab', 'favorites')) }}">
                            <a href="{{ route('users.show', [$user->id, 'tab' => 'favorites']) }}">收藏</a>
                        </li>
                    </ul>
                    @if (if_query('tab', 'replies'))
                        @include('users._replies', ['replies' => $user->replies()->with('topic')->recent()->paginate(8)])
                    @elseif(if_query('tab', 'favorites'))
                        @include('users._topics', ['topics' => $user->favorites()->recent()->paginate(8)])
                    @else
                        @include('users._topics', ['topics' => $user->topics()->recent()->paginate(8)])
                    @endif
                </div>
            </div>
        </div>
    </div>
@stop