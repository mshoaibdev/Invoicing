<script setup>
import useProjects from '@/composables/projects'
import { emailValidator, requiredValidator } from '@validators'
import projectStatus from '@/data/projectStatus'
import useUsers from '@/composables/users'


const props = defineProps({
  isDialogVisible: {
    type: Boolean,
    required: true,
  },
})

const emit = defineEmits([
  'refetchData',
  'update:isDialogVisible',
])

const { storeProject, errors, respResult, isLoading } = useProjects()

const { users, fetchUsersList } = useUsers()


onMounted(async () => {
  if(props.isDialogVisible){
    await fetchUsersList()
  }
})

const initialState = {
  title: '',
  description: '',
  contact_info: '',
  price: '',
  time: '',
  type: '',
  user_id: '',
  added_date: '',
  last_worked_on: '',
  status: '',
}


const formData = ref({ ...initialState })
const refForm = ref()

const resetFormData = () => {
  formData.value = {
    ...initialState,
  }
  nextTick(() => {
    refForm.value?.reset()
    refForm.value?.resetValidation()
  })
}

const onSubmit = async() => {
  refForm.value?.validate().then(async ({ valid: isValid }) => {
    if (isValid){
      const formNewData = new FormData()

      for (const key in formData.value) {
        if (Object.hasOwnProperty.call(formData.value, key)) {
          formNewData.append(key, formData.value[key])
        }
      }
      await storeProject(formNewData)
      if (respResult.value.status === 200) {
        emit('refetchData')
        emit('update:isDialogVisible', false)
        resetFormData()
      }
    }
  })
}

const dialogModelValueUpdate = val => {
  emit('update:isDialogVisible', val)
}
</script>

<template>
  <VDialog
    :width="$vuetify.display.smAndDown ? 'auto' : 1000"
    :model-value="props.isDialogVisible"
    persistent
    @update:model-value="dialogModelValueUpdate"
  >
    <!-- Dialog close btn -->
    <DialogCloseBtn @click="dialogModelValueUpdate(false)" />
    <VCard title="Add New Project">
      <VCardText>
        <!-- 👉 Form -->
        <VForm
          ref="refForm"
          @submit.prevent="onSubmit"
        >
          <VRow>
            <VCol
              cols="12"
              md="6"
            >
              <AppTextField
                v-model="formData.title"
                label="Project Title"
                :rules="[requiredValidator]"
              />
            </VCol>


            <VCol
              cols="12"
              md="6"
            >
              <AppSelect
                v-model="formData.user_id"
                label="Assign User"
                item-title="name"
                item-value="id"
                :items="users"
                :rules="[requiredValidator]"
              />
            </VCol>

            <VCol
              cols="12"
              md="6"
            >
              <AppTextField
                v-model="formData.price"
                label="Project Price"
                :rules="[requiredValidator]"
              />
            </VCol>

            <VCol
              cols="12"
              md="6"
            >
              <AppTextField
                v-model="formData.time"
                label="Project Timing"
                :rules="[requiredValidator]"
              />
            </VCol>

            <VCol
              cols="12"
              md="6"
            >
              <AppTextField
                v-model="formData.type"
                label="Project Type"
                :rules="[requiredValidator]"
              />
            </VCol>


            <VCol
              cols="12"
              md="6"
            >
              <AppSelect
                v-model="formData.status"
                label="Project Status"
                :rules="[requiredValidator]"
                item-title="name"
                item-value="id"
                :items="projectStatus"
              />
            </VCol>

            <VCol
              cols="12"
              md="6"
            >
              <AppDateTimePicker
                v-model="formData.added_date"
                :rules="[requiredValidator]"
                density="compact"
                placeholder="Select Date"
                :config="{
                  altInput: true,
                  altFormat: 'F j, Y',
                  dateFormat: 'Y-m-d',
                  disableMobile: true,
                }"
              />
            </VCol>

            <VCol
              cols="12"
              md="6"
            >
              <AppDateTimePicker
                v-model="formData.last_worked_on"
                :rules="[requiredValidator]"
                density="compact"
                placeholder="Last Work Date"
                :config="{
                  altInput: true,
                  altFormat: 'F j, Y',
                  dateFormat: 'Y-m-d',
                  disableMobile: true,
                }"
              />
            </VCol>

            <VCol
              cols="12"
              md="12"
            >
              <VTextarea
                v-model="formData.contact_info"
                clearable
                clear-icon="tabler-circle-x"
                label="Contact Info"
              />
            </VCol>

            <VCol
              cols="12"
              md="12"
            >
              <VTextarea
                v-model="formData.description"
                clearable
                clear-icon="tabler-circle-x"
                label="Notes"
              />
            </VCol>

            <VCol
              cols="12"
              class="d-flex flex-wrap gap-4 justify-end"
            >
              <VBtn
                type="submit"
                :loading="isLoading"
                :disabled="isLoading"
                @click="refForm?.validate()"
              >
                Submit
              </VBtn>
              <VBtn
                color="secondary"
                variant="tonal"
                @click="dialogModelValueUpdate(false)"
              >
                Cancel
              </VBtn>
            </VCol>
          </VRow>
        </VForm>
      </VCardText>
    </VCard>
  </VDialog>
</template>
