import axios from '@axios'
import { computed, reactive, ref, watch } from 'vue'
import { toast } from 'vue3-toastify';
import 'vue3-toastify/dist/index.css';
import route from 'ziggy-js'

export default function useRoles() {
  // Use toast
  const isLoading = ref(false)

  const respResult = ref(null)
  const refListTable = ref(null)

  // Table Handlers
  const tableColumns = ref([
    { label: "Name" },
    { label: "Assigned Permissions" },
  ])

  const filters = reactive({
    
  })

  const roles = ref([])
  const perPage = ref(10)
  const totalRecords = ref(0)
  const currentPage = ref(1)
  const totalPages = ref(1)
  const perPageOptions = [10, 25, 50, 100]
  const searchQuery = ref('')
  const sortBy = ref('id')
  const isSortDirDesc = ref(true)
  const roleId = ref(null)
  const role = ref({})
  const errors = ref({})

  const paginationData = computed(() => {
    const firstIndex = roles.value.length ? (currentPage.value - 1) * perPage.value + 1 : 0
    const lastIndex = roles.value.length + (currentPage.value - 1) * perPage.value
  
    return `Showing ${ firstIndex } to ${ lastIndex } of ${ totalRecords.value } entries`
  })

  const refetchData = () => {
    refListTable.value.refresh()
  }


  const deleteRole = async id => {
    try {
      isLoading.value = true

      const res = await axios.delete(route('roles.destroy', id))

      respResult.value = res
      toast.success(res.data.message)
      // refetchData()
    } catch (error) {
      console.log(error)
      toast.error('Error! Deleting role')
    } finally {
      isLoading.value = false
    }
  }

  const getRole = async id => {
    const response = await axios.get(route('roles.show', id))

    role.value = response.data.data
  }


  const updateRole = async (formData, id) => {
    try {
      isLoading.value = true

      const response = await axios.post(route('roles.update', id), formData)

      respResult.value = response
      toast.success(response.data.message)
    } catch (error) {
      if (error.response.status === 422) {
        errors.value = error.response.data.errors
      }
      toast.error(error.response.data.message)
    } finally {
      isLoading.value = false
    }
  }




  const storeRole = async formData => {
    isLoading.value = true
    await axios
      .post(route('roles.store'), formData)
      .then(resp => {
        respResult.value = resp
        toast.success(resp.data.message)
      })
      .catch(err => {
        respResult.value = err
        if (err.response.status === 422) {
          toast.error(err.response.data.message)
        }
      }).finally(() => {
        isLoading.value = false
      })
  }

  const fetchRoles = async () => {
    isLoading.value = true
    try {
      const response = await axios.get(route('roles.index'), {
        params: {
          q: searchQuery.value,
          perPage: perPage.value,
          page: currentPage.value,
          sortBy: sortBy.value,
          sortDesc: isSortDirDesc.value,
          ...filters,
        },
      })

      const { total, last_page } = response.data.meta

      totalPages.value = last_page
      roles.value = response.data.data
      totalRecords.value = total
    } catch (e) {
      toast.error(e.response.data.message)
    } finally {
      isLoading.value = false
    }
  }

  const fetchRolesList = async role => {
    isLoading.value = true
    try {
      const response = await axios.get(route('roles.index'), {
        params: {
          ...filters,
        },
      })

      roles.value = response.data.data
    } catch (e) {
      toast.error(e.response.data.message)
    } finally {
      isLoading.value = false
    }
  }

  const resolveRoleRoleVariant = role => {
    if (role === 'admin')
      return {
        color: 'warning',
        icon: 'tabler-shield-check',
      }
    if (role === 'user')
      return {
        color: 'success',
        icon: 'tabler-role',
      }
    
    return {
      color: 'primary',
      icon: 'tabler-role',
    }
  }


  watch([currentPage, perPage, searchQuery, filters], () => {
    fetchRoles()
  })

  return {
    role,
    isLoading,
    errors,
    getRole,
    roleId,
    sortBy,
    perPage,
    totalPages,
    filters,
    paginationData,
    respResult,
    roles,
    fetchRoles,
    deleteRole,
    refetchData,
    updateRole,
    storeRole,
    currentPage,
    searchQuery,
    refListTable,
    totalRecords,
    tableColumns,
    isSortDirDesc,
    fetchRolesList,
    perPageOptions,
    resolveRoleRoleVariant,
  }
}
