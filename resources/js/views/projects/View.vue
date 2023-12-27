<script setup>
import useProjects from '@/composables/projects'
import { formatCurrency } from '@core/utils/formatters'

const props = defineProps({
  isDialogVisible: {
    type: Boolean,
    required: true,
  },
  projectId: {
    type: Number,
    required: true,
  },
})

const emit = defineEmits([
  'update:isDialogVisible',
  'editCustomer',
  'deleteCustomer',
])


const { getProject, projectData, isLoading } = useProjects()


// mount
onMounted(async () => {
  if(props.isDialogVisible){
    await getProject(props.projectId)
  }
})

const dialogModelValueUpdate = val => {
  emit('update:isDialogVisible', val)
}
</script>

<template>
  <VDialog
    :width="$vuetify.display.smAndDown ? 600 : '60%'"
    :model-value="isDialogVisible"
    @update:model-value="dialogModelValueUpdate"
  >
    <!-- Dialog close btn -->
    <DialogCloseBtn @click="dialogModelValueUpdate(false)" />
    <VCard v-if="projectData.user">
      <VCardText>
        <VRow>
          <VCol 
            cols="12"
            lg="12"
            md="12"
            sm="12"
          >
            <p class="text-sm text-uppercase text-disabled">
              Project Details
            </p>

            <VTable>
              <tbody>
                <tr>
                  <th>
                    Project Title:
                  </th>
                  <td>
                    {{ projectData.title }}
                  </td>
                </tr>
                <tr>
                  <th>
                    Assign User:
                  </th>
                  <td v-if="projectData.user">
                    {{ projectData.user.name }}
                  </td>
                </tr>
                <tr>
                  <th>
                    Contact Info:
                  </th>
                  <td>
                    {{ projectData.contact_info }}
                  </td>
                </tr>
                <tr>
                  <th>
                    Pricing:
                  </th>
                  <td>
                    {{ projectData.price }}
                  </td>
                </tr>
                <tr>
                  <th>
                    Timing:
                  </th>
                  <td>
                    {{ projectData.time }}
                  </td>
                </tr>

                <tr>
                  <th>
                    Type:
                  </th>
                  <td>
                    {{ projectData.type }}
                  </td>
                </tr>

                <tr>
                  <th>
                    Status:
                  </th>
                  <td>
                    {{ projectData.status }}
                  </td>
                </tr>

                <tr>
                  <th>
                    Date Added At:
                  </th>
                  <td>
                    {{ projectData.added_date }}
                  </td>
                </tr>

                <tr>
                  <th>
                    Last Work On:
                  </th>
                  <td>
                    {{ projectData.last_worked_on }}
                  </td>
                </tr>


                <tr>
                  <th>
                    Notes:
                  </th>
                  <td>
                    {{ projectData.description }}
                  </td>
                </tr>
              </tbody>
            </VTable>

           
          </VCol>
        </VRow>
      </VCardText>
    </VCard>
  </VDialog>
</template>

