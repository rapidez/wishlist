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
            return this.$scopedSlots.default({
                mutation: this.mutation,
                variables: this.variables,
                isOnWishlist: this.isOnWishlist,
                wishlistCallback: this.wishlistCallback,
                itemsCount: this.itemsCount,
                wishlist: this.wishlist
            })
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
                this.$root.$emit('wishlist-changed')
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
                    ? { wishlistId: this.wishlist.id, wishlistItemsIds: [this.wishlistItem.id] }
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
