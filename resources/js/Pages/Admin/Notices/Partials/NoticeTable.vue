  
<script setup>
import { ref, onMounted } from 'vue';
import { useForm, Link, usePage } from '@inertiajs/vue3';
import axios from 'axios';
import { router } from '@inertiajs/vue3'

import AdminLayout from '@/Layouts/AdminLayout.vue';

import Table from '@/Components/Table.vue';
import Switch from '@/Components/Switch.vue';
import Radio from '@/Components/Radio.vue';
import PrimaryPaginatorButton from '@/Components/PrimaryPaginatorButton.vue';
import SecondaryPaginatorButton from '@/Components/SecondaryPaginatorButton.vue';
import PrimaryIconButton from '@/Components/PrimaryIconButton.vue';
import SecondaryIconButton from '@/Components/SecondaryIconButton.vue';
import DangerIconButton from '@/Components/DangerIconButton.vue';
import DeleteNoticeForm from '@/Pages/Admin/Notices/Partials/DeleteNoticeForm.vue';


const { notices } = defineProps(['notices']);
const showModal = ref(false);
const selectedNotice = ref(null);

const toggleModal = (notice) => {
    selectedNotice.value = notice;
    showModal.value = !showModal.value;
};

// const updateStatus = (notice) => {
//     // Send an Axios request to update the status on the server.
//     axios.post(`/admin/notices/${notice.id}/status`, { status: notice.status })
//         .then(response => {
//             // Handle success
//             console.log('Status updated successfully');
//         })
//         .catch(error => {
//             // Handle error
//             console.error('Error updating status: ' + error);
//         });
// };


const updateStatus = async (notice) => {
    router.put(`/admin/notices/${notice.id}/status`, {
        status: notice.status,
    }, {
        preserveScroll: true,
    });
};

const formatName = (name) => {
    // Split the name into parts by spaces
    const nameParts = name.split(' ');

    // Capitalize the first letter of each part except the last one
    const formattedName = nameParts
        .map((part, index) => (index === nameParts.length - 1 ? part.charAt(0).toUpperCase() + part.slice(1).toLowerCase() : part.charAt(0).toUpperCase() + '.'))
        .join(' ');

    return formattedName;
};

// Create a function to format the date as "1 January, 2023"
const formatDate = (dateString) => {
    const date = new Date(dateString);
    const day = date.getDate();
    const month = date.toLocaleString('default', { month: 'long' });
    const year = date.getFullYear();
    return `${day} ${month}, ${year}`;
};

// Create a function to format the date as "1 January, 2023"
const formatDateTime = (dateString) => {
    const date = new Date(dateString);
    const day = date.getDate();
    const month = date.toLocaleString('default', { month: 'long' });
    const year = date.getFullYear();

    const dateFormatted = `${day} ${month}, ${year}`;

    // Format the time
    const hours = date.getHours();
    const minutes = date.getMinutes();
    const ampm = hours >= 12 ? 'PM' : 'AM';
    const formattedHours = hours % 12 || 12; // Convert to 12-hour format

    const timeFormatted = `${formattedHours}:${minutes < 10 ? '0' : ''}${minutes} ${ampm}`;

    return `${dateFormatted} at \n${timeFormatted}`;
};




</script>

<template>
    <Table>
        <template #thead>
            <tr>
                <th class="py-2 px-4 border-b bg-slate-200">#</th>
                <th class="py-2 px-4 border-b bg-slate-200">Heading</th>
                <th class="py-2 px-4 border-b bg-slate-200">Notice</th>
                <th class="py-2 px-4 border-b bg-slate-200">Scroll?</th>
                <th class="py-2 px-4 border-b bg-slate-200">Published</th>
                <th class="py-2 px-4 border-b bg-slate-200">Edited</th>
                <th class="py-2 px-4 border-b bg-slate-200">Attachment</th>
                <th class="py-2 px-4 border-b bg-slate-200">Action</th>
            </tr>
        </template>
        <template #tbody>

            <tr v-if="notices.data.length > 0" v-for="(notice, index) in notices.data" :key="index"
                class="hover:bg-blue-100" :class="notice.status === 0 ? 'bg-gray-200 opacity-70' : ''">
                <td class="py-2 px-4 border-b">{{ (notices.current_page - 1) * notices.per_page + index + 1 }}</td>
                <td class="py-2 px-4 border-b">
                    <div class="font-2xl text-slate-500">{{ notice.heading }}</div>
                </td>
                <td class="py-2 px-4 border-b">
                    <div class="font-medium text-slate-500">{{ notice.title }}</div>
                    <div>{{ notice.content }}</div>
                </td>
                <td class="py-2 px-4 border-b text-center">{{ notice.scroll === 1 ? 'Yes' : 'No' }}</td>
                <td class="py-2 px-4 border-b text-center whitespace-nowrap">{{ formatDate(notice.published_on) }}</td>
                <td class="py-2 px-4 border-b text-center">
                    <div v-if="notice.updated_by">
                        <div class="text-xs whitespace-nowrap">
                            {{ formatDateTime(notice.updated_at) }}
                        </div>
                        <div class="text-xs">
                            By <span class="text-blue-700">{{ formatName(notice.user.name) }}</span>
                        </div>
                    </div>
                    <div v-else class="text-gray-500">
                        Not updated yet
                    </div>
                </td>
                <td class="py-2 px-4 border-b text-center">
                    <div v-if="notice.attachment" class="flex gap-1">
                        <div>
                            <SecondaryIconButton class="relative">
                                <a :href="'/storage/' + notice.attachment" target="_blank" class="stretched-link">
                                    <i class="fa-solid fa-eye fa-lg p-0 text-dark"></i>
                                </a>
                            </SecondaryIconButton>
                            <!-- <span class="text-[10px]">View</span> -->
                        </div>
                        <div>
                            <SecondaryIconButton class="relative">
                                <a :href="route('admin.notices.download', notice.id)" class="stretched-link">
                                    <i class="fa-solid fa-download fa-lg p-0 text-dark"></i>
                                </a>
                            </SecondaryIconButton>
                            <!-- <span class="text-[10px]">Save</span> -->
                        </div>
                    </div>
                    <div v-else>
                        -
                    </div>
                </td>
                <td class="py-2 px-4 border-b">
                    <div class="flex justify-center">
                        <div class="form-check form-switch relative">

                            <!-- <form ref="statusForm"> -->
                                <!-- Add a hidden input for the CSRF token here -->
                                <!-- <input type="hidden" name="_token" :value="csrfToken" /> -->

                                <Radio v-model:checked="notice.status" :id="'switch-' + (index + 1)"
                                    class="form-check-input checked:bg-auto checked:bg-right cursor-pointer" type="checkbox" name="status"
                                    :value="notice.status == 1 ? 1 : ''" @change="updateStatus(notice)" />


              
                                    <label :for="'switch-' + (index + 1)" class="py-1 absolute top-[14px] left-0 form-check-label text-[8px] select-none cursor-pointer">
                                        <small :class="notice.status ? 'text-blue-700 font-bold' : ''">
                                            {{ notice.status ? 'SHOWED' : 'HIDDEN' }}
                                        </small>
                                    </label>
                      
                            <!-- </form> -->
                        </div>
                        <!-- <Switch v-model:checked="notice.status" name="status" :id="'switch-' + (index + 1)" @update:checked="updateStatus(notice)"/> -->
                        <!-- <button type="submit" style="display: none;"></button> -->
                        <Link :href="route('admin.notices.edit', notice.id)">
                        <PrimaryIconButton>
                            <i class="fas fa-pen"></i>
                        </PrimaryIconButton>
                        </Link>

                        <!-- Delete button -->
                        <DangerIconButton class="ml-1" @click="() => toggleModal(notice)">
                            <i class="fas fa-trash"></i>
                        </DangerIconButton>

                    </div>
                </td>
            </tr>

            <tr v-else>
                <td colspan="6" class="text-center p-3">
                    Not Data Found
                </td>
            </tr>
        </template>
    </Table>
    <!-- Modal form outside the table -->
    <DeleteNoticeForm :show="showModal" :notice="selectedNotice" @close="toggleModal" />


    <div class="mt-5">
        <template v-for="(link, index) in notices.links">
            <template v-if="link.url">
                <Link :href="link.url">
                <template v-if="link.active">
                    <PrimaryPaginatorButton v-html="link.label" />
                </template>
                <template v-else>
                    <template v-if="index === 0">
                        <SecondaryPaginatorButton v-html="link.label.split(' ')[0].trim()" />
                    </template>
                    <template v-else-if="index === notices.links.length - 1">
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
                <template v-else-if="index === notices.links.length - 1">
                    <SecondaryPaginatorButton v-html="link.label.split(' ')[1].trim()" class='opacity-40' />
                </template>
                <template v-else>
                    <SecondaryPaginatorButton v-html="link.label" />
                </template>
            </template>
        </template>
    </div>
</template>



