import './bootstrap';
import axios from 'axios';
import { createRouter, createWebHistory } from 'vue-router';
import { createApp, h } from 'vue';
import routes from './routes';
import store from './store';
import './toastify'
import Layout from './components/Layout.vue';
import Header from './components/Header.vue';
import Footer from './components/Footer.vue';
import Sidebar from './components/Sidebar.vue';
import { getAuthStatus, refreshToken } from './auth'; // Import refreshToken

// Create a new axios instance with default settings
// Need to add VITE_APP_URL=http://127.0.0.1:8000/ in .env files
const axiosInstance = axios.create({
  baseURL: import.meta.env.VITE_APP_URL || process.env.APP_URL,
  headers: {
    'Content-Type': 'application/json'
  }
});

// Add a request interceptor to include the token
axiosInstance.interceptors.request.use(config => {
  const token = localStorage.getItem('token');
  if (token) {
    config.headers.Authorization = `Bearer ${token}`;
  }
  return config;
}, error => {
  return Promise.reject(error);
});

axiosInstance.interceptors.response.use(response => {
  return response;
}, async error => {
  const originalRequest = error.config;
  if (error.response.status === 401 && !originalRequest._retry) {
    originalRequest._retry = true;
    try {
      const token = await refreshToken();
      originalRequest.headers.Authorization = `Bearer ${token}`;
      return axiosInstance(originalRequest);
    } catch (error) {
      return Promise.reject(error);
    }
  }
  return Promise.reject(error);
});
const app = createApp({});

// Attach axios instance to Vue prototype
app.config.globalProperties.$axios = axiosInstance;

// Modify each route to use the Layout component and handle meta titles
const router = createRouter({
  history: createWebHistory(),
  routes: routes.map(route => ({
    ...route,
    component: {
      render() {
        return h(Layout, null, {
          default: () => h(route.component)
        });
      }
    }
  }))
});

// Navigation guard to check for auth status
router.beforeEach((to, from, next) => {
    if (to.matched.some(record => record.meta.requiresAuth)) {
      if (!getAuthStatus().value) {
        next({ name: 'login' }); // Redirect to login if not authenticated
      } else {
        next(); // Proceed to the route
      }
    } else {
      if (getAuthStatus().value && (to.name === 'login' || to.name === 'register')) {
        next({ name: 'home' }); // Redirect authenticated user from login and register to home
      } else {
        next(); // Proceed to the route
      }
    }
});

// Register components globally
app.component('header-component', Header);
app.component('sidebar-component', Sidebar);
app.component('footer-component', Footer);

// Update document title based on route meta title
router.afterEach((to) => {
  document.title = to.meta.title || 'Your Default Title';
});
// Use Vuex store in Vue App
app.use(store);
app.use(router);
app.mount('#app');

