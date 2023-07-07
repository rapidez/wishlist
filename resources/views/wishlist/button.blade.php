<wishlist v-cloak v-if="$root.user?.id" :sku="{{ isset($product) ? 'config.product.sku' : 'item.sku' }}">
    <div slot-scope="{ mutation, variables, isOnWishlist, wishlistCallback }">
        <graphql-mutation
            :query="mutation"
            :variables="variables"
            :callback="wishlistCallback"
        >
            <form slot-scope="{ mutate, mutated }" v-on:submit.prevent="mutate">
                <x-rapidez::button type="submit">
                    <x-heroicon-s-heart v-if="isOnWishlist" class="h-5 w-5" />
                    <x-heroicon-o-heart v-else class="h-5 w-5" />
                </x-rapidez::button>
            <form>
        </graphql-mutation>
    </div>
</wishlist>

<x-rapidez::button v-else :href="route('account.login')">
    <x-heroicon-o-heart class="h-5 w-5" />
</x-rapidez::button>
