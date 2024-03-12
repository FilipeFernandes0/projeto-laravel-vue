<template>
    <Navbar></Navbar>

    <div class="col-lg-12">
        <div class="box">
            <h1>Add Product</h1>

            <hr>
            <form enctype="multipart/form-data" @submit.prevent="submitForm">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input id="name" type="text" class="form-control" v-model="form.name" required>
                    <!-- <div v-if="authStore.errors.email" class="text-danger mt-2">
                  <span>{{ authStore.errors.email[0] }}</span>
          </div> -->
                </div>

                <div class="form-group">
                    <label for="price">Price</label>
                    <input id="price" type="text" class="form-control" v-model="form.price" required>
                    <!-- <div v-if="authStore.errors.password" class="text-danger mt-2">
                  <span>{{ authStore.errors.password[0] }}</span>
          </div> -->
                </div>
               
                <div class="form-group">
                    <label for="image">Image</label>
                    <input id="image" type="file" class="form-control" @change="onChange">
                    <!-- <div v-if="authStore.errors.password" class="text-danger mt-2">
                  <span>{{ authStore.errors.password[0] }}</span>
          </div> -->
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Create</button>
                </div>
            </form>
        </div>
    </div>
    <Footer></Footer>
</template>

<script>

import Navbar from '../components/Navbar.vue';
import Footer from '../components/Footer.vue';
import { ref } from 'vue';
import axios from 'axios';


export default {

    components: {
    Navbar,
    Footer
  },
    setup() {
        const file = ref('');
        const form = ref({
            name: '',
            price: '',
        });

        const onChange = (e) => {
            file.value = e.target.files[0];
        };

        const submitForm = (e) => {
            e.preventDefault();

            // Check if file.value is defined
            if (file.value) {
                const config = {
                    headers: {
                        'content-type': 'multipart/form-data'
                    }
                };

                let data = new FormData();
                data.append('image', file.value);
                data.append('name', form.value.name); // Make sure form.name is defined
                data.append('price', form.value.price); // Make sure form.price is defined
              // Make sure form.brand is defined

                axios.post('api/product', data, config)
                    .then(function (res) {
                        // Handle response
                        console.log(res.data);
                    })
                    .catch(function (err) {
                        // Handle error
                        console.error(err);
                    });
            } else {
                console.error('No file selected.');
            }
        };

        return {
            form,
            onChange,
            submitForm
        };
    }
};


</script>                                                                                                                                                                                               