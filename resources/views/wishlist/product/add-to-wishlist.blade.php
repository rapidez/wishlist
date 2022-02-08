<graphql v-if="$root.user" v-cloak query="{ customer { wishlists { id items_v2 { items { id product { sku } } } } } }">
    <div slot-scope="{ data, runQuery }">
        <wishlist v-if="data" :sku="config.product.sku" :customer="data.customer">
            <div slot-scope="{ mutation, variables, wishlistItem }">
                <graphql-mutation
                    :query="mutation"
                    :variables="variables"
                    :callback="runQuery"
                >
                    <form slot-scope="{ mutate, mutated }" v-on:submit.prevent="mutate">
                        <x-rapidez::button type="submit">
                            <template v-if="wishlistItem">
                                @lang('Remove from wishlist')
                            </template>
                            <template v-else>
                                @lang('Add to wishlist')
                            </template>
                        </x-rapidez::button>
                    <form>
                </graphql-mutation>
            </div>
        </wishlist>
    </div>
</graphql>

<x-rapidez::button v-else href="/login">
    @lang('Add to wishlist')
</x-rapidez::button>
