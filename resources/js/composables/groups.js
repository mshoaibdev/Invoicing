import axios from '@axios'
import { debounce } from 'lodash'

import { toast } from 'vue3-toastify';
import 'vue3-toastify/dist/index.css';

import route from 'ziggy-js'

export default function useGroups() {
  // Use toast
  const isLoading = ref(false)

  const respResult = ref(null)
  const refListTable = ref(null)

  // Table Handlers
  const headers = [
    {
      title: '#ID',
      key: 'id',
    },
    {
      title: 'Name',
      key: 'name',
      sortable: false,
    },
    {
      title: 'Description',
      key: 'description',
      sortable: false,
    },
    {
      title: 'Actions',
      key: 'actions',
      sortable: false,
    },
  ]

  const filters = reactive({
    status: '',
  })

  const groups = ref([])
  const groupsByStatus = ref([])
  const itemsPerPage = ref(10)
  const totalRecords = ref(0)
  const currentPage = ref(1)
  const totalPages = ref(1)
  const perPageOptions = [10, 25, 50, 100]
  const searchQuery = ref('')
  const sortBy = ref('id')
  const isSortDirDesc = ref(true)
  const groupId = ref(null)
  const groupData = ref({})
  const errors = ref({})

  const paginationData = computed(() => {
    const firstIndex = groups.value.length ? (currentPage.value - 1) * itemsPerPage.value + 1 : 0
    const lastIndex = groups.value.length + (currentPage.value - 1) * itemsPerPage.value
  
    return `Showing ${ firstIndex } to ${ lastIndex } of ${ totalRecords.value } entries`
  })

  const refetchData = () => {
    refListTable.value.refresh()
  }


  const deleteGroup = async id => {
    try {
      isLoading.value = true

      const res = await axios.delete(route('groups.destroy', id))

      respResult.value = res
      toast.success(res.data.message)

      // refetchData()
    } catch (error) {
      console.log(error)
      toast.error('Error! Deleting group')
    } finally {
      isLoading.value = false
    }
  }

  const getGroup = async id => {
    const response = await axios.get(route('groups.show', id))

    groupData.value = response.data.data
  }


  const updateGroup = async (id, formData) => {
    try {
      isLoading.value = true

      const response = await axios.put(route('groups.update', id), formData)

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



  const storeGroup = async formData => {
    isLoading.value = true
    await axios
      .post(route('groups.store'), formData)
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


  const fetchGroups = async () => {
    isLoading.value = true
    try {
      const response = await axios.get(route('groups.index'), {
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
      groups.value = response.data.data
      totalRecords.value = total
    } catch (e) {
      toast.error(e.response.data.message)
    } finally {
      isLoading.value = false
    }
  }


  const fetchGroupsList = async role => {
    isLoading.value = true
    try {
      const response = await axios.get(route('groups.index'), {
        params: {
          ...filters,
        },
      })

      groups.value = response.data.data
    } catch (e) {
      toast.error(e.response.data.message)
    } finally {
      isLoading.value = false
    }
  }

  const debouncedSearch = debounce(() => {
    fetchGroups()
  }, 500)

  watch(searchQuery, () => {
    debouncedSearch()
  })
  


  watch([currentPage, itemsPerPage, filters], () => {
    fetchGroups()
  })

  return {
    groupData,
    isLoading,
    errors,
    getGroup,
    groupId,
    sortBy,
    itemsPerPage,
    totalPages,
    filters,
    paginationData,
    respResult,
    groups,
    groupsByStatus,
    fetchGroups,
    deleteGroup,
    refetchData,
    updateGroup,
    currentPage,
    searchQuery,
    refListTable,
    totalRecords,
    headers,
    isSortDirDesc,
    perPageOptions,
    storeGroup,
    fetchGroupsList,
  }
}
