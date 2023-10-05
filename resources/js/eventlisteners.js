import { useLocalStorage } from "@vueuse/core";

document.addEventListener('turbo:load', () => {
    window.app.$on('logged-in', async () => {
        let response = await axios.post(config.magento_url + '/graphql', {
            query: '{ customer { wishlists { id items_v2 { items { id product { sku id } } } } } }'
        }, { headers: { Authorization: `Bearer ${localStorage.token}`, Store: config.store_code }})

        useLocalStorage('wishlist', response.data.data.customer.wishlists[0]).value = response.data.data.customer.wishlists[0];
        window.app.$emit('wishlist-changed')
    });

    window.app.$on('logout', () => {
        useLocalStorage('wishlist', {}).value = null;
    });
})
