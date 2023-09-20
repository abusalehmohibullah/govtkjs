<template>
  <div
    class="container notice-container overflow-hidden bg-white flex my-3 p-0 shadow-sm animate-on-load animate__backInUp animate__delay-1s">
    <div class="title flex items-center font-bold z-50 py-1 px-3 bg-gray-800">
      <a href="#" class="text-decoration-none text-white mini-text">Notice</a>
    </div>

    <ul class="d-flex align-items-center text-nowrap" ref="noticeList">
      <li v-for="(scroll, index) in scrolls" :key="index"
        class="whitespace-nowrap px-5 py-1 relative after:content-[''] after:w-1 after:h-1 after:rounded-full after:absolute after:top-1/2 after:right-0 after:bg-black after:last:hidden">
        <a href="#" class="hover-deep text-reset text-decoration-none mini-text">{{ scroll.title }}</a>
      </li>
    </ul>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
defineProps({
    scrolls : Object,
});
const animationDuration = ref(0);
const containerWidth = ref(0);
const ulWidth = ref(0);

const initializeScrollAnimation = () => {
  const ul = document.querySelector('.notice-container ul');
  const container = ul.parentElement;
  ulWidth.value = ul.scrollWidth;
  containerWidth.value = container.offsetWidth;
  animationDuration.value = ulWidth.value / 50; // Adjust this value to change the animation speed

  const style = document.createElement("style");
  style.textContent = `
    .notice-container ul {
      animation: scroll ${animationDuration.value}s infinite linear;
    }

    .notice-container:hover ul {
      animation-play-state: paused;
    }

    @keyframes scroll {
      from {
        transform: translateX(calc(${containerWidth.value}px));
      }
    
      to {
        transform: translateX(calc(-${ulWidth.value}px));
      }
    }
  `;
  document.head.appendChild(style);
};

onMounted(() => {
  initializeScrollAnimation();
});
</script>


<style scoped>
@keyframes scroll {
  from {
    transform: translateX(100%);
  }

  to {
    transform: translateX(-100%);
  }
}
</style>




<!-- 
<template>
    <div
        class="container notice-container overflow-hidden light-bg flex my-3 p-0 shadow-sm animate-on-load animate__backInUp animate__delay-1s">
        <div class="title flex items-center font-bold z-50 py-1 px-3">
            <a href="#" class="text-decoration-none light-color mini-text">Notice</a>
        </div>

        <ul class="d-flex align-items-center text-nowrap">

            <li class="whitespace-nowrap px-5 py-1 relative after:content-[''] after:w-1 after:h-1 after:rounded-full after:absolute after:top-1/2 after:right-0 after:bg-black after:last:hidden"><a href="#" class="hover-deep text-reset text-decoration-none mini-text">Lorem ipsum dolor sit</a></li>
            <li class="whitespace-nowrap px-5 py-1 relative after:content-[''] after:w-1 after:h-1 after:rounded-full after:absolute after:top-1/2 after:right-0 after:bg-black after:last:hidden"><a href="#" class="hover-deep text-reset text-decoration-none mini-text">Lorem ipsum dolor sit</a></li>
            <li class="whitespace-nowrap px-5 py-1 relative after:content-[''] after:w-1 after:h-1 after:rounded-full after:absolute after:top-1/2 after:right-0 after:bg-black after:last:hidden"><a href="#" class="hover-deep text-reset text-decoration-none mini-text">Lorem ipsum dolor sit</a></li>
            <li class="whitespace-nowrap px-5 py-1 relative after:content-[''] after:w-1 after:h-1 after:rounded-full after:absolute after:top-1/2 after:right-0 after:bg-black after:last:hidden"><a href="#" class="hover-deep text-reset text-decoration-none mini-text">Lorem ipsum dolor sit</a></li>
            <li class="whitespace-nowrap px-5 py-1 relative after:content-[''] after:w-1 after:h-1 after:rounded-full after:absolute after:top-1/2 after:right-0 after:bg-black after:last:hidden"><a href="#" class="hover-deep text-reset text-decoration-none mini-text">Lorem ipsum dolor sit</a></li>
            <li class="whitespace-nowrap px-5 py-1 relative after:content-[''] after:w-1 after:h-1 after:rounded-full after:absolute after:top-1/2 after:right-0 after:bg-black after:last:hidden"><a href="#" class="hover-deep text-reset text-decoration-none mini-text">Lorem ipsum dolor sit</a></li>
            <li class="whitespace-nowrap px-5 py-1 relative after:content-[''] after:w-1 after:h-1 after:rounded-full after:absolute after:top-1/2 after:right-0 after:bg-black after:last:hidden"><a href="#" class="hover-deep text-reset text-decoration-none mini-text">Lorem ipsum dolor sit</a></li>
            <li class="whitespace-nowrap px-5 py-1 relative after:content-[''] after:w-1 after:h-1 after:rounded-full after:absolute after:top-1/2 after:right-0 after:bg-black after:last:hidden"><a href="#" class="hover-deep text-reset text-decoration-none mini-text">Lorem ipsum dolor sit</a></li>
            <li class="whitespace-nowrap px-5 py-1 relative after:content-[''] after:w-1 after:h-1 after:rounded-full after:absolute after:top-1/2 after:right-0 after:bg-black after:last:hidden"><a href="#" class="hover-deep text-reset text-decoration-none mini-text">Lorem ipsum dolor sit</a></li>
            <li class="whitespace-nowrap px-5 py-1 relative after:content-[''] after:w-1 after:h-1 after:rounded-full after:absolute after:top-1/2 after:right-0 after:bg-black after:last:hidden"><a href="#" class="hover-deep text-reset text-decoration-none mini-text">Lorem ipsum dolor sit</a></li>
            <li class="whitespace-nowrap px-5 py-1 relative after:content-[''] after:w-1 after:h-1 after:rounded-full after:absolute after:top-1/2 after:right-0 after:bg-black after:last:hidden"><a href="#" class="hover-deep text-reset text-decoration-none mini-text">Lorem ipsum dolor sit</a></li>
            <li class="whitespace-nowrap px-5 py-1 relative after:content-[''] after:w-1 after:h-1 after:rounded-full after:absolute after:top-1/2 after:right-0 after:bg-black after:last:hidden"><a href="#" class="hover-deep text-reset text-decoration-none mini-text">Lorem ipsum dolor sit</a></li>

        </ul>

    </div>
</template>


<script>
  
  const ul = document.querySelector(".notice-container ul");
const container = document.querySelector(".notice-container");
const ulWidth = ul.scrollWidth;
const containerWidth = container.offsetWidth;
const animationDuration = ulWidth / 60; // adjust this value to change the animation speed
const style = document.createElement("style");

style.textContent = `
  .notice-container ul {
    animation: scroll ${animationDuration}s infinite linear;
  }

  .notice-container:hover ul {
    animation-play-state: paused;
  }

  @keyframes scroll {
    from {
      transform: translateX(calc(${containerWidth}px));
    }
  
    to {
      transform: translateX(calc(-${ulWidth}px));
    }
  }
`;

</script>
<style>

@keyframes scroll {
    from {
        transform: translateX(100%);
    }

    to {
        transform: translateX(-100%);
    }
}
</style> -->