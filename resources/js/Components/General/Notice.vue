<script setup>

import { Head, Link, router } from '@inertiajs/vue3';
import ApplicationMark from '@/Components/ApplicationMark.vue';
import { ref, watchEffect } from 'vue';
import { usePage } from '@inertiajs/vue3';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import NavLink from '@/Components/NavLink.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';

const page = usePage();
const show = ref(true);
const style = ref('success');
const message = ref('');

watchEffect(async () => {
    style.value = page.props.jetstream.flash?.bannerStyle || 'success';
    message.value = page.props.jetstream.flash?.banner || '';
    show.value = true;
});


// const showingNavigationDropdown = ref(false);

const switchToTeam = (team) => {
    router.put(route('current-team.update'), {
        team_id: team.id,
    }, {
        preserveState: false,
    });
};

const logout = () => {
    router.post(route('logout'));
};
</script>


<template>
    <div class="notice-box shadow-sm bg-white px-3 py-2 h-full">
        <div class="d-flex jusify-content-center align-items-center">
            <h3 class="alert-heading deep-color mt-2 large-text">Notice</h3>
            <div class="ms-auto"><a href="https://mdch.edu.bd/education/news">See All</a></div>
        </div>
        <hr>
        <div class="notices">
            <ul>
                <li class="animate-on-scroll animate__animated animate__fadeInDown" data-animation="fadeInDown"
                    style="animation-delay: 0s;">
                    <a href="https://mdch.edu.bd/education/news/2022-2023-sikshabrshe-dental-klej-oo-medikel-klej-dental-iunitsmuuhe-bidies-korse-vrti-bijngpti"
                        class="hover-deep text-reset text-decoration-none text-nowrap">
                        <div class="text-truncate mini-text">
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Esse suscipit consectetur a fugiat
                            commodi ut ab, mollitia explicabo necessitatibus! Ad dignissimos illum nemo animi quaerat
                            impedit cumque odit voluptatibus laborum.
                        </div>
                        <div class="text-end mb-2 text-muted"><small>25 July, 2023</small></div>
                    </a>
                </li>
                <li class="animate-on-scroll animate__animated animate__fadeInDown" data-animation="fadeInDown"
                    style="animation-delay: 0s;">
                    <a href="https://mdch.edu.bd/education/news/2022-2023-sikshabrshe-dental-klej-oo-medikel-klej-dental-iunitsmuuhe-bidies-korse-vrti-bijngpti-oo-smuuh-tarikh"
                        class="hover-deep text-reset text-decoration-none text-nowrap">
                        <div class="text-truncate mini-text">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Recusandae quaerat quas voluptates quia
                            voluptas repudiandae reprehenderit blanditiis distinctio, ea tempora accusamus modi quae totam
                            deleniti tenetur in facere, odio officiis.
                        </div>
                        <div class="text-end mb-2 text-muted"><small>25 July, 2023</small></div>
                    </a>
                </li>
                <li class="animate-on-scroll animate__animated animate__fadeInDown" data-animation="fadeInDown"
                    style="animation-delay: 0s;">
                    <a href="https://mdch.edu.bd/education/news/2022-2023-sikshabrshe-dental-klej-oo-medikel-klej-dental-iunitsmuuhe-bidies-korse-vrti-bijngpti-oo-smuuh-tarikh"
                        class="hover-deep text-reset text-decoration-none text-nowrap">
                        <div class="text-truncate mini-text">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Recusandae quaerat quas voluptates quia
                            voluptas repudiandae reprehenderit blanditiis distinctio, ea tempora accusamus modi quae totam
                            deleniti tenetur in facere, odio officiis.
                        </div>
                        <div class="text-end mb-2 text-muted"><small>25 July, 2023</small></div>
                    </a>
                </li>
                <li class="animate-on-scroll animate__animated animate__fadeInDown" data-animation="fadeInDown"
                    style="animation-delay: 0s;">
                    <a href="https://mdch.edu.bd/education/news/2022-2023-sikshabrshe-dental-klej-oo-medikel-klej-dental-iunitsmuuhe-bidies-korse-vrti-bijngpti-oo-smuuh-tarikh"
                        class="hover-deep text-reset text-decoration-none text-nowrap">
                        <div class="text-truncate mini-text">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Recusandae quaerat quas voluptates quia
                            voluptas repudiandae reprehenderit blanditiis distinctio, ea tempora accusamus modi quae totam
                            deleniti tenetur in facere, odio officiis.
                        </div>
                        <div class="text-end mb-2 text-muted"><small>25 July, 2023</small></div>
                    </a>
                </li>
                <li class="animate-on-scroll animate__animated animate__fadeInDown" data-animation="fadeInDown"
                    style="animation-delay: 0s;">
                    <a href="https://mdch.edu.bd/education/news/2022-2023-sikshabrshe-dental-klej-oo-medikel-klej-dental-iunitsmuuhe-bidies-korse-vrti-bijngpti-oo-smuuh-tarikh"
                        class="hover-deep text-reset text-decoration-none text-nowrap">
                        <div class="text-truncate mini-text">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Recusandae quaerat quas voluptates quia
                            voluptas repudiandae reprehenderit blanditiis distinctio, ea tempora accusamus modi quae totam
                            deleniti tenetur in facere, odio officiis.
                        </div>
                        <div class="text-end mb-2 text-muted"><small>25 July, 2023</small></div>
                    </a>
                </li>
                <li class="animate-on-scroll animate__animated animate__fadeInDown" data-animation="fadeInDown"
                    style="animation-delay: 0s;">
                    <a href="https://mdch.edu.bd/education/news/2022-2023-sikshabrshe-dental-klej-oo-medikel-klej-dental-iunitsmuuhe-bidies-korse-vrti-bijngpti-oo-smuuh-tarikh"
                        class="hover-deep text-reset text-decoration-none text-nowrap">
                        <div class="text-truncate mini-text">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Recusandae quaerat quas voluptates quia
                            voluptas repudiandae reprehenderit blanditiis distinctio, ea tempora accusamus modi quae totam
                            deleniti tenetur in facere, odio officiis.
                        </div>
                        <div class="text-end mb-2 text-muted"><small>25 July, 2023</small></div>
                    </a>
                </li>
                <li class="animate-on-scroll animate__animated animate__fadeInDown" data-animation="fadeInDown"
                    style="animation-delay: 0s;">
                    <a href="https://mdch.edu.bd/education/news/2022-2023-sikshabrshe-dental-klej-oo-medikel-klej-dental-iunitsmuuhe-bidies-korse-vrti-bijngpti-oo-smuuh-tarikh"
                        class="hover-deep text-reset text-decoration-none text-nowrap">
                        <div class="text-truncate mini-text">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Recusandae quaerat quas voluptates quia
                            voluptas repudiandae reprehenderit blanditiis distinctio, ea tempora accusamus modi quae totam
                            deleniti tenetur in facere, odio officiis.
                        </div>
                        <div class="text-end mb-2 text-muted"><small>25 July, 2023</small></div>
                    </a>
                </li>
        </ul>
    </div>
</div></template>


