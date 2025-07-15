<wishlist v-cloak v-if="$root.loggedIn" :sku="{{ isset($product) ? 'config.product.sku' : 'item.sku' }}">
    <div slot-scope="{ mutation, variables, isOnWishlist, wishlistCallback }">
        <graphql-mutation
            :query="mutation"
            :variables="variables"
            :callback="wishlistCallback"
        >
            <button class="block" slot-scope="{ mutate, mutated }" v-on:click.prevent="mutate">
                <x-heroicon-s-heart v-if="isOnWishlist" class="size-5" />
                <x-heroicon-o-heart v-else class="size-5 text-muted" />
            </button>
        </graphql-mutation>
    </div>
</wishlist>

<a v-else href="{{ route('account.login') }}">
    <x-heroicon-o-heart class="size-5 text-muted"  />
</a>
