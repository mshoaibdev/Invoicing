import { setupLayouts } from 'virtual:generated-layouts'
import { createRouter, createWebHistory } from 'vue-router'

import { isUserLoggedIn } from './utils'

import accountSettingsRoutes from './account-settings'
import authRoutes from './auth'
import customersRoutes from './customers'

// import estimatesRoutes from './estimates'
import invoicesRoutes from './invoices'

// import calendarRoutes from './calendar'
// import projectsRoutes from './projects'


const routes = [
  {
    path: '/dashboard',
    name: 'dashboard',
    component: () => import('@/views/Dashboard.vue'),
    meta: {
      auth: true,
      action: 'Read',
      subject: 'All',
    },
  },

  // ...projectsRoutes,
  // ...calendarRoutes,
  // ...estimatesRoutes,
  ...customersRoutes,
  ...invoicesRoutes,
  ...accountSettingsRoutes,
  {
    path: '/not-authorized',
    name: 'not-authorized',
    component: () => import('@/views/pages/not-authorized.vue'),
    meta: {
      auth: false,
    },
  },
  {
    path: '/not-found',
    name: 'not-found',
    component: () => import('@/views/pages/not-found.vue'),
    meta: {
      auth: true,
    },
  },
]

const router = createRouter({
  history: createWebHistory(),
  routes: [
    ...authRoutes,
    ...setupLayouts(routes),
  ],
})

router.beforeEach((to, _, next) => {
  const isLoggedIn = isUserLoggedIn()

  // Redirect to dashboard if user is logged in
  if (isLoggedIn && to.meta.redirectIfLoggedIn) {
    next({ name: 'dashboard' })
  } else if (!isLoggedIn && to.meta.auth) {
    return next({ name: 'login' })
  } 
  
  // else if (!canNavigate(to) && to.meta.auth) {
  //   return next({ name: 'not-authorized' })
  // }

  return next()
})

// Docs: https://router.vuejs.org/guide/advanced/navigation-guards.html#global-before-guards
export default router
