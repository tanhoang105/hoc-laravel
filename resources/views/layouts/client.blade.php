<!DOCTYPE html>
<html lang="en">
<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <meta http-equiv="X-UA-Compatible" content="ie=edge">
     <title>@yield('title')</title>
     <link rel="stylesheet" href="{{asset('assets/clients/css/bootstrap.min.css')}}">
     <link rel="stylesheet" href="{{asset('assets/clients/css/style.css')}}">
     @yield('css')
</head>
<body>
     {{-- masternlayout --}}
     @include('clients.block.header')
     <main>
          <div class="container py-5">
               <div class="row">
                    <div class="col-4">
                         <aside>
                              @section('sidebar')
                                   @include('clients.block.sidebar')
                              @show
                         </aside>
                    </div>
                    <div class="col-8">                       
                         <div class="content">
                              @yield('content')
                         </div>
                    </div>
               </div>
          </div>
         
     </main>
    @include('clients.block.footer')
    @yield('js')

    <script src="{{asset('assets/clients/css/bootstrap.min.js')}}"></script>
    <script src="{{asset('assets/clients/css/style.js')}}"></script>
    <script type="text/javascript" src="https://code.jquery.com.jquery"></script>
</body>
</html>