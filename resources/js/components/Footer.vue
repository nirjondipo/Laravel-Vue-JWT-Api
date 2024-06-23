<template>
    <div class="footer">
        <footer class="content-footer footer bg-footer-theme">
            <div class="container-xxl">
              <div
                class="footer-container d-flex align-items-center justify-content-between py-2 flex-md-row flex-column">
                <div>
                    &copy; {{ currentYear }}, made with ❤️ by
                  <router-link to="/" class="footer-link text-primary fw-medium">{{ appName }}</router-link>
                </div>
              </div>
            </div>
          </footer>
    </div>
</template>

  <script>
    import { mapState } from 'vuex';
    export default {
        data() {
            return {
            currentYear: new Date().getFullYear()
            };
        },
        computed: {
        ...mapState(['appName']),
        },
    };
  </script>

  <style scoped>
  /* Add your styles here */
  footer {
    background-color: #f8f9fa;
    padding: 1rem;
    text-align: center;
  }
  </style>


