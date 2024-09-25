import { createRouter, createWebHistory } from 'vue-router'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: '/',
      component: () => import('../views/sign.vue')
    },
    {
      path: '/home',
      name: 'home',
      component: () => import('../views/home.vue')
    },
    {
      path: '/reservation',
      name: 'reservation',
      component: () => import('../views/reservas.vue')
    },
    {
      path: '/warning',
      name: 'warning',
      component: () => import('../views/avisos.vue')
    },
    {
      path: '/users',
      name: 'users',
      component: () => import('../views/moradores.vue')
    },
    {
      path: '/house',
      name: 'house',
      component: () => import('../views/houses.vue')
    },
    {
      path: '/profile',
      name: 'profile',
      component: () => import('../views/profile.vue')
    },
    {
      path: '/security',
      name: 'security',
      component: () => import('../views/security.vue')
    },
    {
      path: '/report',
      name: 'report',
      component: () => import('../views/report.vue')
    },
    {
      path: '/documents',
      name: 'documents',
      component: () => import('../views/documents.vue')
    },
    {
      path: '/document',
      name: 'document',
      component: () => import('../views/document.vue')
    },
    {
      path: '/forgotPassword',
      name: 'forgotPassword',
      component: () => import('../views/forgotPassword.vue')
    },
  ]
})

router.beforeEach((to, from, next) => {
  const isActive = sessionStorage.getItem('activeState'); // Verifica se o estado está ativo no sessionStorage

  if (to.path === '/forgotPassword') {
    // Permite acesso à tela de recuperação de senha independentemente do estado
    next();
  } else if (isActive === "active" && to.path === '/login') {
    // Se o estado estiver ativo e o usuário tentar acessar a rota de login, redireciona para a rota principal
    next('/');
  } else {
    // Caso contrário, permite a navegação
    next();
  }
});

export default router;
