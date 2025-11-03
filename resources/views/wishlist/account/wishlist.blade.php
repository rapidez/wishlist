@extends('rapidez::account.partials.layout')

@section('title', __('Wishlist'))

@section('account-content')
    <div class="container mx-auto">
        <wishlist v-slot="{ wishlist, itemsCount, wishlistCallback }">
            <div v-if="itemsCount">
                <graphql-mutation
                    query="mutation ( $wishlistId: ID! $wishlistItemIds: [ID!]! ) { addWishlistItemsToCart ( wishlistId: $wishlistId wishlistItemIds: $wishlistItemIds ) { wishlist { id items_count } } }"
                    :variables="{ wishlistId: wishlist.id, wishlistItemIds: [] }"
                    :callback="(data, response) => {
                        wishlistCallback(data, response);
                        window.$emit('rapidez:refresh-cart');
                    }"
                    v-slot="{ mutate, mutated }"
                >
                    <form v-on:submit.prevent="mutate">
                        <x-rapidez::button type="submit">
                            @lang('Add all products to the cart')
                        </x-rapidez::button>
                    </form>
                </graphql-mutation>

                <x-rapidez::productlist value="wishlist.items_v2.items.map((item) => item.product.sku)"/>
            </div>
            <div v-else>
                @lang('You have no items in your wish list.')
            </div>
        </wishlist>
    </div>
@endsection
