import { createRouter, createWebHistory } from 'vue-router'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'home',
      component: ()=> import('../views/home.vue')
    },
    {
      path: '/reservation',
      name: 'reservation',
      component: ()=> import('../views/reservas.vue')
    },
    {
      path: '/warning',
      name: 'warning',
      component: ()=> import('../views/avisos.vue')
    },
    {
      path: '/users',
      name: 'users',
      component: ()=> import('../views/moradores.vue')
    },
    {
      path: '/house',
      name: 'house',
      component: ()=> import('../views/houses.vue')
    },
    {
      path: '/profile',
      name: 'profile',
      component: ()=> import('../views/profile.vue')
    },
    {
      path: '/security',
      name: 'security',
      component: ()=> import('../views/security.vue')
    },
    {
      path: '/report',
      name: 'report',
      component: ()=> import('../views/report.vue')
    },
    {
      path: '/documents',
      name: 'documents',
      component: ()=> import('../views/documents.vue')
    },
    // {
    //   path: '/about',
    //   name: 'about',
    //   // route level code-splitting
    //   // this generates a separate chunk (About.[hash].js) for this route
    //   // which is lazy-loaded when the route is visited.
    //   component: () => import('../views/AboutView.vue')
    // }
  ]
})

export default router
