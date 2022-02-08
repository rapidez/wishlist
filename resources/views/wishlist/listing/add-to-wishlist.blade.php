<graphql v-if="$root.user" v-cloak query="{ customer { wishlists { id items_v2 { items { id product { sku } } } } } }">
    <div slot-scope="{ data, runQuery }">
        <wishlist v-if="data" :sku="item.sku" :customer="data.customer">
            <div slot-scope="{ mutation, variables, wishlistItem }">
                <graphql-mutation
                    :query="mutation"
                    :variables="variables"
                    :callback="runQuery"
                >
                    <form slot-scope="{ mutate, mutated }" v-on:submit.prevent="mutate">
                        <x-rapidez::button type="submit">
                            <x-heroicon-s-heart v-if="wishlistItem" class="h-5 w-5" />
                            <x-heroicon-o-heart v-else class="h-5 w-5" />
                        </x-rapidez::button>
                    <form>
                </graphql-mutation>
            </div>
        </wishlist>
    </div>
</graphql>

<x-rapidez::button v-else href="/login">
    <x-heroicon-o-heart class="h-5 w-5" />
</x-rapidez::button>
