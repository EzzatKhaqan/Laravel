@extends('backend.layouts.master')
@section("content")
    <!--**********************************
        Content body start
    ***********************************-->

    <div class="row page-titles mx-0">
        <div class="col p-md-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
            </ol>
        </div>
    </div>
    <!-- row -->

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-4 col-xl-3">
                <div class="card">
                    <div class="card-body">
                        <div class="media align-items-center mb-4">
                            <img class="mr-3" src="{{asset('dist/images/avatar/11.png')}}" width="80" height="80"
                                 alt="">
                            <div class="media-body">
                                <h3 class="mb-0">EzZat Khaqan</h3>
                                <p class="text-muted mb-0">Afghanistan</p>
                            </div>
                        </div>

                        <div class="row mb-5">
                            <div class="col">
                                <div class="card card-profile text-center">
                                    <span class="mb-1 text-primary"><i class="icon-people"></i></span>
                                    <h3 class="mb-0">263</h3>
                                    <p class="text-muted px-4">Following</p>
                                </div>
                            </div>
                            <div class="col">
                                <div class="card card-profile text-center">
                                    <span class="mb-1 text-warning"><i class="icon-user-follow"></i></span>
                                    <h3 class="mb-0">263</h3>
                                    <p class="text-muted">Followers</p>
                                </div>
                            </div>
                            <div class="col-12 text-center">
                                <button class="btn btn-danger px-5">Follow Now</button>
                            </div>
                        </div>

                        <h4>About Me</h4>
                        <p class="text-muted">Hi, I'm Ezzat, Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                            Cumque deleniti dicta distinctio eveniet laborum maxime qui, sed ut voluptates. Accusantium
                            amet fugit illo, inventore iusto optio quae sequi totam veritatis!.</p>
                        <ul class="card-profile__info">
                            <li class="mb-1"><strong class="text-dark mr-4">Mobile</strong> <span>0790683536</span>
                            </li>
                            <li><strong class="text-dark mr-4">Email</strong> <span>khaqanezzat007@gmail.com</span></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-8 col-xl-9">
                <div class="card">
                    <div class="card-body">
                        <form action="#" class="form-profile">
                            <div class="form-group">
                                <textarea class="form-control" name="textarea" id="textarea" cols="30" rows="2"
                                          placeholder="Post a new message"></textarea>
                            </div>
                            <div class="d-flex align-items-center">
                                <ul class="mb-0 form-profile__icons">
                                    <li class="d-inline-block">
                                        <button class="btn btn-transparent p-0 mr-3"><i class="fa fa-user"></i></button>
                                    </li>
                                    <li class="d-inline-block">
                                        <button class="btn btn-transparent p-0 mr-3"><i class="fa fa-paper-plane"></i>
                                        </button>
                                    </li>
                                    <li class="d-inline-block">
                                        <button class="btn btn-transparent p-0 mr-3"><i class="fa fa-camera"></i>
                                        </button>
                                    </li>
                                    <li class="d-inline-block">
                                        <button class="btn btn-transparent p-0 mr-3"><i class="fa fa-smile"></i>
                                        </button>
                                    </li>
                                </ul>
                                <button class="btn btn-primary px-3 ml-4">Send</button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <div class="media media-reply">
                            <img class="mr-3 circle-rounded" src="{{asset('dist/images/avatar/2.jpg')}}" width="50"
                                 height="50"
                                 alt="Generic placeholder image">
                            <div class="media-body">
                                <div class="d-sm-flex justify-content-between mb-2">
                                    <h5 class="mb-sm-0">Milan Gbah <small class="text-muted ml-3">about 3 days
                                            ago</small></h5>
                                    <div class="media-reply__link">
                                        <button class="btn btn-transparent p-0 mr-3"><i class="fa fa-thumbs-up"></i>
                                        </button>
                                        <button class="btn btn-transparent p-0 mr-3"><i class="fa fa-thumbs-down"></i>
                                        </button>
                                        <button class="btn btn-transparent text-dark font-weight-bold p-0 ml-2">Reply
                                        </button>
                                    </div>
                                </div>

                                <p>Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante
                                    sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis.
                                    Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in
                                    faucibus.</p>
                                <ul>
                                    <li class="d-inline-block"><img class="rounded" width="60" height="60"
                                                                    src="{{asset('dist/images/avatar/1.png')}}" alt="">
                                    </li>
                                    <li class="d-inline-block"><img class="rounded" width="60" height="60"
                                                                    src="{{asset('dist/images/avatar/11.png')}}" alt="">
                                    </li>
                                    <li class="d-inline-block"><img class="rounded" width="60" height="60"
                                                                    src="{{asset('dist/images/avatar/1.png')}}" alt="">
                                    </li>
                                    <li class="d-inline-block"><img class="rounded" width="60" height="60"
                                                                    src="{{asset('dist/images/avatar/11.png')}}" alt="">
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--**********************************
        Content body end
    ***********************************-->
@endsection
@section('title')
    Profile
@endsection
