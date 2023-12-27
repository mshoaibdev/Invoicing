import axios from 'axios'
import router from '@/router'
import useJwtService from "@/composables/jwtService"

const { removeToken, removeUserData, removeUserAbilities, getUser } = useJwtService()

const axiosIns = axios.create({
  // baseURL: process.env.VITE_LIVE_APP_URL
})

const unsetStorage = () => {

  removeToken()
  removeUserData()
  removeUserAbilities()
}

// ℹ️ Add request interceptor to send the authorization header on each subsequent request after login
axiosIns.interceptors.request.use(config => {
  // Retrieve token from localStorage
  const token = localStorage.getItem('token')

  // If token is found
  if (token) {
    // Get request headers and if headers is undefined assign blank object
    config.headers = config.headers || {}

    // Set authorization header
    // ℹ️ JSON.parse will convert token to string
    config.headers.Authorization = token ? `Bearer ${token}` : ''
  }

  // Return modified config
  return config
})

// ℹ️ Add response interceptor to handle 401 response
axiosIns.interceptors.response.use(response => {
  return response
}, error => {
  // Handle error
  if (error.response.status === 401) {

    unsetStorage()

    router.push('/login')

    return Promise.reject(error)
  }
  else {
    return Promise.reject(error)
  }
})
export default axiosIns
