// resources/js/store/index.js

import { createStore } from 'vuex';

const store = createStore({
  state: {
    appName: 'Dalace App' // Replace with your actual app name
  },
  mutations: {
    // Optionally define mutations if you need to change appName dynamically
  },
  actions: {
    // Optionally define actions if you need to fetch appName asynchronously
  },
  getters: {
    // Optionally define getters to access appName in a computed manner
  }
});

export default store;
