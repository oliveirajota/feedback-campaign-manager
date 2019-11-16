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
                    <h2>Answering questions for {{ $collaborator['name'] }}</h2>
                    <div class="clearfix"></div>
                </div>

                <div class="x_content">
                    @if ($questions)
                        <form data-parsley-validate class="form-horizontal form-label-left" action="/user/campaign/{{ $campaign['id'] }}/collaborator/{{ $subjectId }}/answer" method="post">
                            {{ Form::token() }}
                            {{ Form::hidden('campaign_id', $campaign['id']) }}
                        @foreach ($questions as $key => $question)
                            <div class="form-group">

                                <h3>{{ $question['question'] }}</h3>
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    {{ Form::hidden('id[]', $question['id']) }}
                                    {{ Form::text('result['. $question['id']. ']', $question['result'], ['class' => 'form-control col-md-12 col-xs-12', 'id' => 'slider_' . $key]) }}
                                    {{ Form::textarea('comment['. $question['id']. ']', $question['comment'], ['class' => 'form-control col-md-12 col-xs-12', 'rows' => 3, 'placeholder' => 'Comentários' ]) }}

                                </div>
                                <div class="clearfix"></div>
                                <div class="ln_solid"></div>
                            </div>

                        @endforeach

                            <div class="form-group">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <a href="/user/campaign/{{ $campaign['id'] }}" class="btn btn-primary">Back </a>
                                    <button type="submit" class="btn btn-success pull-right">Save Answers</button>
                                </div>
                            </div>
                        </form>
                    @endif

                </div>

            </div>
        </div>
    </div>
    </div>


@stop

@section('js')
    <script>
        $(document).ready(function () {
            let values = [0,1,2,3,4,5,6];
            let values_text = ['Inaceitável', 'Péssimo', 'Ruim', 'Regular', 'Bom', 'Ótimo', 'Excelente'];

            $.each({!! json_encode($questionResults)  !!}, function (key, val) {

                $('#slider_'+key).ionRangeSlider({
                    grid: true,
                    values: values,
                    from : val,
                    prettify: function (n) {
                        let ind = values.indexOf(n);
                        return values_text[ind];
                    }
                });
            });
        });
    </script>
@stop