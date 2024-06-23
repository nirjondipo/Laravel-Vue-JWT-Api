<template>
    <div>
      <h1>Register</h1>
      <form @submit.prevent="register">
        <input type="text" v-model="name" placeholder="Name" @input="clearMessage" />
        <input type="email" v-model="email" placeholder="Email" @input="clearMessage" />
        <input type="password" v-model="password" placeholder="Password" @input="clearMessage" />
        <input type="password" v-model="password_confirmation" placeholder="Password" @input="clearMessage" />
        <button type="submit" :disabled="loading">Register</button>
      </form>
      <p v-if="errors">{{ errors }}</p>
    </div>
  </template>

  <script>
  import { login } from '../auth';
  export default {
    data() {
      return {
        name: '',
        email: '',
        password: '',
        password_confirmation: '',
        errors: '',
        loading: false
      };
    },
    methods: {
      async register() {
        this.loading = true;
        try {
        const response = await this.$axios.post('/api/auth/register', {
            name: this.name,
            email: this.email,
            password: this.password,
            password_confirmation: this.password_confirmation
          });

          login(response.data.access_token);
          this.$router.push({ name: 'home' });
        } catch (error) {
          this.errors = error.response ? error.response.data.error : 'An error occurred';
        } finally {
          this.loading = false;
        }
      },
      clearMessage() {
        this.errors = '';
      }
    }
  };
  </script>
