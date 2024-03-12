<template>
  <Navbar></Navbar>
  <div id="all">
    <div id="content">
      <div class="container">
        <div class="row">
       
          <pictureComponent :product-id="productId"></pictureComponent>
          


        </div>
      </div>
    </div>
  </div>

  <offersComponent :product-id="productId"></offersComponent>


  <Footer></Footer>
</template>

<script>
import Navbar from '../components/Navbar.vue';
import Footer from '../components/Footer.vue';
import pictureComponent from '../components/pictureComponent.vue';
import offersComponent from '../components/offersComponent.vue';






export default {

  components: {
    Navbar,
    pictureComponent,
    Footer,
    offersComponent,

  },
    computed: {
      productId() {
        return this.$route.params.productId;
      },
    },

}
</script>