<x-public-layout>

<!-- Place Your Components Here using following format -->
<!-- include('path-to-component') -->

<!-- make components using terminal command: php artisan make:component -->
<!-- move generated component .blade.php file to pages>homepage>components -->

<!-- css is to be added into css>app.css -->

@include('pages.homepage.components.company-search')
@include('pages.homepage.components.internship-procedures')
@include('pages.homepage.components.display-companies')
@include('pages.homepage.components.intern-metrics')

@include('pages.homepage.components.contact-us')

</x-public-layout>
