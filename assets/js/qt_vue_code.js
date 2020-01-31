Vue.component('calc', {
    template: `
    <div>
        Quantity :
        <input type="number" v-model="data_quantity" @keyup="calculation">
        x € {{ data_price }} = € {{ total }}

        <br>
        <p v-if="minorder" style="color:red;">Minimum Order : {{ morder }} pieces!</p>
    </div>
    `,

    data() {
        return {
            total: '',
            morder: '',
            minorder: false,
            data_quantity: this.quantity,
            data_price: this.price,
        }
    },

  methods: {
      calculation() {
        var lprice = localStorage.getItem('price');

        if (this.product_id == 11) {
          if (this.data_quantity >= 100 && this.data_quantity <= 249) {
            this.data_price = lprice;
          } else if(this.data_quantity >= 250 && this.data_quantity <= 499) {
              this.data_price = 0.59;
          } else if(this.data_quantity >= 500 && this.data_quantity <= 999) {
              this.data_price = 0.55;
          } else if(this.data_quantity >= 1000) {
              this.data_price = 0.49;
          } else {
              this.data_price = lprice;
          }

          if (this.data_quantity < 100) {
            this.minorder = true;
            this.morder = 100;
          } else {
            this.minorder = false;
          }

        } else if (this.product_id == 21) {

          if (this.data_quantity >= 25 && this.data_quantity <= 49) {
            this.data_price = lprice;
          } else if(this.data_quantity >= 50 && this.data_quantity <= 74) {
              this.data_price = 5.49;
          } else if(this.data_quantity >= 75 && this.data_quantity <= 99) {
              this.data_price = 5.10;
          } else if(this.data_quantity >= 100) {
              this.data_price = 4.99;
          } else {
              this.data_price = lprice;
          }

          if (this.data_quantity < 25) {
            this.minorder = true;
            this.morder = 25;
          } else {
            this.minorder = false;
          }

        }

        this.total = this.data_quantity * this.data_price;

        document.querySelector('[name="quantity"]').value = this.data_quantity;
      },
  },

  props: {
    quantity: {
      type: Number,
      required: true
    },

    price: {
      type: Number,
      required: true
    },

    product_id: {
      type: Number,
      required: true
    },
  },

  mounted() {
    // var cvalue = this.quantity;
    // var cname = "quantity";
    // document.cookie = cname + "=" + cvalue;

    localStorage.setItem("price", this.price);

    this.calculation();
  },

  // watch: {
  //   quantity(newQuantity) {
  //     var cname = "quantity";
  //     document.cookie = cname + "=" + newQuantity;
  //   },
  // }

});

new Vue({
    el: '#quantity_el',
});
