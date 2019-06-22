@extends('layouts.user')

@section('content')

    <div class="page-title">
        <div class="title_left">
            <h3>{{ $campaign['name'] }}</h3>
        </div>

    </div>

    <div class="clearfix"></div>

    @if(Session::get('msg'))
        <div class="alert alert-{{Session::get('msg.type')}}">
            <span><strong>{{Session::get('msg.txt')}}</strong></span>
        </div>
    @endif

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">

                <div class="x_title">
                    <h2>Feedback Campaign List</h2>
                    <a class="btn btn-success pull-right" href="/user/campaign/{{ $campaign['id'] }}/answer">
                        <i class="fa fa-check"></i> Answer the Questions
                    </a>
                    <div class="clearfix"></div>
                </div>

                <div class="x_content">
                    @if ($questions)

                        <table id="datatable" class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th>Name</th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach ($questions as $question)
                                <tr>
                                    <td>{{ $question['question'] }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>

            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">

                <div class="x_title">
                    <h4>Collaborators</h4>
                </div>

                <div class="x_content">
                    @if ($collaborators)

                        <table id="datatable" class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach ($collaborators as $collaborator)
                                <tr>
                                    <td>{{ $collaborator['collaborator']['name'] }}</td>
                                    <td>{{ $collaborator['status'] }}</td>
                                    <td class="text-right">
                                        <a href="/user/campaign/{{ $campaign['id']}}/collaborator/{{ $collaborator['collaborator']['id']}}" class="btn btn-success btn-xs">
                                            <i class="fa fa-check"></i> Answer the Questions
                                        </a>
                                        {{--<a href="#" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Delete </a>--}}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @else
                        <div class="jumbotron">
                            <h3>No Collaborators Yet!</h3>
                            <p>Please add Collaborators to this Campaign.</p>
                            <a class="btn btn-success" href="/campaigns/{{ $campaign['id'] }}/collaborators/add">
                                <i class="fa fa-question"></i> Add Questions
                            </a>
                        </div>
                    @endif
                </div>

            </div>

        </div>

    </div>


@stop

@section('js')

@stop