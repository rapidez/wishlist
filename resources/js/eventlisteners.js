import { useLocalStorage } from "@vueuse/core";

document.addEventListener('vue:loaded', () => {
    window.app.$on('logged-in', async () => {
        let response = await window.magentoGraphQL(
            '{ customer { wishlists { id items_v2 { items { id product { sku id } } } } } }'
        )

        useLocalStorage('wishlist', response.data.customer.wishlists[0]).value = response.data.customer.wishlists[0];
        window.app.$emit('wishlist-changed')
    });

    window.app.$on('logout', () => {
        useLocalStorage('wishlist', {}).value = null;
    });
})
