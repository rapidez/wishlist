@extends('rapidez::account.partials.layout')

@section('title', __('Wishlist'))

@section('account-content')
    <div class="container mx-auto">
        <graphql v-cloak query="{ customer { wishlists { id items_v2 { items { id product { sku } } } } } }">
            <div v-if="data" slot-scope="{ data, runQuery }" :set="wishlist = data.customer.wishlists[0]">
                <div v-if="data.customer.wishlists[0].items_v2.items.length">
                    <reactive-base v-cloak :app="config.es_prefix + '_products_' + config.store" :url="config.es_url">
                        <reactive-list
                            component-id="wishlist"
                            data-field="sku.keyword"
                            :size="999"
                            :default-query="function () { return { query: { terms: { 'sku.keyword': data.customer.wishlists[0].items_v2.items.map(item => item.product.sku) } } } }"
                        >
                            <div slot="renderResultStats"></div>
                            <div slot="renderNoResults"></div>

                            <div class="flex flex-wrap relative" slot="render" slot-scope="{ data, loading }" v-if="!loading">
                                <template v-for="item, index in data">
                                    <div class="relative flex w-1/2 sm:w-1/3 px-1 my-1" slot="renderItem">
                                        <graphql-mutation
                                            query="mutation ( $wishlistId: ID! $wishlistItemsIds: [ID!]! ) { removeProductsFromWishlist ( wishlistId: $wishlistId wishlistItemsIds: $wishlistItemsIds ) { wishlist { id items_count } } }"
                                            :variables="{
                                                wishlistId: wishlist.id,
                                                wishlistItemsIds: [wishlist.items_v2.items[index].id]
                                            }"
                                            :callback="runQuery"
                                        >
                                            <div slot-scope="{ mutate, mutated }">
                                                <form class="relative z-10" v-on:submit.prevent="mutate">
                                                    <button type="submit" class="absolute top-1 right-1">
                                                        <x-heroicon-s-x class="w-4 h-4" />
                                                    </button>
                                                </form>

                                                <div class="w-full bg-white rounded hover:shadow group relative" :key="item.id">
                                                    <a :href="item.url" class="relative block">
                                                        <picture v-if="item.thumbnail">
                                                            <source :srcset="'/storage/resizes/200/catalog/product' + item.thumbnail + '.webp'" type="image/webp">
                                                            <img :src="'/storage/resizes/200/catalog/product' + item.thumbnail" class="object-contain rounded-t h-48 w-full mb-3" :alt="item.name" loading="lazy" width="200" height="200" />
                                                        </picture>
                                                        <x-rapidez::no-image v-else class="rounded-t h-48 mb-3"/>
                                                        <div class="px-2">
                                                            <div class="hyphens">@{{ item.name }}</div>
                                                        </div>
                                                    </a>
                                                    @include('rapidez::wishlist.account.item.addtocart')
                                                </div>
                                            </div>
                                        </graphql-mutation>
                                    </div>
                                </template>
                            </div>
                        </reactive-list>
                    </reactive-base>
                    <graphql-mutation
                        query="mutation ( $wishlistId: ID! $wishlistItemIds: [ID!]! ) { addWishlistItemsToCart ( wishlistId: $wishlistId wishlistItemIds: $wishlistItemIds ) { wishlist { id items_count } } }"
                        :variables="{
                            wishlistId: wishlist.id,
                            wishlistItemIds: []
                        }"
                        :callback="() => {runQuery(); $root.$emit('refresh-cart');}"
                    >
                        <form class="relative z-10" slot-scope="{ mutate, mutated }" v-on:submit.prevent="mutate">
                            <button type="submit" class="absolute right-1">
                                @lang('Add All to Cart')
                            </button>
                        </form>
                    </graphql-mutation>
                </div>
                <div v-else>
                    @lang('You have no items in your wish list.')
                </div>
            </div>
        </graphql>
    </div>
@endsection
