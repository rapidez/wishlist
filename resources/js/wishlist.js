import wishlist from 'Vendor/rapidez/wishlist/resources/js/Wishlist.vue'
Vue.component('wishlist', wishlist)

document.addEventListener('turbolinks:load', () => {
    window.app.$on('logged-in', async () => {
        let response = await axios.post(config.magento_url + '/graphql', {
            query: '{ customer { wishlists { id items_v2 { items { id product { sku id } } } } } }'
        }, { headers: { Authorization: `Bearer ${localStorage.token}`, Store: config.store_code }})

        localStorage.wishlist = JSON.stringify(response.data.data.customer.wishlists[0])
        window.app.$emit('wishlist-changed')
    });

    window.app.$on('logout', () => {
        localStorage.removeItem('wishlist')
    });
})
