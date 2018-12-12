<nav class="megamenu relative bg-grey px-6">
    <div class="flex uppercase justify-around tracking-wide">
        @foreach($categories as $category)
            <div class="megamenu__category py-4 px-3">
                <a href="/search?category={{ $category->category->id }}" class="megamenu__category-link">{{ $category->category->name }}</a>
                @if($category->children)
                    <div class="megamenu__category-children font-bold mt-4 shadow-md">
                        @foreach($category->children as $subcategory)
                            <div class="@if($subcategory->children) mb-3 @endif">
                                <a href="/search?category={{ $subcategory->category->id }}">{{ $subcategory->category->name }}</a>
                                @if($subcategory->children)
                                    <div>
                                        @foreach($subcategory->children as $subcategory)
                                            <div class="ml-3 font-normal">
                                                <a href="search?category={{ $subcategory->category->id }}">{{ $subcategory->category->name }}</a>
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