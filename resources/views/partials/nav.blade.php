<nav class="megamenu relative px-6 bg-orange-dark">
    <div class="flex uppercase justify-around tracking-wide">
        @foreach($categories as $category)
            @if($category->getCategory()->productCount)
                <div class="megamenu__category py-4 px-3">
                    <div class="megamenu__category-active relative">
                        <a href="{{ route('category.show', ['category' => $category->getCategory()->slug]) }}"
                            class="megamenu__category-link">
                            {{ $category->getCategory()->name }}
                        </a>
                        <div class="b-rounded-bar"></div>
                    </div>
                    @if($category->getChildren())
                        <div class="megamenu__category-children font-bold mt-4 shadow-md justify-center">
                            @foreach($category->getChildren() as $subcategory)
                                <div class="@if($subcategory->getChildren()) mb-3 @endif mx-12">
                                    <a href="{{ route('category.show',[
                                        'category' => $subcategory->getCategory()->categoryPath[0]['slug'],
                                        'subcategory' => $subcategory->getCategory()->slug
                                    ])}}">{{ $subcategory->getCategory()->name }}</a>
                                    @if($subcategory->getChildren())
                                        <div class="my-2 border-b border-grey-light w-5/6"></div>
                                        <div class="megamenu__category-children-children">
                                            @foreach($subcategory->getChildren() as $subcategory)
                                                <div class="font-normal">
                                                    <a href="{{ route('category.show',[
                                                        'category' => $subcategory->getCategory()->categoryPath[0]['slug'],
                                                        'subCategory' => $subcategory->getCategory()->categoryPath[1]['slug'],
                                                        'finalCategory' => $subcategory->getCategory()->slug
                                                    ])}}">
                                                        {{ $subcategory->getCategory()->name }}
                                                    </a>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            @endif
        @endforeach
    </div>
</nav>

@push('scripts')
    <script>
        const path = window.location.href;
        const links = document.querySelectorAll('.megamenu__category-link');
        links.forEach(link => {
            if (window.location.href.startsWith(link.href)) {
                link.classList.add('megamenu__category-link--active');
            }
        })
    </script>
@endpush