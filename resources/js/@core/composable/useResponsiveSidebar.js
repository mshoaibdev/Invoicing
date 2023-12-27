import { useDisplay } from 'vuetify'

export const useResponsiveLeftSidebar = (mobileBreakpoint = undefined) => {
  const { mdAndDown, name: currentBreakpoint } = useDisplay()
  const _mobileBreakpoint = mobileBreakpoint || mdAndDown
  const isLeftSidebarOpen = ref(false)

  const setInitialValue = () => {
    isLeftSidebarOpen.value = !_mobileBreakpoint.value
  }


  // Set the initial value of sidebar
  // setInitialValue()
  watch(currentBreakpoint, () => {
    // Reset left sidebar
    // isLeftSidebarOpen.value = !_mobileBreakpoint.value
  })
  
  return {
    isLeftSidebarOpen,
  }
}


// isRightSidebarOpen


export const useResponsiveRightSidebar = (mobileBreakpoint = undefined) => {
  const { mdAndDown, name: currentBreakpoint } = useDisplay()
  const _mobileBreakpoint = mobileBreakpoint || mdAndDown
  const isRightSidebarOpen = ref(false)

  const setInitialValue = () => {
    isRightSidebarOpen.value = !_mobileBreakpoint.value
  }


  // Set the initial value of sidebar
  // setInitialValue()
  watch(currentBreakpoint, () => {
    // Reset left sidebar
    // isRightSidebarOpen.value = !_mobileBreakpoint.value
  })
  
  return {
    isRightSidebarOpen,
  }
}