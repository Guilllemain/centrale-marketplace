<section class="tabs mt-16">
    <input type="radio" name="tab-control" id="tab1" checked>
    <input type="radio" name="tab-control" id="tab2">
    <input type="radio" name="tab-control" id="tab3">
    
    <div class="bg-grey-lighter p-4">
        <ul class="container">
            <li title="Description">
                <label for="tab1" role="button">Description</label>
            </li>
            <li title="Caractéristiques">
                <label for="tab2" role="button">Caractéristiques</label>
            </li>
            <li title="Avis">
                <label for="tab3" role="button">Avis</label>
            </li>
        </ul>
    </div>
    <div class="container">
        <div class="slider"><div class="indicator"></div></div>
    </div>

    <div class="content container text-sm font-light">
        <section>
            <h2>Description</h2>
            {!! $product->description !!}
        </section>
        <section>
            <h2>Caractéristiques</h2>
            <table>
                <tbody>
                    @foreach($product->attributes as $attribute)
                        @if($attribute['id'] !== 3 && $attribute['id'] !== 4 && $attribute['id'] !== 5 && $attribute['id'] !== 13)
                            <tr class="h-bar">
                                <th class="pr-6">{{ $attribute['name'] }}</th>
                                @if(!$attribute['children'])
                                    <td class="py-2">
                                        @if(is_array($attribute['value']))
                                            {{ implode(', ', $attribute['value'])}}
                                        @else
                                            {{ $attribute['value'] }}
                                        @endif
                                    </td>
                                @else
                                    <td>
                                        <table>
                                            <tbody>
                                                @foreach($attribute['children'] as $children)
                                                    <tr class="py-2">
                                                        <td class="pr-2 font-normal">{{ $children['name'] }}</td>
                                                        <td>
                                                            @if(is_array($children['value']))
                                                                {{ implode(', ', $children['value'])}}
                                                            @else
                                                                {{ $children['value'] }}
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </td>
                                @endif
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </section>
        <section>
            <h2>Avis</h2>
            <h4 class="mb-4">Commentaires des clients</h4>
            @if(!session('authenticated'))
                <p>Vous devez <a href="/login">être connecté</a> pour ajouter un commentaire sur ce produit.</p>
            @else
                <review-component></review-component>
            @endif
        </section>
    </div>


    
</section>