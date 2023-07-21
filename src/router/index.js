import { createRouter, createWebHistory } from 'vue-router'
import { useLoginStore } from "@/stores/login.js";

const router = createRouter({
  scrollBehavior(to, from, savedPosition) {
    // always scroll to top
    return { top: 0 };
},
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'login',
      component: () => import('../views/LoginView.vue'),
      meta: {
        requireAuth: false,
    },
    },
    {
      path: '/logout',
      name: 'logout',
      component: () => import('../views/LogoutView.vue'),
      meta: {
        requireAuth: true,
    },
    },
    {
      path: '/dashboard',
      name: 'dashboard',
      component: () => import('../views/DashboardView.vue'),
      meta: {
        requireAuth: true,
    },
    },
    {
      path: '/users',
      name: 'users',
      component: () => import('../views/UsersView.vue'),
      meta: {
        requireAuth: true,
    },
    },
    {
      path: '/tailors',
      name: 'tailors',
      component: () => import('../views/TailorsView.vue'),
      meta: {
        requireAuth: true,
    },
    },
    
    {
      path: '/tailor/:id',
      name: 'tailorview',
      component: () => import('../views/Tailors/ViewTailorOrder.vue'),
      meta: {
        requireAuth: true,
    },
    },
    {
      path: '/orders',
      name: 'orders',
      component: () => import('../views/OrdersView.vue'),
      meta: {
        requireAuth: true,
    },
    },
    {
      path: '/sizes',
      name: 'sizes',
      component: () => import('../views/SizesView.vue'),
      meta: {
        requireAuth: true,
    },
    },
    {
      path: '/product_types',
      name: 'product_types',
      component: () => import('../views/ProductTypesView.vue'),
      meta: {
        requireAuth: true,
    },
    },
    
    {
      path: '/skus',
      name: 'skus',
      component: () => import('../views/SkusView.vue'),
      meta: {
        requireAuth: true,
    },
    },

    
    {
      path: '/:catchAll(.*)',
      name: 'notfound',
      component: () => import('../components/common/NotFound.vue'),
      meta: {
        requireAuth: false,
    },
    },
  ]
})

router.beforeEach((to, from, next) => {
  const { getAccessToken } = useLoginStore();
  if (to.meta.requireAuth && getAccessToken === null) {
      next({ name: "login" });
  }
  if (
      to.name === "login" &&
      !to.meta.requireAuth &&
      getAccessToken !== null
  ) {
      next({ name: "dashboard" });
  }
  next();
});

export default router
