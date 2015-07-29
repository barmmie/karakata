@extends('layouts.public')

@section('content')
    @include('partials._search_cta')

    <div class="ui container p-t-lg">
        <div class="ui two column relaxed stackable grid">


            <div class="twelve wide column">
                <div class="ui segments">
                    <div class="ui segment">
                        <div class="ui breadcrumb">
                            <a class="section" href="{{route('pages.homepage')}}">Home</a>
                            @if($item->category->parent && $item->category->parent->id !=1)
                                <i class="right angle icon divider"></i>
                                <a class="section"
                                   href="{{route('categories.show', $item->category->parent->slug)}}">{{$item->category->parent->title}}</a>
                            @endif
                            <i class="right angle icon divider"></i>
                            <a class="section"
                               href="{{route('categories.show', $item->category->slug)}}">{{$item->category->title}}</a>


                        </div>
                    </div>

                    <div class="ui padded segment">

                        <h3 class="ui dividing header">
                            {{$item->title}}
                        </h3>

                        <div class="ui horizontal list">
                            <div class="item">
                                <i class="teal calendar icon"></i> {{$item->created_at->format('M j, Y g:i A')}}
                            </div>

                            <div class="item">
                                <i class="teal marker icon"></i> {{$item->location->name}}
                            </div>
                        </div>


                        <h4 class="ui horizontal divider header">
                            <i class="tag icon"></i>
                            Description
                        </h4>

                        <div class="ui content">
                            <div class="ui stackable equal height stackable grid">
                                <div class="ten wide column">
                                    {{$item->description}}
                                </div>

                                <div class="six wide column">
                                    <div class="ui message m-b-lg">
                                        <ul class="ui list">
                                            <div class="item">
                                                <strong>Price:</strong> £ {{$item->amount}}
                                            </div>
                                            <div class="item">
                                                <strong>Negotiable:</strong> New
                                            </div>
                                            <div class="item">
                                                <strong>Type:</strong> Mobile Mobiles,For sale
                                            </div>
                                            <div class="item">
                                                <strong>Location:</strong> {{$item->location->name}}
                                            </div>

                                            <div class="item">
                                                <strong>Posted by a/an:</strong> {{($item->type == 'personal')? 'Individual' :  'Business'}}
                                            </div>
                                        </ul>
                                    </div>
                                    <div class="ui middle aligned divided list">
                                        <div class="item">
                                            <i class="user icon"></i>
                                            <div class="content">
                                                <a class="header">More ads by this user</a>
                                            </div>
                                        </div>
                                        <div class="item">
                                            <i class="heart icon"></i>
                                            <div class="content">
                                                <a class="header">Save ad</a>
                                            </div>
                                        </div>
                                        <div class="item">
                                            <i class="share icon"></i>
                                            <div class="content">
                                                <a class="header">Share ad</a>
                                            </div>
                                        </div>
                                        <div class="item">
                                            <i class="warning sign icon"></i>
                                            <div class="content">
                                                <a class="header">Report abuse</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        </div>


                    </div>

                </div>
            </div>
            <div class="four wide column">


            </div>
        </div>
    </div>


@endsection

@section('scripts')
    <script type="text/javascript">
        $(document).ready(function () {
            $('.ui.advanced_filter.accordion').accordion();
        });

        $('.ui.form').form();


    </script>
@endsection