<template>
  <div class="col-lg-10 order-1 order-lg-2">
              <div id="productMain" class="row">
                <div class="col-md-6">
                  <div data-slider-id="1" class="owl-carousel shop-detail-carousel">
                    <div class="item"> <img :src="product.image" alt="" class="img-fluid"></div>
                   
                  </div>
              
                </div>
                <div class="col-md-6">
                  <div class="box">
                    <h3 class="text-center font-size-sm">{{ product.name }}</h3>
                    <p class="price">{{ product.price }}€</p>
                  </div>
                  <div data-slider-id="1" class="owl-thumbs">
                    <button class="owl-thumb-item"><img :src="product.image" alt="" class="img-fluid"></button>
                 
                  </div>
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
        product: {},
      };
    },
    methods: {
      fetchProduct(productId) {
        axios.get(`/api/products/${productId}`)
          .then(response => {
            this.product = response.data;
            console.log('Products:', this.products);
          })
          .catch(error => {
            console.error('Error fetching products:', error);
          });
      },
    },
    mounted() {
      this.fetchProduct(this.productId);
    },
  };
  </script>