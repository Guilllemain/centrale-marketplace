
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Invoice - #123</title>

    <style type="text/css">
        @page {
            margin: 0px;
        }
        body {
            margin: 0px;
        }
        * {
            font-family: Verdana, Arial, sans-serif;
        }
        a {
            color: #fff;
            text-decoration: none;
        }
        table {
            font-size: x-small;
        }
        tfoot tr td {
            font-weight: bold;
            font-size: x-small;
        }
        .invoice table {
            margin: 15px;
        }
        .invoice h3 {
            margin-left: 15px;
        }
        .information {
            background-color: #60A7A6;
            color: #FFF;
        }
        .information .logo {
            margin: 5px;
        }
        .information table {
            padding: 10px;
        }
    </style>

</head>
<body>
    <div class="information">
        <table width="100%">
            <tr>
                <td align="left" style="width: 40%;">
                    <h3>John Doe</h3>
                    <pre>
                    Street 15
                    123456 City
                    United Kingdom
                    <br /><br />
                    Date: 2018-01-01
                    Identifier: #uniquehash
                    Status: Paid
                    </pre>
                </td>
                <td align="center">
                    {{-- <img src="/path/to/logo.png" alt="Logo" width="64" class="logo"/> --}}
                </td>
                <td align="right" style="width: 40%;">
                    <h3>CompanyName</h3>
                    <pre>
                        https://company.com

                        Street 26
                        123456 City
                        United Kingdom
                    </pre>
                </td>
            </tr>
        </table>
    </div>
    <br/>
    <div class="invoice">
        <h3>Invoice specification #123</h3>
        @foreach ($basket->getCompanies() as $company)
            <h4>Vendu par {{ $company['company']['name'] }}</h4>
            <table width="100%">
                <thead>
                <tr>
                    <th>Nom</th>
                    <th>Description</th>
                    <th>Quantité</th>
                    <th>Total</th>
                </tr>
                </thead>
                <tbody>
                @foreach($company['shippingGroups'] as $shippingGroup)
                        @foreach($shippingGroup['items'] as $item)
                            <tr>
                                <td>{{ $item['productName']}}</td>
                                <td>Add description</td>
                                <td>{{$item['quantity']}}</td>
                                <td align="left">{{formatPrice($item['total'])}}</td>
                            </tr>
                        @endforeach
                    @endforeach
                </tbody>

                <tfoot>
                <tr>
                    <td colspan="1"></td>
                    <td align="left">Total pour ce marchand</td>
                    <td align="left" class="gray">{{ formatPrice($company['productTotalWithTaxes']) }}</td>
                </tr>
                </tfoot>
            </table>
        @endforeach
    </div>

    <div class="information" style="position: absolute; bottom: 0;">
        <table width="100%">
            <tr>
                <td align="left" style="width: 50%;">
                    &copy; {{ date('Y') }} {{ config('app.url') }} - All rights reserved.
                </td>
                <td align="right" style="width: 50%;">
                    Company Slogan
                </td>
            </tr>
        </table>
    </div>
  </body>
</html>