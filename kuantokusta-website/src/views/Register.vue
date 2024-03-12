
<template>
  <!-- navbar-->
  <Navbar></Navbar>
  <div id="all">
    <div id="content">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <!-- breadcrumb-->
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><router-link to="/">Home</router-link></li>
                <li aria-current="page" class="breadcrumb-item active">New account</li>
              </ol>
            </nav>
          </div>
          <div class="col-lg-12">
            <div class="box">
              <h1>Register</h1>

              <hr>
              <form @submit.prevent="authStore.handleRegister(form)">
                <div class="form-group">
                  <label for="name">Name</label>
                  <input id="name" type="text" class="form-control" v-model="form.name">
                  <div v-if="authStore.errors.name" class="text-danger mb-2">
                    <span>{{ authStore.errors.name[0] }}</span>
                  </div>
                </div>
                <div class="form-group">
                  <label for="email">Email</label>
                  <input id="email" type="email" class="form-control" v-model="form.email">
                  <div v-if="authStore.errors.email" class="text-danger mb-2">
                    <span>{{ authStore.errors.email[0] }}</span>
                  </div>
                </div>
                <div class="form-group">
                  <label for="password">Password</label>
                  <input id="password" type="password" class="form-control" v-model="form.password">
                  <div v-if="authStore.errors.password" class="text-danger mb-2">
                    <span>{{ authStore.errors.password[0] }}</span>
                  </div>
                </div>
                <div class="form-group">
                  <label for="password_confirmation">Password Confirmation</label>
                  <input id="password_confirmation" type="password" class="form-control"
                    v-model="form.password_confirmation">
                  <div v-if="authStore.errors.password_confirmation" class="text-danger mb-2">
                    <span>{{ authStore.errors.password_confirmation[0] }}</span>
                  </div>
                </div>
                <div class="text-center">
                  <button type="submit" class="btn btn-primary"><i class="fa fa-user-md"></i> Register</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <Footer></Footer>
</template>

<script setup>
import Navbar from '../components/Navbar.vue';
import Footer from '../components/Footer.vue';
import { ref } from 'vue';
import { useAuthStore } from '../stores/auth';
const authStore = useAuthStore()
const form = ref({
  name: '',
  email: '',
  password: '',
  password_confirmation: ''
})




</script>