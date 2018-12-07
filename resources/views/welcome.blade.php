<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">
    </head>
    <body>
        <nav class="megamenu relative bg-grey px-6">
            <div class="flex uppercase justify-around tracking-wide">
                @foreach($categories as $category)
                    <div class="megamenu__category p-6">
                        <a href="?category={{ $category->category->id }}" class="megamenu__category-link">{{ $category->category->name }}</a>
                        @if($category->children)
                            <div class="megamenu__category-children text-xs font-bold mt-6">
                                @foreach($category->children as $subcategory)
                                    <div class="@if($subcategory->children) mb-3 @endif">
                                        <a href="?category={{ $category->category->id }}">{{ $subcategory->category->name }}</a>
                                        @if($subcategory->children)
                                            <div>
                                                @foreach($subcategory->children as $subcategory)
                                                    <div class="ml-3 font-normal">
                                                        <a href="?category={{ $category->category->id }}">{{ $subcategory->category->name }}</a>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
        </nav>
    </body>
</html>
