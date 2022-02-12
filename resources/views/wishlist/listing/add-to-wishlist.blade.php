<wishlist v-if="$root.user" :sku="item.sku">
    <div slot-scope="{ mutation, variables, wishlistItem, refreshWishlist }">
        <graphql-mutation
            :query="mutation"
            :variables="variables"
            :callback="refreshWishlist"
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

<x-rapidez::button v-else href="/login">
    <x-heroicon-o-heart class="h-5 w-5" />
</x-rapidez::button>
