@extends('layouts.admin')


@section('title')
    {{trans('phrases.manage_abuse_reports')}}
@endsection

@section('content')
    <div class="main ui container">

        <div class="ui segments">

            <div class="ui segment">
                <h4 class="header">
                    <i class="warning icon"></i>     {{trans('phrases.manage_abuse_reports')}}

                </h4>

            </div>

            <div class="ui clearing segment ">

                <div class="ui pointing secondary menu">
                    <a href="{{route('admin.reports.index', 'all')}}"
                       class="{{$status == 'all' ? 'active' : ''}} item">{{trans('words.all')}}</a>
                    <a href="{{route('admin.reports.index', 'reviewed')}}"
                       class="{{$status == 'reviewed' ? 'active' : ''}} item">{{trans('phrases.reviewed_only')}}</a>
                    <a href="{{route('admin.reports.index', 'unreviewed')}}"
                       class="{{$status == 'unreviewed' ? 'active' : ''}} item">{{trans('phrases.unreviewed_only')}}</a>
                </div>

            </div>

            <div class="ui padded segment">

                @if(count($reports) < 1)
                    <div class="ui message">
                        <div class="header">

                        </div>
                        {{trans('phrases.no_reports_here')}}
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

                                    <a class="header"
                                       href="{{route('admin.items.show', $report->item->id)}}">{{$report->item->title}}</a>

                                    <div class="meta">
                                            <span class="date m-b-xs">
                                                <i class="teal calendar icon"></i> {{$report->item->created_at->format('M j, Y g:i A')}}
                                            </span>

                                            <span class="category m-b-xs">
                                                <i class="minus icon"></i>{{$report->item->category->title}}<i
                                                        class="minus icon"></i>
                                            </span>
                                             <span class="location">
                                                <i class="teal marker icon"></i>{{$report->item->location->name}}
                                            </span>

                                    </div>
                                    <div class="description">

                                        <p><i class="red warning icon "> </i> {{$report->message}}</p>
                                    </div>
                                    <div class="extra">
                                        @if($report->item->negotiable)
                                            <div class="ui brown tag label">{{trans('words.negotiable')}}</div>
                                        @endif

                                        @if($report->item->isApproved())
                                            <div class="ui blue label">{{trans('words.approved')}}</div>
                                        @endif

                                        @if($report->item->isRejected())
                                            <div class="ui orange label">{{trans('words.rejected')}}</div>
                                        @endif

                                        @if($report->item->isPending())
                                            <div class="ui grey label">{{trans('phrases.pending_approval')}}</div>
                                        @endif

                                    </div>
                                    <div class="extra">

                                        <a href="{{route('admin.reports.delete', $report->item->id)}}"
                                           class="ui right floated tiny red button confirm-delete">
                                            <i class="trash icon"></i>

                                            {{trans('words.delete')}}
                                        </a>
                                        @if(! $report->isReviewed())
                                            <a href="{{route('admin.reports.reviewed', $report->id)}}"
                                               class="ui right floated tiny primary button">
                                                <i class="check icon"></i>

                                                {{trans('phrases.mark_as_reviewed')}}
                                            </a>
                                        @endif
                                        @if(! $report->isUnreviewed())
                                            <a href="{{route('admin.reports.unreviewed', $report->id)}}"
                                               class="ui right floated tiny orange button">
                                                <i class="cancel icon"></i>

                                                {{trans('phrases.mark_as_unreviewed')}}
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