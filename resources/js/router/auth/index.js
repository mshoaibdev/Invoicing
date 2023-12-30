const routes = [
  {
    path: '/',
    name: 'login',
    component: () => import('@/views/auth/Login.vue'),
    meta: {
      redirectIfLoggedIn: true,
    },
  },
  {
    path: '/forgot-password',
    name: 'forgot-password',
    component: () => import('@/views/auth/ForgotPassword.vue'),
    meta: {
      redirectIfLoggedIn: true,
    },
  },
  {
    path: '/password-reset',
    name: 'password-reset',
    component: () => import('@/views/auth/ResetPassword.vue'),
    meta: {
      redirectIfLoggedIn: true,
    },
  },

]

export default routes
