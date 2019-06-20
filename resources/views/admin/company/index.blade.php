@extends('layouts.admin')

@section('content')

    <div class="page-title">
        <div class="title_left">
            <h3>Users <small>Some examples to get you started</small></h3>
        </div>

        <div class="title_right">
            <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search for...">
                    <span class="input-group-btn">
                  <button class="btn btn-default" type="button">Go!</button>
                </span>
                </div>
            </div>
        </div>
    </div>

    <div class="clearfix"></div>

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Company List <small>Users</small></h2>
                    <a class="btn btn-success pull-right" href="{{ route('campaigns.create') }}">
                        <i class="fa fa-plus"></i> Create new Company
                    </a>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">

                    <table id="datatable" class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>Name</th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach ($companies as $company)
                        <tr>
                            <td>{{ $company['name'] }}</td>
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

@stop