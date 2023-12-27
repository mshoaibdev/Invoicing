
// jwt service
import axios from '@axios'

export default function useJwtService() {

  const setToken = newToken => {
    axios.defaults.headers.common.Authorization = `Bearer ${newToken}`
    localStorage.setItem('token', newToken)
  }

  const getUser = () => {
    const userData = localStorage.getItem('userData')
    if (!userData) {
      return null
    }
    
    return JSON.parse(userData)
  }


  const setUser = newUser => {
    
    localStorage.setItem('userData', JSON.stringify(newUser))
  }

  const removeToken = () => {
    // axios.defaults.headers.common.Authorization = undefined
    localStorage.removeItem('token')
  }

  //   removeUserData
  const removeUserData = () => {
    localStorage.removeItem('userData')
  }


  const removeUserAbilities = () => {
    localStorage.removeItem('userAbilities')
  }
  
  const setUserAbilities = userAbilities => {
    localStorage.setItem('userAbilities', JSON.stringify(userAbilities))
  }
    

  const initialize = () => {
    const tokenString = localStorage.getItem('token')
    if (tokenString) {
      setToken(tokenString)
    }
  }

  return {
    getUser,
    setToken,
    setUser,
    removeToken,
    removeUserData,
    setUserAbilities,
    removeUserAbilities,
    initialize,
  }

}
