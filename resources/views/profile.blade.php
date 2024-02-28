@extends('layouts.app')
@section('content')
<!-- Main Content-->
<div class="main-container container-fluid">
    <div class="inner-body">

        <!-- Page Header -->
        <div class="page-header">
            <div>
                <h2 class="main-content-title tx-24 mg-b-5">Profile</h2>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Pages</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Profile</li>
                </ol>
            </div>
        </div>
        <!-- End Page Header -->

        <div class="row square">
            <div class="col-lg-12 col-md-12">
                <div class="card custom-card">
                    <div class="card-body">
                        <div class="panel profile-cover">
                            <div class="profile-cover__img">
                                @if (auth()->user()->image == null)
                                    <img alt="avatar" src="{{asset('assets/img/users/no-image.png')}}">
                                @else
                                    <img alt="avatar" src="profile/{{ $user->image }}">
                                @endif
                                <h3 class="h3">{{$user->name}}</h3>
                            </div>
                            <div class="profile-cover__action bg-img"></div>
                            <div class="profile-cover__info">
                                <ul class="nav">
                                    <li><strong>26</strong>Projects</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Row -->
        <div class="row row-sm">
            <div class="col-lg-12 col-md-12">
                <div class="card custom-card main-content-body-profile">
                    <div class="tab-content">
                        <div class="main-content-body tab-pane p-4 border-top-0 active" id="settings">
                            <div class="card-body border" data-select2-id="12">
                                <form class="form-horizontal" data-select2-id="11" action="{{ route('profile-update') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="mb-4 main-content-label">Account</div>
                                    <div class="form-group ">
                                        <div class="row row-sm">
                                            <div class="col-md-3">
                                                <label class="form-label">User Name</label>
                                            </div>
                                            <div class="col-md-9">
                                                <input class="form-control" name="name" value="{{$user->name}}" placeholder="Enter your name" autocomplete="name">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group mt-3">
                                        <div class="row row-sm">
                                            <div class="col-md-3">
                                                <label class="form-label">Email</label>
                                            </div>
                                            <div class="col-md-9">
                                                <input class="form-control" name="email" value="{{ $user->email }}" autocomplete="email" placeholder="Enter your email" type="email">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group mt-3">
                                        <div class="row row-sm">
                                            <div class="col-md-3">
                                                <label class="form-label">Old Password</label>
                                            </div>
                                            <div class="col-md-9">
                                                <input class="form-control" name="old_password" autocomplete="new-password" type="password">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group mt-3">
                                        <div class="row row-sm">
                                            <div class="col-md-3">
                                                <label class="form-label">Current Password</label>
                                            </div>
                                            <div class="col-md-9">
                                                <input class="form-control" name="current_password" type="password" autocomplete="new-password">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group mt-3">
                                        <div class="row row-sm">
                                            <div class="col-md-3">
                                                <label class="form-label">Profile Image</label>
                                            </div>
                                            <div class="col-md-4">
                                                <input type="file" name="image" class="dropify" data-height="200" />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="text-end mt-3"><button type="submit" class="btn ripple btn-primary pd-x-30 ">Update</button></div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Row -->
    </div>
</div>
<!-- End Main Content-->
@endsection

