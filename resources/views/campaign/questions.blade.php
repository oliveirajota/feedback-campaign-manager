@extends('layouts.app')

@section('content')
    <div class="page-title">
        <div class="title_left">
            <h3>Feedback Campaign</h3>
        </div>

    </div>
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Add Questions to Campaign</h2>

                    <div class="clearfix"></div>
                </div>
                <div class="x_content">

                    @if(Session::get('msg'))
                        <div class="alert alert-{{Session::get('msg.type')}}">
                            <span><strong>{{Session::get('msg.txt')}}</strong></span>
                        </div>
                    @endif

                    <table id="datatable" class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th></th>
                            <th>Name</th>
                            <th>Type</th>
                            <th></th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach ($questions as $question)
                            <tr>
                                <td>
                                    <input type="checkbox">
                                </td>
                                <td>{{ $question['question'] }}</td>
                                <td>{{ $question['type'] }}</td>
                                <td class="text-right">
                                    <a href="/campaigns/{{ $campaign['id'] }}/questions/add/{{ $question['id'] }}" class="btn btn-success btn-xs"><i class="fa fa-plus"></i> Add </a>
                                    {{--<a href="#" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Delete </a>--}}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
@stop


@section('js')
    <script>
        $(document).ready(function () {
        });
    </script>
@stop