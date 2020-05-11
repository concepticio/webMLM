@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="my-5">
                <div class="card">
                    <div class="card-header">
                        <h3>Jackpot Wallet</h3>
                    </div>
                    <div class="card-body">
                        <div class="child-member">
                            <div class="card-body">{{$bonus->balance}}</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="my-5">
                <div class="card">
                    <div class="card-header">
                        <h3>Summaries</h3>
                    </div>
                    <br>
                    @foreach($summaries as $s)
                    <div class="card-body">
                        {{$s->text}}
                        @if($s->status == "increment")
                        <label style="color: #2a9055; font-weight: bold; font-size: 1.3em;">++</label>
                        @else
                        <label style="color: red; font-weight: bold; font-size: 1.3em;">--</label>
                        @endif
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="my-5">
                <div class="card">
                    <div class="card-header">
                        <h3>Withdraw</h3>
                    </div>
                    <form action="/wallet/withdraw/3" method="post">
                        {{csrf_field()}}
                        <div class="card-body">
                            <div class="child-member">
                                <input type="number" min="2" id="wallet" name="wallet" max="{{$bonus->balance}}" value="0">
                            </div>
                            <div class="child-member">
                                <div>20% from your withdrawal will be donated to the community</div>
                                <div>
                                    <div>
                                        What will you divide your withdrawal into?
                                    </div>
                                    <div id="max_get">Max: 0</div>
                                    <div>
                                        <div>BCA: <input type="number" name="bank" value="0"></div>
                                        <div>Registration Point: <input type="number" name="registration" value="0"></div>
                                        <div>Activation Point: <input type="number" name="activation" value="0"></div>
                                        <div>MCD Point: <input type="number" name="mcd" value="0"></div>
                                    </div>
                                </div>
                            </div>
                            <input type="submit" value="Withdraw">
                        </div>
                    </form>
                    @foreach($errors->all() as $e)
                    <div>{{$e}}</div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{asset('js/jquery-3.3.1.min.js')}}"></script>
<script>
    $(document).ready(function () {
        $('#wallet').change(function () {
            $.ajax({
                url: "{{url('package')}}",
                method: 'GET',
                success: function (data) {
                    var max = 0
                    if ($('#wallet').val() != '') {
                        var max = Math.floor(parseFloat($('#wallet').val())*0.8);
                    } else {
                        $('#wallet').val(0)
                    }
                    $('#max_get').html('Max: ' + max)
                }
            });
        });
    });
</script>
@endsection
