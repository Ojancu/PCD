<!DOCTYPE html>
<html lang="en">
<head>
    @include('layouts.components.head')
</head>
<body>
    <div class="body-wrapper">
    <!-- Navigation -->
        <div class="container-fluid">
            @include('layouts.components.nav')
            <!-- Content -->
            <div class="main-content">
                @yield('main-content')
            </div>
        </div>
    </div>
    @include('layouts.components.script')
</body>
</html>