<script setup>
  import { ref, onMounted, reactive } from 'vue';
  import axios from 'axios';
  import { route } from 'ziggy-js';
  import { useForm } from '@inertiajs/vue3';
  

  function search() {
    axios.get(route('get.api.data',{search:searchTerm.data}))
      .then(response => {
        console.log(response.data)
        ResultUsersApi.data = response.data
      })
      .catch(error => {
        console.error('Error:', error);
      });
  }

  let timeout = null
  
  const handleKeyup = (event) => {
  if (event.key === 'Enter') {
    clearTimeout(timeout); // Clear any previous timeouts
    timeout = setTimeout(() => {
      search();
    }, 300); // 300ms delay
  }
};

  const searchTerm = reactive({data: null});

  const ResultUsersApi = reactive({data: null});

  const currentIndex = ref(0);

    const nextImage = () => {
      if (currentIndex.value < ResultUsersApi.data.length - 1) {
        currentIndex.value++;
      }
    };

    const prevImage = () => {
      if (currentIndex.value > 0) {
        currentIndex.value--;
      }
    };



  </script>

<template>
  <div class="flex min-h-screen">
  
    <div class="w-64 bg-gray-800 text-white fixed h-full">
      <div class="p-4">
        <h2 class="text-lg font-semibold">Sidebar</h2>
        <ul class="mt-4">
          <li class="mb-2">
            <a :href="route('render.screen1')" class="block p-2 hover:bg-gray-700 rounded">Screen 1</a>
          </li>
          <li class="mb-2">
            <a :href="route('render.screen2')" class="block p-2 hover:bg-gray-700 rounded">Screen 2</a>
          </li>
          <li class="mb-2">
            <a :href="route('render.screen3')" class="block p-2 hover:bg-gray-700 rounded">Screen 3</a>
          </li>
        </ul>
      </div>
    </div>

    
    <div class="flex-1 ml-64 p-6">

      <div class="max-w-md mx-auto">

        <div class="flex">
          <label for="search" class="block text-sm font-medium text-gray-700 mx-2 my-3">Search:</label>
          <input 
            type="text" 
            id="search" 
            @keyup="handleKeyup" 
            v-model="searchTerm.data"
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
          />
          
        </div>

      </div>

      <hr class="my-2">

      <div v-if="ResultUsersApi.data" class="flex justify-center items-center">
    
        <button @click="prevImage()" class="p-2 bg-gray-200 rounded-full">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
          </svg>
        </button>

      
        <img :src="ResultUsersApi.data[currentIndex].urls.regular" class="mx-4" />

      
        <button @click="nextImage()" class="p-2 bg-gray-200 rounded-full">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
          </svg>
        </button>
      </div>

    </div>

  </div>
</template>
  