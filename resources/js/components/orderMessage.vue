<template>
        <div class="order-message">
            <p>Order Summary</p>
            <table class="table table-condensed total-result">
                <tr>
                    <td>Cart Sub Total</td>
                    <td>${{sum}}</td>
                </tr>
                <tr class="shipping-cost">
                    <td>Shipping Cost</td>
                    <td>Free</td>
                </tr>
                <tr>
                    <td>Total</td>
                    <td><span>${{sum + shipping}}</span></td>
                </tr>
            </table>
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

