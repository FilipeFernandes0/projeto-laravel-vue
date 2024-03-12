<template>
  <div id="hot">
    <div class="box py-4">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <h2 class="mb-0">Trending</h2>
          </div>
        </div>
      </div>
    </div>
    <div class="container">
      <div class="row">
        <div v-for="(product, index) in products.slice(1, 30)" :key="index" class="col-md-3 mb-4">
          <div class="product">
            <div class="flip-container">
              <div class="flipper">
                <div class="front">
                  <router-link :to="`/product/${product.id}`">
                    <img :src="product.image" alt="" class="img-fluid smaller-image">
                  </router-link>
                </div>
                <div class="back">
                  <router-link :to="`/product/${product.id}`">
                    <img :src="product.image" alt="" class="img-fluid smaller-image">
                  </router-link>
                </div>
              </div>
            </div>
            <router-link :to="`/product/${product.id}`" class="invisible">
              <img :src="product.image" alt="" class="img-fluid">
            </router-link>
            <div class="text">
              <h3>
                <router-link :to="`/product/${product.id}`">{{ product.name }}</router-link>
              </h3>
              <p class="price">{{ product.price }}€</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { onMounted, ref } from "vue";
import axios from 'axios';

const products = ref([]);

onMounted(async () => {
  try {
    const response = await axios.get('/api/index');
    products.value = response.data;
    console.log(response.data);
  } catch (error) {
    console.error('Error fetching products:', error);
  }
});
</script>