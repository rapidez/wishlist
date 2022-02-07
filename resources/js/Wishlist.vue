<script>
    import removeProductsFromWishlist from './graphql/removeProductsFromWishlist.graphql'
    import addProductsToWishlist from './graphql/addProductsToWishlist.graphql'

    export default {
        props: {
            sku: {
                type: String
            },
            customer: {
                type: Object,
                default: () => ({})
            }
        },

        render() {
            return this.$scopedSlots.default({
                mutation: this.mutation,
                variables: this.variables,
                wishlistItem: this.wishlistItem,
                itemsCount: this.itemsCount
            })
        },

        computed: {
            wishlistItem() {
                return this.customer.wishlists[0].items_v2.items.find(a => a.product.sku == this.sku) ?? false
            },
            mutation() {
                return this.wishlistItem ? removeProductsFromWishlist.loc.source.body : addProductsToWishlist.loc.source.body
            },
            variables() {
                return this.wishlistItem ? {
                    wishlistId: this.customer.wishlists[0].id,
                    wishlistItemsIds: [this.wishlistItem.id]
                } : {
                    wishlistId: 0,
                    wishlistItems: [{sku: this.sku, quantity: 1}]
                }
            }
        }
    }
</script>
