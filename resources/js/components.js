import 'Vendor/rapidez/core/resources/js/vue'
import { defineAsyncComponent } from 'vue'

// Register components when the Rapidez Vue app is loaded (Vue 3)
document.addEventListener('vue:loaded', function (event) {
	const vue = event.detail.vue
	vue.component('wishlist', defineAsyncComponent(() => import('./components/Wishlist.vue')))
})