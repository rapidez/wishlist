Vue.component('wishlist', require('Vendor/rapidez/wishlist/resources/js/Wishlist.vue').default)

document.addEventListener('turbolinks:load', () => {
    window.app.$on('logged-in', async () => {
        let response = await axios.post(config.magento_url + '/graphql', {
            query: '{ customer { wishlists { id items_v2 { items { id product { sku } } } } } }'
        }, { headers: { Authorization: `Bearer ${localStorage.token}` }})

        localStorage.wishlist = JSON.stringify(response.data.data.customer.wishlists[0])
        this.$root.$emit('wishlist-changed')
    });

    window.app.$on('logout', () => {
        localStorage.removeItem('wishlist')
    });
})
