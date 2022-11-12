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
        th, td {
            padding: 8px 16px;
        }

        th {
            background: #eee;
        }
        .table td.textoverflow {
            max-width: 177px;
        }

        .table td.textoverflow span {
            overflow: hidden;
            display: inline-block;
            white-space: nowrap;
            text-overflow: ellipsis;
            max-width: 100%;
        }

        .table td.textoverflow span:hover {
            text-overflow: clip;
            white-space: normal;
            word-break: break-all;
        }
    </style>
@endsection

@section('content')
    @if (Auth::user()->level == 1)
    <form action="{{route("/quiz/add_quiz")}}" enctype="multipart/form-data" method="POST" class="mt-5">
        @csrf
        <div class="custom-file">
            <input type="file" class="custom-file-input" id="customFile" name="filename">
            <label class="custom-file-label" for="customFile">Choose file</label>
        </div>
        <div class="form-group pt-3">
            <input type="text" class="form-control form-control-sm" placeholder="Gợi ý" name="hint">
        </div>

        <script>
            // Add the following code if you want the name of the file appear on select
            $(".custom-file-input").on("change", function () {
                var fileName = $(this).val().split("\\").pop();
                $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
            });
        </script>
        <div class="mt-1 d-flex justify-content-center align-items-center">
            <button type="submit" class="btn btn-primary">Đăng câu đố</button>
        </div>
        @endif
        <div class="mt-5 tableFixHead">
            <table class="table table-ellipsis">
                <thead>
                <tr>
                    <th>Câu đố</th>
                    <th>Gợi ý</th>
                    <th></th>
                </tr>
                </thead>
                @foreach($quiz as $q)
                <tbody class="col-sm">
                    <tr>
                        <td>{{$q->id}}</td>
                        <td class="textoverflow">
                            <span>{{$q->hint}}</span>
                        </td>
                        <td>
                            @if(Auth::user()->level == 0)
                            <form class="form-inline" action="{{route('/quiz/checkans', $q->linkfiletxt)}}" enctype="multipart/form-data" method="POST">
                                @csrf
                                <div class="form-group ml-auto">
                                    <input type="text" class="form-control form-control-sm" placeholder="Nhập đáp án"
                                           name="ansquiz">
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="form-control form-control-sm">Kiểm tra</button>
                                </div>
                            </form>
                            @endif
                        </td>
                    </tr>
                </tbody>
                @endforeach
            </table>
        </div>
@endsection
