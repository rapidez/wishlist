import { useLocalStorage } from "@vueuse/core";

document.addEventListener('vue:loaded', () => {
    window.$on('logged-in', async () => {
        let response = await window.magentoGraphQL(
            '{ customer { wishlists { id items_v2 { items { id product { sku id } } } } } }'
        )

        useLocalStorage('wishlist', response.data.customer.wishlists[0]).value = response.data.customer.wishlists[0];
        window.$emit('rapidez:wishlist-changed', response.data.customer.wishlists[0])
    });

    window.$on('rapidez:logout', () => {
        useLocalStorage('wishlist', {}).value = null;
    });
})
