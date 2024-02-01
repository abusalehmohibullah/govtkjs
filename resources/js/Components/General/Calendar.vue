<script setup>
import { ref, onMounted, watch, computed } from 'vue';

const { events } = defineProps(['events']);

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

    const startDayOfWeek = firstDayOfMonth.getDay();

    for (let i = 0; i < startDayOfWeek; i++) {
        calendarDays.push('');
    }

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
        selectMonth(11);
        currentYear.value--;
        currentMonth.value = 'December';
    }
};

const nextMonth = () => {
    const currentMonthIndex = monthNames.value.indexOf(currentMonth.value);
    if (currentMonthIndex < 11) {
        selectMonth(currentMonthIndex + 1);
    } else {
        selectMonth(0);
        currentYear.value++;
        currentMonth.value = 'January';
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

watch([currentMonth, currentYear], () => {
    calendarDays.value = generateCalendar(monthNames.value.indexOf(currentMonth.value), currentYear.value);
});


const filteredEvents = computed(() => {
    const selectedMonthIndex = monthNames.value.indexOf(currentMonth.value);
    return events.filter(event => new Date(event.start_date).getMonth() === selectedMonthIndex && new Date(event.start_date).getFullYear() === parseInt(currentYear.value));
});

const eventDetails = ref(null);

let oldParameter;
const showEventDetails = (day) => {
    console.log(oldParameter);
    if (oldParameter == day) {
        closeEventDetails();
    } else {
        oldParameter = day;
        eventDetails.value = filteredEvents.value.filter((event) => {
            const startDate = new Date(event.start_date).getDate();
            const endDate = event.end_date ? new Date(event.end_date).getDate() : startDate;
            return day === startDate || (day >= startDate && day <= endDate);
        });
    }
}
const closeEventDetails = () => {
    eventDetails.value = null;
    oldParameter = null;
}

const findEventsByDay = (day) => {

    if (new Date(currentYear.value, monthNames.value.indexOf(currentMonth.value), day).getDay() === 5 || // Friday
        new Date(currentYear.value, monthNames.value.indexOf(currentMonth.value), day).getDay() === 6) { // Saturday
        return 'red'; // Return the style for Fridays and Saturdays
    }

    const matchingEvents = filteredEvents.value.filter((event) => {
        const startDate = new Date(event.start_date).getDate();
        const endDate = event.end_date ? new Date(event.end_date).getDate() : startDate;
        return day === startDate || (day >= startDate && day <= endDate);
    });

    if (matchingEvents.length == 0) {
        return 'black';
    }

    // Check if there are multiple values
    // Check if there are multiple values
    if (matchingEvents.length > 1) {

        // Check if any of the events is a single-day event
        const singleDayEvent = matchingEvents.find((event) => {
            return new Date(event.start_date).getDate() === day && !event.end_date;
        });

        if (singleDayEvent) {
            return [singleDayEvent.color];
        } else {
            // Check if any event is a public holiday or vacation
            const holidayOrVacation = matchingEvents.find((event) => {
                return event.type === 'Public_Holidays' || event.type === 'Vacation';
            });

            if (holidayOrVacation) {
                return [holidayOrVacation.color];
            } else {
                // Return the event with shorter duration
                const shortestEvent = matchingEvents.reduce((min, event) => {
                    return new Date(event.end_date).getDate() - new Date(event.start_date).getDate() < new Date(min.end_date).getDate() - new Date(min.start_date).getDate() ? event : min;
                });
                return [shortestEvent.color];
            }
        }
    }
    return matchingEvents.map((event) => event.color);
};





</script>


<template>
    <div class="calendar bg-white relative overflow-hidden p-3 rounded h-full">
        <div class="text-2xl font-semibold text-center">
            Academic Calendar
        </div>
        <hr class="mb-0 pb-0">
        <div class="calendar-header flex justify-between items-center text-xl font-medium p-2">
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
            <div class="calendar-week-day text-black">
                <div class="m-[1px]" v-for="day in weekDays" :key="day"
                    :class="{ 'text-red-600': day == weekDays[5] || day == weekDays[6] }">{{ day }}</div>
            </div>
            <div class="calendar-days">
                <div v-for="day in calendarDays" :key="day" class="calendar-day-hover relative" @click="showEventDetails(day)"
                    :class="{
                        'border': day === currentDay,
                        'border-2': day === currentDay,
                        'border-gray-400': day === currentDay,
                        'font-semibold': findEventsByDay(day)
                    }" :style="{ color: findEventsByDay(day) }">
                    {{ day }}
                    <!-- <div v-if="day" class="absolute bottom-0 left-0 w-full h-[2px]" :style="{  backgroundColor: findEventsByDay(day) }"></div> -->
                </div>
            </div>
        </div>
        <div v-if="eventDetails" class="absolute top-0 left-0 w-full bg-[#C6DCE4] p-2 font-black">
            <button class="absolute top-1 right-1" @click="closeEventDetails"><i class="bi bi-x-lg"></i></button>
            <div v-for="details in eventDetails" :key="details">
                <div v-if="details.title" class="text-lg">{{ details.title }}</div>
                <div v-if="details.description">{{ details.description }}</div>
            </div>
        </div>
        <div class="month-list flex flex-wrap" :class="{ 'show': showMonthList }">
            <div class="flex justify-center items-center text-xl font-semibold bg-white w-1/3 border cursor-pointer hover:border-slate-400"
                v-for="(month, index) in monthNames" :key="index" @click="selectMonth(index)">
                {{ month }}
            </div>
        </div>
    </div>
</template>

<style>
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
}

.calendar-days {
    display: grid;
    grid-template-columns: repeat(7, 1fr);
    gap: 2px;
}

.calendar-days>div {
    width: 100%;
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

.month-picker {
    padding: 5px 10px;
    border-radius: 10px;
    cursor: pointer;
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

.month-list {
    position: absolute;
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
    visibility: hidden;
    pointer-events: none;
}

.month-list.show {
    transform: scale(1);
    visibility: visible;
    pointer-events: visible;
    transition: all 0.2s ease-in-out;
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


