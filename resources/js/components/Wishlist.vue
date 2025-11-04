<script>
    import { useLocalStorage } from '@vueuse/core';
    import removeProductsFromWishlist from '../graphql/removeProductsFromWishlist'
    import addProductsToWishlist from '../graphql/addProductsToWishlist'

    const wishlist = useLocalStorage('wishlist', {});

    export default {
        props: {
            sku: {
                type: String
            }
        },

            render() {
                // Vue 3: slots are functions on `$slots`. Pass the raw wishlist value so templates can use it normally.
                return this.$slots && this.$slots.default
                    ? this.$slots.default({
                        mutation: this.mutation,
                        variables: this.variables,
                        isOnWishlist: this.isOnWishlist,
                        wishlistCallback: this.wishlistCallback,
                        itemsCount: this.itemsCount,
                        wishlist: this.wishlist
                    })
                    : null
            },

        data() {
            return {
                wishlist: wishlist
            }
        },

        methods: {
            wishlistCallback(data, response) {
                let mutationName = Object.keys(response.data)[0]
                let items = response.data[mutationName].wishlist
                wishlist.value = items
                window.$emit('rapidez:wishlist-changed', items)
            }
        },

        computed: {
            itemsCount() {
                return this.wishlist?.items_v2?.items.length ?? 0
            },

            wishlistItem() {
                return this.wishlist?.items_v2?.items.find((item) => item.product.sku == this.sku)
            },

            isOnWishlist() {
                return !!this.wishlistItem
            },

            variables() {
                return this.isOnWishlist
                    ? { wishlistId: this.wishlist?.id, wishlistItemsIds: [this.wishlistItem.id] }
                    : { wishlistId: 0, wishlistItems: [{sku: this.sku, quantity: 1}] }
            },

            mutation() {
                return this.isOnWishlist
                    ? removeProductsFromWishlist.query
                    : addProductsToWishlist.query
            }
        }
    }
</script>
