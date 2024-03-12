<template>
  <div class="row products">
    <div class="col-lg-4 col-md-6" v-for="product in products" :key="product.id">
      <div class="product">
        <div class="flip-container">
          <div class="flipper">

            <div class="front">
              <router-link :to="`/product/${product.id}`">

                <img :src="product.image" alt="" class="img-fluid">
              </router-link>
            </div>
            <div class="back">
              <router-link :to="`/product/${product.id}`">

                <img :src="product.image" alt="" class="img-fluid">
              </router-link>
            </div>
          </div>
        </div>
        <a href="" class="invisible"><img :src="product.image" alt="" class="img-fluid"></a>
        <div class="text">
          <router-link :to="`/product/${product.id}`">

            <h3>{{ product.name }}</h3>
          </router-link>
          <p class="price">{{ product.price }}</p>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  props: {
    categoryId: {
      required: true,
    },
  },
  data() {
    return {
      products: [],
    };
  },
  methods: {
    fetchProducts(categoryId) {
      axios.get(`/api/category/${categoryId}`)
        .then(response => {
          this.products = response.data.products;;
          console.log('Products:', this.products);
        })
        .catch(error => {
          console.error('Error fetching products:', error);
        });
    },
  },
  mounted() {
    console.log('Category ID:', this.categoryId);
    this.fetchProducts(this.categoryId);
  },
};
</script>