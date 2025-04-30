<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Git Shop</title>
    <meta name="description"
        content="240+ Best Bootstrap Templates are available on this website. Find your template for your project compatible with the most popular HTML library in the world." />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <link rel="canonical" href="Replace_with_your_PAGE_URL" />

    <!-- Open Graph (OG) meta tags are snippets of code that control how URLs are displayed when shared on social media  -->
    <meta property="og:locale" content="en_US" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="Bucker -  Bakery Shop Bootstrap 5 Template" />
    <meta property="og:url" content="PAGE_URL" />
    <meta property="og:site_name" content="Bucker -  Bakery Shop Bootstrap 5 Template" />
    <!-- For the og:image content, replace the # with a link of an image -->
    <meta property="og:image" content="#" />
    <meta property="og:description" content="Bucker -  Bakery Shop Bootstrap 5 Template" />

    <!-- Add site Favicon -->
    <link rel="icon" href="{{asset('assets/img/favicon2.png')}}" sizes="32x32" />
    <link rel="icon" href="{{asset('assets/img/favicon2.png')}}"
        sizes="192x192" />
    <link rel="apple-touch-icon" href="{{asset('assets/img/favicon2.png')}}" />
    <meta name="msapplication-TileImage"
        content="https://hasthemes.com/wp-content/uploads/2019/04/cropped-favicon-270x270.png" />

    @include('landing-page.landing.link')
</head>

<body>
    @include('landing-page.landing.header')
    @yield('content')
    @include('landing-page.landing.footer')
    @include('landing-page.landing.script')
</body>

</html>
