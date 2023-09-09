<template>
  <div
    class="container notice-container overflow-hidden light-bg flex my-3 p-0 shadow-sm animate-on-load animate__backInUp animate__delay-1s">
    <div class="title flex items-center font-bold z-50 py-1 px-3 bg-white">
      <a href="#" class="text-decoration-none light-color mini-text">Notice</a>
    </div>

    <ul class="d-flex align-items-center text-nowrap" ref="noticeList">
      <li v-for="(notice, index) in notices" :key="index"
        class="whitespace-nowrap px-5 py-1 relative after:content-[''] after:w-1 after:h-1 after:rounded-full after:absolute after:top-1/2 after:right-0 after:bg-black after:last:hidden">
        <a href="#" class="hover-deep text-reset text-decoration-none mini-text">{{ notice }}</a>
      </li>
    </ul>
  </div>
</template>

<script>
export default {
  data() {
    return {
      notices: [
        "Lorem ipsum dolor sit",
        "Lorem ipsum dolor sit",
        "Lorem ipsum dolor sit",
        "Lorem ipsum dolor sit",
        "Lorem ipsum dolor sit",
        "Lorem ipsum dolor sit",
        "Lorem ipsum dolor sit",
        "Lorem ipsum dolor sit",
        "Lorem ipsum dolor sit",
        // Add more notices here
      ],
      animationDuration: 0,
      containerWidth: 0,
      ulWidth: 0,
    };
  },
  mounted() {
    this.initializeScrollAnimation();
  },
  methods: {
    initializeScrollAnimation() {
      const ul = this.$refs.noticeList;
      const container = ul.parentElement;
      this.ulWidth = ul.scrollWidth;
      this.containerWidth = container.offsetWidth;
      this.animationDuration = this.ulWidth / 50; // Adjust this value to change the animation speed

      const style = document.createElement("style");
      style.textContent = `
        .notice-container ul {
          animation: scroll ${this.animationDuration}s infinite linear;
        }

        .notice-container:hover ul {
          animation-play-state: paused;
        }

        @keyframes scroll {
          from {
            transform: translateX(calc(${this.containerWidth}px));
          }
        
          to {
            transform: translateX(calc(-${this.ulWidth}px));
          }
        }
      `;
      document.head.appendChild(style);
    },
  },
};
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