@extends('layouts.index')
@section('script_css')
    <style>
        .tableFixHead {
            overflow-y: auto;
            height: 250px;
        }

        .tableFixHead thead th {
            position: sticky;
            top: 0;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            padding: 8px 16px;
        }

        th {
            background: #eee;
        }
    </style>
@endsection
@section('content')
    @if (Auth::user()->level == 1)
        <form action="{{route("/exercise/add_exercise")}}" enctype="multipart/form-data" method="POST" class="mt-5">
            @csrf
            <div class="form-group">
                <input type="text" class="form-control form-control-sm" placeholder="Chủ đề bài tập" name="topic">
            </div>
            <div class="custom-file">
                <input type="file" class="custom-file-input" id="customFile" name="filename">
                <label class="custom-file-label" for="customFile">Choose file</label>
            </div>

            <script>
                // Add the following code if you want the name of the file appear on select
                $(".custom-file-input").on("change", function () {
                    var fileName = $(this).val().split("\\").pop();
                    $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
                });
            </script>
            <div class="mt-3 d-flex justify-content-center align-items-center">
                <button type="submit" class="btn btn-primary">Đăng bài</button>
            </div>
        </form>
    @endif
    <div class="table-responsive mt-5 tableFixHead">
        <table class="table">
            <thead>
            <tr>
                <th>Chủ đề</th>
                <th>Bài tập</th>
                <th>Bài giải</th>
                @if (Auth::user()->level==0)
                    <th>Nộp bài</th>
                @endif
            </tr>
            </thead>
            <tbody>
            @foreach($topics as $topic)
                <tr>
                    <td>{{$topic->topic}}</td>
                    <td>
                        @foreach($exercises as $exercise)
                            @if($exercise->topic == $topic->topic)
                                <a href="{{$exercise->exercise}}" download>Tải xuống</a>
                                @break
                            @endif
                        @endforeach
                    </td>
                    <td>
                        @foreach($exercises as $exercise)
                            @if (Auth::user()->level==0 and $exercise->topic == $topic->topic and $exercise->user_submit == Auth::user()->username)
                                <a href="{{$exercise->solution}}" download>Tải xuống</a>
                                <ul style="overflow:auto;
                                                    list-style-type: none;
                                                    height:50px;
                                                    list-style: none;
                                    padding-left: 0;">
                            @elseif (Auth::user()->level==1 and $exercise->solution!='null' and $exercise->topic == $topic->topic)

                                    <li>{{$exercise->user_submit}}: <a href="{{$exercise->solution}}">Tải xuống</a></li>
                            @endif
                                </ul>
                        @endforeach
                    </td>
                    @if (Auth::user()->level==0)

                        <td>
                            <form action="{{route('/exercise/upload_solution', $topic->topic)}}"
                                  enctype="multipart/form-data"
                                  method="POST">
                                @csrf
                                <div class="file mb-3">
                                    <input type="file" id="customFile" name="filename">
                                </div>
                                <div class="mt-3">
                                    <button type="submit" class="btn btn-primary">Nộp bài</button>
                                </div>
                            </form>
                        </td>
                    @endif
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div class="container">
        @yield('content')
    </div>
@endsection
