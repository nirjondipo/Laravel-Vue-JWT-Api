import HomePage from './pages/HomePage.vue';
import Product from './pages/Product.vue';
import UserList from './pages/UserList.vue';
import Login from './pages/Login.vue';
import Register from './pages/Register.vue';
import AddProduct from './pages/AddProduct.vue';
const routes = [
    {
        path: '/',
        name: 'home',
        component: HomePage,
        meta: {
            requiresAuth: true,
            title: 'Dashboard',
            hideLayout: false
        }
    },
    {
        path: '/login',
        name: 'login',
        component: Login,
        meta: {
            title: 'Login',
            hideLayout: true
        }
    },
    {
        path: '/register',
        name: 'register',
        component: Register,
        meta: {
            requiresAuth: true,
            title: 'Register',
            hideLayout: true
        }
    },
    {
        path: '/product',
        name: 'product',
        component: Product,
        meta: {
            title: 'Product Page',
            requiresAuth: true,
            hideLayout: false
        }
    },
    {
        path: '/add-product',
        name: 'addproduct',
        component: AddProduct,
        meta: {
            title: 'Add Product',
            requiresAuth: true,
            hideLayout: false
        }
    },
    {
        path: '/user',
        name: 'userlist',
        component: UserList,
        meta: {
            title: 'User List',
            requiresAuth: true,
            hideLayout: false
        }
    }
];

export default routes;
