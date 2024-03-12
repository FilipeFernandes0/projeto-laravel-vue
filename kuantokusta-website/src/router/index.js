// router/index.js

import { createRouter, createWebHistory } from 'vue-router';
import Home from '../views/Home.vue';

import Register from '../views/Register.vue';
import Login from '../views/Login.vue';
import createProduct from '../views/createProduct.vue';
import Category from '../views/Category.vue';
import Product from '../views/Product.vue';





const routes = [
  {
    path: '/',
    name: 'Home',
    component: Home,
  },

  {
    path: '/register',
    name: 'Register',
    component: Register,
  },
  {
    path: '/login',
    name: 'Login',
    component: Login,
  },
  {
    path: '/create-product',
    name: 'createProduct',
    component: createProduct,
  },

  {
    path: '/categories/:categoryId',
    name: 'Category',
    component: Category,
  },

  {
    path: '/product/:productId',
    name: 'Product',
    component: Product,
  },

 
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;
