@if (Session::has('messages'))
    @foreach (Session::pull('messages') as $type => $messages)
        <div class="alert alert-dismissible alert-{{ $type }} m-b-md no-print" role="alert">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <ul>
                @foreach($messages as $message)
                    <li>{!! $message !!}</li>
                @endforeach
            </ul>
        </div>
    @endforeach
@endif

@if (count($errors))
    <div class="alert alert-dismissible alert-danger m-b-md no-print" role="alert">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
