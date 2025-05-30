@extends("errors.errors_layout")
@section('content')

    <div class="login-form-bg h-100">
        <div class="container h-100">
            <div class="row justify-content-center h-100">
                <div class="col-xl-6">
                    <div class="error-content">
                        <div class="card mb-0">
                            <div class="card-body text-center">
                                <h1 class="error-text text-primary">500</h1>
                                <h4 class="mt-4"><i class="fa fa-thumbs-down text-danger"></i> Bad Request</h4>
                                <p>Your Request resulted in an error.</p>
                                <form class="mt-5 mb-5">

                                    <div class="text-center mb-4 mt-4"><a href="index.html" class="btn btn-primary">Go
                                            to Homepage</a>
                                    </div>
                                </form>
                                <div class="text-center">
                                    <p>Copyright © Designed by <a href="#">...</a>,
                                        Developed by <a href="#">...</a> 2024</p>

                                    <ul class="list-inline">
                                        <li class="list-inline-item"><a href="javascript:void()"
                                                                        class="btn btn-facebook"><i
                                                    class="fa fa-facebook"></i></a>
                                        </li>
                                        <li class="list-inline-item"><a href="javascript:void()"
                                                                        class="btn btn-twitter"><i
                                                    class="fa fa-twitter"></i></a>
                                        </li>
                                        <li class="list-inline-item"><a href="javascript:void()"
                                                                        class="btn btn-linkedin"><i
                                                    class="fa fa-linkedin"></i></a>
                                        </li>
                                        <li class="list-inline-item"><a href="javascript:void()"
                                                                        class="btn btn-google-plus"><i
                                                    class="fa fa-google-plus"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('title')
    500
@endsection
