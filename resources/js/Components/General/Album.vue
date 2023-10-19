<template>
  <div class="mb-3 py-2 animate-on-scroll" data-animation="fadeIn">
    <div class="shadow-sm bg-white pt-2 rounded">
      <div class="text-2xl font-bold p-2">Image Gallery</div>
      <div class="grid grid-cols-3 grid-rows-1 gap-2 sm:grid-cols-4 sm:grid-rows-1 sm:gap-4 parent-container">
        <div v-for="(album, index) in albums" :key="album.id">
          <!-- Add a v-if directive to check if there are any media in the album -->
          <div v-if="album.media.length > 0" @click="openAlbum(album.id)"
            class="child-container mb-2 animate-on-scroll" data-animation="fadeInUp">
            <div class="d-flex align-items-center position-relative w-full">
              <div class="show-first-child card m-2 w-full hover-deep position-relative">
                <template v-for="(media, mediaIndex) in album.media" :key="mediaIndex">
                  <a :data-fancybox="'album-' + album.id" :href="'/storage/' + media.path"
                    class="child stretched-link" :data-caption="media.caption"></a>
                </template>
                <div class="w-full rounded bg-white border shadow-sm">
                  <div class="w-full ratio ratio-4x3 overflow-hidden">
                    <img :src="album.media.length > 0 ? '/storage/' + album.media[0].path : '/assets/images/album-icon.png'" class="object-cover" />
                  </div>
                  <div class="p-2">
                    <div class="text-gray-700 text-xl font-bold m-0 text-truncate mini-text">
                      <small>{{ album.title }}</small>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- End of v-if directive -->
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { onMounted } from 'vue';

defineProps({
  albums: Object,
});

const openAlbum = (id) => {
  // Use the id parameter in your JavaScript logic
  console.log('[data-fancybox="album-' + id + '"]');

  Fancybox.bind('[data-fancybox="album-' + id + '"]', {
    // Configure Fancybox options here
  });
};

onMounted(() => {
  // Additional setup logic if needed
});
</script>


<style>
.show-first-child .child:not(:first-child) {
  display: none;
}
</style>
