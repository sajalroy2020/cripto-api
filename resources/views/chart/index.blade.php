@extends('layouts.app')
@section('content')

<div class="main-container container-fluid">
    <div class="inner-body">

        <!-- Page Header -->
        <div class="page-header">
            <div>
                <h2 class="main-content-title tx-24 mg-b-5">Chart Data List</h2>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Chart</li>
                </ol>
            </div>

            <div class="d-flex">
                <div class="justify-content-center">
                    <a class="btn ripple btn-primary" data-bs-target="#modaldemo1" data-bs-toggle="modal" href="">Add data</a>
                </div>
            </div>
        </div>
        <!-- End Page Header -->

        <!-- row -->
        <div class="row row-sm">
            <div class="col-md-12 col-lg-12 col-xl-12">
                <div class="card custom-card transcation-crypto">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table" id="example1">
                                <thead>
                                    <tr class="border-bottom">
                                        <th>ID</th>
                                        <th>Time</th>
                                        <th>Open</th>
                                        <th>High</th>
                                        <th>Low</th>
                                        <th>Close</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($chartData as $key => $chart)
                                        <tr class="border-bottom">
                                            <th scope="row">{{$key+1}}</th>
                                            <td>{{$chart->time}}</td>
                                            <td>{{$chart->open}}</td>
                                            <td>{{$chart->high}}</td>
                                            <td>{{$chart->low}}</td>
                                            <td>{{$chart->close}}</td>
                                            <td>
                                                <div class="button-list">
                                                    <a href="#" data-bs-target="#editModel" data-bs-toggle="modal"
                                                        data-time="{{$chart->time}}"
                                                        data-open="{{$chart->open}}"
                                                        data-high="{{$chart->high}}"
                                                        data-low="{{$chart->low}}"
                                                        data-close="{{$chart->close}}"
                                                        data-id="{{$chart->id}}"
                                                     class="btn editDataBtn"><i class="ti ti-pencil"></i></a>
                                                    <a href="{{ route('chart.delete', $chart->id) }}" class="btn deleteItem"><i class="ti ti-trash"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- Row End -->
            </div>
        </div>
        <!-- Row End -->
    </div>
</div>

<!-- Basic modal -->
<div class="modal fade" id="modaldemo1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-content-demo rounded">

            <form id="chartForm">
                <div class="modal-header">
                    <h6 class="modal-title">Add Chart data</h6><button aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"></button>
                </div>

                <div class="modal-body">
                    <div class="form-group text-start">
                        <label>Time</label>
                        <input class="form-control" name="time" autocomplete="time" type="date">
                    </div>
                    <div class="form-group text-start">
                        <label>Open</label>
                        <input class="form-control" step="0.01" name="open" autocomplete="open" placeholder="000.00" type="number">
                    </div>
                    <div class="form-group text-start">
                        <label>High</label>
                        <input class="form-control" step="0.01" name="high" autocomplete="high" placeholder="000.00" type="number">
                    </div>
                    <div class="form-group text-start">
                        <label>Low</label>
                        <input class="form-control" step="0.01" name="low" autocomplete="low" placeholder="000.00" type="number">
                    </div>
                    <div class="form-group text-start">
                        <label>Close</label>
                        <input class="form-control" step="0.01" name="close" autocomplete="close" placeholder="000.00" type="number">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" id="submitForm" class="btn btn-primary">Submit</button>
                    <button class="btn ripple btn-secondary" type="button" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End Basic modal -->


{{-- edit model start --}}
<div class="modal fade" id="editModel" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-content-demo rounded">
            @include('chart.edit')
        </div>
    </div>
</div>
{{-- edit model end --}}



<input type="hidden" id="chart-store-route" value="{{route('chart.store')}}">

@endsection
