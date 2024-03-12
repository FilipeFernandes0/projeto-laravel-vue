<template>
  <Navbar></Navbar>


  <div class="col-lg-12">
    <div class="box">
      <h1>Login</h1>

      <hr>
      <form @submit.prevent="authStore.handleLogin(form)">
        <div class="form-group">
          <label for="email">Email</label>
          <input id="email" type="email" class="form-control" v-model="form.email">
          <div v-if="authStore.errors.email" class="text-danger mt-2">
                  <span>{{ authStore.errors.email[0] }}</span>
          </div>
        </div>
        
        <div class="form-group">
          <label for="password">Password</label>
          <input id="password" type="password" class="form-control" v-model="form.password">
          <div v-if="authStore.errors.password" class="text-danger mt-2">
                  <span>{{ authStore.errors.password[0] }}</span>
          </div>
        </div>
        <div class="text-center">
          <button type="submit" class="btn btn-primary"><i class="fa fa-sign-in"></i> Log in</button>
        </div>
      </form>
    </div>
  </div>
  <Footer></Footer>
</template>

<script setup>
import Navbar from '../components/Navbar.vue';
import Footer from '../components/Footer.vue';
import { ref } from 'vue';
import { useAuthStore } from '../stores/auth';

const authStore = useAuthStore();
const form = ref({
  email: '',
  password: '',
});

</script>