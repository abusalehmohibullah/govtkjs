<template>
    <div class="calendar">
        <div class="calendar-header">
            <div class="month-picker w-full flex justify-between">
                <span class="month-change" @click="prevMonth">
                    <pre><i class="fa-solid fa-chevron-left"></i></pre>
                </span>
                <span class="month-picker" id="month-picker" @click="toggleMonthList">{{ currentMonth }}</span>
                <span class="month-change" @click="nextMonth">
                    <pre><i class="fa-solid fa-chevron-right"></i></pre>
                </span>
            </div>
            <div class="year-picker">
                <span id="year">{{ currentYear }}</span>
            </div>
        </div>
        <div class="calendar-body">
            <div class="calendar-week-day">
                <div v-for="day in weekDays" :key="day">{{ day }}</div>
            </div>
            <div class="calendar-days">
                <div v-for="day in calendarDays" :key="day" class="calendar-day-hover"
                    :class="{ 'current-day': day === currentDay }"
                    >
                    {{ day }}
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </div>
        </div>
        <div class="month-list" v-if="showMonthList">
            <div v-for="(month, index) in monthNames" :key="index" @click="selectMonth(index)">
                {{ month }}
            </div>
        </div>
    </div>
</template>
  
<script setup>
import { ref, onMounted, watch, computed } from 'vue';

const currentDay = computed(() => new Date().getDate());
const currentMonth = ref('');
const currentYear = ref('');
const weekDays = ref(['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat']);
const monthNames = ref([
    'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August',
    'September', 'October', 'November', 'December'
]);

const showMonthList = ref(false);



const getDaysInMonth = (year, month) => {
    return new Date(year, month + 1, 0).getDate();
};

const generateCalendar = (month, year) => {
    const calendarDays = [];
    if (month === undefined) month = new Date().getMonth();
    if (year === undefined) year = new Date().getFullYear();
    currentMonth.value = monthNames.value[month];
    currentYear.value = year;

    const firstDayOfMonth = new Date(year, month, 1);
    const daysInMonth = getDaysInMonth(year, month);

    // Determine the day of the week on which the month starts (0 = Sunday, 1 = Monday, etc.)
    const startDayOfWeek = firstDayOfMonth.getDay();

    // Push empty placeholders for the days before the start of the month
    for (let i = 0; i < startDayOfWeek; i++) {
        calendarDays.push('');
    }

    // Push the days of the month
    for (let i = 1; i <= daysInMonth; i++) {
        calendarDays.push(i);
    }

    return calendarDays;
};


const calendarDays = ref(generateCalendar());

const selectMonth = (index) => {
    showMonthList.value = false;
    calendarDays.value = generateCalendar(index, currentYear.value);
};

const prevMonth = () => {
    const currentMonthIndex = monthNames.value.indexOf(currentMonth.value);
    if (currentMonthIndex > 0) {
        selectMonth(currentMonthIndex - 1);
    } else {
        selectMonth(11); // Go to December if currently in January
        currentYear.value--;
        currentMonth.value = 'December'; // Update the current month to December
    }
};

const nextMonth = () => {
    const currentMonthIndex = monthNames.value.indexOf(currentMonth.value);
    if (currentMonthIndex < 11) {
        selectMonth(currentMonthIndex + 1);
    } else {
        selectMonth(0); // Go to January if currently in December
        currentYear.value++;
        currentMonth.value = 'January'; // Update the current month to January
    }
};


const toggleMonthList = () => {
    showMonthList.value = !showMonthList.value;
};

onMounted(() => {
    const currDate = new Date();
    currentMonth.value = monthNames.value[currDate.getMonth()];
    currentYear.value = currDate.getFullYear();
});

// Watch for changes in currentMonth and currentYear
watch([currentMonth, currentYear], () => {
    calendarDays.value = generateCalendar(monthNames.value.indexOf(currentMonth.value), currentYear.value);
});

</script>



<style>
:root {
    --dark-body: #4d4c5a;
    --dark-main: #141529;
    --dark-second: #79788c;
    --dark-hover: #323048;
    --dark-text: #f8fbff;

    --light-body: #f3f8fe;
    --light-main: #fdfdfd;
    --light-second: #c3c2c8;
    --light-hover: #edf0f5;
    --light-text: #151426;

    --blue: #0000ff;
    --white: #fff;

    --shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;

    --font-family: cursive;
}

.dark {
    --bg-body: var(--dark-body);
    --bg-main: var(--dark-main);
    --bg-second: var(--dark-second);
    --color-hover: var(--dark-hover);
    --color-txt: var(--dark-text);
}

.light {
    --bg-body: var(--light-body);
    --bg-main: var(--light-main);
    --bg-second: var(--light-second);
    --color-hover: var(--light-hover);
    --color-txt: var(--light-text);
}

* {
    padding: 0;
    margin: 0;
    box-sizing: border-box;
}

.current-day {
  background-color: #2b9ff2; /* Change this to the desired background color */
  color: #000; /* Change this to the desired text color */
  /* border-radius: 50%; */
  /* Add any other styles you want to apply to the current day */
}

.calendar {
    height: max-content;
    width: max-content;
    background-color: var(--bg-main);
    border-radius: 30px;
    padding: 20px;
    position: relative;
    overflow: hidden;
    /* transform: scale(1.25); */
}

.light .calendar {
    box-shadow: var(--shadow);
}

.calendar-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    font-size: 25px;
    font-weight: 600;
    color: var(--color-txt);
    padding: 10px;
}

.calendar-body {
    padding: 10px;
}

.calendar-week-day {
    height: 50px;
    display: grid;
    grid-template-columns: repeat(7, 1fr);
    font-weight: 600;
}

.calendar-week-day div {
    display: grid;
    place-items: center;
    color: var(--bg-second);
}

.calendar-days {
    display: grid;
    grid-template-columns: repeat(7, 1fr);
    gap: 2px;
    color: var(--color-txt);
}

.calendar-days div {
    width: 50px;
    height: 50px;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 5px;
    position: relative;
    cursor: pointer;
    animation: to-top 1s forwards;
    /* border-radius: 50%; */
}

.calendar-days div span {
    position: absolute;
}

.calendar-days div:hover span {
    transition: width 0.2s ease-in-out, height 0.2s ease-in-out;
}

.calendar-days div span:nth-child(1),
.calendar-days div span:nth-child(3) {
    width: 2px;
    height: 0;
    background-color: var(--color-txt);
}

.calendar-days div:hover span:nth-child(1),
.calendar-days div:hover span:nth-child(3) {
    height: 100%;
}

.calendar-days div span:nth-child(1) {
    bottom: 0;
    left: 0;
}

.calendar-days div span:nth-child(3) {
    top: 0;
    right: 0;
}

.calendar-days div span:nth-child(2),
.calendar-days div span:nth-child(4) {
    width: 0;
    height: 2px;
    background-color: var(--color-txt);
}

.calendar-days div:hover span:nth-child(2),
.calendar-days div:hover span:nth-child(4) {
    width: 100%;
}

.calendar-days div span:nth-child(2) {
    top: 0;
    left: 0;
}

.calendar-days div span:nth-child(4) {
    bottom: 0;
    right: 0;
}

.calendar-days div:hover span:nth-child(2) {
    transition-delay: 0.2s;
}

.calendar-days div:hover span:nth-child(3) {
    transition-delay: 0.4s;
}

.calendar-days div:hover span:nth-child(4) {
    transition-delay: 0.6s;
}

.calendar-days div.curr-date,
.calendar-days div.curr-date:hover {
    background-color: var(--blue);
    color: var(--white);
    border-radius: 50%;
}

.calendar-days div.curr-date span {
    display: none;
}

.month-picker {
    padding: 5px 10px;
    border-radius: 10px;
    cursor: pointer;
}

.month-picker:hover {
    background-color: var(--color-hover);
}

.month-picker {
    display: flex;
    align-items: center;
}

.month-change {
    height: 40px;
    width: 40px;
    border-radius: 50%;
    display: grid;
    place-items: center;
    margin: 0 10px;
    cursor: pointer;
}

.month-change:hover {
    background-color: var(--color-hover);
}

.calendar-footer {
    padding: 10px;
    display: flex;
    justify-content: flex-end;
    align-items: center;
}

.toggle {
    display: flex;
}

.toggle span {
    margin-right: 10px;
    color: var(--color-txt);
}

.month-list {
    position: absolute;
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
    background-color: var(--bg-main);
    padding: 20px;
    grid-template-columns: repeat(3, auto);
    gap: 5px;
    display: grid;
    transform: scale(1.5);
    visibility: hidden;
    pointer-events: none;
}

.month-list.show {
    transform: scale(1);
    visibility: visible;
    pointer-events: visible;
    transition: all 0.2s ease-in-out;
}

.month-list>div {
    display: grid;
    place-items: center;
}

.month-list>div>div {
    width: 100%;
    padding: 5px 20px;
    border-radius: 10px;
    text-align: center;
    cursor: pointer;
    color: var(--color-txt);
}

.month-list>div>div:hover {
    background-color: var(--color-hover);
}

@keyframes to-top {
    0% {
        transform: translateY(100%);
        opacity: 0;
    }

    100% {
        transform: translateY(0);
        opacity: 1;
    }
}
</style>






<!-- <template>
    <div class="aspect-[3/4]">
        <iframe src="https://calendar.google.com/calendar/embed?height=600&wkst=1&bgcolor=%23ffffff&ctz=Asia%2FDhaka&showTitle=0&showTz=0&showPrint=0&showCalendars=0&showTabs=1&showNav=1&showDate=1&mode=MONTH&title&src=NTZmYTA4ZWMwNmZjNzI0MTlkNjk5MzdiMjZhMWYxNmFlNjA5OWFiMjQ4OWIyMDc0OTM1ODQ4MTdjNTY2OGFlN0Bncm91cC5jYWxlbmRhci5nb29nbGUuY29t&src=ZW4uYmQjaG9saWRheUBncm91cC52LmNhbGVuZGFyLmdvb2dsZS5jb20&color=%23A79B8E&color=%230B8043" style="border-width:0" width="100%" height="100%" frameborder="0" scrolling="no"></iframe>
    </div>
</template> -->









<!-- <script setup>

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
    notices: Object,
});
</script> -->


<!-- <template>
    <div class="notice-box shadow-sm bg-[#DFF6FF] px-3 py-2 h-full">
        <div class="d-flex jusify-content-center align-items-center">
            <h3 class="alert-heading deep-color mt-2 large-text">Notice</h3>
            <div class="ms-auto"><a href="https://mdch.edu.bd/education/news">See All</a></div>
        </div>
        <hr>
        <div class="notices">
            <ul>
                <li v-for="notice in notices" class="animate-on-scroll animate__animated animate__fadeInDown"
                    data-animation="fadeInDown" style="animation-delay: 0s;">
                    <Link :href="route('notice.show', { slug: notice.slug })" class="text-nowrap">
                    <div class="flex gap-2">

                        <img src="assets/images/pin.png" alt="" class="h-5">

                        <div class="text-truncate w-full text-base text-gray-600 hover:text-gray-800 relative group">
                            {{ notice.title }}
                            <div
                                class="after:block after:absolute after:bottom-0 after:left-0 after:h-[2px] after:w-0 after:bg-gradient-to-r after:from-indigo-500 group-hover:after:w-full after:transition-all after:duration-300">
                            </div>
                        </div>

                    </div>
                    <div class="text-end mb-2 text-muted"><small>{{ notice.published_on }}</small></div>
                    </Link>
                </li>
            </ul>
        </div>
    </div>
</template> -->


