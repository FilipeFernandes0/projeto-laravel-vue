<template>
  <header class="header mb-5">
    <!--
      *** TOPBAR ***
      _________________________________________________________
      -->
    <div id="top">
      <div class="container">
        <div class="row">
          <div class="col-lg-6 offer mb-3 mb-lg-0"></div>
          <div class="col-lg-6 text-center text-lg-right">
            <ul class="menu list-inline mb-0">
              <template v-if="!authStore.user">
                <li class="list-inline-item"><router-link to="/login">Login</router-link></li>
                <li class="list-inline-item"><router-link to="/register">Register</router-link></li>
              </template>
              <template v-else>
                <li class="list-inline-item"><button @click="authStore.handleLogout">Logout</button></li>

              </template>

            </ul>
          </div>
        </div>
      </div>

      <!-- *** TOP BAR END ***-->


    </div>
    <nav class="navbar navbar-expand-lg">
      <div class="container"><a href="/" class="navbar-brand home"><img src="/img/logo.png" alt="Obaju logo"
            class="d-none d-md-inline-block"><img src="/img/logo-small.png" alt="Obaju logo"
            class="d-inline-block d-md-none"><span class="sr-only">Obaju - go to homepage</span></a>
        <div class="navbar-buttons">
          <button type="button" data-toggle="collapse" data-target="#navigation"
            class="btn btn-outline-secondary navbar-toggler"><span class="sr-only">Toggle navigation</span><i
              class="fa fa-align-justify"></i></button>
          <button type="button" data-toggle="collapse" data-target="#search"
            class="btn btn-outline-secondary navbar-toggler"><span class="sr-only">Toggle search</span><i
              class="fa fa-search"></i></button><a href="basket.html"
            class="btn btn-outline-secondary navbar-toggler"><i class="fa fa-shopping-cart"></i></a>
        </div>
        <div id="navigation" class="collapse navbar-collapse">
  <ul class="navbar-nav mr-auto">
    <li class="nav-item dropdown menu-large">
      <a href="#" data-toggle="dropdown" data-hover="dropdown" data-delay="200" class="dropdown-toggle nav-link">Categories<b class="caret"></b></a>
      <ul class="dropdown-menu megamenu">
        <li>
          <div class="row">
            <!-- Each category will take 4 columns on medium screens (col-md-4) -->
            <div class="col-md-4">
              <ul class="list-unstyled mb-3">
                <li v-for="category in categories.slice(0, Math.ceil(categories.length / 3))" :key="category.id">
                  <router-link :to="`/categories/${category.id}`">
                    {{ category.name }}
                  </router-link>
                </li>
              </ul>
            </div>
            <!-- Repeat the above structure for the remaining categories -->
            <div class="col-md-4">
              <ul class="list-unstyled mb-3">
                <li v-for="category in categories.slice(Math.ceil(categories.length / 3), Math.ceil(2 * categories.length / 3))" :key="category.id">
                  <router-link :to="`/categories/${category.id}`">
                    {{ category.name }}
                  </router-link>
                </li>
              </ul>
            </div>
            <div class="col-md-4">
              <ul class="list-unstyled mb-3">
                <li v-for="category in categories.slice(Math.ceil(2 * categories.length / 3), categories.length)" :key="category.id">
                  <router-link :to="`/categories/${category.id}`">
                    {{ category.name }}
                  </router-link>
                </li>
              </ul>
            </div>
          </div>
        </li>
      </ul>
    </li>
  </ul>


          <div class="navbar-buttons d-flex justify-content-end">
            <!-- /.nav-collapse-->
            <div id="search-not-mobile" class="navbar-collapse collapse"></div><a data-toggle="collapse" href="#search"
              class="btn navbar-btn btn-primary d-none d-lg-inline-block"><span class="sr-only">Toggle search</span><i
                class="fa fa-search"></i></a>
          </div>
        </div>
      </div>
    </nav>
    <div id="search" class="collapse">
      <div class="container">
        <form role="search" class="d-flex align-items-center">
          <div class="input-group">
            <input type="text" placeholder="Search" class="form-control">
            <div class="input-group-append">
              <button type="button" class="btn btn-primary"><i class="fa fa-search"></i></button>
            </div>
          </div>
          <template v-if="authStore.user">
            <router-link to="/create-product" class="btn btn-primary ml-5">add product</router-link>
          </template>
        </form>
      </div>
    </div>
  </header>
</template>


<script>
import { ref } from 'vue';
import { useAuthStore } from '../stores/auth';
import axios from 'axios';

export default {
  setup() {
    const authStore = useAuthStore();
    const categories = ref([]);

    const fetchCategories = async () => {
      try {
        const response = await axios.get('/api/category'); // Adjust the API endpoint as needed
        categories.value = response.data;
      } catch (error) {
        console.error('Error fetching categories:', error);
      }
    };

    fetchCategories(); // Fetch categories when component is mounted

    return {
      authStore,
      categories,
    };
  },
};
</script>