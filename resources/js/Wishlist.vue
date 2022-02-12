<script>
    import removeProductsFromWishlist from './graphql/removeProductsFromWishlist.graphql'
    import addProductsToWishlist from './graphql/addProductsToWishlist.graphql'

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
                wishlistItem: this.wishlistItem,
                refreshWishlist: this.refreshWishlist,
                itemsCount: this.itemsCount,
                wishlist: this.wishlist
            })
        },

        data() {
            return {
                wishlistItem: false,
                mutation: {},
                variables: {},
                itemsCount: 0,
                wishlist: {}
            }
        },

        methods: {
            setWishlistItem() {
                let wishlist = localStorage.wishlist ? JSON.parse(localStorage.wishlist) : []
                if (!wishlist || !wishlist.items_v2.items.length) {
                    return false
                }

                let wishlistItem = false
                wishlist.items_v2.items.forEach((item) => {
                    if (item.product.sku == this.sku) {
                        wishlistItem = item
                        return
                    }
                })

                this.wishlistItem = wishlistItem
            },

            setMutation() {
                this.mutation = this.wishlistItem ? removeProductsFromWishlist.loc.source.body : addProductsToWishlist.loc.source.body
            },

            setVariables() {
                this.variables = this.wishlistItem ? {
                    wishlistId: JSON.parse(localStorage.wishlist).id,
                    wishlistItemsIds: [this.wishlistItem.id]
                } : {
                    wishlistId: 0,
                    wishlistItems: [{sku: this.sku, quantity: 1}]
                }
            },

            setWishlist() {
                this.wishlist = localStorage.wishlist ? JSON.parse(localStorage.wishlist) : false
            },

            setItemsCount() {
                this.itemsCount = localStorage.wishlist ? JSON.parse(localStorage.wishlist).items_v2.items.length : 0
            },

            async refreshWishlist() {
                await this.$root.getWishlist()
                this.setWishlistItem()
                this.setMutation()
                this.setVariables()
                this.setWishlist()
                this.$root.$emit('refreshed-wishlist')
            }
        },

        created() {
            if (this.sku) {
                this.setWishlistItem()
                this.setMutation()
                this.setVariables()
            }
            this.setWishlist()
            this.setItemsCount()
        },

        mounted() {
            this.$root.$on('refreshed-wishlist', this.setItemsCount)
        }
    }
</script>
