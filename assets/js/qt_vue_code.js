Vue.component('calc', {
    template: `
    <div>
        Quantity :
        <input type="number" v-model="quantity" @keyup="calclulation">
        x € {{ price }} + {{ free }} Gratis = € {{ total }}
    </div>
    `,

    data() {
        return {
            total: 69,
            free: 50,
        }
    },

  methods: {
      calclulation() {
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

        this.free = this.quantity / 2;

        this.total = this.quantity * this.price;
      },
  },

  props: {
    quantity: {
      type: Number,
      required: true // my assumption
    },

    price: {
      type: Number,
      required: true // my assumption
    },
  },

  /*mounted() {
    if (localStorage.quantity) {
      this.quantity = localStorage.quantity;
    }
  },
  watch: {
    quantity(newQuantity) {
      localStorage.quantity = newQuantity;
    }
  }*/

  // created() {
    // this.id = document.querySelector('.input-text.qty.text').getAttribute('value')
    //     .replace("product-", "");
  // }

  mounted() {
    var cvalue = this.quantity;
    var cname = "quantity";
    document.cookie = cname + "=" + cvalue;
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
