<?php
/**
 * Created by PhpStorm.
 * User: maxim
 * Date: 2/8/17
 * Time: 4:41 PM
 */

namespace App\Http\Controllers;

use App\Http\Requests\CartProductRequest;
use App\Http\Requests\CartRequest;
use App\Model\Cart;
use App\Model\Configuration;
use App\Model\Product;

/**
 * Class CartController
 * @package App\Http\Controllers
 * @resource Cart
 */
class CartController extends Controller
{
    /**
     * Get user cart
     * Authorization
     * @return Cart
     */
    public function get()
    {
        if (!\Auth::user()->cart) {
            $cart = new Cart();
            $cart->customer()->associate(\Auth::user()->id_customer);
        } else {
            $cart = \Auth::user()->cart;
        }
        $cart->save();
        return $cart;

    }

    /**
     * Create or update cart
     * @param CartRequest $request
     * @return Cart
     */
    public function update(CartRequest $request)
    {
        $cart = $this->get();
        /** @var Cart $cart */
        if (!$request->has('id_address_invoice') && !$cart->id_address_invoice) {
            $cart->address_delivery()->associate($request->get('id_address_delivery'));
        }

        if (!$request->has('id_address_invoice') && !$cart->id_address_invoice) {
            $cart->address_invoice()->associate($request->get('id_address_delivery'));
        }

        if (!$request->has('id_carrier') && !$cart->id_carrier) {
            $cart->carrier()->associate(Configuration::getValue('PS_CARRIER_DEFAULT'));
        }

        if (!$cart->secure_key) {
            $cart->secure_key = \Auth::user()->secure_key;
        }
        $cart->save();

        return $cart;
    }

    /**
     * Add product ot cart
     * @param CartProductRequest $request
     * @param Product $product
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function addProduct(CartProductRequest $request, Product $product)
    {
        $cart = $this->get();

        $cart_product = Cart\CartProduct::firstOrCreate([
            'id_cart' => (int)$cart->id_cart,
            'id_product' => (int)$product->id_product
        ]);
        $cart_product->update($request->all());
        $cart_product->save();
        return $cart;
    }

    /**
     * Remove product from cart
     * @param Product $product
     * @return mixed
     */
    public function removeProduct(Product $product)
    {
        $cart = $this->get();

        $cart_product = Cart\CartProduct::where([
            'id_cart' => (int)$cart->id_cart,
            'id_product' => (int)$product->id_product
        ]);
        $cart_product->delete();

        return $cart;
    }

    /**
     * Redirect to order
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function redirectUrlOrder()
    {
        return 'http://' . $_SERVER['HTTP_HOST'] . '/index.php?' .
        http_build_query([
            'controller' => 'auth',
            'back' => 'order-opc'
        ]);
    }


}