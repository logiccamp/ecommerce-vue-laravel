<template>
    <div>
        
	<section id="do_action">
		<div class="container">
			<div class="row">
				<div class="col-sm-6">
					<div class="total_area">
						<ul>
							<li>Cart Sub Total <span>${{sum}}</span></li>
							<li>Shipping Cost <span>Free</span></li>
							<li>Total <span>${{sum + shipping}}</span></li>
						</ul>
						<a class="btn btn-default check_out" href="/checkout">Check Out</a>
					</div>
				</div>
			</div>
		</div>
	</section><!--/#do_action-->
	
    
    </div>
</template>


<script>
export default {
    data() {
        return {
            cart : [],
            isCart : false,
            message : 'Loading...',
            sum : 0,
            shipping : 0,
        }
    },

    methods: {
        async updateCart (id, action, qty) {
            if (qty == 1 && action == 'minus') return false

            let response = await axios.post(`/updateCart/${id}`, {
                'qty' : action == 'minus' ? qty - 1 : qty + 1
            });
            this.getCart()
        },
        async deleteCart (id) {
            let response = await axios.get(`/deleteCart/${id}`)
            this.getCart()
        },
        async getCart () {
            const response = await axios.get('/getCart')
            this.cart = response.data.cart
            this.isCart = response.data.isCart
            this.sum = response.data.sum

            if(!response.data.isCart){
                this.message = "No item in your cart"
            }
        }
    },
    mounted() {
        this.getCart()
    },
}
</script>

