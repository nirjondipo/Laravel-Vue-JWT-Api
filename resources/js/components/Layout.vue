<template>
    <div v-if="!hideLayout" class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <div class="layout-page">
                <header-component></header-component>
                <sidebar-component></sidebar-component>
                <div class="content-wrapper">
                    <div class="container flex-grow-1 p-0 pt-4">
                        <slot></slot>
                    </div>
                    <footer-component></footer-component>
                    <div class="content-backdrop fade"></div>
                </div>
            </div>
        </div>
        <!-- Overlay -->
        <div class="layout-overlay layout-menu-toggle"></div>

        <!-- Drag Target Area To SlideIn Menu On Small Screens -->
        <div class="drag-target"></div>
    </div>
      <div v-else>
        <slot></slot>
      </div>
  </template>

  <script>
  export default {
    computed: {
      hideLayout() {
        return this.$route.meta.hideLayout;
      }
    }
  };
  </script>

  <style scoped lang="scss">
  /* Add your styles here */
  </style>
