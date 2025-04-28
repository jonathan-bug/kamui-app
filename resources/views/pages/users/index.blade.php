@extends("layout")

@push("styles")
<style>
    body {
        height: 100vh;
    }

    .container, .row {
        height: inherit;
    }
</style>
@endpush

@section("content")
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-sm-10 col-md-6 col-lg-4 d-flex align-items-center">
                <form class="card flex-grow-1" method="POST" action="{{route('users.login')}}">
                    @csrf
                    <div class="card-header">
                        <div class="fw-bold fs-2 text-center">
                            <i class="fa fa-yin-yang"></i>
                            KAMUI
                        </div>
                    </div>
                    <div class="card-body p-4">
                        <div class="form-group">
                            <label class="form-label" for="">Email</label>
                            <input class="form-control" name="email" type="text" value=""/>
                        </div>
                        <div class="form-group mt-4">
                            <label class="form-label" for="">Password</label>
                            <input class="form-control" name="password" type="password" value=""/>
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-end p-4">
                        <button class="btn btn-primary">Login</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
