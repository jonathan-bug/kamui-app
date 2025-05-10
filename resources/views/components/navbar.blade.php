<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand fw-bold" href="#">
          <i class="fa-regular fa-circle-check" style="color: #ff7a7a;"></i>
          <span>Todo</span>
          <span style="color: #ff7a7a;">Ing</span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                @foreach($options as $option)
                    <li class="nav-item">
                        @if($option["key"] == $active)
                            <a class="nav-link active" aria-current="page" href="{{$option['route']}}">
                                <i class="{{$option['icon']}}"></i>
                                {{$option["title"]}}
                            </a>
                        @else
                            <a class="nav-link" aria-current="page" href="{{$option['route']}}">
                                <i class="{{$option['icon']}}"></i>
                                {{$option["title"]}}
                            </a>
                        @endif
                        
                    </li>
                @endforeach
            </ul>
            
        </div>
        <span class="navbar-text">
            <a class="nav-link" href="{{route('users.logout')}}">
                <i class="fa fa-right-from-bracket"></i>
                Logout
            </a>
        </span>
    </div>
</nav>
