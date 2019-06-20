@extends('layouts.admin')

@section('content')

    <div class="page-title">
        <div class="title_left">
            <h3>Base Questions</h3>
        </div>
    </div>

    <div class="clearfix"></div>

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Question List</h2>
                    <a class="btn btn-success pull-right" href="{{ route('questions.create') }}">
                        <i class="fa fa-plus"></i> Create new Question
                    </a>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">

                    <table id="datatable" class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Type</th>
                            <th></th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach ($questions as $question)
                        <tr>
                            <td>{{ $question['question'] }}</td>
                            <td>{{ $question['type'] }}</td>
                            <td class="text-right">
                                <a href="{{ route('questions.edit', $question['id']) }}" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Edit </a>
                                <a href="#" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Delete </a>
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
            $('#datatable').dataTable();
        });
    </script>
@stop