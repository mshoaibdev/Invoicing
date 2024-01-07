import axios from '@axios'
import { computed, reactive, ref, watch } from 'vue'
import { toast } from 'vue3-toastify';
import 'vue3-toastify/dist/index.css';
import route from 'ziggy-js'
import { debounce } from 'lodash'

export default function useUsers() {
  // Use toast
  const isLoading = ref(false)

  const respResult = ref(null)
  const refListTable = ref(null)

  const headers = [
    {
      title: 'Name',
      key: 'name',
      sortable: false,
    },
    {
      title: 'Personal Phone',
      key: 'phone',
      sortable: false,
    },
    {
      title: 'Address',
      key: 'address.address_street_1',
      sortable: false,
    },
    {
      title: 'Zip',
      key: 'address.zip',
      sortable: false,
    },
    {
      title: 'State',
      key: 'address.state',
      sortable: false,
    },
    {
      title: 'City',
      key: 'address.city',
      sortable: false,
    },
    {
      title: 'Country',
      key: 'address.country.name',
      sortable: false,
    },
    {
      title: 'Home Phone',
      key: 'address.phone',
      sortable: false,
    },
    {
      title: 'Role',
      key: 'role',
      sortable: false,
    },
    {
      title: 'Date Added',
      key: 'created_at',
      sortable: false,
    },
    {
      title: 'Actions',
      key: 'actions',
      sortable: false,
    },
  ]

  const filters = reactive({
    
  })

  const users = ref([])
  const itemsPerPage = ref(10)
  const totalRecords = ref(0)
  const currentPage = ref(1)
  const totalPages = ref(1)
  const perPageOptions = [10, 25, 50, 100]
  const searchQuery = ref('')
  const sortBy = ref('id')
  const isSortDirDesc = ref(true)
  const userId = ref(null)
  const user = ref({})
  const errors = ref({})

  const refetchData = () => {
    refListTable.value.refresh()
  }


  const deleteUser = async id => {
    try {
      isLoading.value = true

      const res = await axios.delete(route('users.destroy', id))

      respResult.value = res
      toast.success(res.data.message)
      // refetchData()
    } catch (error) {
      console.log(error)
      toast.error('Error! Deleting user')
    } finally {
      isLoading.value = false
    }
  }

  const getUser = async id => {
    const response = await axios.get(route('users.show', id))

    user.value = response.data.data
  }


  const updateUser = async (formData, id) => {
    try {
      isLoading.value = true

      const response = await axios.post(route('users.update', id), formData)

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


  const updateUserStatus = async formData => {
    try {
      isLoading.value = true

      const response = await axios.post(route('users.status', formData.id), formData)

      respResult.value = response
      toast.success(response.data.message)
    } catch (e) {
      console.log(e)
      toast.error(e.response.data.message)
    } finally {
      isLoading.value = false
    }
  }


  const storeUser = async formData => {
    isLoading.value = true
    await axios
      .post(route('users.store'), formData)
      .then(resp => {
        respResult.value = resp
        toast.success(resp.data.message)
      })
      .catch(err => {
        respResult.value = err
        toast.error(err.response.data.message)
      }).finally(() => {
        isLoading.value = false
      })
  }

  const fetchUsers = async () => {
    isLoading.value = true
    try {
      const response = await axios.get(route('users.index'), {
        params: {
          q: searchQuery.value,
          perPage: itemsPerPage.value,
          page: currentPage.value,
          sortBy: sortBy.value,
          sortDesc: isSortDirDesc.value,
          ...filters,
        },
      })

      const { total, last_page } = response.data.meta

      totalPages.value = last_page
      users.value = response.data.data
      totalRecords.value = total
    } catch (e) {
      toast.error(e.response.data.message)
    } finally {
      isLoading.value = false
    }
  }

  const fetchUsersList = async role => {
    isLoading.value = true
    try {
      const response = await axios.get(route('users.index'), {
        params: {
          ...filters,
        },
      })

      users.value = response.data.data
    } catch (e) {
      toast.error(e.response.data.message)
    } finally {
      isLoading.value = false
    }
  }

  const resolveUserRoleVariant = role => {


    if (['Admin','admin', 'super admin', 'Supe Admin', 'super-admin'].includes(role))
      return {
        color: 'warning',
        icon: 'tabler-shield-check',
      }
    if (role === 'user')
      return {
        color: 'success',
        icon: 'tabler-user',
      }
    
    return {
      color: 'primary',
      icon: 'tabler-user',
    }
  }

  const debouncedSearch = debounce(() => {
    fetchUsers()
  }, 500)

  watch(searchQuery, () => {
    debouncedSearch()
  })
  


  watch([currentPage, itemsPerPage], () => {
    fetchUsers()
  })

  return {
    user,
    isLoading,
    errors,
    getUser,
    userId,
    sortBy,
    itemsPerPage,
    totalPages,
    filters,
    respResult,
    users,
    fetchUsers,
    deleteUser,
    refetchData,
    updateUser,
    currentPage,
    searchQuery,
    refListTable,
    totalRecords,
    headers,
    isSortDirDesc,
    perPageOptions,
    storeUser,
    fetchUsersList,
    updateUserStatus,
    resolveUserRoleVariant,
  }
}
