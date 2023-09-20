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

defineProps({
    sliders : Object,
});
</script>


<template>
    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
      <div class="carousel-indicators">
        <button
          v-for="(slider, key) in sliders"
          :key="key"
          type="button"
          :data-bs-target="'#carouselExampleIndicators'"
          :data-bs-slide-to="key"
          :class="{ active: key === 0 }"
          :aria-label="`Slide ${key + 1}`"
        ></button>
      </div>
      <div class="carousel-inner">
        <div
          v-for="(slider, key) in sliders"
          :key="key"
          class="carousel-item"
          :class="{ active: key === 0 }"
          data-bs-interval="2500"
        >
          <img :src="slider" class="d-block w-full aspect-video" alt="...">
          <div class="carousel-caption d-none d-md-block semitrans-bg">
            <!-- <h5>{{ slider.caption }}</h5> -->
          </div>
        </div>
      </div>
      <button
        v-if="sliders.length > 1"
        class="carousel-control-prev"
        type="button"
        :data-bs-target="'#carouselExampleIndicators'"
        data-bs-slide="prev"
      >
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button
        v-if="sliders.length > 1"
        class="carousel-control-next"
        type="button"
        :data-bs-target="'#carouselExampleIndicators'"
        data-bs-slide="next"
      >
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>
  </template>


