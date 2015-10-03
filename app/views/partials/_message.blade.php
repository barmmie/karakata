@if(Session::has('feedback'))

    @foreach(Session::get('feedback') as $message)
        <div class="ui container">
            <div class="ui floating {{$message['type']}} message m-t-sm m-b-sm">
                <i class="close icon"></i>

                <div class="header">
                    {{$message['content']}}
                </div>
                <p>{{$message['additionalInfo']}}</p>
            </div>
        </div>

    @endforeach


@endif



