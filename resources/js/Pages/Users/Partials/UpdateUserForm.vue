  
<script setup>
import { useForm } from '@inertiajs/vue3';
import { ref } from 'vue';

import FormSection from '@/Components/FormSection.vue';
import RolePermission from '@/Components/Admin/RolePermission.vue';
import ActionMessage from '@/Components/ActionMessage.vue';
import TextInput from '@/Components/TextInput.vue';
import TextArea from '@/Components/TextArea.vue';
import InputLabel from '@/Components/InputLabel.vue';
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';

const props = defineProps({
    user: Object,
    roles: Array,
    userRoles: Object,
    userPermissions: Array,
});

const form = useForm({
    _method: 'PUT',
    selectedRoles: [], // Add your selected roles array here
    selectedPermissions: [], // Add your selected permissions array here
    // Other form fields
});

const handleSelectedRolesUpdated = (newSelectedRoles) => {
    // console.log('Selected Roles Updated:', newSelectedRoles);
    form.selectedRoles = newSelectedRoles;
};

const handleSelectedPermissionsUpdated = (newSelectedPermissions) => {
    // console.log('Selected Permissions Updated:', newSelectedPermissions);
    form.selectedPermissions = newSelectedPermissions;
};

console.log(form);
const updateUser = () => {
    form.post(route('admin.users.update', props.user.id), {
        errorBag: 'updateUser',
        preserveScroll: true,
    });
};




</script>

<template>
    <div>
        <!-- Use the Form component to wrap your form -->
        <FormSection @submitted="updateUser">
            <template #title>
                Edit User Permissions
            </template>

            <template #description>
                Ensure your account is using a long, random password to stay secure.
            </template>

            <template #form>
                <!-- Use the Text Input component for each form field -->

                <div class="col-span-6 sm:col-span-4">

                    <div class="flex items-center gap-2">
                        <img :src="user.profile_photo_url" :alt="user.name" class="rounded-full h-20 w-20 object-cover">
                        <div>

                            <div class="font-bold text-2xl"> {{ user.name }}</div>

                            <div class="text-base"> {{ user.email }}</div>
                        </div>
                    </div>
                </div>

                <RolePermission :user="user" :roles="roles" :userRoles="userRoles" :userPermissions="userPermissions"
                    @selected-roles-updated="handleSelectedRolesUpdated"
                    @selected-permissions-updated="handleSelectedPermissionsUpdated" />


            </template>

            <template #actions>
                <ActionMessage :on="form.processing" class="mr-3"
                    :class="{ 'text-green-600': form.recentlySuccessful, ' text-gray-600': form.processing }">
                    {{ form.processing ? 'Saving...' : (form.recentlySuccessful ? 'Saved!' : 'Failed') }}
                </ActionMessage>

                <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Save</PrimaryButton>
            </template>


        </FormSection>
    </div>
</template>