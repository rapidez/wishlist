<wishlist v-if="$root.user" :sku="{{ isset($product) ? 'config.product.sku' : 'item.sku' }}">
    <div slot-scope="{ mutation, variables, isOnWishlist, wishlistCallback }">
        <graphql-mutation
            :query="mutation"
            :variables="variables"
            :callback="wishlistCallback"
        >
            <form slot-scope="{ mutate, mutated }" v-on:submit.prevent="mutate">
                <x-rapidez::button.primary type="submit">
                    <x-heroicon-s-heart v-if="isOnWishlist" class="h-5 w-5" />
                    <x-heroicon-o-heart v-else class="h-5 w-5" />
                </x-rapidez::button.primary>
            <form>
        </graphql-mutation>
    </div>
</wishlist>

<x-rapidez::button.primary v-else href="/login">
    <x-heroicon-o-heart class="h-5 w-5" />
</x-rapidez::button.primary>
