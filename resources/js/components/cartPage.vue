<template>
    <div>
    <section id="cart_items">
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="#">Home</a></li>
				  <li class="active">Shopping Cart</li>
				</ol>
			</div>
			<div class="table-responsive cart_info">
                        <div class="text-danger" v-if="!isCart">
                {{message}}
            </div>
            <table class="table table-condensed" v-else>
                <thead>
                    <tr class="cart_menu">
                        <td class="image">Item</td>
                        <td class="description"></td>
                        <td class="price">Price</td>
                        <td class="quantity">Quantity</td>
                        <td class="total">Total</td>
                        <td></td>
                    </tr>
                </thead>
                <tbody>
                    <tr class="heading" v-for="(item, index) in cart" :key="index">
                        <td class="cart_product">
                            <a href=""><img style="height: 100px" :src="item.product.image_name" alt=""></a>
                        </td>
                        <td class="cart_description heading">
                            <h4><a href="">{{item.product.name}}</a></h4>
                        </td>
                        <td class="cart_price">
                            <p>${{item.product.sale_price}}</p>
                        </td>
                        <td class="cart_quantity">
                            <div class="cart_quantity_button">
                                <a @click="updateCart(item.id, 'add', item.quantity)" class="cart_quantity_up" href="#"> + </a>
                                <span class="form-control cart_quantity_input" style="width: 40px" >{{item.quantity}}</span>
                                <a @click="updateCart(item.id, 'minus', item.quantity)" class="cart_quantity_down" href="#"> - </a>
                            </div>
                        </td>
                        <td class="cart_total">
                            <p class="cart_total_price">${{item.price}}</p>
                        </td>
                        <td class="cart_delete">
                            <a @click="deleteCart(item.id)" class="cart_quantity_delete" href="#"><i class="fa fa-times"></i></a>
                        </td>
                    </tr>
                </tbody>
            </table>
			</div>
		</div>
	</section> <!--/#cart_items-->

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

