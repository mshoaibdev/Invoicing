<script setup>
import useRoles from '@/composables/roles'
import useUsers from '@/composables/users'
import useCompanies from '@/composables/companies'


import {
  emailValidator,
  requiredValidator,
} from '@validators'

const props = defineProps({
  isDialogVisible: {
    type: Boolean,
    required: true,
  },
  userId: {
    type: Number,
    required: true,
  },
})

const emit = defineEmits([
  'refetchData',
  'update:isDialogVisible',
])

const { updateUser,  respResult, isLoading, errors, getUser, user } = useUsers()
const {  isLoading: rolesLoading, fetchRolesList, roles } = useRoles()
const {  isLoading: companiesLoading, fetchCompaniesList, companies } = useCompanies()


const refForm = ref()
const refInputEl = ref()
const formData = ref({})
const originalData = ref({})
const avatarFile = ref('')
const avatarPreview = ref('')
const isPasswordVisible = ref(false)

onMounted(async () => {
  if(props.isDialogVisible){
    await getUser(props.userId)
    await fetchRolesList()
    await fetchCompaniesList()
    formData.value = {
      ...user.value,
      role_id: user.value.roles[0]?.id,
      companies: user.value.companies.map(company => company.id),
    }
    avatarPreview.value = originalData.value.avatar_url
  }
})

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

const onSubmit = async() => {
  refForm.value?.validate().then(async ({ valid: isValid }) => {
    if (isValid){
      const formNewData = new FormData()

      formNewData.append('first_name', formData.value.first_name)
      formNewData.append('last_name', formData.value.last_name)
      formNewData.append('email', formData.value.email)
      formNewData.append('phone', formData.value.phone)
      formNewData.append('address', formData.value.address)
      formNewData.append('state', formData.value.state ?? '')
      formNewData.append('zip', formData.value.zip ?? '')
      formNewData.append('role_id', formData.value.role_id)
      formNewData.append('password', formData.value.password ?? '')
      formNewData.append('password_confirmation', formData.value.password_confirmation ?? '')

      if (formData.value.companies.length) {
        formData.value.companies.forEach(company => {
          formNewData.append('companies[]', company)
        })
      }
      
      if(avatarFile.value){
        formNewData.append('avatar', avatarFile.value)
        formNewData.append('is_avatar_removed', true)
      }
      formNewData.append('_method', 'PUT')
      await updateUser(formNewData, formData.value.id)
      if (respResult.value.status === 200) {
        emit('refetchData')
        emit('update:isDialogVisible', false)
      }
    }
  })
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
    <VCard title="Update User">
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
              md="12"
            >
              <VSelect
                v-model="formData.companies"
                label="Select Company"
                item-title="name"
                item-value="id"
                multiple
                :items="companies"
                :loading="companiesLoading"
                :rules="[requiredValidator]"
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
                :loading="isLoading"
                :disabled="isLoading"
                @click="refForm?.validate()"
              >
                Update User
              </VBtn>
            </VCol>
          </VRow>
        </VForm>
      </VCardText>
    </VCard>
  </VDialog>
</template>
