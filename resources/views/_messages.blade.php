@if (Session::has('messages'))
    @foreach (Session::pull('messages') as $type => $messages)
        <div class="alert alert-{{ $type }}" role="alert">
            <ul class="m-a-0 p-a-0">
                @foreach($messages as $message)
                    <li>{!! $message !!}</li>
                @endforeach
            </ul>
        </div>
    @endforeach
@endif

@if (count($errors))
    <div class="alert alert-dismissible alert-danger no-print" role="alert">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
