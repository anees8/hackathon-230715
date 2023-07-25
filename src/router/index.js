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
      path: '/orders',
      name: 'orders',
      component: () => import('../views/OrdersView.vue'),
      meta: {
        requireAuth: true,
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
