<wishlist v-cloak v-if="window.app.config.globalProperties.loggedIn?.value" :sku="{{ isset($product) ? 'config.product.sku' : 'item.sku' }}" v-slot="{ mutation, variables, isOnWishlist, wishlistCallback }">
    <graphql-mutation
        :query="mutation"
        :variables="variables"
        :callback="wishlistCallback"
        v-slot="{ mutate, mutated }"
    >
        <button class="block" @click.prevent="mutate">
            <x-heroicon-s-heart v-if="isOnWishlist" class="size-5" />
            <x-heroicon-o-heart v-else class="size-5 text-muted" />
        </button>
    </graphql-mutation>
</wishlist>

<a v-else href="{{ route('account.login') }}">
    <x-heroicon-o-heart class="size-5 text-muted"  />
</a>
