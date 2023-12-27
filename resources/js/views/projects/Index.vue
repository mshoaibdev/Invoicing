<script setup>
import useProjects from '@/composables/projects'
import projectStatus from '@/data/projectStatus'
import { VDataTableServer } from 'vuetify/labs/VDataTable'
import ViewProject from './View.vue'
import AddProject from './Add.vue'


const { projects, totalRecords, isLoading, fetchProjects, updateProjectStatus, currentPage, headers, deleteProject, itemsPerPage, searchQuery, filters, paginationData, projectsByStatus } = useProjects()
const selectedRows = ref([])
const isEditProjectDialogVisible = ref(false)
const isViewProjectDialogVisible = ref(false)
const isAddProjectDialogVisible = ref(false)
const isConfirmDialogVisible = ref(false)
const projectId = ref(0)


// filterProjects
const filterProjects = () => {

  fetchProjects()
}

// updateProjectStatus

const updateProjectStatusHandle = async (id, status) => {

  await updateProjectStatus(id, { status })
  await fetchProjects()
  
}

const tableColumns = ref([])

// computed 

const updateTableColumns = () => {

  const storageColumns = JSON.parse(localStorage.getItem('projects.table'))

  if(storageColumns) {
    tableColumns.value =  storageColumns.filter(column => column.visible === true)

  } else {
    tableColumns.value = headers
  }

}


updateTableColumns()


const toggleTableColumns = async items => {

  headers.forEach(header => {
    header.visible = items.includes(header.title)
  })


  localStorage.setItem('projects.table', JSON.stringify(headers))

  updateTableColumns()
 
}

// mount
onMounted(async () => {
  // await fetchProjectsByStatus()
  await fetchProjects()
})

const editProject = id => {
  projectId.value = id
  isEditProjectDialogVisible.value = true
}

const viewProject = id => {
  projectId.value = id
  isViewProjectDialogVisible.value = true
}

const deleteProjectConfirm = id => {
  isConfirmDialogVisible.value = true
  projectId.value = id
}

const confirmDelete = async ev => {
  if(ev === false) {
    isConfirmDialogVisible.value = false
    
    return
  }
  await deleteProject(projectId.value)
  isConfirmDialogVisible.value = false
  isViewProjectDialogVisible.value = false
  await fetchProjects()
}
</script>

<template>
  <VCard
    v-if="projects"
    id="invoice-list"
  >
    <VCardText class="d-flex align-center flex-wrap gap-4">
      <VRow>
        <VCol
          lg="3"
          md="3"
          sm="4"
          cols="12"
        >
          <div class="me-3 d-flex gap-3">
            <VBtn
              prepend-icon="tabler-plus"
              @click="isAddProjectDialogVisible = true"
            >
              Create Project
            </VBtn>
          </div>
        </VCol>
        <VCol
          lg="3"
          md="6"
          sm="8"
          cols="12"
        >
          <AppSelect
            v-model="tableColumns"
            label="Select Column Visibility "
            multiple
            eager
            :items="headers"
            @update:model-value="toggleTableColumns"
          > 
            <template #selection="{ item, index }">
              <VChip v-if="index < 4">
                <span>{{ item.title }}</span>
              </VChip>
              <span
                v-if="index === 4"
                class="text-grey text-caption align-self-center"
              >
                (+{{ tableColumns.length - 4 }} others)
              </span>
            </template>
          </AppSelect>
        </VCol>
        <VCol
          lg="3"
          md="3"
          cols="12"
          sm="6"
        >
          <AppTextField
            v-model="searchQuery"
            label="Search Projects"
            density="compact"
          />
        </VCol>

        <VCol
          lg="2"
          md="3"
          sm="6"
          cols="12"
        >
          <AppSelect
            v-model="filters.status"
            :items="projectStatus"
            item-title="name"
            item-value="id"
            label="Filter by Status"
            clearable
            clear-icon="tabler-x"
            density="compact"
            single-line
            @update:model-value="filterProjects"
          />
        </VCol>
      </VRow>
    </VCardText>

    <VDivider />

    <VDataTableServer
      v-model="selectedRows"
      v-model:items-per-page="itemsPerPage"
      v-model:page="currentPage"
      :loading="isLoading"
      :items-length="totalRecords"
      :headers="tableColumns"
      :items="projects"
      class="text-no-wrap"
    >
      <template #item.title="{ item }">
        <div class="d-flex align-center">
          <a
            href="javascript:;" 
              
            @click="viewProject(item.raw.id)"
          >
            {{ item.raw.title }}
          </a>
        </div>
      </template>

      <template #item.status="{ item }">
        <div class="d-flex align-center">
          <AppSelect
            v-model="item.raw.status"
            :items="projectStatus"
            item-title="name"
            item-value="id"
            @update:model-value="updateProjectStatusHandle(item.raw.id, $event)"
          />
        </div>
      </template>
            
      <!-- Actions -->
      <template #item.actions="{ item }">
        <IconBtn @click="deleteProjectConfirm(item.raw.id)">
          <VIcon icon="tabler-trash" />
        </IconBtn>
        <IconBtn @click="viewProject(item.raw.id)">
          <VIcon icon="tabler-eye" />
        </IconBtn>
        <!--
          <IconBtn @click="editProject(item.raw.id)">
          <VIcon icon="tabler-pencil" />
          </IconBtn>
        -->
      </template>
    </VDataTableServer>
    <ViewProject
      v-if="isViewProjectDialogVisible"
      v-model:isDialogVisible="isViewProjectDialogVisible"
      :project-id="projectId"
    />

    <AddProject
      v-if="isAddProjectDialogVisible"
      v-model:isDialogVisible="isAddProjectDialogVisible"
      :project-id="projectId"
      @refetch-data="fetchProjects"
    />


    <ConfirmDialog
      v-model:isDialogVisible="isConfirmDialogVisible"
      cancel-title="Cancelled"
      confirm-title="Deleted"
      confirm-msg="Project deleted successfully."
      confirmation-question="Are you sure you want to delete this project? This action cannot be undone."
      cancel-msg="Project deletion cancelled."
      @confirm="confirmDelete"
    />
  </VCard>
</template>

