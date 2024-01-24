  
<script setup>

import { useForm } from '@inertiajs/vue3';
import RolePermission from '@/Components/Admin/RolePermission.vue';
import FormSection from '@/Components/FormSection.vue';
import ActionMessage from '@/Components/ActionMessage.vue';
import TextInput from '@/Components/TextInput.vue';
import InputLabel from '@/Components/InputLabel.vue';
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SelectInput from '@/Components/SelectInput.vue';

const props = defineProps({
    roles: Array,
});

const form = useForm({
    email: '',
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

const inviteUser = () => {
    form.post(route('admin.user-invitations.store'), {
        errorBag: 'inviteUser',
        preserveScroll: true,
    });
};

</script>

<template>
    <div>
        <!-- Use the Form component to wrap your form -->
        <FormSection @submitted="inviteUser">
            <template #title>
                Invite Users
            </template>

            <template #description>
                Ensure your account is using a long, random password to stay secure.
            </template>

            <template #form>
                <!-- Use the Text Input component for each form field -->

                <div class="col-span-6 sm:col-span-4">
                    <InputLabel for="email" value="Email Address">
                        <template #required>*</template>
                    </InputLabel>
                    <TextInput id="email" v-model="form.email" required class="mt-1 block w-full"
                        :class="{ 'border-red-500 focus:border-red-500': form.errors.email }" type="email" name="email" />
                    <InputError :message="form.errors.email" class="text-red-500" />
                </div>

                <RolePermission :roles="roles"
                    @selected-roles-updated="handleSelectedRolesUpdated"
                    @selected-permissions-updated="handleSelectedPermissionsUpdated" />

            </template>

            <template #actions>
                <ActionMessage :on="form.processing" class="mr-3"
                    :class="{ 'text-green-600': form.recentlySuccessful, ' text-gray-600': form.processing }">
                    {{ form.processing ? 'Inviting...' : (form.recentlySuccessful ? 'Invited!' : 'Failed') }}
                </ActionMessage>

                <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Invite</PrimaryButton>
            </template>
        </FormSection>
    </div>
</template>