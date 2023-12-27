<script setup>
import useRoles from '@/composables/roles'
import useUsers from '@/composables/users'

// import useGroups from '@/composables/groups'

import {
  emailValidator,
  requiredValidator,
} from '@validators'

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

const { storeUser, respResult, isBusy, errors } = useUsers()
const {  isBusy: rolesLoading, fetchRolesList, roles } = useRoles()

// const { fetchGroupsList, groups, loading: groupsLoading } = useGroups()

const refForm = ref()
const avatarFile = ref('')
const avatarPreview = ref('')
const isPasswordVisible = ref(false)

const initialState = {
  first_name: '',
  last_name: '',
  email: '',
  phone: '',
  address: '',
  password: '',
  password_confirmation: '',
  country: '',
  zip: '',
  state: '',
  role_id: '',
  
}


onMounted(async () => {
  if(props.isDialogVisible){
    await fetchRolesList()

    // await fetchGroupsList()
  }
})

const formData = ref({ ...initialState })
const refInputEl = ref()

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
      
      if(avatarFile.value){
        formNewData.append('avatar', avatarFile.value)
      }


      await storeUser(formNewData)
      if (respResult.value.status === 200) {
        emit('refetchData')
        emit('update:isDialogVisible', false)
        resetFormData()
      }
    }
  })
}


const onFormReset = () => {
  resetFormData()
  emit('update:isDialogVisible', false)
}


// generate random password
const generatePassword = () => {
  const length = 8
  const charset = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'
  let retVal = ''
  for (let i = 0, n = charset.length; i < length; ++i) {
    retVal += charset.charAt(Math.floor(Math.random() * n))
  }
  
  formData.value.password = retVal
  formData.value.password_confirmation = retVal
}


const changeAvatar = file => {
  const fileReader = new FileReader()
  const { files } = file.target
  if (files && files.length) {
    fileReader.readAsDataURL(files[0])
    avatarFile.value = files[0]
    fileReader.onload = () => {
      if (typeof fileReader.result === 'string')
        avatarPreview.value = fileReader.result
    }
  }
}

// reset avatar image
const resetAvatar = () => {
  avatarPreview.value = ''
  avatarFile.value = ''
}

const dialogModelValueUpdate = val => {
  emit('update:isDialogVisible', val)
}
</script>

<template>
  <VDialog
    :width="$vuetify.display.smAndDown ? 'auto' : 800"
    :model-value="props.isDialogVisible"
    @update:model-value="dialogModelValueUpdate"
  >
    <!-- Dialog close btn -->
    <DialogCloseBtn @click="dialogModelValueUpdate(false)" />
    <VCard title="Add New User">
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
              <VTextField
                v-model="formData.first_name"
                label="First Name"
                :rules="[requiredValidator]"
              />
            </VCol>

            <VCol
              cols="12"
              md="6"
            >
              <VTextField
                v-model="formData.last_name"
                label="Last Name"
                :rules="[requiredValidator]"
              />
            </VCol>

            <VCol
              cols="12"
              md="6"
            >
              <VTextField
                v-model="formData.email"
                label="Email"
                :rules="[requiredValidator, emailValidator]"
              />
            </VCol>
            <VCol
              cols="12"
              md="6"
            >
              <VTextField
                v-model="formData.phone"
                label="Phone"
                :rules="[requiredValidator]"
              />
            </VCol>
            <VCol
              cols="12"
              md="12"
            >
              <VTextField
                v-model="formData.address"
                label="Address"
                :rules="[requiredValidator]"
              />
            </VCol>

            <!-- 👉 State -->
            <VCol
              cols="12"
              md="6"
            >
              <VTextField
                v-model="formData.state"
                label="State"
                name="state"
              />
            </VCol>

            <!-- 👉 Zip Code -->
            <VCol
              cols="12"
              md="6"
            >
              <VTextField
                v-model="formData.zip"
                label="Zip Code"
                name="zip"
              />
            </VCol>

            
            <VCol
              cols="12"
              md="6"
            >
              <VSelect
                v-model="formData.role_id"
                label="Role"
                item-title="name"
                item-value="id"
                :items="roles"
                :loading="rolesLoading"
                :rules="[requiredValidator]"
              />
            </VCol>

            
            <VCol
              cols="12"
              md="6"
            >
              <div class="d-flex">
                <VTextField
                  v-model="formData.password"
                  label="Password"
                  :rules="[requiredValidator]"
                  :error-messages="errors.password"
                  :type="isPasswordVisible ? 'text' : 'password'"
                  :append-inner-icon="isPasswordVisible ? 'tabler-eye-off' : 'tabler-eye'"
                  @click:append-inner="isPasswordVisible = !isPasswordVisible"
                />
                <VBtn
                  color="primary"
                  class="ml-2"
                  @click="generatePassword"
                >
                  <VIcon icon="tabler-refresh" />
                </VBtn>
              </div>
            </VCol>

            <VCol
              cols="12"
              md="6"
            >
              <VTextField
                v-model="formData.password_confirmation"
                label="Confirm Password"
                :rules="[requiredValidator]"
                :error-messages="errors.password_confirmation"
                :type="isPasswordVisible ? 'text' : 'password'"
                :append-inner-icon="isPasswordVisible ? 'tabler-eye-off' : 'tabler-eye'"
                @click:append-inner="isPasswordVisible = !isPasswordVisible"
              />
            </VCol>

          

           
            <VCol
              cols="12"
              md="12"
            >
              <div class="d-flex ">
                <!-- 👉 Avatar -->
                <VAvatar
                  rounded
                  size="120"
                  class="me-6 border"
                  :image="avatarPreview"
                />

                <!-- 👉 Upload Photo -->
               
                <div class="d-flex flex-column justify-center gap-4">
                  <div class="d-flex flex-wrap gap-2">
                    <VBtn
                      color="primary"
                      @click="refInputEl?.click()"
                    >
                      <VIcon
                        icon="tabler-cloud-upload"
                        class="d-sm-none"
                      />
                      <span class="d-none d-sm-block">Upload Avatar</span>
                    </VBtn>

                    <input
                      ref="refInputEl"
                      type="file"
                      accept=".jpeg,.png,.jpg,GIF"
                      hidden
                      @input="changeAvatar"
                    >

                    <VBtn
                      type="button"
                      color="secondary"
                      variant="tonal"
                      @click="resetAvatar"
                    >
                      <span class="d-none d-sm-block">Reset</span>
                      <VIcon
                        icon="tabler-refresh"
                        class="d-sm-none"
                      />
                    </VBtn>
                  </div>

                  <p class="text-body-1 mb-0">
                    Allowed JPG, GIF or PNG. Max size of 6MB
                  </p>
                </div>
              </div>
            </VCol>
            <VCol
              cols="12"
              class="d-flex flex-wrap gap-4 justify-end"
            >
              <VBtn
                type="submit"
                :loading="isBusy"
                :disabled="isBusy"
                @click="refForm?.validate()"
              >
                Submit
              </VBtn>
              <VBtn
                color="secondary"
                variant="tonal"
                @click="onFormReset"
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
