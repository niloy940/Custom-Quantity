Vue.component('calc', {
    template: `
    <div>
        Quantity :
        <input type="number" v-model="quantity" @keyup="calclulation">
        x € {{ price }} = € {{ total }}

        <br>
        <p v-if="minorder" style="color:red;">Minimum Order : {{ morder }} pieces!</p>
    </div>
    `,

    data() {
        return {
            total: '',
            morder: '',
            minorder: false,
        }
    },

  methods: {
      calclulation() {
        if (this.product_id == 11) {
          if (this.quantity >= 100 && this.quantity <= 249) {
            this.price = 0.69;
          } else if(this.quantity >= 250 && this.quantity <= 499) {
              this.price = 0.59;
          } else if(this.quantity >= 500 && this.quantity <= 999) {
              this.price = 0.55;
          } else if(this.quantity >= 1000) {
              this.price = 0.49;
          } else {
              this.price = 0.69;
          }

          if (this.quantity < 100) {
            this.minorder = true;
            this.morder = 100;
          } else {
            this.minorder = false;
          }

        } else if (this.product_id == 21) {

          if (this.quantity >= 25 && this.quantity <= 49) {
            this.price = 5.99;
          } else if(this.quantity >= 50 && this.quantity <= 74) {
              this.price = 5.49;
          } else if(this.quantity >= 75 && this.quantity <= 99) {
              this.price = 5.10;
          } else if(this.quantity >= 100) {
              this.price = 4.99;
          } else {
              this.price = 5.99;
          }

          if (this.quantity < 25) {
            this.minorder = true;
            this.morder = 25;
          } else {
            this.minorder = false;
          }

        }

        this.total = this.quantity * this.price;
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
    var cvalue = this.quantity;
    var cname = "quantity";
    document.cookie = cname + "=" + cvalue;

    this.calclulation();
  },

  watch: {
    quantity(newQuantity) {
      var cname = "quantity";
      document.cookie = cname + "=" + newQuantity;
    },

  }
});

new Vue({
    el: '#quantity_el',
});
