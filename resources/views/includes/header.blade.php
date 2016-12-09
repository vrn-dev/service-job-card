<header>
    <nav class="navbar navbar-inverse">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="{{ route('dashboard') }}">SJC</a>
            </div>

            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li><a href="#">Job Cards <i class="fa fa-file-text" aria-hidden="true"></i></a></li>
                    <li><a href="{{ route('companyView') }}">Company Directory <i class="fa fa-address-book-o" aria-hidden="true"></i></a></li>
                    <li><a href="{{ route('inventory.index') }}">Inventory <i class="fa fa-address-book-o" aria-hidden="true"></i></a></li>
                    <li><a href="{{ route('ticket.index') }}">Generate Ticket <i class="fa fa-ticket" aria-hidden="true"></i></a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="#">Welcome, {{ Auth::user()->name }}</a></li>
                    <li><a href="#">Account <span class="glyphicon glyphicon-user" aria-hidden="true"></span></a></li>
                    <li><a href="{{ route('logout') }}">Logout <span class="glyphicon glyphicon-log-out" aria-hidden="true"></span></a></li>
                </ul>
            </div><!-- /.navbar-collapse -->

        </div><!-- /.container-fluid -->
    </nav>
</header>