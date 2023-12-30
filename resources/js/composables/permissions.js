import axios from '@axios'
import { computed, ref, watch } from 'vue'
import { toast } from 'vue3-toastify';
import 'vue3-toastify/dist/index.css';
import route from 'ziggy-js'

export default function usePermissions() {

  // Use toast
  const isLoading = ref(false)

  const busy = ref(false)
  const respResult = ref(null)
  const permissions = ref([])
  const errors = ref({})
  const perPage = ref(20)
  const totalRecords = ref(0)
  const currentPage = ref(1)
  const perPageOptions = [10, 25, 50, 100]
  const searchQuery = ref('')
  const sortBy = ref('name')
  const isSortDirDesc = ref(true)
  const refListTable = ref(null)

  const tableColumns = [
    // { key: 'id', sortable: false },
    { key: 'name', sortable: true },
    { key: 'actions' },
  ]


  const dataMeta = computed(() => {
    const localItemsCount = refListTable.value ? refListTable.value.localItems.length : 0
    
    return {
      from: perPage.value * (currentPage.value - 1) + (localItemsCount ? 1 : 0),
      to: perPage.value * (currentPage.value - 1) + localItemsCount,
      of: totalRecords.value,
    }
  })

  const fetchPermissions = async () => {
    try {
      const response = await axios.get(route('permissions.index'), {
        params: {
          q: searchQuery.value,
          perPage: perPage.value,
          page: currentPage.value,
          sortBy: sortBy.value,
          sortDesc: isSortDirDesc.value,
        },
      })

      permissions.value = response.data.data
      if (response.data.meta) {
        const { total } = response.data.meta

        totalRecords.value = total
      }
    } catch (error) {
      if (error.message === 'Network Error') {
        toast.error(error.message)
      } else {
        respResult.value = error
        toast.error(error.response.data.message)
      }
    }
  }


  const storePermission = async data => {
    errors.value = ''
    try {
      busy.value = true

      const response = await axios.post(route('permissions.store'), data)

      respResult.value = response
      toast.success(response.data.message)
    } catch (error) {
      if (error.message === 'Network Error') {
        toast.error(error.message)
      } else {
        if (error.response.status === 422) {
          errors.value = error.response.data.errors
        }
        respResult.value = error
        toast.error(error.response.data.message)
      }
    } finally {
      busy.value = false
    }
  }


  const updatePermission = async data => {
    errors.value = ''
    try {
      busy.value = true

      const response = await axios.put(route('permissions.update', data.id), data)

      respResult.value = response
      toast.success(response.data.message)
    } catch (error) {
      if (error.message === 'Network Error') {
        toast.error(error.message)
      } else {
        if (error.response.status === 422) {
          errors.value = error.response.data.errors
        }
        respResult.value = error
        toast.error(error.response.data.message)
      }
    } finally {
      busy.value = false
    }
  }


  const deletePermission = async id => {
    try {
      busy.value = true

      const response = await axios.delete(route('permissions.destroy', id))

      toast.success(response.data.message)
      respResult.value = response
    } catch (error) {
      if (error.message === 'Network Error') {
        toast.error(error.message)
      } else {
        respResult.value = error
        toast.error(error.response.data.message)
      }
    } finally {
      busy.value = false
    }
  }

  const fetchPermissionsList = async (searchString = '') => {
    busy.value = true
    try {
      const response = await axios.get(route('permissions.index'), {
        params: {
          q: searchString,
        },
      })

      permissions.value = response.data.data
    } catch (e) {
      toast.error(e.response.data.message)
    } finally {
      busy.value = false
    }
  }

  watch([currentPage, perPage, searchQuery], () => {
    fetchPermissions()
  })

  return {
    busy,
    sortBy,
    errors,
    perPage,
    dataMeta,
    respResult,
    currentPage,
    permissions,
    searchQuery,
    tableColumns,
    isSortDirDesc,
    perPageOptions,
    storePermission,
    deletePermission,
    updatePermission,
    fetchPermissions,
    fetchPermissionsList,
  }
}
