<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Basket extends Model
{
    // private $id;
    // private $coupons;
    // private $subtotal;
    // private $totalDiscount;
    // private $totalShipping;
    // private $totalTax;
    // private $total;
    // private $totalQuantity;
    // private $itemsPrice;
    // private $shippingPrice;
    // private $totalPrice;
    // private $comment;
    // private $isEligibleToPickupPointsShipping;
    // private $isPickupPointsShipping;
    // private $shippingAddress;
    // private $companyGroups;

    // protected $attributes = [
    //     'coupons' => [],
    //     'subtotal' => 0.0,
    //     'totalDiscount' => 0.0,
    //     'totalShipping' => 0.0,
    //     'totalTax' => 0.0,
    //     'total' => 0.0,
    //     'totalQuantity' => 0,
    //     'comment' => '',
    //     'companyGroups' => [],
    //     'totalItemsPrice' => [
    //         'priceWithoutVat' => 0.0,
    //         'priceWithTaxes' => 0.0,
    //         'vat' => 0.0,
    //     ],
    //     'totalShippingsPrice' => [
    //         'priceWithoutVat' => 0.0,
    //         'priceWithTaxes' => 0.0,
    //         'vat' => 0.0,
    //     ],
    //     'totalGlobalPrice' => [
    //         'priceWithoutVat' => 0.0,
    //         'priceWithTaxes' => 0.0,
    //         'vat' => 0.0,
    //     ],
    //     'isEligibleToPickupPointsShipping' => false,
    //     'isPickupPointsShipping' => false,
    // ];

    // public function __construct(array $attributes = [])
    // {
    //     parent::__construct($attributes);
    //     $this->id = $attributes->id;
    //     $this->coupons = $attributes->coupons;
    //     $this->subtotal = $attributes->subtotal;
    //     $this->totalDiscount = $attributes->totalDiscount;
    //     $this->totalShipping = $attributes->totalShipping;
    //     $this->totalTax = $attributes->totalTax;
    //     $this->total = $attributes->total;
    //     $this->totalQuantity = $attributes->totalQuantity;
    //     $this->itemsPrice = $attributes->totalItemsPrice;
    //     $this->shippingPrice = $attributes->totalShippingsPrice;
    //     $this->totalPrice = $attributes->totalGlobalPrice;
    //     $this->comment = $attributes->comment;
    //     $this->isEligibleToPickupPointsShipping = $attributes->isEligibleToPickupPointsShipping;
    //     $this->isPickupPointsShipping = $attributes->isPickupPointsShipping;
    //     $this->shippingAddress = $attributes->shippingAddress;
    //     $this->companyGroups = $attributes->companyGroups;
    // }

    // public function getId()
    // {
    //     return $this->id;
    // }

    protected $guarded = [];

    // public static function createEmpty($id)
    // {
    //     return new self([
    //         'id' => $id,
    //         'coupons' => [],
    //         'subtotal' => 0.0,
    //         'totalDiscount' => 0.0,
    //         'totalShipping' => 0.0,
    //         'totalTax' => 0.0,
    //         'total' => 0.0,
    //         'totalQuantity' => 0,
    //         'comment' => '',
    //         'companyGroups' => [],
    //         'totalItemsPrice' => [
    //             'priceWithoutVat' => 0.0,
    //             'priceWithTaxes' => 0.0,
    //             'vat' => 0.0,
    //         ],
    //         'totalShippingsPrice' => [
    //             'priceWithoutVat' => 0.0,
    //             'priceWithTaxes' => 0.0,
    //             'vat' => 0.0,
    //         ],
    //         'totalGlobalPrice' => [
    //             'priceWithoutVat' => 0.0,
    //             'priceWithTaxes' => 0.0,
    //             'vat' => 0.0,
    //         ],
    //         'isEligibleToPickupPointsShipping' => false,
    //         'isPickupPointsShipping' => false,
    //     ]);
    // }
}
