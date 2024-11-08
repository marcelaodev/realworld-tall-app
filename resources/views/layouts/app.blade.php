<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {!! SEO::generate(true) !!}
    @livewireStyles
    <link href="//code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet" type="text/css">
    <link
        href="//fonts.googleapis.com/css?family=Titillium+Web:700|Source+Serif+Pro:400,700|Merriweather+Sans:400,700|Source+Sans+Pro:400,300,600,700,300italic,400italic,600italic,700italic"
        rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="//localhost/app.css">
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-HK4XWWXRK0"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag() { dataLayer.push(arguments); }
        gtag('js', new Date());

        gtag('config', 'G-HK4XWWXRK0');
    </script>
</head>

<body>
    <nav class="navbar navbar-light">
        <div class="container">
            <a class="navbar-brand" wire:navigate href="{{ route('home') }}">conduit</a>
            <livewire:menu />
        </div>
    </nav>
    {{ $slot }}
    <footer>
        <div class="container">
            <a wire:navigate href="{{ route('home') }}" class="logo-font">conduit</a>
            <span class="attribution">
                An interactive learning project from <a href="https://thinkster.io">Thinkster</a>. Code &amp; design
                licensed under MIT. Implementation by <a href="https://github.com/sawirricardo" target="_blank"
                    rel="noopener noreferrer">Ricardo Sawir</a>
            </span>
        </div>
    </footer>
    @livewireScripts
    @stack('scripts')
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script> -->

</body>

</html>