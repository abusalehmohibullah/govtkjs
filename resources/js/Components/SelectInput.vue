<script setup>
import { ref, defineProps, defineEmits, watch, onMounted } from 'vue';

const props = defineProps({
  options: Array,
  selectedOption: Array,
  inputName: String,
  fieldName: String,
  valueField: String,
});

const emit = defineEmits();

const selected = ref(null);
const optionsContainer = ref(null);
const optionsContainerIsOpen = ref(false);
const selectedLabel = ref('Select an Option');
const selectedId = ref(null);
const searchTerm = ref('');
const localOptions = ref([]);

const isSelected = (option) => {
  return option[props.fieldName] === selectedLabel.value ? 'selected' : '';
};

const filterList = () => {
  const searchTermLower = searchTerm.value.toLowerCase();
  localOptions.value = props.options.filter((option) =>
    option[props.fieldName].toLowerCase().includes(searchTermLower)
  );
};

const toggleOptionsContainer = () => {
  optionsContainerIsOpen.value = !optionsContainerIsOpen.value;
  if (optionsContainer.value) {
    // Example: selected.value.classList.toggle('expanded');
    searchTerm.value = '';
    filterList();
  }
};

const handleOptionClick = (option) => {
  selectedLabel.value = option[props.fieldName];
  selectedId.value = option[props.valueField];
  optionsContainerIsOpen.value = false;
  if (optionsContainer.value) {
    // Example: selected.value.classList.remove('expanded');
  }
  emit('option-selected', option[props.valueField]);
};

watch(() => props.options, (newValue, oldValue) => {
  localOptions.value = [...newValue];
  selectedLabel.value = 'Select an Option';
      selectedId.value = null;
});

onMounted(() => {
  // Set localOptions initially with the provided props.options
  selected.value = document.querySelector('.selected');
  optionsContainer.value = document.querySelector('.options-container');

  // Set the initially selected option based on the propSelectedOption
  if (props.selectedOption) {
      selectedLabel.value = props.selectedOption[props.fieldName];
      selectedId.value = props.selectedOption[props.valueField];
  }
});
</script>



<template>
  <!-- <pre>{{ localOptions }}</pre> -->
    <div class="select-box relative flex flex-col">
        <div class="selected relative mb-4 order-none border border-gray-300 active:border-indigo-500 active:ring-indigo-500 rounded-md shadow-sm flex justify-between items-center"
            @click="toggleOptionsContainer">
            {{ selectedLabel }}
            <i class="icon fa-solid"
                :class="{ 'fa-chevron-up': optionsContainerIsOpen, 'fa-chevron-down': !optionsContainerIsOpen }"></i>
        </div>

        <div class="options-container border border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
            :class="{ 'active': optionsContainerIsOpen }">
            <div v-if="localOptions.length === 0" class="option">
                <label>No matching options found</label>
            </div>
            <div v-for="(option, index) in localOptions" :key="index" @click="handleOptionClick(option)">
                <div class="option border-gray-700 focus:border-indigo-500 focus:ring-indigo-500 hover:bg-indigo-200 hover:text-indigo-900 rounded-md shadow-sm"
                    :class="{ 'bg-indigo-100': isSelected(option) }">
                    <input type="radio" class="radio" :id="option.id" :name="inputName" :value="option[valueField]" />
                    <label :for="option.id">{{ option[fieldName] }}</label>
                </div>
            </div>
        </div>

        <div class="search-box">
            <input v-model="searchTerm"
                class="border border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                type="text" placeholder="Start Typing..." @keyup="filterList" />
        </div>
    </div>
</template>




<style>
.expanded {
    border-color: #6366f1;
    /* Adjust the color as needed */
    box-shadow: 0 0 0 2px rgba(99, 102, 241, 0.5);
    /* Adjust the color and spread as needed */
}

.select-box .options-container {

    max-height: 0;
    width: 100%;
    opacity: 0;
    transition: all 0.4s;
    overflow: hidden;

    order: 1;
}


.selected::after {
    content: "";
    background: url("img/arrow-down.svg");
    background-size: contain;
    background-repeat: no-repeat;

    position: absolute;
    height: 100%;
    width: 32px;
    right: 10px;
    top: 5px;

    transition: all 0.4s;
}

.select-box .options-container.active {
    max-height: 240px;
    opacity: 1;
    overflow-y: scroll;
    margin-top: 50px;
}

.select-box .options-container.active+.selected::after {
    transform: rotateX(180deg);
    top: -6px;
}

.select-box .options-container::-webkit-scrollbar {
    width: 8px;

}


.select-box .option,
.selected {
    padding: 8px 16px;
    cursor: pointer;
    font-size: 16px;
}


.select-box label {
    cursor: pointer;
}

.select-box .option .radio {
    display: none;
}

/* Searchbox */

.search-box input {
    width: 100%;

    position: absolute;
    z-index: 100;

    opacity: 0;
    pointer-events: none;
    transition: all 0.4s;
}

.search-box input:focus {
    outline: none;
}

.select-box .options-container.active~.search-box input {
    opacity: 1;
    pointer-events: auto;
}
</style>