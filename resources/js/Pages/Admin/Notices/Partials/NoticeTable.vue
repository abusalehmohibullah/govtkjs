  
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
import DeleteNoticeForm from '@/Pages/Admin/Notices/Partials/DeleteNoticeForm.vue';


const props = defineProps({
    notices: Object,
});

const showModal = ref(false);
const selectedNotice = ref(null);

const toggleModal = (notice) => {
    selectedNotice.value = notice;
    showModal.value = !showModal.value;
};


</script>

<template>
    <Table>
        <template #thead>
            <tr>
                <th class="py-2 px-4 border-b bg-slate-200">#</th>
                <th class="py-2 px-4 border-b bg-slate-200">Notice</th>
                <th class="py-2 px-4 border-b bg-slate-200">Scroll?</th>
                <th class="py-2 px-4 border-b bg-slate-200">Published</th>
                <th class="py-2 px-4 border-b bg-slate-200">Attachment</th>
                <th class="py-2 px-4 border-b bg-slate-200">Action</th>
            </tr>
        </template>
        <template #tbody>

            <tr v-if="notices.data.length > 0" v-for="(notice, index) in notices.data" :key="index" class="hover:bg-blue-100"
                :class="notice.status === 0 ? 'bg-slate-100' : ''">
                <td class="py-2 px-4 border-b">{{ (notices.current_page - 1) * notices.per_page + index + 1 }}</td>
                <td class="py-2 px-4 border-b">
                    <div class="font-medium text-slate-500">{{ notice.title }}</div>
                    <div>{{ notice.content }}</div>
                </td>
                <td class="py-2 px-4 border-b text-center">{{ notice.scroll === 1 ? 'Yes' : 'No' }}</td>
                <td class="py-2 px-4 border-b text-center">{{ notice.published_on }}</td>
                <td class="py-2 px-4 border-b text-center">{{ notice.attachment }}</td>
                <td class="py-2 px-4 border-b">
                    <div class="flex justify-center">
                        <div class="form-check form-switch relative">
                            <input class="form-check-input checked:bg-auto checked:bg-right" type="checkbox" role="switch"
                                :id="'switch-' + (index + 1)">

                            <!-- <label class="form-check-label" for="flexSwitchCheckDefault">SHOW</label> -->
                            <div class="absolute top-[14px] left-0">
                                <label class="form-check-label text-[8px] select-none"
                                    :for="'switch-' + (index + 1)"><small>SHOWED</small></label>
                            </div>
                        </div>
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



