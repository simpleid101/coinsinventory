<html>
    <head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href ="/css/app.css" rel="stylesheet" />
    <script  src="/js/app.js"> </script>
    <link href="//cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js" />
    <script src="//cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js" ></script>
    
        <title>Coins Inventory</title>
    </head>

    <body>
        <div class="container">
            
        <div class="row">
            <div class="col-sm-12">
                <header>
                	@section('header')
                	@yield('header')
                </header>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <nav class="navbar navbar-default">
                	@section('navigation')
                	@yield('nav')
                </nav>
            </div>
        </div>

        

                	@section('main')
                	@yield('main')

        


        <div class="row">
            <div class="col-sm-12">
                <footer>
                    @section('footer')
                    @yield('footer')
                </footer>
            </div>
        </div>
    </body>

</html>