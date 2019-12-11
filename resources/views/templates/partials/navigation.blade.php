<nav class="navbar navbar-light bg-light navbar-expand-md" role="navigation">
    <div class="container"><a class="navbar-brand" href="#">Chatty</a>
        <div class="collapse navbar-collapse">
            @if (Auth::check())
                <ul class="nav navbar-nav">
                    <li class="nav-item"><a href="#" class="nav-link">Timeline</a>
                    </li>
                    <li class="nav-item"><a href="#" class="nav-link">Friends</a>
                    </li>
                </ul>
                <form class="form-inline " role="search" action="#">
                    <div class="form-group">
                        <input type="text" name="query" class="form-control" placeholder="Find people">
                    </div>
                    <button type="submit" class="btn btn-secondary">Search</button>
                </form>
            @endif
            <ul class="nav navbar-nav ml-auto">
                @if (Auth::check())
                    <li class="nav-item"><a href="#"
                                            class="nav-link">Dayle {{-- Auth::user()-&gt;getNameOrUsername() }} --}}</a>
                    </li>
                    <li class="nav-item"><a href="#" class="nav-link">Update profile</a>
                    </li>
                    <li class="nav-item"><a href="#" class="nav-link">Sign out</a>
                    </li>
                @else
                    <li class="nav-item"><a href="#" class="nav-link">Sign up</a>
                    </li>
                    <li class="nav-item"><a href="#" class="nav-link">Sign in</a>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>
