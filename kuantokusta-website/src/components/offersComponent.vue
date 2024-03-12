<template>
    <div id="basket" class="col-lg-9">
        <div class="box">
            <h1>Offers</h1>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Store</th>
                            <th>Price</th>
                            <th>View Offer</th>

                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="offer in offers" :key="offer.id">
                            <td>{{ offer.store }}</td>
                            <td>{{ offer.price }}</td>
                            <td>
                                <a :href="offer.link_store" class="btn btn-primary" target="_blank">
                                   View Offer <i class="fa fa-chevron-right"></i>
                                </a>
                            </td>
                        </tr>
                    </tbody>

                </table>
            </div>

        </div>
    </div>

</template>

<script>
  import axios from 'axios';

export default {
    props: {
    productId: {
      required: true,
    },
    },
  data() {
    return {
      offers: [] 
    };
  },
  mounted() {
    this.fetchOffers(this.productId);
  },
  methods: {
    fetchOffers(productId) {
     
      axios.get(`/api/products/${productId}/offers`)
        .then(response => {
          this.offers = response.data; // Assuming response.data is an array of offers
        })
        .catch(error => {
          console.error('Error fetching offers:', error);
        });
    }
  }
};
</script>