<nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">

        <button type="button" id="sidebarCollapse" class="btn btn-primary">
            <i class="fa fa-bars"></i>
            <span class="sr-only">Toggle Menu</span>
        </button>
        <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fa fa-bars"></i>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="nav navbar-nav ml-auto btn-group">
            <li class="nav-item active">
                <a class="nav-link" href="/home"><button class="btn btn-outline-primary"><i class="fas fa-home"></i></button></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('getLogout') }}"><button class="btn btn-outline-danger"><i class="fas fa-sign-out-alt"></i></button></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#"><button class="btn btn-outline-success"><i class="fas fa-comments"></i></button></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#"><button class="btn btn-outline-secondary"><i class="fas fa-ellipsis-v"></i></button></a>
            </li>
            </ul>
        </div>
        </div>
</nav>