@extends('layouts.public')

@section('content')
    @include('partials._search_cta')

    <div class="ui container p-t-lg">
        <div class="ui two column relaxed stackable grid">
            <div class="four wide column">
               <div class="ui content">
                   <div class="ui card">
                       <div class="image">
                           <img src="{{gravatar($user->email)}}">
                       </div>
                       <div class="content">
                           <a class="header">{{$user->full_name}}</a>
                           <div class="meta">
                               <span class="date">Joined in {{$user->created_at->format('M, j Y')}}</span>
                           </div>

                       </div>
                       <div class="extra content">
                           <a>
                               <i class="file icon"></i>
                               {{$item_count}} Items
                           </a>
                       </div>
                   </div>
               </div>



            </div>

            <div class="twelve wide column">
                <div class="ui segments">

                    <div class="ui segment">
                        <h4 class="header">
                            <i class="icon"></i> Items by {{$user->full_name}}

                        </h4>

                    </div>

                    <div class="ui padded segment">


                        @if(count($items) < 1)
                            <div class="ui message">
                                <div class="header">

                                </div>
                                This user currently has no items in this category.
                            </div>
                        @else
                            <div class="ui divided items">

                                @foreach($items as $item)
                                    @include('partials._item')
                                @endforeach
                            </div>

                        @endif



                    </div>


                    @if($item_count > 10)
                        <div class="ui segment">
                            {{$items->links()}}

                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>


@endsection

@section('scripts')
    <script type="text/javascript">
        $(document).ready(function(){
            $('.ui.advanced_filter.accordion').accordion();
        });

        $('.ui.form').form();


    </script>
@endsection