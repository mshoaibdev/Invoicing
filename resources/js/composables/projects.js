import axios from '@axios'
import { debounce } from 'lodash'
import { computed, reactive, ref, watch } from 'vue'
import { toast } from 'vue3-toastify';
import 'vue3-toastify/dist/index.css';
import route from 'ziggy-js'

export default function useProjects() {
  // Use toast
  const isLoading = ref(false)
  const respResult = ref(null)
  const refListTable = ref(null)

  // Table Handlers
  const headers = [
    {
      title: '#Project ID',
      key: 'project_number',
      sortable: false,
    },
    {
      title: 'Title',
      key: 'title',
      sortable: false,
    },
    {
      title: 'Project Type',
      key: 'type',
      sortable: false,
    },
    {
      title: 'Date Added',
      key: 'added_date',
      sortable: false,
    },
    {
      title: 'Last worked on',
      key: 'last_worked_on',
      sortable: false,
    },
    
    {
      title: 'Status',
      key: 'status',
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

  const projects = ref([])
  const projectsByStatus = ref([])
  const itemsPerPage = ref(10)
  const totalRecords = ref(0)
  const currentPage = ref(1)
  const totalPages = ref(1)
  const perPageOptions = [10, 25, 50, 100]
  const searchQuery = ref('')
  const sortBy = ref('id')
  const isSortDirDesc = ref(true)
  const projectId = ref(null)
  const projectData = ref({})
  const errors = ref({})

  const paginationData = computed(() => {
    const firstIndex = projects.value.length ? (currentPage.value - 1) * itemsPerPage.value + 1 : 0
    const lastIndex = projects.value.length + (currentPage.value - 1) * itemsPerPage.value
  
    return `Showing ${ firstIndex } to ${ lastIndex } of ${ totalRecords.value } entries`
  })

  const refetchData = () => {
    refListTable.value.refresh()
  }


  const deleteProject = async id => {
    try {
      isLoading.value = true

      const res = await axios.delete(route('projects.destroy', id))

      respResult.value = res
      toast.success(res.data.message)

      // refetchData()
    } catch (error) {
      console.log(error)
      toast.error('Error! Deleting project')
    } finally {
      isLoading.value = false
    }
  }

  const getProject = async id => {
    const response = await axios.get(route('projects.show', id))

    projectData.value = response.data.data
  }


  const updateProject = async (id, formData) => {
    try {
      isLoading.value = true

      const response = await axios.post(route('projects.update', id), formData)

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


  const updateProjectStatus = async (id, formData) => {
    try {
      isLoading.value = true  

      const response = await axios.post(route('projects.status', id), formData)

      respResult.value = response
      toast.success(response.data.message)
    } catch (e) {
      console.log(e)
      if (e.response.status === 422) {
        toast.error(e.response.data.message)
      }
    } finally {
      isLoading.value = false
    }
  }



  const storeProject = async formData => {
    isLoading.value = true
    await axios
      .post(route('projects.store'), formData)
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


  const fetchProjects = async () => {
    isLoading.value = true
    try {
      const response = await axios.get(route('projects.index'), {
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
      projects.value = response.data.data
      totalRecords.value = total
    } catch (e) {
      toast.error(e.response.data.message)
    } finally {
      isLoading.value = false
    }
  }

  const fetchProjectsByStatus= async () => {
    isLoading.value = true
    try {
      const response = await axios.get(route('projects.count-by-status'))

      projectsByStatus.value = response.data.data
    } catch (e) {
      toast.error(e.response.data.message)
    } finally {
      isLoading.value = false
    }
  }

  const fetchProjectsList = async role => {
    isLoading.value = true
    try {
      const response = await axios.get(route('projects.index'), {
        params: {
          ...filters,
        },
      })

      projects.value = response.data.data
    } catch (e) {
      toast.error(e.response.data.message)
    } finally {
      isLoading.value = false
    }
  }

  

  const debouncedSearch = debounce(() => {
    fetchProjects()
  }, 500)

  watch(searchQuery, () => {
    debouncedSearch()
  })
  


  watch([currentPage, itemsPerPage, filters], () => {
    fetchProjects()
  })

  return {
    projectData,
    isLoading,
    errors,
    getProject,
    projectId,
    sortBy,
    itemsPerPage,
    totalPages,
    filters,
    paginationData,
    respResult,
    fetchProjectsByStatus,
    projects,
    projectsByStatus,
    fetchProjects,
    deleteProject,
    refetchData,
    updateProject,
    currentPage,
    searchQuery,
    refListTable,
    totalRecords,
    headers,
    isSortDirDesc,
    perPageOptions,
    storeProject,
    fetchProjectsList,
    updateProjectStatus,
  }
}
