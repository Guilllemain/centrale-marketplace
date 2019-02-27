<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Hi</title>
</head>
<body>
    <div>
        <h2 class="font-light uppercase">Mon panier</h2>
        @foreach ($basket->getCompanies() as $company)
            <div class="my-4 p-4 bg-white border border-grey-light">
                <h4>Vendu par {{ $company['company']['name'] }}</h4>
                @foreach($company['shippingGroups'] as $shippingGroup)
                    <div class="my-4">
                        @foreach($shippingGroup['items'] as $item)
                            <div class="flex items-center mb-4">
                                <div class="flex items-center flex-1">
                                    <div class="flex flex-col">
                                        <h3 class="ml-2">{{ $item['productName']}}</h3>
                                    </div>
                                </div>
                                <div class="flex items-center w-1/5">
                                    <span>Quantité : {{$item['quantity']}}</span>
                                </div>
                                <div class="w-1/5 text-right font-bold">
                                    <p>Total : {{formatPrice($item['total'])}} €</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="flex items-center justify-between">
                        <div class="font-bold">
                            <p>Total pour ce marchand : {{ formatPrice($company['productTotalWithTaxes']) }} €</p>
                        </div>
                    </div>
                @endforeach
            </div>
        @endforeach
    </div>
</body>
</html>