<script setup>

import GeneralLayout from '@/Layouts/GeneralLayout.vue';
import { computed } from 'vue';
import { ref, onMounted } from 'vue';
import { useForm, Link, usePage } from '@inertiajs/vue3';


import AdminLayout from '@/Layouts/AdminLayout.vue';

import Table from '@/Components/Table.vue';
import CreatedUpdatedBy from '@/Components/Admin/CreatedUpdatedBy.vue';
import ToggleStatus from '@/Components/Admin/ToggleStatus.vue';
import PrimaryPaginatorButton from '@/Components/PrimaryPaginatorButton.vue';
import SecondaryPaginatorButton from '@/Components/SecondaryPaginatorButton.vue';
import PrimaryIconButton from '@/Components/PrimaryIconButton.vue';
import SecondaryIconButton from '@/Components/SecondaryIconButton.vue';
import DangerIconButton from '@/Components/DangerIconButton.vue';
import DeleteNoticeForm from '@/Pages/Admin/Notices/Partials/DeleteNoticeForm.vue';

// Define a list of color names
const colorNames = ['red', 'pink', 'violet', 'blue', 'green', 'yellow', 'orange', 'paste'];

// Create a computed property to generate a random color name
const randomColorName = computed(() => {
    const randomIndex = Math.floor(Math.random() * colorNames.length);
    return colorNames[randomIndex];
});

const { notices } = defineProps(['notices']);


const selectedNotice = ref(null);

const formatDate = (dateString) => {
    const date = new Date(dateString);
    const day = date.getDate();
    const month = date.toLocaleString('default', { month: 'short' });
    const year = date.getFullYear();
    return `${day} ${month}, ${year}`;
};


const share = (notice) => {
    if (navigator.share) {
        navigator.share({
            url: route('notice.show', { slug: notice.slug }),
            title: notice.title,
        })
    } else {
        navigator.clipboard.writeText(route('notice.show', { slug: notice.slug }))
    }
}

</script>

<template>
    <GeneralLayout>
        <div class="container p-5">
            <h1 class="font-semibold mb-4 text-center">Notices</h1>
            <Table>
                <template #thead>
                    <tr>
                        <th class="py-2 px-4 border-b bg-slate-200">#</th>
                        <th class="py-2 px-4 border-b bg-slate-200">Notice</th>
                        <th class="py-2 px-4 border-b bg-slate-200">Published</th>
                        <th class="py-2 px-4 border-b bg-slate-200">Attachment</th>
                    </tr>
                </template>
                <template #tbody>

                    <tr v-if="notices.data.length > 0" v-for="(notice, index) in notices.data" :key="index">

                        <td class="border-b">
                            <Link :href="route('notice.show', { slug: notice.slug })" class="px-4 py-2">
                            {{ (notices.current_page - 1) * notices.per_page + index + 1 }}
                            </Link>
                        </td>
                        <td class="border-b">
                            <Link :href="route('notice.show', { slug: notice.slug })" class="py-2">
                            <div class="font-medium text-black">
                                <span class="font-2xl text-slate-700">
                                    {{ notice.heading }} :
                                </span>
                                {{ notice.title }}
                            </div>
                            <!-- <div>{{ notice.content }}</div> -->
                            </Link>
                        </td>
                        <td class="border-b text-center">
                            <Link :href="route('notice.show', { slug: notice.slug })"
                                class="py-2 px-4 text-center whitespace-nowrap">
                            {{ formatDate(notice.published_on) }}
                            </Link>
                        </td>

                        <td class="py-2 px-4 border-b text-center">
                            <div v-if="notice.attachment" class="flex gap-2 justify-center">

                                <a :href="'/storage/' + notice.attachment" target="_blank">
                                    <i
                                        class="fa-solid fa-paperclip px-2 py-2 outline-1 border border-gray-500 rounded hover:bg-gray-800 hover:text-white"></i>
                                </a>
                                <a :href="route('notice.download', notice.id)">
                                    <i
                                        class="fa-solid fa-download px-2 py-2 outline-1 border border-gray-500 rounded hover:bg-gray-800 hover:text-white"></i>
                                </a>
                                <button @click="share(notice)">
                                    <i
                                        class="fa-solid fa-share px-2 py-2 outline-1 border border-gray-500 rounded hover:bg-gray-800 hover:text-white"></i>
                                </button>
                            </div>
                            <div v-else>
                                -
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
        </div>
    </GeneralLayout>
</template>

