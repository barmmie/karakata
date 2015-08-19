@extends('layouts.admin')


@section('content')
    <div class="main ui container">

        <div class="ui segments">

            <div class="ui segment">
                <h4 class="header">
                    <i class="icon"></i> All Items

                </h4>

            </div>

            <div class="ui clearing segment ">

                <div class="ui pointing secondary menu">
                    <a href="{{route('admin.reports.index', 'all')}}" class="{{$status == 'all' ? 'active' : ''}} item" >All</a>
                    <a href="{{route('admin.reports.index', 'reviewed')}}" class="{{$status == 'reviewed' ? 'active' : ''}} item" >Reviewed only</a>
                    <a href="{{route('admin.reports.index', 'unreviewed')}}" class="{{$status == 'unreviewed' ? 'active' : ''}} item" >Unreviewed only</a>
                </div>

            </div>

            <div class="ui padded segment">

                @if(count($reports) < 1)
                    <div class="ui message">
                        <div class="header">

                        </div>
                        There are no reports here
                    </div>
                @else
                    <div class="ui divided items">

                        @foreach($reports as $report)
                            <div class="item">

                                <div class="ui small bordered rounded image">
                                    <a class="ui brown ribbon label">{{Setting::get('currency', '£')}} {{$report->item->amount}}</a>

                                    <a class="ui right corner label">
                                        <i class="camera icon"></i>
                                        <i class=" corner icon">{{count($report->item->pictures)}}</i>

                                    </a>
                                    <img src="{{asset($report->item->mainThumbnail())}}">
                                </div>
                                <div class="content">

                                    <a class="header" href="{{route('items.show', $report->item->slug)}}">{{$report->item->title}}</a>
                                    <div class="meta">
                                            <span class="date m-b-xs">
                                                <i class="teal calendar icon"></i> {{$report->item->created_at->format('M j, Y g:i A')}}
                                            </span>

                                            <span class="category m-b-xs">
                                                <i class="minus icon"></i>{{$report->item->category->title}}<i class="minus icon"></i>
                                            </span>
                                             <span class="location">
                                                <i class="teal marker icon"></i>{{$report->item->location->name}}
                                            </span>

                                    </div>
                                    <div class="description">
                                        <p></p>
                                    </div>
                                    <div class="extra">
                                        @if($report->item->negotiable)
                                            <div class="ui brown tag label">Negotiable</div>
                                        @endif

                                        @if($report->item->isApproved())
                                            <div class="ui blue label">Approved</div>
                                        @endif

                                        @if($report->item->isRejected())
                                            <div class="ui orange label">Rejected</div>
                                        @endif

                                        @if($report->item->isPending())
                                            <div class="ui grey label">Pending approval</div>
                                        @endif

                                    </div>
                                    <div class="extra">

                                        <a href="{{route('admin.items.delete', $report->item->id)}}" class="ui right floated tiny red button confirm-delete">
                                            <i class="trash icon"></i>

                                            Delete
                                        </a>
                                        @if(! $report->item->isRejected())
                                            <a href="{{route('admin.items.reject', $report->item->id)}}" class="ui right floated tiny orange button">
                                                <i class="cancel icon"></i>

                                                Reject
                                            </a>
                                        @endif
                                        @if(! $report->item->isApproved())
                                            <a href="{{route('admin.items.approve', $report->item->id)}}" class="ui right floated tiny primary button">
                                                <i class="check icon"></i>

                                                Approve
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>

                        @endforeach
                    </div>

                @endif



            </div>


            @if($reports->getTotal() > $reports->getPerPage())
                <div class="ui segment">
                    {{$reports->links()}}

                </div>
            @endif
        </div>

    </div>
@endsection


@section('scripts')
    <script type="text/javascript">
        $('.pointing .item')
                .tab()
        ;

        $('.ui.dropdown').dropdown()
    </script>

@endsection