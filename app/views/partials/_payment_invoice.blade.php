<div class="ui segment">
    <div class="ui two column middle aligned very relaxed stackable grid">
        <div class="six wide column">
            <div class="ui bordered rounded large image">
                <img src="{{asset($item->mainThumbnail())}}" alt="{{$item->title}}"/>
            </div>
        </div>

        <div class="ten wide column">
            <table class="ui very basic collapsing table">


                <tbody>
                <tr>
                    <td></td>
                    <td>Date</td>
                    <td>{{\Carbon\Carbon::now()->toDateString()}}</td>
                </tr>
                <tr>
                    <td>
                    </td>
                    <td>
                        {{trans('words.full_name')}}
                    </td>
                    <td>
                        {{Auth::user()->full_name}}
                    </td>
                </tr>
                <tr>
                    <td>
                    </td>
                    <td>
                        {{trans('words.email')}}
                    </td>
                    <td>
                        {{Auth::user()->email}}
                    </td>
                </tr>
                <tr>
                    <td>
                        {{Lang::choice('words.item', 1)}} #{{$item->id}}

                    </td>
                    <td>

                    </td>
                </tr>

                <tr>
                    <td>
                        {{$data['product']}}

                    </td>
                    <td>

                    </td>
                </tr>
                <tr>
                    <td>
                        <strong>{{trans('words.description')}}</strong>
                    </td>
                    <td>

                    </td>
                    <td>
                        <strong>{{trans('words.amount')}}</strong>
                    </td>
                </tr>
                <tr>
                    <td>
                        {{$data['description']}}
                    </td>
                    <td>

                    </td>
                    <td>
                        {{$data['currency']}} {{$data['price']}}
                    </td>
                </tr>

                <tr>
                    <td>

                    </td>
                    <td>
                        {{trans('phrases.total_payable')}}
                    </td>
                    <td>
                        {{$data['currency']}} {{$data['price']}}
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>