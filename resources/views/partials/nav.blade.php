<nav class="megamenu relative bg-grey px-6">
    <div class="flex uppercase justify-around tracking-wide">
        @foreach($categories as $category)
            <div class="megamenu__category py-4 px-3">
                <a href="/{{ $category->getCategory()->slug }}" class="megamenu__category-link">{{ $category->getCategory()->name }}</a>
                @if($category->getChildren())
                    <div class="megamenu__category-children font-bold mt-4 shadow-md justify-center">
                        @foreach($category->getChildren() as $subcategory)
                            <div class="@if($subcategory->getChildren()) mb-3 @endif mx-12">
                                <a href="/{{ $subcategory->getCategory()->slug }}">{{ $subcategory->getCategory()->name }}</a>
                                @if($subcategory->getChildren())
                                    <div class="my-2 border-b border-grey-light w-5/6"></div>
                                    <div class="megamenu__category-children-children">
                                        @foreach($subcategory->getChildren() as $subcategory)
                                            <div class="font-normal">
                                                <a href="/{{ $subcategory->getCategory()->slug }}">{{ $subcategory->getCategory()->name }}</a>
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