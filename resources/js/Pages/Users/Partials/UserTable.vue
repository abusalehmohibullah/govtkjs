  
<script setup>
import { ref, reactive } from 'vue';
import { useForm, Link } from '@inertiajs/vue3';
// import { Inertia } from '@inertiajs/vue3';
import AdminLayout from '@/Layouts/AdminLayout.vue';

import Table from '@/Components/Table.vue';
import PrimaryPaginatorButton from '@/Components/PrimaryPaginatorButton.vue';
import SecondaryPaginatorButton from '@/Components/SecondaryPaginatorButton.vue';
import PrimaryIconButton from '@/Components/PrimaryIconButton.vue';
import DangerIconButton from '@/Components/DangerIconButton.vue';
import DeleteUserForm from '@/Pages/Users/Partials/DeleteUserForm.vue';


const props = defineProps({
    users: Object,
});

const showModal = ref(false);
const selectedUser = ref(null);

const toggleModal = (user) => {
    selectedUser.value = user;
    showModal.value = !showModal.value;
};


</script>

<template>
    <Table>
        <template #thead>
            <tr>
                <th class="py-2 px-4 border-b bg-slate-200">#</th>
                <th class="py-2 px-4 border-b bg-slate-200">Photo</th>
                <th class="py-2 px-4 border-b bg-slate-200">User</th>
                <th class="py-2 px-4 border-b bg-slate-200">Role</th>
                <th class="py-2 px-4 border-b bg-slate-200">Extra Ability</th>
                <th class="py-2 px-4 border-b bg-slate-200">Restriction</th>
                <th class="py-2 px-4 border-b bg-slate-200">Action</th>
            </tr>
        </template>
        <template #tbody>

            <tr v-if="users.data.length > 0" v-for="(user, index) in users.data" :key="index" class="hover:bg-blue-100"
                :class="user.status === 0 ? 'bg-slate-100' : ''">
                <td class="py-2 px-4 border-b text-center">{{ (users.current_page - 1) * users.per_page + index + 1 }}</td>
                <td class="py-2 px-4 border-b flex items-center justify-center">
                    <div v-if="user.profile_photo_url != ''"><img :src="user.profile_photo_url" class="d-block h-24 w-20" alt="..."></div>
                    <div v-else class="h-24 w-20 flex justify-center items-center flex-col">
                        <div>No</div>
                        <div>Photo</div>
                        <div>Found</div>
                    </div>
                </td>
                <td class="py-2 px-4 border-b">
                    <div>{{ user.name }}</div>
                    <div>{{ user.email }}</div>

                </td>
                <td class="py-2 px-4 border-b text-center">
                    <div v-if="user.roles.length > 0" class="flex flex-wrap gap-1 justify-center">
                        <div v-for="role in user.roles" :key="role.id"
                            class="bg-gray-800 text-white rounded-full px-2 py-1 capitalize">{{ role.name }}</div>
                        <!-- <div v-for="role in user.roles" :key="role.id" class="flex flex-wrap gap-1">
                            <span v-for="permission in role.permissions" :key="permission.id">
                                {{ permission.name }}
                            </span>
                        </div> -->
                    </div>
                    <div v-else>No roles assigned</div>
                </td>
                <td class="py-2 px-4 border-b text-center">
                    <div v-if="user.extras.length > 0" class="flex flex-wrap gap-1 justify-center">
                        <div v-for="extra in user.extras" :key="extra"
                            class="bg-green-700 text-white rounded-full px-2 py-1 capitalize text-xs">{{ extra.replace(/_/g, ' ')
                            }}</div>
                    </div>
                    <div v-else>No extras permission</div>
                </td>
                <td class="py-2 px-4 border-b text-center">
                    <div v-if="user.restrictions.length > 0" class="flex flex-wrap gap-1 justify-center">
                        <div v-for="restriction in user.restrictions" :key="restriction"
                            class="bg-red-700 text-white rounded-full px-2 py-1 capitalize text-xs">{{ restriction.replace(/_/g, ' ') }}</div>
                    </div>
                    <div v-else>No restrictions</div>
                </td>

                <td class="py-2 px-4 border-b">
                    <div class="flex justify-center">
                        <Link :href="route('admin.users.edit', user.id)">
                        <PrimaryIconButton>
                            <i class="fas fa-pen"></i>
                        </PrimaryIconButton>
                        </Link>

                        <!-- Delete button -->
                        <DangerIconButton class="ml-1" @click="() => toggleModal(user)">
                            <i class="fas fa-trash"></i>
                        </DangerIconButton>

                    </div>
                </td>
            </tr>

            <tr v-else>
                <td colspan="3" class="text-center p-3">
                    Not Data Found
                </td>
            </tr>
        </template>
    </Table>
    <!-- Modal form outside the table -->
    <DeleteUserForm :show="showModal" :user="selectedUser" @close="toggleModal" />
    <div class="mt-5">
        <template v-for="(link, index) in users.links">
            <template v-if="link.url">
                <Link :href="link.url">
                <template v-if="link.active">
                    <PrimaryPaginatorButton v-html="link.label" />
                </template>
                <template v-else>
                    <template v-if="index === 0">
                        <SecondaryPaginatorButton v-html="link.label.split(' ')[0].trim()" />
                    </template>
                    <template v-else-if="index === users.links.length - 1">
                        <SecondaryPaginatorButton v-html="link.label.split(' ')[1].trim()" />
                    </template>
                    <template v-else>
                        <SecondaryPaginatorButton v-html="link.label" />
                    </template>
                </template>
                </Link>
            </template>
            <template v-else>
                <template v-if="index === 0">
                    <SecondaryPaginatorButton v-html="link.label.split(' ')[0].trim()" class='opacity-40' />
                </template>
                <template v-else-if="index === users.links.length - 1">
                    <SecondaryPaginatorButton v-html="link.label.split(' ')[1].trim()" class='opacity-40' />
                </template>
                <template v-else>
                    <SecondaryPaginatorButton v-html="link.label" />
                </template>
            </template>
        </template>

    </div>
</template>



