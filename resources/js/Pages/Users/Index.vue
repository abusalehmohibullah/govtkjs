  
<script setup>

import { Link } from '@inertiajs/vue3';
import AdminLayout from '@/Layouts/AdminLayout.vue';

import UserTable from '@/Pages/Users/Partials/UserTable.vue';
import Header from '@/Components/Header.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';

const { users } = defineProps(['users']);

</script>

<template>
    <AdminLayout title="Users">

        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">

            <Header>
                <template #header>
                    Users
                </template>
                <template #description>
                    Lorem ipsumuasi eniumquam error aspernatsuscipit.
                </template>
                <template #aside>
                    <Link :href="route('users.create')">
                    <PrimaryButton>
                        Invite
                    </PrimaryButton>
                    </Link>
                </template>
            </Header>

            <UserTable :users="users" />

        </div>

    </AdminLayout>
</template>

  