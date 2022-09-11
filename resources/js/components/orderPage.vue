<template>
    <div>
    <section id="cart_items">
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="#">Home</a></li>
				  <li class="active">Orders</li>
				</ol>
			</div>
			<div class="table-responsive cart_info">
                        <div class="text-danger" v-if="!orders.length > 0">
                {{message}}
            </div>
            <table class="table table-condensed" v-else>
                <thead>
                    <tr class="cart_menu">
                        <!-- Items, no qty, status -->
                        <td class="image"></td>
                        <td class="price">Status</td>
                        <td class="quantity">Items</td>
                        <td class="total">Total</td>
                        <td class="total">Date</td>
                        <td></td>
                    </tr>
                </thead>
                <tbody>
                    <tr class="heading" v-for="(item, index) in orders" :key="index">
                        <td class="cart_product" v-if="item.break_down.length > 0">
                            <a href=""><img style="height: 100px" :src="item.break_down[0].product.image_name" alt=""></a>
                        </td>
                        <td v-else></td>

                        <td class="cart_price">
                            <p>Recieved</p>
                        </td>
                        <td class="cart_quantity">
                            {{item.break_down.length}}
                        </td>
                        <td class="cart_total">
                            <p class="cart_total_price">${{item.total_amount}}</p>
                        </td>
                        <td class="cart_delete">
                            {{item.ddate}}
                        </td>
                    </tr>
                </tbody>
            </table>
			</div>
		</div>
	</section> <!--/#cart_items-->
    
    </div>
</template>


<script>
export default {
    data() {
        return {
            orders : [],
            isCart : false,
            message : 'Loading...',
            sum : 0,
            shipping : 0,
        }
    },

    methods: {
        

        async getOrder () {
            const response = await axios.get('/getOrder')
            console.log(response)
            this.orders = response.data

            if(!response.data.isOrder){
                this.message = "No item in your cart"
            }
        }
    },
    mounted() {
        this.getOrder()
    },
}
</script>

