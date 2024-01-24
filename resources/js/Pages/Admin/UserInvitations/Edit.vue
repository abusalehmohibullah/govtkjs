  
<script setup>

import AdminLayout from '@/Layouts/AdminLayout.vue';

import UpdateUserInvitationForm from '@/Pages/Admin/UserInvitations/Partials/UpdateUserInvitationForm.vue';

const props = defineProps({
    user: Object,
    roles: Array,
    userRoles: Object,
    userPermissions: Array,
});

</script>

<template>
    <AdminLayout title="Basic Info">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Edit Invitation
            </h2>
        </template>

        <div>

            <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
                <!-- Use the Form component to wrap your form -->
                <UpdateUserInvitationForm :user="user" :userPermissions="userPermissions" :roles="roles" :userRoles="userRoles" />
            </div>


        </div>
    </AdminLayout>
</template>

  