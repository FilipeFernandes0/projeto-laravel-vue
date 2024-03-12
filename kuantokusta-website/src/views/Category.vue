<template>
    <div>
      <Navbar></Navbar>
  
      <div id="all">
        <div id="content">
          <div class="container">
            <div class="row">
              <div class="col-lg-12">
                <!-- breadcrumb-->
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li aria-current="page" class="breadcrumb-item active">{{ category }}</li>
                  </ol>
                </nav>
              </div>
             
              <div class="col-lg-12">
                <div class="box">
                  <h1>{{ category }}</h1>
                </div>
                <div class="box info-bar">
                  <div class="row">
                    <div class="col-md-12 col-lg-7 products-number-sort">
                      <!-- <form class="form-inline d-block d-lg-flex justify-content-between flex-column flex-md-row">
                      <div class="products-sort-by mt-2 mt-lg-0"><strong>Sort by</strong>
                        <select name="sort-by" class="form-control">
                          <option>Price</option>
                          <option>Name</option>
                          <option>Sales first</option>
                        </select>
                      </div>
                    </form> -->
                    </div>
                  </div>
                </div>
                <displayCategoryComponent :category-id="categoryId"></displayCategoryComponent>
                <pagination></pagination>
              </div>
            </div>
          </div>
        </div>
      </div>
  
      <Footer></Footer>
    </div>
  </template>
  
  <script>
  import Navbar from '../components/Navbar.vue';
  import Footer from '../components/Footer.vue';
  import categoryComponent from '../components/categoryComponent.vue';
  import pagination from '../components/pagination.vue'
  import displayCategoryComponent from '../components/displayCategoryComponent.vue';
  import axios from 'axios';

  
  export default {
    components: {
      Navbar,
      Footer,
      categoryComponent,
      pagination,
      displayCategoryComponent,
    },
    data() {
      return {
        category: '',
      };
    },
    computed: {
      categoryId() {
        // Access the categoryId from the route params
        return this.$route.params.categoryId;
      },
    },
    methods: {
      async getCategoryName() {
        try {
          const response = await axios.get(`/api/category/${this.categoryId}`);
          this.category = response.data.category;
        } catch (error) {
          console.error('Error fetching category name:', error);
        }
      },
    },
    mounted() {
      this.getCategoryName();
    },
  };
  </script>
  