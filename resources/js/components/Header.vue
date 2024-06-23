<template>
    <nav
    class="layout-navbar container navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
    id="layout-navbar">
    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
      <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
        <i class="ti ti-menu-2 ti-sm"></i>
      </a>
    </div>

    <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
        <h3 class="font-semibold text-xl text-gray-800 mb-0">
            {{ route.meta.title }}
        </h3>
      <ul class="navbar-nav flex-row align-items-center ms-auto">
        <!-- User -->
        <li class="nav-item navbar-dropdown dropdown-user dropdown">
          <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
            <div class="avatar avatar-online">
              <img src="/assets/img/avatars/1.png" alt class="h-auto rounded-circle" />
            </div>
          </a>
          <ul class="dropdown-menu dropdown-menu-end">
            <li>
              <a class="dropdown-item" href="#">
                <div class="d-flex">
                  <div class="flex-shrink-0 me-3">
                    <div class="avatar avatar-online">
                      <img src="/assets/img/avatars/1.png" alt class="h-auto rounded-circle" />
                    </div>
                  </div>
                  <div class="flex-grow-1">
                    <span class="fw-medium d-block">John Doe</span>
                    <small class="text-muted">Admin</small>
                  </div>
                </div>
              </a>
            </li>
            <li>
              <div class="dropdown-divider"></div>
            </li>
            <li>
              <a class="dropdown-item" href="#">
                <i class="ti ti-user-check me-2 ti-sm"></i>
                <span class="align-middle">My Profile</span>
              </a>
            </li>
            <li>
              <a class="dropdown-item" href="#">
                <i class="ti ti-settings me-2 ti-sm"></i>
                <span class="align-middle">Settings</span>
              </a>
            </li>
            <li>
              <a class="dropdown-item" href="#">
                <span class="d-flex align-items-center align-middle">
                  <i class="flex-shrink-0 ti ti-credit-card me-2 ti-sm"></i>
                  <span class="flex-grow-1 align-middle">Billing</span>
                  <span class="flex-shrink-0 badge badge-center rounded-pill bg-label-danger w-px-20 h-px-20"
                    >2</span
                  >
                </span>
              </a>
            </li>
            <li>
              <div class="dropdown-divider"></div>
            </li>
            <li class="nav-item" v-if="isLoggedIn">
                <router-link to="/" class="dropdown-item" @click="handleLogout"><i class="ti ti-logout me-2 ti-sm"></i> <span class="align-middle">Logout</span></router-link>
            </li>
          </ul>
        </li>
        <!--/ User -->
      </ul>
    </div>
  </nav>
  </template>

  <script>
    import { computed } from 'vue';
    import { getAuthStatus, logout } from '../auth'; // Adjust path as per your setup
    import { useRoute, useRouter } from 'vue-router';
    import { toast } from '../toastify'; // Adjust path as per your project structure
    export default {
    setup() {
        const isLoggedIn = computed(() => getAuthStatus().value);
        const route = useRoute();
        const router = useRouter();

        const handleLogout = () => {
        logout();
        // Redirect or handle navigation after logout
        toast.success('Done Logout');
        router.push({ name: 'login' }); // Adjust 'login' to match your route name
        };

        return {
        isLoggedIn,
        route,
        handleLogout,
        };
    },
    };
  </script>

  <style scoped>
  /* Scoped styles for Navbar.vue */
  .nav-link {
    cursor: pointer; /* Optional: Add cursor pointer for links */
  }
  </style>
