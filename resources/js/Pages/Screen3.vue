<script setup>
  import { ref, onMounted, reactive } from 'vue';
  import axios from 'axios';
  import { route } from 'ziggy-js';
  import { useForm } from '@inertiajs/vue3';
    
  const ResultApi = reactive({data: null});

  function toggleColor(row,col) {
    console.log('yesye')
    axios.post(route('set.api.color',{array:ResultApi.data,row:row,col:col}))
      .then(response => {
        ResultApi.data=response.data
      })
      .catch(error => {
        console.error('Error:', error);
      });
  }

  onMounted(()=>{
    axios.get(route('get.api.color'))
      .then(response => {
        console.log(response.data)
        ResultApi.data=response.data
      })
      .catch(error => {
        console.error('Error:', error);
      });
  })

</script>

<template>
  <div class="flex min-h-screen">
    <!-- Sidebar -->
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
      <div class="max-w-2xl mx-auto">
        <!-- 3x3 Grid -->
        <div class="grid grid-cols-3 gap-2 w-[600px] h-[600px]">
          <!-- Outer loop for rows -->
          <div v-for="(row, rowIndex) in ResultApi.data" :key="rowIndex">
            <!-- Inner loop for columns -->
            <div
              v-for="(col, colIndex) in row"
              :key="`${rowIndex}-${colIndex}`"
              @click="toggleColor(rowIndex, colIndex)"
              class="w-48 h-48 border border-white"
              :class="{ 'bg-blue-500': col === true, 'bg-red-500': col === false }"
            ></div>
          </div>
        </div>
      </div>
  </div>

  </div>
</template>
  