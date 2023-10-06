  
<script setup>

import AdminLayout from '@/Layouts/AdminLayout.vue';

import UpdateUserForm from '@/Pages/Users/Partials/UpdateUserForm.vue';

const props = defineProps({
    user: Object,
    userRoles: Object,
    roles: Array,
});

</script>

<template>
    <AdminLayout title="Basic Info">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Edit User
            </h2>
        </template>

        <div>

            <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
                <!-- Use the Form component to wrap your form -->
                <UpdateUserForm :user="user" :userRoles="userRoles" :roles="roles"/>
            </div>


        </div>
    </AdminLayout>
</template>

  