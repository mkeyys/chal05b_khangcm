@extends('layouts.index')
@section('script-css')
    <link rel="resources/css/messages.css">
@endsection

@section('content')
    <div class="row mt-5">
        <div class="col-sm-4 card" style="overflow:scroll; height: 400px">
            <ul class="list-group list-group-flush">
                @foreach($users as $user)
                    <li class="list-group-item">
                        <div class="d-flex w-100 justify-content-between">
                            <a href="/messages/{{$user->username}}" class="mb-1">{{$user->name}}</a>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>

        <div class="col-sm-8 w-75">
            <h5 class="text-center font-weight-bold">To: {{$to_user}}</h5>
            <div style="overflow-y: scroll; height: 338px">
                <table class="table table-fixed">
                    <tbody>
                    @foreach($messages as $message)
                        <tr>
                            @if($message->to_username == $to_username)
                                <td style="float: right;">
                                    <a href="#" data-toggle="collapse" data-target="#editMess{{$message->id}}"><i
                                            class="fas fa-edit"></i></a>
                                    <div id="editMess{{$message->id}}" class="collapse">
                                        <form class="form-inline" action="{{route('/messages/edit', $message->id)}}"
                                              enctype="multipart/form-data" method="POST">
                                            @csrf
                                            <div class="form-group ml-auto">
                                                <input type="text" class="form-control form-control-sm"
                                                       value="{{$message->message}}"
                                                       name="mess_edited">
                                            </div>
                                            <div class="form-group">
                                                <button type="submit" class="form-control form-control-sm">Gửi lại
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                    <a href="/messages/dele/{{$message->id}}"><i class="far fa-trash-alt"></i></a>
                                    {{$message->message}}</td>
                            @else
                                <td style="float: left;">{{$message->message}} </td>
                            @endif


                        </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>
            <form class="row" action="{{route('/messages/send_message', $to_username)}}" method="POST">
                @csrf
                <div class="col-lg-11">
                    <input type="text" placeholder="Message..." class="form-control" name="message_input">
                </div>
                <div class="col-xs-3">
                    <button type="submit" class="btn btn-info btn-block"><i class="far fa-paper-plane"></i></button>
                </div>
            </form>

        </div>
    </div>
@endsection
